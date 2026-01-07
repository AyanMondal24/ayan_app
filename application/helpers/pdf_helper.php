<?php
use Mpdf\Mpdf;

function generateInvoicePdf($order, $order_details, $discount)
{
    $CI = &get_instance();

    $data['order'] = $order;
    $data['order_details'] = $order_details;
    $data['discount'] = $discount;

    $html = $CI->load->view('invoice_view', $data, true);

    $dir = FCPATH . 'uploads/invoices/';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    $pdfPath = $dir . 'invoice-' . $order->order_number . '.pdf';

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
    $mpdf->Output($pdfPath, 'F');

    return $pdfPath;
}
