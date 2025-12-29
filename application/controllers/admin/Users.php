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
        $pageno = $this->input->post('pageno') ?? 1;
        $per_page = (int) 3;
        $offset = ($pageno - 1) * $per_page;

        $users = $this->user_model->getAllUsers($per_page, $offset);

        $total_item = $this->user_model->total_data();

        $total_pages = ceil($total_item / $per_page);

        $firstDisabled = ($pageno == 1) ? 'disabled' : '';
        $firstPage = ($pageno == 1) ? 1 : 1;

        $create_page .= "<a href='javascript:void(0)' class='page-link $firstDisabled' data-id='$firstPage'>First</a>";

        if ($pageno > 1) {
            $create_page .= "<a href='javascript:void(0)' class='' data-id='" . ($pageno - 1) . "'><i class='bi bi-chevron-left'></i> </a>";
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($pageno == $i) {
                $create_page .= "<a href='javascript:void(0)' class='active' data-id='" . $i . "'>" . $i . "</a>";
            } else {
                $create_page .= "<a href='javascript:void(0)' class='' data-id='" . $i . "'>" . $i . "</a>";
            }
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
                // "links" => $links,
                "offset" => $offset,
            ]);
            exit;
        } else {
            $data['users'] = $users;
            // $data['links'] = $links;
            load_admin_views('view_users', $data);
        }
    }

    public function change_status()
    {
        $status = $this->input->post('status');
        $user_id = $this->input->post('user_id');

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
