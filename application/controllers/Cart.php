<?php

class Cart extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('common');
        $this->load->helper('calc_discount');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('coupon_model');
        $this->load->library('session');
        // $this->load->library('pagination');
    }



    public function add_to_cart()
    {
        $id = $this->input->post('product_id');
        $quantity = $this->input->post('quantity');

        $mode = $this->input->post('update_mode');

        $cart = $this->session->userdata('cart') ?? [];

        $found = false;

        foreach ($cart as &$item) {

            if ($item['product_id'] == $id) {

                if ($mode == 'add') {
                    $item['qty'] += $quantity;
                } else {
                    $item['qty'] = $quantity;
                }

                $found = true;
                break;
            }
        }


        if (!$found) {
            $cart[] = [
                'product_id' => $id,
                'qty' => $quantity
            ];
        }

        $this->session->set_userdata('cart', $cart);

        $this->cart_response();
        // echo json_encode([
        //     'status'=>'success'
        // ]);
    }


    public function index()
    {

        $cart = $this->session->userdata('cart') ?? [];
        $cart_products = [];

        foreach ($cart as $item) {

            $product = $this->product_model->getProductById($item['product_id']);

            if ($product) {
                $product->qty = $item['qty'];  // attach session qty
                $cart_products[] = $product;  // push to final array
            }
        }

        $data['product'] = $cart_products;

        $applied_coupon = $this->session->userdata('applied_coupon');

        $coupon = null;
        if (!empty($applied_coupon)) {
            $coupon = $this->coupon_model->getCouponById($applied_coupon['coupon_id']);
        }

        $data['coupon'] = $coupon;
        
        load_views('cart', $data);
    }

    public function remove_item()
    {
        $product_id = $this->input->post('product_id');
        $cart = $this->session->userdata('cart');

        if ($cart) {
            foreach ($cart as $key => $item) {
                if ($item['product_id'] == $product_id) {
                    unset($cart[$key]);
                }
            }

            // Reindex array
            $cart = array_values($cart);

            // Save updated cart
            if (count($cart) > 0) {
                $this->session->set_userdata('cart', $cart);
            } else {
                $this->session->unset_userdata('cart');
                $this->session->unset_userdata('applied_coupon');
            }

            return $this->cart_response(); // return refreshed values
        }
    }

    function apply_coupon()
    {

        // Load cart subtotal directly from cart session
        $cart = $this->session->userdata('cart');
        if (!$cart) {
            echo json_encode(['status' => 'error', 'message' => 'Cart Empty']);
            return;
        }
        $coupon_code = $this->input->post('code');

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cart as $item) {
            $product = $this->product_model->getProductById($item['product_id']);
            $subtotal += $product->price * $item['qty'];
        }


        $coupon = $this->coupon_model->getCouponByCode($coupon_code);
        if (!$coupon) {
            // $this->session->unset_userdata("applied_coupon");
            $this->cart_response();
            return;
        }

        $discount = calculate_discount($subtotal, $coupon);

        // Calculate discount
        // if ($coupon->discount_type === 'fixed') {
        //     $discount = $coupon->discount_value;
        // } else {
        //     $discount = ($subtotal * $coupon->discount_value) / 100;
        // }

        // if ($discount > $subtotal) {
        //     $discount = $subtotal;
        // }

        $this->session->set_userdata("applied_coupon", [
            "coupon_id" => $coupon->id
        ]);
        $this->cart_response();
    }


    public function cart_response()
    {
        // Read cart session
        $cart = $this->session->userdata('cart');
        $cart_count = is_array($cart) ? count($cart) : 0;

        if (empty($cart)) {
            echo json_encode([
                "status" => "error",
                "cart_items" => 0,
                "message" => "Cart is empty"
            ]);
            return;
        }

        // Get IDs
        $cart_keys = array_column($cart, 'product_id');

        //Fetch products
        $db_products = $this->product_model->getProductByIds($cart_keys);

        //  Maintain order
        $ordered_products = [];
        foreach ($cart_keys as $pid) {
            foreach ($db_products as $p) {
                if ($p->product_id == $pid) {
                    $ordered_products[] = $p;
                    break;
                }
            }
        }

        // Build cart products
        $products = [];
        $subtotal = 0;

        foreach ($ordered_products as $p) {

            foreach ($cart as $item) {
                if ($item['product_id'] == $p->product_id) {
                    $qty = $item['qty'];
                    break;
                }
            }

            $itemSubtotal = $p->price * $qty;

            $products[] = [
                "product_id" => $p->product_id,
                "name" => $p->product_name,
                "quantity" => $qty,
                "price" => $p->price,
                "subtotal" => $itemSubtotal,
                "image" => $p->image_name,
                "alt_text" => $p->alt_text,
                "unit" => $p->short_name,
            ];

            $subtotal += $itemSubtotal;
        }

        // Coupons 
        $session_coupon = $this->session->userdata('applied_coupon');

        $discount = 0;
        $coupon_applied = false;
        $coupon_data = null;

        if (!empty($session_coupon)) {
            $coupon = $this->coupon_model->getCouponById($session_coupon['coupon_id']);

            $discount = calculate_discount($subtotal, $coupon);

            // Recalculate discount every cart refresh
            // if ($coupon->discount_type === 'percentage') {
            //     $discount = ($subtotal * $coupon->discount_value) / 100;
            // } else {
            //     $discount = $coupon->discount_value; //if fixed
            // }

            // if ($discount > $subtotal) {
            //     $discount = $subtotal;
            // }

            $coupon_applied = true;

            $coupon_data = [
                "code" => $coupon->code,
                "type" => $coupon->discount_type,
                "discount_value" => $coupon->discount_value,
                "discount" => $discount
            ];
        }


        // coupon exist and also new coupon comes 
        $input_coupon   = $this->input->post("code");
        if ($input_coupon) {

            $coupon = $this->coupon_model->getCouponByCode($input_coupon);

            if (!$coupon) {
                $this->session->unset_userdata('applied_coupon');
                $discount = 0;
                $coupon_applied = false;

                $coupon_data = [
                    "code" => '',
                    "type" => '',
                    "discount_value" => '',
                    "discount" => ''

                ];
            } else {

                if (strtotime($coupon->expiry_date) < time()) {
                    $this->session->unset_userdata('applied_coupon');

                    $discount = 0;
                    $total = $subtotal;

                    echo json_encode([
                        "status" => "couponError",
                        "message" => "Coupon Expired",
                        "subtotal" => $subtotal,
                        "discount" => 0,
                        "total" => $total,
                        "coupon_applied" => false,
                        "coupon" => null,
                        "cart_items" => $cart_count,
                        "products" => $products
                    ]);
                    return;
                }

                // New discount calculate with updated subtotal
                $discount = calculate_discount($subtotal, $coupon);

                // if ($coupon->discount_type === 'percentage') {
                //     $discount = ($subtotal * $coupon->discount_value) / 100;
                // } else {
                //     $discount = $coupon->discount_value;
                // }

                // if ($discount > $subtotal) {
                //     $discount = $subtotal;
                // }

                $coupon_applied = true;

                $this->session->set_userdata('applied_coupon', [
                    "coupon_id" => $coupon->id
                ]);
                $coupon_data = [
                    "code" => $coupon->code,
                    "type" => $coupon->discount_type,
                    "discount_value" => $coupon->discount_value,
                    "discount" => $discount
                ];
            }
        }

        //  Final Total

        $total = $subtotal - $discount;

        //Final JSON Response
        echo json_encode([
            "status" => "success",
            "subtotal" => $subtotal,
            "discount" => $discount,
            "total" => $total,
            "coupon_applied" => $coupon_applied,
            "coupon" => $coupon_data,
            "cart_items" => $cart_count,
            "products" => $products
        ]);
    }
}
