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
        }

        echo json_encode(['selected' => $data]);
    }

    function index()
    {
        $range = 1;
        $search = '';
        $filterBy = '';
        $filterValue = '';
        $sortOrder='';
        $sortColumn='';

        $pageno = (int) ($this->input->post('pageno') ?? 1);
        $search = $this->input->post('search') ?? '';
        $sortOrder = ($this->input->post('sortOrder')=='desc') ? 'desc': 'asc';

        $sortColumn = $this->input->post('sortColumn') ?? '';
        $filterBy = $this->input->post('filterBy') ?? '';
        $filterValue = $this->input->post('filterValue') ?? '';

        $orders = [];
        $pagination = '';

        $per_page = (int) $this->input->post('per_page');
        if ($per_page <= 0) {
            $per_page = 5; // safe default
        }

        $offset = ($pageno - 1) * $per_page;
        $total_item = $this->order_model->countTotalOrder($search, $filterBy, $filterValue);

        $orders = $this->order_model->getAllOrdersAdmin(
            $per_page,
            $offset,
            $search,
            $filterBy,
            $filterValue,
            $sortOrder,
            $sortColumn
        );


        $total_pages = ($per_page > 0) ? ceil($total_item / $per_page) : 1;

        // pagination
        $firstDisable = ($pageno == 1) ? 'disabled' : '';
        $firstPage = ($pageno == 1) ? 1 : 1;

        $pagination .= "<a href='javascript:void(0)' class='page-link $firstDisable' data-id='$firstPage'>First</a>";

        if ($pageno > 1) {
            $pagination .= "<a href='javascript:void(0)' class='' data-id='" . ($pageno - 1) . "'><i class='bi bi-chevron-left'></i> </a>";
        }
        // first 2 page
        for ($i = 1; $i <= min(2, $total_pages); $i++) {
            $active = ($pageno == $i) ? 'active' : '';
            $pagination .= "<a href='javascript:void(0)' class='" . $active . "'  data-id='" . $i . "'>" . $i . "</a>";
        }

        if ($pageno > 4) {
            $pagination .= "<span class='page-dots'>...</span>";
        }

        // middle page
        $start = max(3, $pageno - $range);
        $end   = min($total_pages - 2, $pageno + $range);

        for ($i = $start; $i <= $end; $i++) {
            if ($i <= 2 || $i > $total_pages - 2) continue;
            $active = ($pageno == $i) ? 'active' : '';
            $pagination .= "<a href='javascript:void(0)' class='" . $active . "'  data-id='" . $i . "'>" . $i . "</a>";
        }

        if ($pageno < $total_pages - 3) {
            $pagination .= "<span class='page-dots'>...</span>";
        }

        for ($i = max($total_pages - 1, 3); $i <= $total_pages; $i++) {
            $active = ($pageno == $i) ? 'active' : '';
            $pagination .= "<a href='javascript:void(0)' class='" . $active . "'  data-id='" . $i . "'>" . $i . "</a>";
        }


        if ($pageno < $total_pages) {
            $pagination .= "<a href='javascript:void(0)' class='' data-id='" . ($pageno + 1) . "'><i class='bi bi-chevron-right'></i> </a>";
        }

        $lastDisabled = ($pageno == $total_pages) ? 'disabled' : '';
        $lastPage = $total_pages;

        $pagination  .= "<a href='javascript:void(0)' class='page-link $lastDisabled' data-id='$lastPage'>Last</a>";

        foreach ($orders as &$order) {
            $order->enc_order_id = urlencode(
                base64_encode(
                    $this->encryption->encrypt($order->order_id)
                )
            );
        }
        unset($order);

        if ($this->input->is_ajax_request()) {
            echo json_encode([
                'orders' => $orders,
                'pagination' => $pagination,
                'offset' => $offset,
                'per_page'=>$per_page,
                'total_item'=>$total_item,
                'pageno' => $pageno,
                'sortOrder' => $sortOrder,
                'sortColumn' => $sortColumn,
                // 'links'  => $links
            ]);
            return;
        }

        $data['orders'] = $orders;
        $data['offset'] = $offset;

        load_admin_views('view_orders', $data);
    }

    function getEntriesPerPage(){
        $total_item = $this->order_model->countTotalOrder();
        echo json_encode([
            'status' => 'success',
            'total' => $total_item
        ]);
        return;
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
