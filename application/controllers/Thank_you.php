<?php
// pjbj djpw phik xrap
use Stripe\Stripe;

class Thank_you extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->library('encryption');
        $this->load->helper(['invoice', 'pdf', 'calc_discount']);
    }

    function index($enc_order_id = null)
    {
        if (!$this->session->userdata('order_success')) {
            redirect('/');
            exit;
        }
        $download_btn='';
        $this->session->unset_userdata('order_success');

        $order_id = $this->encryption->decrypt(base64_decode(urldecode($enc_order_id)));
        $order = $this->order_model->getOrderSummary($order_id);

        if ($order->payment_method === 'Cash On Delivery') {
            $order_details = $this->order_model->getOrderItems($order_id);
            $subtotal = 0;
            foreach ($order_details as $order_detail) {
                $subtotal += $order_detail->price * $order_detail->quantity;
            }
            $coupon = (object)[
                'discount_type'  => $order->discount_type,
                'discount_value' => $order->discount_value
            ];
            $discount = calculate_discount($subtotal, $coupon);

            $pdfPath = generateInvoicePdf($order, $order_details, $discount);

            $data['discount']=$discount;
            $data['order'] = $order;
            $data['order_details'] = $order_details;
            $invoice_html=$this->load->view('invoice_view',$data,true);

            $downloadUrl = base_url('pdf/' . $enc_order_id . '?action=download');
            $download_btn = '<a href="' . $downloadUrl . '" target="_blank" style=" display:inline-block;padding:14px 24px;background-color:#000000;color:#ffffff;font-size:14px;font-weight:bold;text-decoration:none;border-radius:6px;border:1px solid #000000;font-family:Arial, Helvetica, sans-serif;">Download Invoice</a>';

            $emailHtml = "
                    <h2>Thank you for your order!</h2>
                    <p><b>Order No:</b> {$order->order_number}</p>
                    <p>Please find your invoice attached.</p>
                    {$download_btn}
                    {$invoice_html}
                    ";
            $mailSent = sendInvoiceMail(
                $order->order_b_email,
                'Invoice - ' . $order->order_number,
                $emailHtml,
                $pdfPath
            );
            if (!$mailSent) {
                log_message('error', 'Invoice email failed for Order: ' . $order->order_number);
            }
        }


        $data['order'] = $order;
        load_views('thank_you', $data);
    }

    public function verifyIntent()
    {
        // Get PaymentIntent ID and client secret from URL
        $payment_intent_id = $this->input->get('payment_intent');
        $client_secret = $this->input->get('payment_intent_client_secret');
        $redirect_status   = $this->input->get('redirect_status');

        if (!$payment_intent_id) {
            show_error("Invalid PaymentIntent");
        }

        // Initialize Stripe
        \Stripe\Stripe::setApiKey(STRIPE_SECRET);

        try {
            // Retrieve PaymentIntent from Stripe
            $intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);

            // Verify client secret matches (security check)
            if ($redirect_status !== 'succeeded') {
                show_error("Payment not completed. Status: " . $redirect_status);
            }

            $status = $intent->status;
            $charge_id = $intent->latest_charge;

            // Check if payment is already processed in DB
            $check_already_paid_or_not = $this->order_model->isPaymentProcessed($payment_intent_id);
            if (!empty($check_already_paid_or_not)) {
                $order_enc_id = urlencode(base64_encode($this->encryption->encrypt($check_already_paid_or_not->id)));

                // Redirect to already paid page (avoid re-processing)
                redirect('thankyou/already-paid/' . $order_enc_id);
                exit;
            }

            // Handle based on status
            if ($status === 'succeeded') {

                // Mark as success (idempotent)
                $order_id = $this->order_model->markPaymentSuccess($payment_intent_id, $charge_id);

                $order = $this->order_model->getOrderSummary($order_id);
                $order_details = $this->order_model->getOrderItems($order_id);

                // Calculate discount (same logic as PDF controller)
                $subtotal = 0;
                foreach ($order_details as $od) {
                    $subtotal += $od->price * $od->quantity;
                }

                $coupon = (object)[
                    'discount_type'  => $order->discount_type,
                    'discount_value' => $order->discount_value
                ];

                $discount = calculate_discount($subtotal, $coupon);

                // Generate PDF
                $pdfPath = generateInvoicePdf($order, $order_details, $discount);

                $data['discount'] = $discount;
                $data['order'] = $order;
                $data['order_details'] = $order_details;
                $invoice_html = $this->load->view('invoice_view', $data, true);

                $order_enc_id = urlencode(base64_encode($this->encryption->encrypt($order_id)));
                $downloadUrl = base_url('pdf/' . $order_enc_id . '?action=download');
                $download_btn = '<a href="' . $downloadUrl . '" target="_blank" style=" display:inline-block;padding:14px 24px;background-color:#000000;color:#ffffff;font-size:14px;font-weight:bold;text-decoration:none;border-radius:6px;border:1px solid #000000;font-family:Arial, Helvetica, sans-serif;">Download Invoice</a>';

                // Email body
                $emailHtml = "
                    <h2>Thank you for your order!</h2>
                    <p>Your payment was successful.</p>
                    <p><b>Order No:</b> {$order->order_number}</p>
                    <p>Please find your invoice attached.</p>
                    {$download_btn}
                    {$invoice_html}
                    ";

                // Send email
                $mailSent = sendInvoiceMail(
                    $order->order_b_email,
                    'Invoice - ' . $order->order_number,
                    $emailHtml,
                    $pdfPath
                );
                if (!$mailSent) {
                    log_message('error', 'Invoice email failed for Order: ' . $order->order_number);
                }
                // Cleanup session (only on success)
                if ($this->session->has_userdata('applied_coupon')) {
                    $this->session->unset_userdata('applied_coupon');
                }
                if ($this->session->has_userdata('cart')) {
                    $this->session->unset_userdata('cart');
                }
                $this->session->set_userdata('order_success', true);

                // Redirect to thank you (secure encoding)
                redirect('thankyou/' . urlencode(base64_encode(
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
        $data['enc_order_id'] = $enc_order_id;
        load_views('already_paid', $data);
    }
}
