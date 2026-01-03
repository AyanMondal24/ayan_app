<?php

// use Mpdf\Mpdf;

// function generateInvoicePdf($order, $order_details, $discount)
// {
//     $CI = &get_instance();

//     $data['order'] = $order;
//     $data['order_details'] = $order_details;
//     $data['discount'] = $discount;

//     $html = $CI->load->view('invoice_view', $data, true);

//     $filePath = FCPATH . 'uploads/invoices/';
//     if (!is_dir($filePath)) {
//         mkdir($filePath, 0777, true);
//     }

//     $pdfFile = $filePath . 'invoice-' . $order->order_number . '.pdf';

//     $mpdf = new Mpdf([
//         'tempDir' => FCPATH . 'uploads/tmp',
//         'format' => 'A4'
//     ]);

//     $mpdf->WriteHTML($html);
//     $mpdf->Output($pdfFile, 'F'); // SAVE FILE

//     return $pdfFile;
// }

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
        'format'  => 'A4'
    ]);

    $mpdf->WriteHTML($html);
    $mpdf->Output($pdfPath, 'F'); // ✅ SAVE FILE

    return $pdfPath; // ✅ RETURN PATH FOR EMAIL
}
