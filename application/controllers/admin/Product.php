<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('unit_model');
        $this->load->helper('form', 'url');
        $this->load->library('pagination');
        $this->load->library('encryption');
        $this->load->helper('common');
    }



    public function add($enc_id = null)
    {
        $data['category'] = $this->category_model->getAllCategory();
        $data['units'] = $this->unit_model->getAllUnits();
        if ($enc_id) {
            $id = $this->encryption->decrypt(base64_decode(urldecode($enc_id)));
            $data['product'] = $this->product_model->getSingleProduct($id);
            $data['images'] = $this->product_model->getProductImages($id);
            // var_dump($data['images']);
            // die();
            $data['title'] = 'Updating Product';
        } else {
            // 🔹 Add mode: blank data
            $data['product'] = null;
            $data['images'] = null;
            $data['title'] = 'Adding Products';
        }

        load_admin_views('add_products', $data);
    }


    public function store()
    {
        $this->load->library('form_validation');

        // 🔹 Basic form validations
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'required|trim|numeric');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|trim|numeric');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('status', 'Active Or Deactive', 'required');
        $this->form_validation->set_rules('is_available', 'Available Or Not', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('alt_text[]', 'Alt', 'required');

        // 🔹 File validation logic (now checks temp uploads)
        if (empty($this->input->post('id'))) {
            // Add mode → temp images required
            $this->form_validation->set_rules('images[]', 'Product Images', 'callback_file_check');
        } else {
            // Edit mode → only validate if new temp images are uploaded
            if (!empty($this->input->post('images[]'))) {
                $this->form_validation->set_rules('images[]', 'Product Images', 'callback_file_check');
            }
        }

        // 🔹 Run validation
        if ($this->form_validation->run() == FALSE) {
            $errors = [];
            $fields_name = [
                'name',
                'price',
                'quantity',
                'unit',
                'category',
                'status',
                'is_available',
                'description',
                'images[]',
                'alt_text[]'
            ];
            foreach ($fields_name as $field) {
                $error = form_error($field);
                if (!empty($error)) {
                    $errors[$field] = $error;
                }
            }
            echo json_encode(["status" => "error", "errors" => $errors]);
            return;
        }

        // 🔹 Prepare product data
        $data = [
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'quantity' => $this->input->post('quantity'),
            'unit_id' => $this->input->post('unit'),
            'category' => $this->input->post('category'),
            'status' => $this->input->post('status'),
            'is_available' => $this->input->post('is_available'),
            'description' => $this->input->post('description'),
        ];

        if (empty($this->input->post('id'))) {
            // ADD MODE
            $product_instant_id = $this->product_model->setProducts($data);
            // var_dump($product_instant_id);
            // die();
            // return;

            if (!empty($product_instant_id)) {
                // Get temp images from hidden inputs
                $alt_texts = $this->input->post('alt_text');
                $remove_sapce = str_replace(' ', '_', $_FILES['images']['name']);
                $rowImages = $remove_sapce;

                $perm_folder = FCPATH . 'assets/uploads/products/';
                if (!is_dir($perm_folder)) {
                    mkdir($perm_folder, 0755, true);
                }

                if (!empty($rowImages)) {
                    foreach ($rowImages as $index => $image) {
                        // echo $image;
                        $prefix = 'product_';
                        $unique_file = uniqid();
                        $ext = pathinfo($image, PATHINFO_EXTENSION);

                        $new_file = $prefix . $unique_file . "." . $ext;
                        $temp_path = FCPATH . 'assets/uploads/temp/' . $image;
                        $perm_path = $perm_folder . $new_file;

                        if (file_exists($temp_path)) {
                            rename($temp_path, $perm_path);
                        } else {
                            log_message('error', 'Temp file not found: ' . $temp_path);
                        }
                        // Use the matching alt text if it exists
                        $alt_text = isset($alt_texts[$index]) ? $alt_texts[$index] : '';
                        $image_data = [
                            'product_id' => $product_instant_id,
                            'image_name' => $new_file,
                            'alt_text'   => $alt_text
                        ];
                        $this->product_model->SetProductImages($image_data);
                    }
                }

                echo json_encode(["status" => "success", "product_id" => $product_instant_id]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to add product.']);
            }
        } else {
            // UPDATE MODE
            $product_id = $this->input->post('id');
            $uploaded_temp = $this->input->post('uploaded_temp');
            // $old_alt_text = $this->input->post('old_alt_text');

            $alt_texts = $this->input->post('alt_text');

            $rowImages = str_replace(' ', '_', $_FILES['images']['name']);
            $perm_folder = FCPATH . 'assets/uploads/products/';

            if (!is_dir($perm_folder)) {
                mkdir($perm_folder, 0755, true);
            }

            if (!empty(array_filter($rowImages))) {

                foreach ($rowImages as $index => $image) {


                    $prefix = 'product_';
                    $unique_file = uniqid();
                    $ext = pathinfo($image, PATHINFO_EXTENSION);
                    $new_file = $prefix . $unique_file . "." . $ext;

                    $temp_path = FCPATH . 'assets/uploads/temp/' . $image;
                    $perm_path = $perm_folder . $new_file;

                    if (file_exists($temp_path)) {
                        rename($temp_path, $perm_path);
                    } else {
                        log_message('error', 'Temp file not found: ' . $temp_path);
                    }
                    $alt_text = isset($alt_texts[$index]) ? $alt_texts[$index] : '';

                    $image_data = [
                        'product_id' => $product_id,
                        'image_name' => $new_file,
                        'alt_text'   => $alt_text
                    ];

                    // Check if image already exists for product
                    $exists = $this->product_model->checkImageExists($product_id, $new_file);

                    if ($exists) {
                        $this->product_model->updateProductImage($image_data, $new_file);
                    } else {
                        $this->product_model->insertProductImage($image_data);
                    }
                    // if ($this->product_model->updateProductImages($image_data, $product_id) == FALSE) {
                    //     echo json_encode(['status' => 'error', 'message' => 'Failed to update product image.']);

                    //     return;
                    // }
                }
            }

            if ($this->product_model->updateProduct($product_id, $data)) {
                echo json_encode(["status" => "update"]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update product.']);
            }
        }
    }

    // Callback for form_validation for multiple image 
    public function file_check()
    {
        // Check if at least one file is selected
        // $uploaded_tmp_file = $this->input->post('images[]');
        if (empty($_FILES['images']['name'][0])) {
            $this->form_validation->set_message('file_check', 'Please select at least one image to upload.');
            return FALSE;
        }

        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif'];

        foreach ($_FILES['images']['name'] as $key => $name) {

            // Skip empty file slots (in case of multiple inputs)
            if (empty($name)) continue;

            $file_name = $_FILES['images']['name'][$key];
            $file_size = $_FILES['images']['size'][$key];
            $tmp_name  = $_FILES['images']['tmp_name'][$key];

            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // 1️⃣ Extension check
            if (!in_array($ext, $allowed_ext)) {
                $this->form_validation->set_message('file_check', 'Only JPG, JPEG, PNG, and GIF files are allowed.');
                return FALSE;
            }

            // 2️⃣ Size check (max 2MB)
            if ($file_size > 2 * 1024 * 1024) {
                $this->form_validation->set_message('file_check', 'Each file must be less than 2MB.');
                return FALSE;
            }

            // 3️⃣ Ensure it's a real image
            $image_info = @getimagesize($tmp_name);
            if ($image_info === FALSE) {
                $this->form_validation->set_message('file_check', 'One or more files are not valid images.');
                return FALSE;
            }

            // 4️⃣ MIME type check
            if (!in_array($image_info['mime'], $allowed_mimes)) {
                $this->form_validation->set_message('file_check', 'One or more image MIME types are not allowed.');
                return FALSE;
            }
        }

        // ✅ All images passed validation
        return TRUE;
    }

    // public function file_check()
    // {
    //     if (empty($_FILES['image']['name'])) {
    //         $this->form_validation->set_message('file_check', 'Please select an image to upload.');
    //         return FALSE;
    //     }

    //     // Basic checks: is actually an image and allowed mime/extension and size
    //     $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    //     $file_name = $_FILES['image']['name'];
    //     $file_size = $_FILES['image']['size']; // bytes
    //     $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    //     if (!in_array($ext, $allowed_ext)) {
    //         $this->form_validation->set_message('file_check', 'Only JPG, JPEG, PNG and GIF files are allowed.');
    //         return FALSE;
    //     }

    //     // check filesize (example max 2MB)
    //     if ($file_size > 2 * 1024 * 1024) {
    //         $this->form_validation->set_message('file_check', 'File size must be less than 2MB.');
    //         return FALSE;
    //     }

    //     // ensure it's an actual image
    //     $tmp = @getimagesize($_FILES['image']['tmp_name']);
    //     if ($tmp === FALSE) {
    //         $this->form_validation->set_message('file_check', 'The uploaded file is not a valid image.');
    //         return FALSE;
    //     }

    //     // optional: check mime types more strictly
    //     $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif'];
    //     if (!in_array($tmp['mime'], $allowed_mimes)) {
    //         $this->form_validation->set_message('file_check', 'Image MIME type is not allowed.');
    //         return FALSE;
    //     }

    //     return TRUE;
    // }

    public function index()
    {
        // echo $page;
        // die();

        $config = [];
        $config['base_url'] = site_url('admin/Product/index');
        $config['total_rows'] = $this->product_model->totalProducts(); //total records
        $config['per_page'] = 5;
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
        $offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // $offset = $this->uri->segment(4, 0);
        // 🔹 Get data
        $data['products'] = $this->product_model->getProducts($config['per_page'], $offset);
        $data['links'] = $this->pagination->create_links();
        $data['offset'] = $offset;

        // $data['products'] = $this->product_model->getProducts();
        // $this->load->view('admin/includes/header');
        // $this->load->view('admin/view_products', $data);
        // $this->load->view('admin/includes/footer');
        load_admin_views('view_products', $data);
    }

    public function view($enc_id)
    {

        $id =  $this->encryption->decrypt(base64_decode(urldecode($enc_id)));

        if (!$id) {
            // show_error('Invalid product link or ID');
            show_404();
            return;
        }
        // var_dump($data);
        $data['product'] = $this->product_model->singleView($id);
        // $this->load->view('admin/includes/header');
        // $this->load->view('admin/single_view', $data);
        // $this->load->view('admin/includes/footer');
        load_admin_views('product_single_view', $data);
    }

    public function edit($enc_id)
    {
        $id = $this->encryption->decrypt(base64_decode(urldecode($enc_id)));
        var_dump($id);
        // Check if decryption succeeded (returns false on failure)
        if ($id === false) {
            show_error('Invalid or corrupted ID.', 400);
            return;
        }
    }

    public function delete($enc_id)
    {
        // $enc_id=$this->input->post('id');
        $id = $this->encryption->decrypt(base64_decode(urldecode($enc_id)));
        // echo $id;
        $delete = $this->product_model->delete($id);
        if ($delete) {
            echo  json_encode([
                'status' => 'success'
            ]);
        } else {
            echo  json_encode([
                'status' => 'error'
            ]);
        }

        // if($delete){
        //     $this->session->set_flashdata('success', 'Product deleted successfully.');
        // }else{
        //     $this->session->set_flashdata('error', 'Faild to deleted product.');
        // }

        // redirect('admin/Product');
    }

    // for client side show image
    public function upload_temp_image()
    {
        $targetDir = FCPATH . 'assets/uploads/temp/';

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (!empty($_FILES['images']['name'])) {
            // $prefix = 'product_';
            $fileName = str_replace(' ', '_', $_FILES['images']['name']);
            $image_name = $fileName;
            $config['upload_path'] = FCPATH . 'assets/uploads/temp';
            $config['allowed_types'] = 'jpeg|jpg|png|gif';
            $config['max_size'] = 2048;
            $config['encrypt_name']  = FALSE;
            $config['file_name']  = $image_name;


            $this->load->library('upload', $config);
            if ($this->upload->do_upload('images')) {
                $uploadData = $this->upload->data();
                $imageName = $uploadData['file_name'];
                echo json_encode([
                    'status' => 'success',
                    'filename' => $imageName,
                    'url' => base_url('assets/uploads/temp/' . $imageName)
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to move uploaded file']);
                return;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No file received']);
        }
    }

    public function delete_temp_image()
    {
        $filename = $this->input->post('filename');
        // when user click cross btn the delete from database also 
        $this->product_model->deleteProductImage($filename);
        
        $targetDir = FCPATH . 'assets/uploads/temp/';

        $targetDirProducts = FCPATH . 'assets/uploads/products/';
        if ($filename && file_exists($targetDir . $filename)) {
            unlink($targetDir . $filename);
            echo json_encode(['status' => 'success']);
        } else if ($filename && file_exists($targetDirProducts . $filename)) {
            unlink($targetDirProducts . $filename);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'File not found']);
        }
    }
}
