<?php
class Checkout extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('product_model');
        $this->load->model('address_model');
        $this->load->model('user_model');
        $this->load->model('coupon_model');
        $this->load->library('form_validation');
        $this->load->helper('calc_discount');
        $this->load->model('order_model');
        $this->load->model('order_details_model');
        $this->load->library('encryption');
    }

    function store_address()
    {
        $this->form_validation->set_rules('b_fname', 'First name', 'required');
        $this->form_validation->set_rules('b_lname', 'Last name', 'required');
        $this->form_validation->set_rules('b_address', 'Address', 'required|min_length[10]');
        $this->form_validation->set_rules('b_city', 'City', 'required');
        $this->form_validation->set_rules('b_country', 'Country', 'required');
        $this->form_validation->set_rules('b_pin', 'Pin', 'required|min_length[6]|max_length[6]');
        $this->form_validation->set_rules('b_phone', 'Phone', 'required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('b_email', 'Email', 'required|valid_email');

        if ($this->input->post('is_shipping') == "shipped") {
            // Shipping section checked
            $this->form_validation->set_rules('s_fname', 'First name', 'required');
            $this->form_validation->set_rules('s_lname', 'Last name', 'required');
            $this->form_validation->set_rules('s_address', 'Address', 'required|min_length[10]');
            $this->form_validation->set_rules('s_city', 'City', 'required');
            $this->form_validation->set_rules('s_country', 'Country', 'required');
            $this->form_validation->set_rules('s_pin', 'Pin', 'required|min_length[6]|max_length[6]');
            $this->form_validation->set_rules('s_phone', 'Phone', 'required|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('s_email', 'Email', 'required|valid_email');
        }

        if ($this->form_validation->run() === false) {
            $fields = ['b_fname', 'b_lname', 'b_address', 'b_city', 'b_country', 'b_pin', 'b_phone', 'b_email', 's_fname', 's_lname', 's_address', 's_city', 's_country', 's_pin', 's_phone', 's_email'];
            $errors = [];
            foreach ($fields as $field) {
                $error_msg = form_error($field);
                if (!empty($error_msg)) {
                    $errors[$field] = $error_msg;
                }
            }
            echo json_encode([
                "status" => "validation_error",
                "errors" => $errors
            ]);
            return;
        }

        if ($this->input->post('is_shipping') === 'shipped') {
            $shipping = 0;
        } else {
            $shipping = 1;
        }


        if (empty($this->session->userdata('email'))) {
            $guest = 1;

            $bill_email = $this->input->post('b_email');
            // check email exist or not in user table
            $check_user = $this->user_model->getUserByEmailForGuest($bill_email, 'user');
            if ($check_user) {
                $user_id = $check_user->id;

                $data = [
                    "is_guest" => $guest,
                    "fname" => $this->input->post('b_fname'),
                    "lname" => $this->input->post('b_lname'),
                    // "email" => $this->input->post('b_email'),
                    "mobile" => $this->input->post('b_phone'),
                    "password" => '',
                    "updated_at" => date('Y-m-d H:i:s')
                ];
                $this->user_model->update($data, $user_id);
            } else {
                $data = [
                    "is_guest" => $guest,
                    "fname" => $this->input->post('b_fname'),
                    "lname" => $this->input->post('b_lname'),
                    "email" => $this->input->post('b_email'),
                    "mobile" => $this->input->post('b_phone'),
                    "password" => '',
                    "created_at" => date('Y-m-d H:i:s'),
                    "updated_at" => date('Y-m-d H:i:s')
                ];
                $user_id = $this->user_model->add($data);
                $user_id = $user_id;
            }
        } else {
            $guest = 0;
            $user_id = $this->session->has_userdata('user_id')
                ? $this->session->userdata('user_id')
                : 0;
        }
        $data = [
            "user_id" => $user_id,
            "b_fname" => $this->input->post('b_fname'),
            "b_lname" => $this->input->post('b_lname'),
            "b_address" => $this->input->post('b_address'),
            "b_city" => $this->input->post('b_city'),
            "b_country" => $this->input->post('b_country'),
            "b_state" => $this->input->post('b_state'),
            "b_landmark" => $this->input->post('b_landmark'),
            "b_pin" => $this->input->post('b_pin'),
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

        // check guest or user
        if (empty($this->session->userdata('email'))) {
            if ($this->address_model->getAddressByUserIdcheck($user_id)) {
                $existing_address = $this->address_model->getAddressByUserIdcheck($user_id);
                $address_id = $existing_address->id;
            }
        } else {
            $address_id = $this->input->post("address_id");
        }
        // $check_user = $this->user_model->getUserByEmail();

        $address = false;
        $order = false;
        $order_details_check = false;
        // new user
        if (empty($address_id)) {

            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");
            $address_id = $this->address_model->create($data);
            if ($address_id) {
                $address = true;
            } else {
                $address = false;
                echo json_encode([
                    "status" => "error",
                    "message" => "Data Cannot Saved."
                ]);
                return;
            }
        } else {
            // old user update address
            $data['updated_at'] = date("Y-m-d H:i:s");
            // echo $data['updated_at'];
            if ($this->address_model->update($data, $address_id)) {
                $address = true;
            } else {
                $address = false;
                echo json_encode([
                    "status" => "error",
                    "message" => "Data Cannot Updated."
                ]);
                return;
            }
        }

        // --------------------------- ORDER TABLE ----------------------

        // $order_data['user_id'] = $user_id;
        // $order_data['address_id'] = $address_id;
        // getting product price
        $cart = $this->session->userdata('cart') ?? [];
        $subtotal = 0;
        foreach ($cart as $item) {
            $product = $this->product_model->getProductById($item['product_id']);
            $subtotal += $item['qty'] * $product->price;
        }
        // getting coupons data
        $applied_coupon = $this->session->userdata('applied_coupon');

        $coupon = null;
        if (!empty($applied_coupon)) {
            $coupon = $this->coupon_model->getCouponById($applied_coupon['coupon_id']);

            $data['coupon_id'] = $coupon->id;
            // $order_data['coupon_code '] = $coupon->code;
            $discount = calculate_discount($subtotal, $coupon);
            $data['coupon_discount'] = $discount;
            $data['final_amount'] = $subtotal - $discount;
        } else {
            $data['final_amount'] = $subtotal;
        }
        $data['total_amount'] = $subtotal;

        $data['payment_method'] = $this->input->post('payment');
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");

        // insert order data
        $order_id = $this->order_model->create($data);
        // $this->session->set_userdata('order', [
        //     'order_id' => $order_id
        // ]);

        if ($order_id) {
            $enc_order_id = urlencode(base64_encode($this->encryption->encrypt($order_id)));
            $order = true;
            $unique_6_digit = substr(time() . rand(10, 99), -6);

            $order_number = 'ORD-' . date('Ymd') . '-' . $unique_6_digit . '-' . $order_id;

            // update order number
            if ($this->order_model->updateOrderNumber($order_number, $order_id)) {
                $order = true;
            }
        }


        // order details
        $cart = $this->session->userdata('cart') ?? [];

        foreach ($cart as $item) {
            // Get product data
            $product = $this->product_model->getProductById($item['product_id']);

            $order_details = [
                'order_id'   => $order_id,
                'product_id' => $item['product_id'],
                'quantity'   => $item['qty'],
                'price'      => $product->price,
                'total'      => $product->price * $item['qty'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            // Insert order_items
            if ($this->order_details_model->create($order_details)) {
                $order_details_check = true;
            }
        }


        // FINAL RESPONSE
        if ($address && $order && $order_details_check) {
            // getting payment details

            $payment_method = $this->order_model->getPaymentMethod($order_id);
            if ($payment_method->payment_method == 'Card') {
                // $this->session->set_userdata('payment_pending', true);

                echo json_encode([
                    "status" => "success",
                    "message" => "Order placed successfully!",
                    "order_id" => $order_id,
                    "redirect" => base_url('Payment/index/' . $enc_order_id)
                ]);
                return;
            }
            if ($payment_method->payment_method == 'Cash On Delivery') {
                $this->session->set_userdata('order_success', true);

                if ($this->session->has_userdata('applied_coupon')) {
                    $this->session->unset_userdata('applied_coupon');
                }


                if ($this->session->has_userdata('cart')) {
                    $this->session->unset_userdata('cart');
                }
                echo json_encode([
                    "status" => "success",
                    "message" => "Order placed successfully!",
                    "order_id" => $order_id,
                    "redirect" => base_url('Thank_you/index/' . $enc_order_id)
                ]);
                return;
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Something went wrong. Please try again."
            ]);
        }
        return;
    }

    function index()
    {

        // BLOCK checkout if cart is empty
        $cart = $this->session->userdata('cart');
        if (empty($cart)) {
            redirect('Shop');
            exit;
        }

        $cart = $this->session->userdata('cart');
        $cart_products = [];

        if (!empty($cart)) {
            foreach ($cart as $item) {
                $product = $this->product_model->getProductById($item['product_id']);

                if ($product) {
                    $product->qty = $item['qty'];
                    $cart_products[] = $product;
                }

                $data['product'] = $cart_products;
            }
            // load_views('checkout', $data);

            $user_id = $this->session->userdata('user_id');

            $email = $this->session->userdata('email');
            if (!empty($user_id)) {
                if ($this->address_model->getAddressByUserId($user_id)) {
                    $address = $this->address_model->getAddressByUserId($user_id);
                    if ($address->user_id == $user_id) {
                        $data['address'] = $address;
                    }
                } else {
                    $user_details = $this->user_model->getUserById($user_id);
                    $data['userdata'] = $user_details;
                }
            }
            $applied_coupon = $this->session->userdata('applied_coupon');

            $coupon = null;
            if (!empty($applied_coupon)) {
                $coupon = $this->coupon_model->getCouponById($applied_coupon['coupon_id']);
            }

            $data['coupon'] = $coupon;

            load_views('checkout', $data);
            return;
        }
        load_views('checkout');
    }
}
