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
        $pageno = (int) $this->input->get('pageno', TRUE);
        $id = $this->encryption->decrypt(base64_decode(urldecode($order_id)));

        $data['products'] = $this->order_model->getOrderItems($id);

        $data['order_details'] = $this->order_model->getOrderSummary($id);
        $data['pageno'] = $pageno;
        load_admin_views('order_single_view', $data);
    }

    public function set_select()
    {
        $select = $this->input->post('select');

        if ($select == 'payment_status') {
            $data = [
                ['value' => 'paid', 'label' => 'Paid'],
                ['value' => 'pending', 'label' => 'Pending'],
                ['value' => 'cancel', 'label' => 'Cancel'],
            ];
        } elseif ($select == 'order_status') {
            $data = [
                ['value' => 'confirmed', 'label' => 'Confirmed'],
                ['value' => 'pending', 'label' => 'Pending'],
                ['value' => 'cancelled', 'label' => 'Cancelled'],
            ];
        } else {
            $data = [
                ['value' => 'ASC', 'label' => 'Ascending'],
                ['value' => 'DESC', 'label' => 'Descending'],
            ];
        }

        echo json_encode(['selected' => $data]);
    }

    function index()
    {
        $offset = 0;
        $search = '';
        $filterBy = '';
        $filterValue = '';

        if ($this->input->is_ajax_request()) {
            $offset = (int) $this->input->post('offset');
            $search = $this->input->post('search');
            $filterBy = $this->input->post('filterBy');
            $filterValue = $this->input->post('filterValue');
        } else {
            $search = $this->input->post('search') ?? '';
            $filterBy = $this->input->post('filterBy') ?? '';
            $filterValue = $this->input->post('filterValue') ?? '';
            $offset = (int) $this->uri->segment(4, 0);
        }

        $total_rows = $this->order_model->countTotalOrder($search, $filterBy, $filterValue);

        $config['base_url'] = base_url('admin/Orders/index/');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 6;
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;

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
        $config['next_link'] = '>';
        $config['prev_link'] = '<';
        $config['first_link'] = FALSE;
        $config['last_link']  = FALSE;


        $orders = [];
        $links = '';
        if ($total_rows > $config['per_page']) {
            if ($offset >= $total_rows) {
                $offset = 0;
            }

            $config['cur_page'] = $offset;

            $this->pagination->initialize($config);

            $orders = $this->order_model->getAllOrdersAdmin(
                $config['per_page'],
                $offset,
                $search,
                $filterBy,
                $filterValue
            );
            $links = $this->pagination->create_links();
        } else {
            // Only one page or no data
            $offset = 0;

            if ($total_rows > 0) {
                $orders = $this->order_model->getAllOrdersAdmin(
                    $config['per_page'],
                    0,
                    $search,
                    $filterBy,
                    $filterValue
                );
            }
        }

        $current_page = ($total_rows > 0)
            ? floor($offset / $config['per_page']) + 1
            : 1;

        foreach ($orders as &$order) {
            $order->enc_order_id = urlencode(
                base64_encode(
                    $this->encryption->encrypt($order->order_id)
                )
            );
            $order->pageno = $current_page;
        }
        unset($order);

        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'total_rows' => $total_rows,
                'offset' => $offset,
                'pageno' => $current_page,
                'orders' => $orders,
                'links'  => $links
            ]);
            return;
        }

        $data['orders'] = $orders;
        $data['links']  = $this->pagination->create_links();
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
