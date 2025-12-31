<?php
class Users extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('encryption');
        $this->load->library('pagination');
        $this->load->model('user_model');
    }

    function index()
    {
        $create_page = '';
        $searchval=$this->input->post('searchval')??'';
        $userType=$this->input->post('userType')??'';
        $sort_column = $this->input->post('sortColumn') ?? 'id';
        // $sort_order  = $this->input->post('sortOrder')=='desc' ? 'DESC': 'ASC';
        $sort_order = strtolower(
            $this->input->post('sortOrder') == 'desc' ? 'desc' : 'asc'
        );


        $pageno = $this->input->post('pageno') ?? 1;

        $per_page = (int) ($this->input->post('per_page') ?? 5);

        $offset = ($pageno - 1) * $per_page;

        $users = $this->user_model->getAllUsers($per_page, $offset,$sort_column,$sort_order,$searchval, $userType);

        $total_item = $this->user_model->total_data($searchval, $userType);

        $total_pages = ceil($total_item / $per_page);

        $firstDisabled = ($pageno == 1) ? 'disabled' : '';
        $firstPage = ($pageno == 1) ? 1 : 1;

        $range = 1;

        $create_page .= "<a href='javascript:void(0)' class='page-link $firstDisabled' data-id='$firstPage'>First</a>";

        if ($pageno > 1) {
            $create_page .= "<a href='javascript:void(0)' class='' data-id='" . ($pageno - 1) . "'><i class='bi bi-chevron-left'></i> </a>";
        }

        //first 2 page show
        for ($i = 1; $i <= min(2, $total_pages); $i++) {
            $active = ($pageno == $i) ? 'active' : '';
            $create_page .= "<a href='javascript:void(0)' class='" . $active . "' data-id='" . $i . "'>" . $i . "</a>";
        }

        if ($pageno > 4) {
            $create_page .= "<span class='page-dots'>...</span>";
        }
        $start = max(3, $pageno - $range);
        $end = min($total_pages - 2, $pageno + $range);

        for ($i = $start; $i <= $end; $i++) {
            if ($i <= 2 || $i > $total_pages - 2) continue;
            $active = ($pageno == $i) ? 'active' : '';
            $create_page .= "<a href='javascript:void(0)' class='" . $active . "'  data-id='" . $i . "'>" . $i . "</a>";
        }

        if ($pageno < $total_pages - 3) {
            $create_page .= "<span class='page-dots'>...</span>";
        }
        for ($i = max($total_pages - 1, 3); $i <= $total_pages; $i++) {
            $active = ($pageno == $i) ? 'active' : '';
            $create_page .= "<a href='javascript:void(0)' class='" . $active . "'  data-id='" . $i . "'>" . $i . "</a>";
        }

        if ($pageno < $total_pages) {
            $create_page .= "<a href='javascript:void(0)' class='' data-id='" . ($pageno + 1) . "'><i class='bi bi-chevron-right'></i> </a>";
        }

        $lastDisabled = ($pageno == $total_pages) ? 'disabled' : '';
        $lastPage = $total_pages;

        $create_page .= "<a href='javascript:void(0)' class='page-link $lastDisabled' data-id='$lastPage'>Last</a>";

        if ($this->input->is_ajax_request()) {
            echo json_encode([
                "users" => $users,
                "pagination" => $create_page,
                "sortOrder" => $sort_order,
                "sortColumn"  => $sort_column,
                "offset" => $offset,
                "per_page" => $per_page,
                "total_item" => $total_item,
                "userType" => $userType,
            ]);
            exit;
        } else {
            $data['users'] = $users;
            // $data['links'] = $links;
            load_admin_views('view_users', $data);
        }
    }

    function getEntriesPerPage(){
        $total_item = $this->user_model->total_data();
        echo json_encode([
            'status'=>'success',
            'total'=>$total_item
        ]);
        return;
    }
    public function change_status()
    {
        $user_id = $this->input->post('user_id');
        $status = $this->input->post('status');

        if (!$user_id || !in_array($status, ['0', '1'], true)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid data'
            ]);
            exit;
        }

        $updated = $this->user_model->update_status($user_id, $status);

        echo json_encode([
            'success' => $updated ? true : false
        ]);
        exit;
    }
}
