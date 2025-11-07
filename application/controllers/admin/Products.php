<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->helper('form', 'url');
        $this->load->library('pagination');
    }

    public function addProductsForm()
    {
        $this->load->view('admin/includes/header');
        $this->load->view('admin/add_products');
        $this->load->view('admin/includes/footer');
    }

    public function addProductsDB()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'required|trim|numeric');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|trim|numeric');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('status', 'Active Or Deactive', 'required');
        $this->form_validation->set_rules('is_available', 'Available Or Not', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        // file rule: use callback to validate uploaded file
        $this->form_validation->set_rules('image', 'Product Image', 'callback_file_check');

        if ($this->form_validation->run() == FALSE) {
            // $errors = validation_errors();
            $errors = [];
            $fields_name = ['name', 'price', 'quantity', 'category', 'status', 'is_available', 'description', 'image'];
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
            $prefix = 'product_';
            $unique_id = uniqid();
            $config['upload_path'] = FCPATH . 'assets/uploads/products';
            $config['allowed_types'] = 'jpeg|jpg|png|gif';
            $config['max_size'] = 2048;
            $config['encrypt_name']  = FALSE;
            $config['file_name']  = $prefix . $unique_id;
            $this->load->library('upload', $config);

            $imageName = null;

            // Check if file is selected
            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    // File upload successful
                    $uploadData = $this->upload->data();
                    $imageName = $uploadData['file_name']; // get uploaded file name
                } else {
                    // Upload failed
                    echo $this->upload->display_errors('<span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;">', '</span>');
                    return;
                }
            }
            // else{
            //     var_dump($_FILES); 
            // }
            $data = [
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'quantity' => $this->input->post('quantity'),
                'category' => $this->input->post('category'),
                'status' => $this->input->post('status'),
                'is_available' => $this->input->post('is_available'),
                'description' => $this->input->post('description'),
                'img' => $imageName
            ];

            if ($this->product_model->setProducts($data) == true) {

                echo  json_encode(["status" => "success"]);
            }
        }

        // echo "Successfully submitted";
    }

    // Callback for form_validation for image
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

    public function viewProducts()
    {

        $config = [];
        $config['base_url'] = base_url('admin/Products/viewProducts');
        $config['total_rows'] = $this->product_model->totalProducts(); //total records
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
        // 🔹 Determine current page
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        // 🔹 Get data
        $data['products'] = $this->product_model->getProducts($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();

        // $data['products'] = $this->product_model->getProducts();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/view_products', $data);
        $this->load->view('admin/includes/footer');
    }
}
