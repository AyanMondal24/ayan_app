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

    // function invoiceTemplate($order)
    // {
    //     return "
    // <h2>Invoice #{$order->order_number}</h2>
    // <p><b>Name:</b> {$order->customer_name}</p>
    // <p><b>Email:</b> {$order->email}</p>

    // <table border='1' cellpadding='8' cellspacing='0' width='100%'>
    //     <tr>
    //         <th>Product</th>
    //         <th>Qty</th>
    //         <th>Price</th>
    //     </tr>
    //     {$order->items}
    // </table>

    // <h3>Total: ₹{$order->total_amount}</h3>
    // <p>Thank you for shopping with us!</p>
    // ";
    // }
    // public function confirmOrder($order_id)
    // {
    //     // 1. Update order status
    //     $this->db->where('id', $order_id)
    //         ->update('orders', ['order_status' => 'confirmed']);

    //     // 2. Fetch order data
    //     $order = $this->order_model->getOrderInvoice($order_id);

    //     // 3. Generate invoice HTML
    //     $invoiceHtml = invoiceTemplate($order);

    //     // 4. Send email
    //     sendInvoiceMail(
    //         $order->email,
    //         'Your Order Invoice - ' . $order->order_number,
    //         $invoiceHtml
    //     );

    //     echo "Order confirmed & invoice sent";
    // }
}
