<?php

class Profile extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();

          // 🔐 LOGIN CHECK
        if (!$this->session->userdata('logged_in')) {
            redirect('Auth/login?redirect=profile');
        }
        $this->load->model('user_model');
        $this->load->model('order_model');
        $this->load->library('encryption');
        $this->load->library('form_validation');
        $this->load->helper('date');
    }

    function index()
    {
        $user_id = $this->session->userdata('user_id');
        $data['orders'] = $this->order_model->getOrders($user_id);
        $data['user'] = $this->user_model->getUserById($user_id);
        load_views('profile', $data);
    }

    function user()
    {
        $this->form_validation->set_rules('fname', 'First name', 'required');
        $this->form_validation->set_rules('lname', 'Last name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules(
            'phone',
            'Phone number',
            'required|numeric|min_length[10]|max_length[10]',
            [
                'required'   => 'Phone number is required.',
                'numeric'    => 'Phone number must contain only digits.',
                'min_length' => 'Phone number must be exactly 10 digits.',
                'max_length' => 'Phone number must be exactly 10 digits.'
            ]
        );

        if ($this->form_validation->run() === false) {
            $fields = ['fname', 'lname', 'email', 'phone'];
            $errors = [];
            foreach ($fields as $field) {
                $error_msg = form_error($field);
                if (!empty($error_msg)) {
                    $errors[$field] = $error_msg;
                }
            }
            echo json_encode([
                "status" => "error",
                "message" => "Validation Faild.",
                "errors" => $errors
            ]);
            return;
        }

        $user_id = $this->session->userdata('user_id');
        $getUser = $this->user_model->getUserById($user_id);

        $data = [
            "fname" => $this->input->post('fname'),
            "lname" => $this->input->post('lname'),
            "email" => $getUser->email,
            "mobile" => $this->input->post('phone')
        ];

        $user_update = $this->user_model->update($data, $user_id);
        if ($user_update) {
            echo json_encode([
                "status" => "success",
                "message" => "Updated"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Not Update"
            ]);
        }
    }

    function order_details($order_id)
    {
        $orderId = $this->encryption->decrypt(base64_decode(urldecode($order_id)));
        // echo $orderId;
        // die;
        $data['order'] = $this->order_model->getOrderSummary($orderId); // single row
        $data['items'] = $this->order_model->getOrderItems($orderId);   // multiple rows

        load_views('profile_order_details', $data);
    }
}
