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
		$this->load->model('order_details_model');
		$this->load->library('pagination');
	}
	public function index()
	{
		$category_name = $this->input->post('category_name');

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
		$data['total_product'] = $this->product_model->totalProduct();
		$data['slider_category'] = $this->category_model->getAllCategory();
		$data['best_sales_product'] = $this->order_details_model->getBestSellingProduct();
		load_views('home', $data);
	}


	public function checkout()
	{
		load_views('checkout');
	}
}
