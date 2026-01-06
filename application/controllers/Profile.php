<?php

class Profile extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('Auth/login?redirect=profile');
        }
        $this->load->model('user_model');
        $this->load->model('order_model');
        $this->load->model('address_model');
        $this->load->library('encryption');
        $this->load->library('form_validation');
        $this->load->helper('date');
    }

    function index()
    {
        $user_id = $this->session->userdata('user_id');
        $data['orders'] = $this->order_model->getOrders($user_id);
        $data['user'] = $this->user_model->getUserById($user_id);
        $data['address'] = $this->address_model->getAddressByUserId($user_id);
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

        $data['order'] = $this->order_model->getOrderSummary($orderId);
        $data['items'] = $this->order_model->getOrderItems($orderId);

        load_views('profile_order_details', $data);
    }


    public function cancel_order()
    {

        $order_id = $this->input->post('order_id');
        if (!$order_id) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid order ID']);
            return;
        }

        $decrypted_order_id = $this->encryption->decrypt(base64_decode(urldecode($order_id)));

        $update = $this->order_model->update_order_status($decrypted_order_id, 'cancelled');

        if ($update) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to cancel order']);
        }
    }

    function edit_billing_address($enc_order_id = null)
    {
        //i will show change address  for use same address form

        if (!empty($enc_order_id)) {
            $order_id = $this->encryption->decrypt(base64_decode(urldecode($enc_order_id)));
            $data['address'] = $this->order_model->getOrderSummary($order_id);
            $data['billing'] = 'billing';
        } else {
            $user_id = $this->session->userdata('user_id');
            $data['address'] = $this->address_model->getAddressByUserId($user_id);
            $data['billing'] = 'billing';
            // only for profile if there are no  address
            $data['profile']=$this->input->get('profile');
        }
        load_views('address_form', $data);
    }
    function edit_shipping_address()
    {
        $user_id = $this->session->userdata('user_id');
        $data['address'] = $this->address_model->getAddressByUserId($user_id);
        $data['shipping'] = 'shipping';
        load_views('address_form', $data);
    }
    function is_shipping_same(){
        $id=$this->input->post('id');

        $data['is_shipping_same']=1;
        $data["s_fname"]  = '';
        $data["s_lname"]  = '';
        $data["s_address"] =  '';
        $data["s_city"]   = '';
        $data["s_country"] = '';
        $data["s_state"] = '';
        $data["s_landmark"] = '';
        $data["s_pin"]    = '';
        $data["s_phone"]  = '';
        $data["s_email"]  = '';

        $is_shipping_same=$this->address_model->update($data,$id);
        if($is_shipping_same){
            echo json_encode([
                "status"=>"success"
            ]);
            exit;
        }
    }
    function update_address()
    {
        $this->form_validation->reset_validation();
        $profile=$this->input->post('profile');
        $isBilling  = $this->input->post('is_billing') === 'billing';
        $isShipping = $this->input->post('is_shippingcheck') === 'shipping';

        $billing_is_shipping = $this->input->post('is_shipping');


        if ($isBilling) {
            $this->form_validation->set_rules('b_fname', 'First name', 'required');
            $this->form_validation->set_rules('b_lname', 'Last name', 'required');
            $this->form_validation->set_rules('b_address', 'Address', 'required|min_length[10]');
            $this->form_validation->set_rules('b_city', 'City', 'required');
            $this->form_validation->set_rules('b_country', 'Country', 'required');
            $this->form_validation->set_rules('b_landmark', 'Landmark', 'required');
            $this->form_validation->set_rules('b_pin', 'Pin', 'required|exact_length[6]|numeric');
            $this->form_validation->set_rules('b_phone', 'Phone', 'required|exact_length[10]|numeric');
            $this->form_validation->set_rules('b_email', 'Email', 'required|valid_email');
        }

        if ($isShipping || $billing_is_shipping == '1') {
            $this->form_validation->set_rules('s_fname', 'First name', 'required');
            $this->form_validation->set_rules('s_lname', 'Last name', 'required');
            $this->form_validation->set_rules('s_address', 'Address', 'required|min_length[10]');
            $this->form_validation->set_rules('s_city', 'City', 'required');
            $this->form_validation->set_rules('s_country', 'Country', 'required');
            $this->form_validation->set_rules('s_landmark', 'Landmark', 'required');
            $this->form_validation->set_rules('s_pin', 'Pin', 'required|exact_length[6]|numeric');
            $this->form_validation->set_rules('s_phone', 'Phone', 'required|exact_length[10]|numeric');
            $this->form_validation->set_rules('s_email', 'Email', 'required|valid_email');
        }

        if ($this->form_validation->run() === FALSE) {

            $errors = [];

            if ($isBilling) {
                $fields = ['b_fname', 'b_lname', 'b_address', 'b_city', 'b_country', 'b_landmark', 'b_pin', 'b_phone', 'b_email', 's_fname', 's_lname', 's_address', 's_city', 's_country', 's_landmark', 's_pin', 's_phone', 's_email'];
                foreach ($fields as $field) {
                    if ($msg = form_error($field)) {
                        $errors[$field] = $msg;
                    }
                }
            }

            if ($isShipping) {
                $fields = ['s_fname', 's_lname', 's_address', 's_city', 's_country', 's_landmark', 's_pin', 's_phone', 's_email'];
                foreach ($fields as $field) {
                    if ($msg = form_error($field)) {
                        $errors[$field] = $msg;
                    }
                }
            }

            echo json_encode([
                'status' => 'validation_error',
                'errors' => $errors
            ]);
            return;
        }


        $order_id = $this->input->post('order_id');

        $address_id = $this->input->post('address_id');

        if ($this->input->post('is_shipping') == '1') {
            $shipping = 0;
        } else {
            $shipping = 1;
        }

        if ($isBilling) {
            $data = [
                "b_fname" => $this->input->post('b_fname'),
                "b_lname" => $this->input->post('b_lname'),
                "b_address" => $this->input->post('b_address'),
                "b_state" => $this->input->post('b_city'),
                "b_city" => $this->input->post('b_state'),
                "b_country" => $this->input->post('b_country'),
                "b_pin" => $this->input->post('b_pin'),
                "b_landmark" => $this->input->post('b_landmark'),
                "b_phone" => $this->input->post('b_phone'),
                "b_email" => $this->input->post('b_email'),
                "is_shipping_same" => $shipping,
            ];
            if ($shipping == 0) {
                $data["s_fname"]  = $this->input->post('s_fname');
                $data["s_lname"]  = $this->input->post('s_lname');
                $data["s_address"] = $this->input->post('s_address');
                $data["s_city"]   = $this->input->post('s_city');
                $data["s_country"] = $this->input->post('s_country');
                $data["s_state"] = $this->input->post('s_state');
                $data["s_landmark"] = $this->input->post('s_landmark');
                $data["s_pin"]    = $this->input->post('s_pin');
                $data["s_phone"]  = $this->input->post('s_phone');
                $data["s_email"]  = $this->input->post('s_email');
            } else {
                $data["s_fname"]  = '';
                $data["s_lname"]  = '';
                $data["s_address"] =  '';
                $data["s_city"]   = '';
                $data["s_country"] = '';
                $data["s_state"] = '';
                $data["s_landmark"] = '';
                $data["s_pin"]    = '';
                $data["s_phone"]  = '';
                $data["s_email"]  = '';
            }
        }
        if ($isShipping) {
            $data["s_fname"]  = $this->input->post('s_fname');
            $data["s_lname"]  = $this->input->post('s_lname');
            $data["s_address"] = $this->input->post('s_address');
            $data["s_city"]   = $this->input->post('s_city');
            $data["s_country"] = $this->input->post('s_country');
            $data["s_state"] = $this->input->post('s_state');
            $data["s_landmark"] = $this->input->post('s_landmark');
            $data["s_pin"]    = $this->input->post('s_pin');
            $data["s_phone"]  = $this->input->post('s_phone');
            $data["s_email"]  = $this->input->post('s_email');
        }

        if (!empty($order_id)) {
            $update = $this->order_model->update($data, $order_id);
        } else {
            $update = $this->address_model->update($data, $address_id);
        }
        if (!empty($profile)) {
            $data['user_id'] = $this->session->userdata('user_id');
            $create = $this->address_model->create($data);

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status'  => $create ? 'success' : 'error',
                    'message' => $create
                        ? 'Address created successfully'
                        : 'Address cannot be created'
                ]));

            return; // ⛔ VERY IMPORTANT
        }

        if ($update) {
            echo json_encode([
                'status' => 'success',
                'message' =>  'Address Successfully Saved'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Address Cannot Saved'
            ]);
        }
    }
}
