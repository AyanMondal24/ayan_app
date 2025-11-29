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
        $update_mode = $this->input->post('update_mode');
        $product = $this->product_model->getProductById($id);

        // $this->session->sess_destroy();

        // echo $product->image_name;
        // die;
        $cart = $this->session->userdata('cart');
        if (!$cart) {
            $cart = [];
        }

        $found = false;

        foreach ($cart as &$item) {
            if ($item['product_id'] == $id) {
                if ($update_mode === 'add') {
                    // If product exists increase qty  
                    $item['qty'] += $quantity;
                } else {
                    // update quantity 
                    $item['qty'] = $quantity;
                }
                $found = true;
                break;
            }
        }


        // If not found push new item
        if (!$found) {
            $cart[] = [
                'product_id' => $product->product_id,
                'name' => $product->product_name,
                'qty' => $quantity,
                'price' => $product->price,
                'image' => $product->image_name,
                'alt_text' => $product->alt_text,
                'unit' => $product->short_name,
            ];
        }

        $this->session->set_userdata('cart', $cart);

        echo json_encode([
            'status' => 'success',
            'cart_items' => count($cart)
        ]);
    }

    public function index()
    {
        $cart = $this->session->userdata('cart');
        if (!$cart) {
            $cart = [];
        }

        load_views('cart', ['cart' => $cart]);
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
