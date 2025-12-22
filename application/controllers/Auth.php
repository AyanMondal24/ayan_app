<?php

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

    // reset password 
    function reset_pass()
    {
        load_views('auth_reset_pass');
    }
    // signup 
    function addUser()
    {
        $this->form_validation->set_rules('firstname', 'First Name ', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name ', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', [
            'is_unique' => 'This email already exists. Please use another one.'
        ]);

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
                'status' => 'error',
                'data' => $errors
            ]);
            return;
        }


        $password = $this->input->post('password');
        $confirm_password = $this->input->post('cpassword');

        if ($password !== $confirm_password) {
            echo json_encode([
                "status" => 'error',
                "message" => "Password do not match."
            ]);
            return;
            // return $this->set_page("error", "Password do not match.");
        }

        $data = [
            "fname" => $this->input->post('firstname'),
            "lname" => $this->input->post('lastname'),
            "email" => $this->input->post('email'),
            "mobile" => $this->input->post('phone'),
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ];

        if ($this->user_model->add($data)) {
            echo json_encode([
                "status"  => "success",
                "message" => 'Signup Completed.',
                "redirect" => base_url('Auth/login') // send redirect url
            ]);
            return;
            // return $this->set_page('success', 'Signup Completed.', 'signup');
        } else {
            echo json_encode([
                "status" => 'error',
                "message" => 'Signup Not Complete.'
            ]);
            return;
            // return $this->set_page('error', 'Signup Not Complete.', 'signup');
        }
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
            // return $this->set_page("error", "Email not registered.");
        }
        if (!password_verify($password, $user->password)) {
            echo json_encode([
                'status' => 'error',
                'errors' => ['password' => 'Incorrect password']
            ]);
            return;
            // return $this->set_page('error', 'Incorrect password.');
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

        // Check if email exists in database
        // $user = $this->db->get_where('users', ['email' => $email])->row();
        $user = $this->user_model->getUserByEmail($email);
        if (!$user) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Email not found, please enter registered email'
            ]);
            return;
        }

        // Generate token
        $token = bin2hex(random_bytes(25));

        // Save token to table
        // $this->db->where('email', $email)->update('users', ['reset_token' => $token]);

        // Create reset link
        $reset_link = base_url("reset-password/" . $token);

        // Then send email (PHPMailer / CI email library)
        // $this->send_reset_mail($email, $reset_link);

        echo json_encode([
            'status' => 'success',
            'message' => 'Reset link sent to your email'
        ]);
    }


    // logout 
    function logout()
    {
        $this->session->unset_userdata(['user_id', 'email', 'logged_in']);
        redirect('Home/index');
    }
}
