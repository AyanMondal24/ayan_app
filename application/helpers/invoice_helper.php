<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendInvoiceMail($to, $subject, $html, $pdfPath = null)
{
    require_once APPPATH . '../vendor/autoload.php';
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'spidyofficial001@gmail.com';
        $mail->Password   = 'atefpvbrcjfkjyls'; // App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];
        // IMPORTANT
        $mail->SMTPDebug = 0;
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('spidyofficial001@gmail.com', 'Ayan Ecommerce Pvt. Ltd.');
        $mail->addAddress($to);

        if ($pdfPath && file_exists($pdfPath)) {
            $mail->addAttachment($pdfPath);
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $html;

        $mail->send();
        // if ($mail->send()) {
        //     log_message('error', 'EMAIL SENT SUCCESSFULLY to ' . $to);
        //     return true;
        // }

        return true;
    } catch (Exception $e) {
        log_message('error', 'Mailer Error: ' . $mail->ErrorInfo);
        return false;
    }
}
