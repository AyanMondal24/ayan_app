<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->helper('url','form');
    }

    public function addProducts()
    {
        $this->load->view('admin/includes/header');
        $this->load->view('admin/add_products');
        $this->load->view('admin/includes/footer');
    }

    public function saveProducts(){
        $data=[
            'title' => $this->input->post('title'),
            'description' => $this->input->post('desc')
        ];
        $this->product_model->setProducts($data);
        echo "Successfully submitted";
    }
    public function viewProducts()
    {
        $data['products']=$this->product_model->getProducts();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/view_products',$data);
        $this->load->view('admin/includes/footer');
    }
}
