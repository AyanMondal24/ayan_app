<?php

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    function login()
    {
        $data['active'] = 'login';
        load_views('auth_view', $data);
    }
    function signup()
    {
        $data['active'] = 'signup';
        load_views('auth_view', $data);
    }

    function addUser()
    {
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('cpassword');

        if ($password !== $confirm_password) {
            return $this->set_page("error", "Password do not match.");
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
            return $this->set_page('success', 'Signup Completed.', 'signup');
        } else {
            return $this->set_page('error', 'Signup Not Complete.', 'signup');
        }
    }

    function loginUser()
    {
        $email    = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->user_model->getUserByEmail($email);
        if (!$user) {
            return $this->set_page("error", "Email not registered.");
        }
        if (!password_verify($password, $user->password)) {
            return $this->set_page('error', 'Incorrect password.');
        }
        $this->session->set_userdata([
            'user_id' => $user->id,
            'email'   => $user->email,
            'logged_in' => TRUE
        ]);

        return $this->set_page('success','Login Successful.','login');
    }


    function set_page($status = null, $message = null, $type = null)
    {
        if (!empty($status) && $status === 'error') {
            echo json_encode([
                "status" => $status,
                "message" => $message
            ]);
            return;
        }

        if (!empty($status) && $status === 'success' && $type === 'signup') {
            echo json_encode([
                "status"  => "success",
                "message" => $message,
                "redirect" => base_url('Auth/login') // send redirect url
            ]);
        }

        if (!empty($status) && $status === 'success' && $type === 'login') {
            echo json_encode([
                "status"  => "success",
                "message" => $message,
                "redirect" => base_url('Home/index') // send redirect url
            ]);
        }


    }
}
