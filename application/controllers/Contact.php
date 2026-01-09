<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Contact extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('common');
  }

  function index()
  {
    load_views('contact');
  }

  function send_message(){
    require_once APPPATH . '../vendor/autoload.php';
    $email=$this->input->post('email');
    $name=$this->input->post('name');
    $desc=$this->input->post('desc');
    $mail=new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host='smtp.gmail.com';
      $mail->SMTPAuth=true;
      $mail->Username   = 'spidyofficial001@gmail.com';
      $mail->Password   = 'atefpvbrcjfkjyls'; // App password
      $mail->SMTPSecure=PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port=587;

      $mail->CharSet='UTF-8';

      $mail->setFrom('spidyofficial001@gmail.com', 'Ayan Ecommerce Pvt. Ltd.');
      $mail->addAddress('spidyofficial001@gmail.com'); 
      $mail->addReplyTo($email, $name);

      $mail->isHTML(true);
      $mail->Subject =  "Contact Form - {$name} ({$email})";;

      $mail->Body = "
            <h3>New message from Ayan Ecommerce Pvt. Ltd.</h3>
            <p><b>Name:</b> {$name}</p>
            <p><b>Email:</b> {$email}</p>
            <p><b>Message:</b><br>{$desc}</p>
        ";

      if ($mail->send()) {
        echo json_encode([
          "status" => "success",
          "message" => "Message sent successfully!"
        ]);
      } else {
        echo json_encode([
          "status" => "error",
          "message" => "Failed to send message."
        ]);
      }
      exit;

      // return true;
    } catch (\Throwable $th) {
      log_message('error', $mail->ErrorInfo);
      return false;
    }
  }
}
