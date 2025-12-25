<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Mpdf\Mpdf;

class Pdf extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->library('encryption');
        $this->load->helper('calc_discount');
    }

    public function index($order_enc_id)
    {
        $order_id = $this->encryption->decrypt(base64_decode(urldecode($order_enc_id)));
        $order = $this->order_model->getOrderSummary($order_id);
        $order_details = $this->order_model->getOrderItems($order_id);

        $subtotal = 0;
        foreach ($order_details as $od) {
            $subtotal += $od->price * $od->quantity;
        }

        $coupon = (object) [
            'discount_type'  => $order->discount_type,
            'discount_value' => $order->discount_value
        ];

        $data['discount'] = calculate_discount($subtotal, $coupon);

        $data['order'] = $order;
        $data['order_details'] = $order_details;
        $html = $this->load->view('invoice_view', $data, true);

        $mpdf = new Mpdf([
            'tempDir' => FCPATH . 'uploads/tmp',
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
            'margin_right' => 10
        ]);

        $mpdf->WriteHTML($html);
        $mpdf->Output('invoice-' . $order->order_number . '.pdf', 'I');

    }
}
