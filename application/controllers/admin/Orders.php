<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->library('encryption');
        $this->load->library('pagination');
    }

    function view($order_id)
    {
        $id = $this->encryption->decrypt(base64_decode(urldecode($order_id)));

        $data['products'] = $this->order_model->getOrderItems($id);

        $data['order_details'] = $this->order_model->getOrderSummary($id);
        load_admin_views('order_single_view', $data);
    }
    function index()
    {
        $config = [];
        $config['base_url'] = base_url('admin/Orders/index/');
        $config['total_rows'] = $this->order_model->countTotalOrder();
        $config['per_page'] = 6;
        $config['uri_segment'] = 4;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;


        $data['orders'] = $this->order_model->getAllOrdersAdmin($config['per_page'], $offset);
        $data['links'] = $this->pagination->create_links();
        $data['offset'] = $offset;


        load_admin_views('view_orders', $data);
    }

    public function confirm($order_id)
    {
        $id = $this->encryption->decrypt(base64_decode(urldecode($order_id)));

        if (!$id) {
            show_error('Invalid order ID');
        }

        $this->order_model->updateOrderStatus($id, 'confirmed');

        $this->session->set_flashdata('success', 'Order confirmed successfully');
        redirect('admin/orders/view/' . $order_id);
    }

    public function cancel($order_id)
    {
        $id = $this->encryption->decrypt(base64_decode(urldecode($order_id)));

        if (!$id) {
            show_error('Invalid order ID');
        }

        $this->order_model->updateOrderStatus($id, 'cancelled');

        $this->session->set_flashdata('success', 'Order cancelled successfully');
        redirect('admin/orders/view/' . $order_id);
    }
}
