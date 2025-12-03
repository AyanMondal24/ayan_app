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

        load_views('cart', $data);
    }

    public function remove_item()
    {
        // $this->session->sess_destroy();

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
            // echo "<pre>";
            // print_r($cart);
            // die;
            $this->cart_response();
        }

        // echo json_encode([
        //     'status' => 'success',
        //     'cart' => $cart,
        //     'cart_items' => count($cart)
        // ]);
    }

    function apply_coupon()
    {
        $coupon_code = $this->input->post('code');

        // Load cart subtotal directly from cart session
        $cart = $this->session->userdata('cart');
        if (!$cart) {
            echo json_encode(['status' => 'error', 'message' => 'Cart Empty']);
            return;
        }

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cart as $item) {
            $product = $this->product_model->getProductById($item['product_id']);
            $subtotal += $product->price * $item['qty'];
        }

        $coupon = $this->coupon_model->getCouponByCode($coupon_code);
        if (!$coupon) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid Coupon Code']);
            return;
        }

        // Calculate discount
        if ($coupon->discount_type === 'fixed') {
            $discount = $coupon->discount_value;
        } else {
            $discount = ($subtotal * $coupon->discount_value) / 100;
        }

        if ($discount > $subtotal) {
            $discount = $subtotal;
        }

        $this->session->set_userdata("applied_coupon", [
            "code" => $coupon->code,
            "type" => $coupon->discount_type,
            "discount" => $discount,
            "discount_value" => $coupon->discount_value,
            "grand_total" => ($subtotal - $discount),
        ]);

        $this->cart_response(); // will now handle coupon automatically
    }

    // function cart_response()
    // {
    //     $cart = $this->session->userdata('cart');
    //     $ids = array_keys($cart);
    //     // fetch product by this ids

    //     $db_products = $this->product_model->getProductById($ids);
    //     $products = [];
    //     foreach ($db_products as $Product) {
    //         $products[] = [
    //             "product_id" => $Product->product_id,
    //             "name" => $Product->product_name,
    //             "quantity" => $cart[$Product->product_id]['qty'],   // from session cart
    //             "price" => $Product->price,
    //             "subtotal" => $Product->price * $cart[$Product->product_id]['qty'],
    //             "image" => $Product->image_name,
    //             "alt_text" => $Product->alt_text,
    //             "unit" => $Product->short_name,
    //         ];
    //     }
    //     // $products = [
    //     //     [
    //     //         "product_id" => 12,
    //     //         "name" => "Wireless Mouse",
    //     //         "quantity" => 2,
    //     //         "price" => 500,
    //     //         "subtotal" => 1000,
    //     //         "image" => "https://yourwebsite.com/uploads/mouse.jpg"
    //     //     ],
    //     //     [
    //     //         "product_id" => 33,
    //     //         "name" => "Keyboard",
    //     //         "quantity" => 1,
    //     //         "price" => 500,
    //     //         "subtotal" => 500,
    //     //         "image" => "https://yourwebsite.com/uploads/keyboard.jpg"
    //     //     ]
    //     // ];
    //     foreach ($products as $key => $product) {
    //         $products[$key]['quantity'] = $cart[$product['product_id']]['qty'];
    //     }

    //     $coupon_code = $this->input->post('code');
    //     $coupon = $this->coupon_model->getCouponByCode($coupon_code);

    //     $subtotal = $this->input->post('total');
    //     // $subtotal = ;
    //     $coupon = [
    //         "code" => $coupon->code,
    //         "type" => $coupon->discount_type,
    //         "discount_value" => $coupon->discount_value
    //     ];

    //     $response = [
    //         "status" => "success",
    //         "subtotal" => $subtotal,
    //         "discount" => $coupon["amount"],
    //         "total" => $subtotal - $coupon["amount"],
    //         "coupon_applied" => false,
    //         "coupon" => $coupon,
    //         "products" => $products
    //     ];

    //     echo json_encode($response);
    // }

    public function cart_response()
    {
        // 1. Read cart session
        $cart = $this->session->userdata('cart');
        $cart_count = is_array($cart) ? count($cart) : 0;

        if (empty($cart)) {
            echo json_encode([
                "status" => "error",
                "message" => "Cart is empty"
            ]);
            return;
        }

        // 2. Get product IDs from cart (in same order)
        $cart_keys = array_column($cart, 'product_id');

        // 3. Fetch products from DB
        $db_products = $this->product_model->getProductByIds($cart_keys);

        // 4. Reorder DB results to match cart order
        $ordered_products = [];
        foreach ($cart_keys as $pid) {
            foreach ($db_products as $p) {
                if ($p->product_id == $pid) {
                    $ordered_products[] = $p;
                    break;
                }
            }
        }

        // 5. Build product list + subtotal
        $products = [];
        $subtotal = 0;

        foreach ($ordered_products as $p) {

            // find qty from cart
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

        // 6. Coupon Processing
        $session_coupon = $this->session->userdata('applied_coupon');

        $coupon_applied = false;
        $discount = 0;
        $coupon_data = null;

        if (!empty($session_coupon)) {
            // change this section 
            $coupon = $this->coupon_model->getCouponByCode($session_coupon['code']);

            if ($coupon) {
                $coupon_applied = true;
                $coupon_data = $session_coupon;

                if (strtotime($coupon->expiry_date) < time()) {
                    $this->session->unset_userdata('applied_coupon');
                    echo json_encode(['status' => 'error', 'message' => 'Coupon expired.']);
                    return;
                }
                if ($coupon->discount_type === 'fixed') {
                    $discount = $coupon->discount_value;
                } else {
                    $discount = ($subtotal * $coupon->discount_value) / 100;
                }

                if ($discount > $subtotal) {
                    $discount = $subtotal;
                }

                $coupon_applied = true;

                $coupon_data = [
                    "code" => $coupon->code,
                    "type" => $coupon->discount_type,
                    "discount_value" => $coupon->discount_value
                ];
            }
        }

        // here calculate the refresh coupon func 
        
        // 7. Final total
        $total = $subtotal - $discount;

        // 8. Response
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
