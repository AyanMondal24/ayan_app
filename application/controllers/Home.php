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
	
		$this->load->view('includes/header');
		$this->load->view('home');
		$this->load->view('includes/footer');
	}
}
