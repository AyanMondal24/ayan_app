<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('order_model');
        $this->load->model('product_model');
        $this->load->model('user_model');
        $this->load->library('encryption');
    }

    public function index()
    {
        $data['orders'] = $this->order_model->getAdminHomeOrders();
        $data['products'] = $this->product_model->getAdminHomeProducts();
        $data['total_products'] = $this->product_model->countTotalProduct();
        $data['total_orders'] = $this->order_model->countTotalOrder();
        $data['members'] = $this->user_model->total_data();
        $data['latest_users']=$this->user_model->get_latest_users();
        if ($this->session->userdata('admin_logged_in')) {
            $id = $this->session->userdata('admin_id');
            $data['admin'] = $this->admin_model->getAdminById($id);
            // load_admin_views('home', $data);
            // return;
        }

        load_admin_views('home', $data);
    }
}
