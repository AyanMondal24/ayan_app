<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends MY_Controller
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
        $this->load->helper('image');
        $this->load->helper('slug');
    }

    public function add($enc_id = null)
    {
        $id = $this->encryption->decrypt(base64_decode(urldecode($enc_id)));
        if (!empty($id)) {
            // edit page
            $data['category'] = $this->category_model->getSingleCategory($id);
            $data['title'] = 'Updating Category';
            // load_admin_views('add_category', $data);
        } else {
            // add page
            $data['category'] = null;
            $data['title'] = 'Adding Category';
        }
        load_admin_views('add_category', $data);
    }

    public function store()
    {
        // if (isset($_POST['submit'])) {

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('alt_text', 'Alt Text', 'required|trim');

        if (empty($this->input->post('id'))) {
            // add
            $this->form_validation->set_rules('image', 'Category Image', "callback_file_check[image]");
        } else {
            // update
            if (!empty($_FILES['changeImage']['name'])) {
                $this->form_validation->set_rules('changeImage', 'Category Image', "callback_file_check[changeImage]");
            }
        }
        // $this->form_validation->set_rules('update_alt_text', 'Alt Text', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errors = [];
            $fields_name = ['name', 'image', 'alt_text', 'changeImage'];
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
        }

        $category_id = $this->input->post('id');

        if (empty($category_id)) {
            $rowImage = isset($_FILES['image']['name']) ?
                str_replace(' ', '_', $_FILES['image']['name']) : '';
            if (!empty($rowImage)) {
                $prefix = 'cat_';
                $unique_id = uniqid();
                $parm_folder = FCPATH . 'assets/uploads/category/original/';
                $ext = pathinfo($rowImage, PATHINFO_EXTENSION);

                $new_file = $prefix . $unique_id . "." . $ext;
                $destination = $parm_folder . $new_file;
                $tmp_name = $_FILES['image']['tmp_name'];

                if (move_uploaded_file($tmp_name, $destination)) {

                    // Create resized versions using SAME filename
                    create_image_copy(
                        FCPATH . 'assets/uploads/category/',
                        $new_file,
                        150,
                        150,
                        'thumb'
                    );

                    create_image_copy(
                        FCPATH . 'assets/uploads/category/',
                        $new_file,
                        600,
                        600,
                        'medium'
                    );
                    $cat_name= $this->input->post('name');
                    $category_slug= generate_unique_slug($cat_name, 'category','category_slug');
                    $data = [
                        'name' => $this->input->post('name'),
                        'image' => $new_file,
                        'image_alt' => $this->input->post('alt_text'),
                        'category_slug'=> $category_slug
                    ];

                    if ($this->category_model->setCategory($data)) {
                        echo  json_encode(["status" => "success"]);
                    } else {
                        $original = FCPATH . 'assets/uploads/category/original/' . $new_file;
                        $medium   = FCPATH . 'assets/uploads/category/medium/'   . $new_file;
                        $thumb    = FCPATH . 'assets/uploads/category/thumb/'    . $new_file;

                        if (file_exists($original)) unlink($original);
                        if (file_exists($medium)) unlink($medium);
                        if (file_exists($thumb)) unlink($thumb);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => "Faild to upload local folder : $destination "]);
                }
            }
        } else {
            // update page code
            $changeImage = isset($_FILES['changeImage']['name']) ?
                str_replace(' ', '_', $_FILES['changeImage']['name']) : '';

            if (!empty($changeImage)) {
                $prefix = 'cat_';
                $unique_id = uniqid();
                $parm_folder = FCPATH . 'assets/uploads/category/original/';
                $ext = pathinfo($changeImage, PATHINFO_EXTENSION);

                $new_file = $prefix . $unique_id . "." . $ext;
                $destination = $parm_folder . $new_file;
                $tmp_name = $_FILES['changeImage']['tmp_name'];

                if (move_uploaded_file($tmp_name, $destination)) {

                    // Create resized versions using SAME filename
                    create_image_copy(
                        FCPATH . 'assets/uploads/category/',
                        $new_file,
                        150,
                        150,
                        'thumb'
                    );

                    create_image_copy(
                        FCPATH . 'assets/uploads/category/',
                        $new_file,
                        600,
                        600,
                        'medium'
                    );



                    $oldImageName = $this->input->post('old_img');
                    $category_id = $this->input->post('id');
                    $cat_name = $this->input->post('name');
                    $category_slug = generate_unique_slug($cat_name, 'category', 'category_slug');

                    $data = [
                        'name' => $this->input->post('name'),
                        'image' => $new_file,
                        'image_alt' => $this->input->post('alt_text'),
                        'category_slug'=> $category_slug
                    ];


                    // $this->category_model->getOldImage($category_id);
                    if ($this->category_model->updateCategory($category_id, $data)) {
                        $original = FCPATH . 'assets/uploads/category/original/' . $oldImageName;
                        $medium   = FCPATH . 'assets/uploads/category/medium/'   . $oldImageName;
                        $thumb    = FCPATH . 'assets/uploads/category/thumb/'    . $oldImageName;

                        if (file_exists($original)) unlink($original);
                        if (file_exists($medium)) unlink($medium);
                        if (file_exists($thumb)) unlink($thumb);
                        echo  json_encode(["status" => "update"]);
                    } else {
                        $original = FCPATH . 'assets/uploads/category/original/' . $new_file;
                        $medium   = FCPATH . 'assets/uploads/category/medium/'   . $new_file;
                        $thumb    = FCPATH . 'assets/uploads/category/thumb/'    . $new_file;

                        if (file_exists($original)) unlink($original);
                        if (file_exists($medium)) unlink($medium);
                        if (file_exists($thumb)) unlink($thumb);
                        echo  json_encode(["status" => "error", "message" => "Faild to upload database for image."]);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => "Faild to upload local folder : $destination "]);
                }
            } else {
                $oldImageName = $this->input->post('old_img');
                $category_id = $this->input->post('id');
                $alt_text = $this->input->post('alt_text');
                $category_name = $this->input->post('name');
                $category_slug = generate_unique_slug($category_name, 'category', 'category_slug');
                $data = [
                    'name' => $category_name,
                    'image' => $oldImageName,
                    'image_alt' => $alt_text,
                    'category_slug'=> $category_slug
                ];
                if ($this->category_model->updateCategory($category_id, $data)) {
                    echo  json_encode(["status" => "update"]);
                } else {
                    echo  json_encode(["status" => "error", "message" => "Faild to upload database."]);
                }
            }
        }
    }

    public function file_check($str, $param)
    {


        if ($param == 'image') {
            if (empty($_FILES[$param]['name'])) {
                $this->form_validation->set_message('file_check', 'Please select an image to upload.');
                return FALSE;
            }
        }

        // Basic checks: is actually an image and allowed mime/extension and size
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name = $_FILES[$param]['name'];
        $file_size = $_FILES[$param]['size']; // bytes
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
        $tmp = @getimagesize($_FILES[$param]['tmp_name']);
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

    public function delete($enc_id)
    {
        // $enc_id=$this->input->post('id');
        $id = $this->encryption->decrypt(base64_decode(urldecode($enc_id)));
        $delete = $this->category_model->deleteCategory($id);
        $file = $this->input->post('file');
        if ($delete) {
            $original = FCPATH . 'assets/uploads/category/original/' . $file;
            $medium   = FCPATH . 'assets/uploads/category/medium/'   . $file;
            $thumb    = FCPATH . 'assets/uploads/category/thumb/'    . $file;

            if (file_exists($original)) unlink($original);
            if (file_exists($medium)) unlink($medium);
            if (file_exists($thumb)) unlink($thumb);
            echo  json_encode([
                'status' => 'success'
            ]);
        } else {
            echo  json_encode([
                'status' => 'error'
            ]);
        }
        // load_admin_views('category_single_view', $data);
    }
}
