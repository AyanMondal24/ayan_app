<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once APPPATH . '../vendor/autoload.php';

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }
    function login()
    {
        $data['active'] = 'login';
        $data['redirect_to'] = $this->input->get('redirect') ?? 'home';
        $data['check_verification'] = $this->input->get('verify');
        load_views('auth_view', $data);
    }
    function signup()
    {
        $data['active'] = 'signup';
        load_views('auth_view', $data);
    }

    // forgot  password
    function forgot_pass()
    {
        load_views('auth_forgot_pass');
    }


    // signup
    function addUser()
    {
        $this->form_validation->set_rules('firstname', 'First Name ', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name ', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/]',
            array(
                'regex_match' => 'Password must contain at least 1 uppercase, 1 lowercase, 1 number and 1 special character.'
            )
        );

        $this->form_validation->set_rules(
            'cpassword',
            'Confirm Password',
            'required|matches[password]',
            array(
                'matches' => 'Confirm Password does not match with Password.'
            )
        );

        if ($this->form_validation->run() == false) {
            $errors = [];
            $fields = ['firstname', 'lastname', 'email', 'phone', 'password', 'cpassword'];
            foreach ($fields as $field) {
                $error = form_error($field);
                if (!empty($error)) {
                    $errors[$field] = $error;
                }
            }
            echo json_encode([
                'validation' => 'error',
                'errors' => $errors
            ]);
            return;
        }

        $fname = $this->input->post('firstname');
        $lname = $this->input->post('lastname');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('cpassword');
        $check_email=$this->user_model->getUserByEmail($email);
        if($check_email){
            echo json_encode([
                "status" => 'error',
                "message" => "This email already exists. Please use another one."
            ]);
            return;
        }
        if ($password !== $confirm_password) {
            echo json_encode([
                "status" => 'error',
                "message" => "Password do not match."
            ]);
            return;
            // return $this->set_page("error", "Password do not match.");
        }

        $token  = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+24 hours'));

        $data = [
            "fname" => $fname,
            "lname" => $lname,
            "email" => $email,
            "mobile" => $this->input->post('phone'),
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "is_verified" => 0,
            "email_verify_token" => $token,
            "email_token_expiry" => $expiry,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ];
        $add_user = $this->user_model->add($data);

        if ($add_user) {

            try {

                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'spidyofficial001@gmail.com';
                $mail->Password = 'atefpvbrcjfkjyls';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->CharSet = 'UTF-8';

                $mail->setFrom('spidyofficial001@gmail.com', 'Ayan Ecommerce Pvt. Ltd.');
                $mail->addAddress($email);

                $mail->isHTML(true);

                $verify_link = base_url("verify-email?token=$token");

                $mail->Subject = "Verify Your Email - " . date('YmdHis');

                $mail->Body = "
                    <p>Click below to verify your email:</p>
                    <a href='$verify_link'>Verify email</a>
                    <p>This link expires in 24 hours.</p>
                    ";
                if ($mail->send()) {
                    echo json_encode([
                        "status" => "success",
                        "message" => "Please verify your email address. Check your inbox."
                    ]);
                } else {
                    echo json_encode([
                        "status" => "error",
                        "message" => "Failed to send verify link."
                    ]);
                }
                exit;
            } catch (\Throwable $th) {
                log_message('error', $mail->ErrorInfo);
                return false;
            }
        } else {
            echo json_encode([
                "status" => 'error',
                "message" => 'Signup Not Complete.'
            ]);
            return;
            // return $this->set_page('error', 'Signup Not Complete.', 'signup');
        }
    }

    public function verify_email()
    {
        $token = $this->input->get('token');

        $user = $this->user_model->getByVerifyToken($token);

        if (!$user) {
            redirect('auth/login?verify=invalid_link');
            return;
        }

        if (time() > strtotime($user->email_token_expiry)) {
            redirect('auth/login?verify=expired_link');
            return;
        }

        $this->user_model->verifyUser($user->id);

        redirect('auth/login?verify=1');
    }


    // login
    function loginUser()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === false) {
            $errors = [];
            $fields = ['email', 'password'];
            foreach ($fields as $field) {
                $error = form_error($field);
                if (!empty($error)) {
                    $errors[$field] = $error;
                }
            }
            echo json_encode([
                'status' => 'error',
                'errors' => $errors
            ]);
            return;
        }

        $email    = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->user_model->getUserByEmail($email, 'user');
        if (!$user) {
            echo json_encode([
                'status' => 'error',
                'errors' => ['email' => 'Email not registered']
            ]);
            return;
        }
        if (!password_verify($password, $user->password)) {
            echo json_encode([
                'status' => 'error',
                'errors' => ['password' => 'Incorrect password']
            ]);
            return;
        }
        $this->session->set_userdata([
            'user_id' => $user->id,
            'email'   => $user->email,
            'logged_in' => TRUE
        ]);

        $redirectTo = $this->input->post('redirect_to') ?? 'home';

        switch ($redirectTo) {
            case "profile":
                $redirect_url = base_url("Profile");
                break;
            case "checkout":
                $redirect_url = base_url("Checkout/index");
                break;
            default:
                $redirect_url = base_url("Home/index"); // default login location
        }


        echo json_encode([
            "status"  => "success",
            "message" => 'Login Successful.',
            "redirect" => $redirect_url // send redirect url
        ]);
        // return $this->set_page('success', 'Login Successful.', 'login');
    }


    // forgot Password

    public function forgot_password()
    {
        $email = $this->input->post('email');

        $user = $this->user_model->getUserByEmail($email);
        if (!$user) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Email not found, please enter registered email'
            ]);
            return;
        }

        // Generate token
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        // Save token to table
        $data['reset_token'] = $token;
        $data['token_expiry'] = $expiry;
        $storeToken = $this->user_model->updateToken($data, $user->id);
        // $resetLink = base_url("reset-password?token=$token");

        if (!empty($storeToken)) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'spidyofficial001@gmail.com';
                $mail->Password = 'atefpvbrcjfkjyls';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->CharSet = 'UTF-8';

                $mail->setFrom('spidyofficial001@gmail.com', 'Ayan Ecommerce Pvt. Ltd.');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $resetLink = base_url("reset-password?token=$token");

                $mail->Subject = "Reset Your Password - " . date('YmdHis');

                $mail->Body = "
                    <p>Click below to reset your password:</p>
                    <a href='$resetLink'>Reset Password</a>
                    <p>This link expires in 15 minutes.</p>
                    ";
                if ($mail->send()) {
                    echo json_encode([
                        "status" => "success",
                        "message" => "Reset link sent to your email."
                    ]);
                } else {
                    echo json_encode([
                        "status" => "error",
                        "message" => "Failed to send reset link."
                    ]);
                }
                exit;
            } catch (\Throwable $th) {
                log_message('error', $mail->ErrorInfo);
                return false;
            }
        }
    }

    function reset_pass()
    {
        $token = $this->input->get('token');

        $data['token'] = $token;

        $this->load->view('auth_reset_pass', $data);
    }
    function reset_pass_submit()
    {
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/]',
            array(
                'regex_match' => 'Password must contain at least 1 uppercase, 1 lowercase, 1 number and 1 special character.'
            )
        );

        $this->form_validation->set_rules(
            'confirm_password',
            'Confirm Password',
            'required|matches[password]',
            array(
                'matches' => 'Confirm Password does not match with Password.'
            )
        );

        if ($this->form_validation->run() == false) {
            $errors = [];
            $fields = ['password', 'confirm_password'];
            foreach ($fields as $field) {
                $error = form_error($field);
                if (!empty($error)) {
                    $errors[$field] = $error;
                }
            }
            echo json_encode([
                'validation' => 'error',
                'errors' => $errors
            ]);
            return;
        }

        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

        if ($password !== $confirm_password) {
            echo json_encode([
                "status" => 'error',
                "message" => "Password do not match."
            ]);
            return;
        }
        $token = $this->input->post('token');
        $get_token_from_db = $this->user_model->getDataByToken($token);
        if (!$get_token_from_db) {
            echo json_encode([
                "status" => 'error',
                "message" => "Invalid Reset link."
            ]);
            return;
        }

        // $currentTime = date('Y-m-d H:i:s');
        $expiry = $get_token_from_db->token_expiry;
        if (time() > strtotime($expiry)) {
            echo json_encode([
                "status" => 'error',
                "message" => "Reset link has expired."
            ]);
            return;
        } else {
            $user_id = $get_token_from_db->id;
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $data = [
                'password' => $password_hash,
                'reset_token'   => NULL,
                'token_expiry'  => NULL,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $update_user = $this->user_model->update_pass($data, $token, $user_id);
            if ($update_user) {
                echo json_encode([
                    "status" => 'success',
                    "message" => "Password changed successfully.",
                    "redirect" => base_url('login')
                ]);
                return;
            } else {
                echo json_encode([
                    "status" => 'error',
                    "message" => "Password not changed.",
                ]);
                return;
            }
        }
    }
    // logout
    function logout()
    {
        $this->session->unset_userdata(['user_id', 'email', 'logged_in']);
        redirect('Home/index');
    }
}
