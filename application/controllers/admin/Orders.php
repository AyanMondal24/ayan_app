<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->library('encryption');
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
        $data['orders'] = $this->order_model->getAllOrdersAdmin();

        load_admin_views('view_orders', $data);
    }

    public function confirm($order_id)
    {
        $id=$this->encryption->decrypt(base64_decode(urldecode($order_id)));

        if (!$id) {
            show_error('Invalid order ID');
        }

        $this->order_model->updateOrderStatus($id, 'confirmed');

        $this->session->set_flashdata('success', 'Order confirmed successfully');
        redirect('admin/orders/view/' . $order_id);
    }

    public function cancel($order_id)
    {
        $id=$this->encryption->decrypt(base64_decode(urldecode($order_id)));

        if (!$id) {
            show_error('Invalid order ID');
        }

        $this->order_model->updateOrderStatus($id, 'cancelled');

        $this->session->set_flashdata('success', 'Order cancelled successfully');
        redirect('admin/orders/view/' . $order_id);
    }
}
