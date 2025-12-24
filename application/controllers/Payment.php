<?php

use Stripe\Stripe;
use Stripe\PaymentIntent;

class Payment extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('calc_discount');
        $this->load->model('order_model');
        $this->load->library('encryption');
    }

    function index($enc_order_id = null)
    {
        // 🚫 Must come ONLY from checkout
        if (!$this->session->userdata('payment_pending')) {
            redirect('Shop');
            exit;
        }


        $order_id = $this->encryption->decrypt(base64_decode(urldecode($enc_order_id)));
        $data['order'] = $this->order_model->getOrderSummary($order_id);
        $data['order_details'] = $this->order_model->getOrderItems($order_id);

        load_views('payment', $data);
    }

    function get_intent()
    {
        // STRIPE_KEY
        // STRIPE_SECRET
        Stripe::setApiKey(STRIPE_SECRET);

        $order_id = $this->input->post('order_id');

        $order_details = $this->order_model->getOrderItems($order_id);

        $order = $this->order_model->getOrderSummary($order_id);

        $subtotal = 0;
        foreach ($order_details as $od) {
            $subtotal += $od->price * $od->quantity;
        }

        $coupon = (object) [
            'discount_type'  => $order->discount_type,
            'discount_value' => $order->discount_value
        ];

        $discount = calculate_discount($subtotal, $coupon);
        $grand_total = $subtotal - $discount;
        $amount = (int) round($grand_total * 100);

        $intent = PaymentIntent::create([
            'amount' => $amount, // amount in cents
            'currency' => 'inr',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);

        // store intent in db 
        $this->order_model->updatePaymentIntent($order_id, $intent->id);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'clientSecret' => $intent->client_secret
            ]));
    }


    public function check($enc_order_id)
    {
        $order_id = $this->encryption->decrypt(base64_decode(urldecode($enc_order_id)));

        $order = $this->order_model->getOrderSummary($order_id);

        if (!$order) {
            echo json_encode(['status' => 'invalid']);
            return;
        }

        echo json_encode([
            'payment_status' => $order->payment_status,
            'order_status'   => $order->order_status
        ]);
    }

    // function success($order_id)
    // {
    //     // $order = $this->order_model->getOrderPaymentStatusById($order_id);
    //     $data['order'] = $this->order_model->getOrderSummary($order_id);
    //     $order = $data['order'];
    //     if ($order->payment_status === 'paid') {
    //         load_views('thank_you', $data);
    //     } else {
    //         load_views('payment_processing', $data);
    //     }
    // }
}
