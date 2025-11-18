<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->helper('form', 'url');
        // $this->load->helper('view');
        $this->load->library('pagination');
        $this->load->library('encryption');
        $this->load->library('form_validation');
    }

    public function add($enc_id = null)
    {
        $id = $this->encryption->decrypt(base64_decode(urldecode($enc_id)));
        if (!empty($id)) {
            $data['category'] = $this->category_model->getSingleCategory($id);
            $data['title'] = 'Updating Category';
            // load_admin_views('add_category', $data);
        } else {
            $data['category'] = null;
            $data['title'] = 'Adding Category';
        }
        load_admin_views('add_category', $data);
    }

    public function store()
    {
        // if (isset($_POST['submit'])) {

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if (empty($this->input->post('id'))) {
            $this->form_validation->set_rules('image', 'Category Image', 'callback_file_check');
        } else {
            if (!empty($_FILES['image']['name'])) {
                $this->form_validation->set_rules('image', 'Category Image', 'callback_file_check');
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $errors = [];
            $fields_name = ['name', 'image'];
            foreach ($fields_name as $field) {
                $error = form_error($field);
                if (!empty($error)) {
                    $errors[$field] = $error;
                }
            }
            echo json_encode([
                "status" => "error",
                "errors" => $errors
            ]);
            return;
        } else {
            $imageName = $this->input->post('old_img');
            if (!empty($_FILES['image']['name'])) {
                $prefix = 'cat_';
                $unique_id = uniqid();
                $config['upload_path'] = FCPATH . 'assets/uploads/category';
                $config['allowed_types'] = 'jpeg|jpg|png|gif';
                $config['max_size'] = 2048;
                $config['encrypt_name']  = FALSE;
                $config['file_name']  = $prefix . $unique_id;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $imageName = $uploadData['file_name'];
                } else {
                    // Upload failed
                    echo $this->upload->display_errors('<span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;">', '</span>');
                    return;
                }
            }


            $data = [
                'name' => $this->input->post('name'),
                'image' => $imageName,
            ];

            if (empty($this->input->post('id'))) {
                // add 
                if ($this->category_model->setCategory($data) == true) {
                    echo  json_encode(["status" => "success"]);
                }
            }else{
                // update 
                $id=$this->input->post('id');
                 if ($this->category_model->updateCategory($id,$data) == true) {
                    echo  json_encode(["status" => "update"]);
                }
            }
        }
        // }
    }

    public function file_check()
    {
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_message('file_check', 'Please select an image to upload.');
            return FALSE;
        }

        // Basic checks: is actually an image and allowed mime/extension and size
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size']; // bytes
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed_ext)) {
            $this->form_validation->set_message('file_check', 'Only JPG, JPEG, PNG and GIF files are allowed.');
            return FALSE;
        }

        // check filesize (example max 2MB)
        if ($file_size > 2 * 1024 * 1024) {
            $this->form_validation->set_message('file_check', 'File size must be less than 2MB.');
            return FALSE;
        }

        // ensure it's an actual image
        $tmp = @getimagesize($_FILES['image']['tmp_name']);
        if ($tmp === FALSE) {
            $this->form_validation->set_message('file_check', 'The uploaded file is not a valid image.');
            return FALSE;
        }

        // optional: check mime types more strictly
        $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($tmp['mime'], $allowed_mimes)) {
            $this->form_validation->set_message('file_check', 'Image MIME type is not allowed.');
            return FALSE;
        }

        return TRUE;
    }

    public function index()
    {
        $config = [];
        $config['base_url'] = base_url('admin/Category/index');
        $config['total_rows'] = $this->category_model->getTotalCategory();
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
        $this->pagination->initialize($config);

        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data['category'] = $this->category_model->getCategory($config['per_page'], $offset);
        $data['links'] = $this->pagination->create_links();
        $data['offset'] = $offset;

        load_admin_views('view_category', $data);
    }

    public function view($enc_id)
    {
        $id = $this->encryption->decrypt(base64_decode(urldecode($enc_id)));
        $data['category'] = $this->category_model->getSingleCategory($id);

        load_admin_views('category_single_view', $data);
    }
}
