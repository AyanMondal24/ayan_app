<?php

use Stripe\Stripe;

class Thank_you extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->library('encryption');
    }

    function index($enc_order_id = null)
    {
        if (!$this->session->userdata('order_success')) {
            redirect('/');
            exit;
        }

        $this->session->unset_userdata('order_success');

        $order_id = $this->encryption->decrypt(base64_decode(urldecode($enc_order_id)));
        $data['order'] = $this->order_model->getOrderSummary($order_id);
        load_views('thank_you', $data);
    }

    public function verifyIntent()
    {
        //  Get PaymentIntent ID from URL
        $payment_intent_id = $this->input->get('payment_intent'); // pi_XXX
        $client_secret = $this->input->get('payment_intent_client_secret');

        if (!$payment_intent_id || !$client_secret) {
            show_error("Invalid PaymentIntent");
        }

        // Initialize Stripe
        \Stripe\Stripe::setApiKey(STRIPE_SECRET);

        try {
            // Retrieve PaymentIntent from Stripe
            $intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);

            $status = $intent->status; // succeeded, processing, requires_payment_method
            $charge_id = $intent->latest_charge;
            //  Optional: update your order DB if succeeded
            if ($status === 'succeeded') {
                $order_id = $this->order_model->markPaymentSuccess($payment_intent_id, $charge_id);
            }

            //  Load appropriate view
            $data['order'] = $this->order_model->getOrderSummary($order_id ?? 0);

            if ($status === 'succeeded') {
                if ($this->session->has_userdata('applied_coupon')) {
                    $this->session->unset_userdata('applied_coupon');
                }

                if ($this->session->has_userdata('cart')) {
                    $this->session->unset_userdata('cart');
                }

                $this->session->unset_userdata('payment_pending');
                $this->session->set_userdata('order_success', true);

                redirect('Thank_you/index/' . urlencode(base64_encode(
                    $this->encryption->encrypt($order_id)
                )));
                exit;
            } else {
                load_views('payment_processing', $data);
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            show_error("Stripe API Error: " . $e->getMessage());
        }
    }
}
