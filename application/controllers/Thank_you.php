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
        // Get PaymentIntent ID and client secret from URL
        $payment_intent_id = $this->input->get('payment_intent');
        $client_secret = $this->input->get('payment_intent_client_secret');

        if (!$payment_intent_id || !$client_secret) {
            show_error("Invalid PaymentIntent");
        }

        // Initialize Stripe
        \Stripe\Stripe::setApiKey(STRIPE_SECRET);

        try {
            // Retrieve PaymentIntent from Stripe
            $intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);

            // Verify client secret matches (security check)
            if ($intent->client_secret !== $client_secret) {
                show_error("Invalid client secret");
            }

            $status = $intent->status;
            $charge_id = $intent->latest_charge;

            // Check if payment is already processed in DB
            $check_already_paid_or_not = $this->order_model->isPaymentProcessed($payment_intent_id);
            if (!empty($check_already_paid_or_not)) {
                $order_enc_id = urlencode(base64_encode($this->encryption->encrypt($check_already_paid_or_not->id)));

                // Redirect to already paid page (avoid re-processing)
                redirect('Thank_you/already_paid/' . $order_enc_id);
                exit;
            }

            // Handle based on status
            if ($status === 'succeeded') {
                // Mark as success (idempotent)
                $order_id = $this->order_model->markPaymentSuccess($payment_intent_id, $charge_id);

                // Cleanup session (only on success)
                if ($this->session->has_userdata('applied_coupon')) {
                    $this->session->unset_userdata('applied_coupon');
                }
                if ($this->session->has_userdata('cart')) {
                    $this->session->unset_userdata('cart');
                }
                $this->session->set_userdata('order_success', true);

                // Redirect to thank you (secure encoding)
                redirect('Thank_you/index/' . urlencode(base64_encode(
                    $this->encryption->encrypt($order_id)
                )));
                exit;
            } elseif ($status === 'processing') {
                // Payment is still processing
                $data['order'] = $this->order_model->getOrderSummary(0); // Placeholder
                load_views('payment_processing', $data);
            } else {
                // Failed or requires action
                show_error("Payment not successful. Status: " . $status);
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Log the error for debugging
            log_message('error', 'Stripe API Error: ' . $e->getMessage());
            show_error("Stripe API Error: " . $e->getMessage());
        }
    }

    public function already_paid($enc_order_id = null)
    {
        if (!$enc_order_id) {
            show_error('Invalid access');
        }

        //Decode & decrypt order id
        $order_id = $this->encryption->decrypt(base64_decode(urldecode($enc_order_id)));

        if (!$order_id) {
            show_error('Invalid order');
        }

        //Verify order exists & is PAID
        $order = $this->order_model->getOrderById($order_id);

        if (!$order || $order->payment_status !== 'paid') {
            show_error('Unauthorized access');
        }

        //Safe to show already paid page
        $data['title'] = [
            'title' => 'Payment Already Completed'
        ];
        $data['order'] = $order;
        $data['enc_order_id']=$enc_order_id;
        load_views('already_paid', $data);
    }
}
