<?php

use Stripe\Stripe;
use Stripe\Webhook;

// class Stripe_webhook extends CI_Controller
// {
//     function __construct()
//     {
//         parent::__construct();
//         $this->load->model('order_model');
//     }

//     public function index()
//     {
//         Stripe::setApiKey(STRIPE_SECRET);

//         $payload = @file_get_contents('php://input');
//         $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';
//         $endpointSecret = STRIPE_WEBHOOK_SECRET; // from Stripe dashboard

//         try {
//             $event = Webhook::constructEvent(
//                 $payload,
//                 $sigHeader,
//                 $endpointSecret
//             );
//         } catch (\Exception $e) {
//             http_response_code(400);
//             exit();
//         }
//         // log_message('debug', 'Stripe event type: ' . $event->type);
//         // ✅ Payment successful
//         if ($event->type === 'payment_intent.succeeded') {
//             $intent = $event->data->object;

//             $paymentIntentId = $intent->id;
//             // log_message('debug', 'PaymentIntent ID: ' . $paymentIntentId);
//             // find order using intent_id
//             $this->order_model->markPaymentSuccess($paymentIntentId);
//         }

//         http_response_code(200);
//     }
// }
