<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Product');
	}
	public function index()
	{
		$data['products'] = $this->Product->getProducts();
		$this->load->view('home', $data);
	}
}
