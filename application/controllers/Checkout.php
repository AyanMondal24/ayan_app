<?php
class Checkout extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('product_model');
    }

    function index()
    {
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
            load_views('checkout', $data);
            return;
        }
        load_views('checkout');
    }
}
