<?php

class Cart extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('common');
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

        echo json_encode([
            'status'      => 'success',
            'cart_items'  => count($cart)
        ]);
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
            $this->session->set_userdata('cart', $cart);
        }

        echo json_encode([
            'status' => 'success',
            'cart' => $cart,
            'cart_items' => count($cart)
        ]);
    }

    function apply_coupon()
    {
        $coupon_code = $this->input->post('code');
        $subtotal = $this->input->post('total');
        $coupon = $this->coupon_model->getCouponByCode($coupon_code);

        if (!$coupon) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid Coupon Code.']);
            return;
        }
        if (strtotime($coupon->expiry_date) < time()) {
            echo json_encode(['status' => 'error', 'message' => 'Coupon expired.']);
            return;
        }
        // calculate 
        if ($coupon->discount_type === 'fixed') {
            $discount = $coupon->discount_value;
        } else {
            // percentage 
            $discount = ($subtotal * $coupon->discount_value) / 100;
        }
        $grand_total = $subtotal - $discount;
        if ($grand_total <= 0) {
            $grand_total = 0;
        }
        $this->session->set_userdata([
            'coupon_code' => $coupon->code,
            'discount' => $discount,
            'grand_total' => $grand_total,
        ]);
        echo json_encode([
            "status" => "success",
            "discount" => $discount,
            "grand_total" => $grand_total
        ]);
    }
}
