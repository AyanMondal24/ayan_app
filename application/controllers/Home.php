<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('common');
		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->library('pagination');
	}
	public function index()
	{
		$category_name = $this->input->post('category_name');
		// var_dump($category_name);
		// die;
		if (empty($category_name)) {
			$data['products'] = $this->product_model->getAllproducts(null, 8);
			$data['category'] = $this->category_model->getAllCategory();
		} else {
			$products = $this->product_model->getAllproducts($category_name, 8);
			$html = $this->load->view('ajax_products', ['products' => $products], TRUE);
			echo json_encode([
				'html' => $html
			]);
			return;
			// load_views('home', $html);
		}
		$data['vegetables'] = $this->product_model->getAllproducts('vegetables');
		$data['featured'] = $this->product_model->getAllproducts(null, null, '0');
		load_views('home', $data);
	}
	// public function contact()
	// {
	// 	load_views('contact');
	// }
	// public function shop()
	// {
	// 	$config = [];
	// 	$config['base_url'] = base_url("Home/shop/");
	// 	$config['total_rows'] = $this->product_model->totalProducts();
	// 	$config['per_page'] = 9;
	// 	$config['uri_segments'] = 3;

	// 	$config['full_tag_open'] = '<ul class="pagination">';
	// 	$config['full_tag_close'] = '</ul>';
	// 	$config['attributes'] = ['class' => 'page-link'];
	// 	$config['first_tag_open'] = '<li class="page-item">';
	// 	$config['first_tag_close'] = '</li>';
	// 	$config['last_tag_open'] = '<li class="page-item">';
	// 	$config['last_tag_close'] = '</li>';
	// 	$config['next_tag_open'] = '<li class="page-item">';
	// 	$config['next_tag_close'] = '</li>';
	// 	$config['prev_tag_open'] = '<li class="page-item">';
	// 	$config['prev_tag_close'] = '</li>';
	// 	$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
	// 	$config['cur_tag_close'] = '</span></li>';
	// 	$config['num_tag_open'] = '<li class="page-item">';
	// 	$config['num_tag_close'] = '</li>';

	// 	$this->pagination->initialize($config);

	// 	$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	// 	if ($this->input->is_ajax_request()) {
	// 		$category_name = $this->input->post('category_name');
	// 		$search = $this->input->post('search');
	// 		$price = $this->input->post('price');
	// 		$offset =  $this->input->post('offset') ?? 0;

	// 		$config['total_rows'] = $this->product_model->countTotalProduct($category_name, $search, $price);
	// 		$this->pagination->initialize($config);

	// 		$products = $this->product_model->getShopProducts($config['per_page'], $offset, $category_name, $search, $price);

	// 		$html = $this->load->view('ajax_products', ['shopProducts' => $products, 'category_name' => $category_name], TRUE);

	// 		echo json_encode([
	// 			'html' => $html,
	// 			'pagination' => $this->pagination->create_links()
	// 		]);
	// 		return;
	// 	}
	// 	$data['products'] = $this->product_model->getShopProducts($config['per_page'], $offset);
	// 	$data['total_product'] = $this->product_model->totalProducts();
	// 	$data['category'] = $this->category_model->getAllCategoryWithProductCount();
	// 	$data['pagination'] = $this->pagination->create_links();
	// 	load_views('shop', $data);
	// }

	// public function add_to_cart()
	// {
	// 	$id = $this->input->post('product_id');
	// 	$quantity = $this->input->post('quantity');
	// 	$update_mode = $this->input->post('update_mode');
	// 	$product = $this->product_model->getProductById($id);

	// 	// $this->session->sess_destroy();

	// 	// echo $product->image_name;
	// 	// die;
	// 	$cart = $this->session->userdata('cart');
	// 	if (!$cart) {
	// 		$cart = [];
	// 	}

	// 	$found = false;

	// 	foreach ($cart as &$item) {
	// 		if ($item['product_id'] == $id) {
	// 			if ($update_mode === 'add') {
	// 				// If product exists increase qty  
	// 				$item['qty'] += $quantity;
	// 			} else {
	// 				// update quantity 
	// 				$item['qty'] = $quantity;
	// 			}
	// 			$found = true;
	// 			break;
	// 		}
	// 	}


	// 	// If not found push new item
	// 	if (!$found) {
	// 		$cart[] = [
	// 			'product_id' => $product->product_id,
	// 			'name' => $product->product_name,
	// 			'qty' => $quantity,
	// 			'price' => $product->price,
	// 			'image' => $product->image_name,
	// 			'alt_text' => $product->alt_text,
	// 			'unit' => $product->short_name,
	// 		];
	// 	}

	// 	$this->session->set_userdata('cart', $cart);

	// 	echo json_encode([
	// 		'status' => 'success',
	// 		'cart_items' => count($cart)
	// 	]);
	// }



	// public function cart()
	// {
	// 	$cart = $this->session->userdata('cart');
	// 	if (!$cart) {
	// 		$cart = [];
	// 	}

	// 	load_views('cart', ['cart' => $cart]);
	// }
	// public function remove_item()
	// {
	// 	$product_id = $this->input->post('product_id');

	// 	$cart = $this->session->userdata('cart');

	// 	if ($cart) {
	// 		foreach ($cart as $key => $item) {
	// 			if ($item['product_id'] == $product_id) {
	// 				unset($cart[$key]);
	// 			}
	// 		}

	// 		// Reindex array
	// 		$cart = array_values($cart);

	// 		// Save updated cart
	// 		$this->session->set_userdata('cart', $cart);
	// 	}

	// 	echo json_encode([
	// 		'status' => 'success',
	// 		'cart' => $cart,
	// 		'cart_items' => count($cart)
	// 	]);
	// }


	public function checkout()
	{
		load_views('checkout');
	}
}
