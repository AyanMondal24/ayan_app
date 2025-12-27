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
        $offset = 0;
        if ($this->input->is_ajax_request()) {
            $offset = $this->input->post('offset');
        } else {
            // $offset = $this->input->post('offset') ?? 0;
            $offset = (int) $this->uri->segment(4,1);
        }

        $total_row = $this->user_model->total_data();
        $config = [];
        $config['base_url'] = base_url('admin/users/index');
        $config['total_rows'] = $total_row;
        $config['per_page'] = 3;
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
        $config['next_link'] = '>';
        $config['prev_link'] = '<';
        $config['first_link'] = FALSE;
        $config['last_link']  = FALSE;

        $current_page = floor($offset / $config['per_page']) + 1;

        $config['cur_page'] = $current_page;

        $this->pagination->initialize($config);

        $users = $this->user_model->getAllUsers($config['per_page'], $offset);

        $links = $this->pagination->create_links();

        if ($this->input->is_ajax_request()) {
            echo json_encode([
                "users" => $users,
                "links" => $links,
                "offset" => $offset,
            ]);
            exit;
        } else {

            $data['users'] = $users;
            $data['links'] = $links;
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
