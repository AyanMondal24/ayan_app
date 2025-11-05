<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        // $this->load->helper('url', 'form');
        $this->load->helper('form','url');
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

        if ($this->form_validation->run() == FALSE) {
            $errors=validation_errors();
            echo json_encode([
                "status"=>"Ok",
                "errors"=>$errors
            ]);
        } else {
            $prefix = 'product_';
            $unique_id = uniqid();
            $config['upload_path'] = FCPATH . 'assets/uploads';
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
                    echo $this->upload->display_errors('<span style="color:#ff3030; font-size:16px;letter-spacing:0.7px;font-weight:lighter!important;">','</span>');
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
                echo 0;
            } else {
                echo 1;
            }
        }

        // echo "Successfully submitted";
    }
    public function viewProducts()
    {
        $data['products'] = $this->product_model->getProducts();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/view_products', $data);
        $this->load->view('admin/includes/footer');
    }
}
