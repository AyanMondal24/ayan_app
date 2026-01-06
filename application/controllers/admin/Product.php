<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MY_Controller
// class Product extends CI_Controller
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
        $this->load->helper('image');
        $this->load->helper('slug');
    }



    public function index()
    {

        $total_item = $this->product_model->totalProducts(); //total records
        // $per_page=5;
        // $offset=0;
        $data['products'] = $this->product_model->getProducts();

        $data['totalRows'] = $total_item;
        load_admin_views('view_products', $data);
    }
    // make featured
    public function make_featured()
    {
        $image_id = $this->input->post('image_id');
        $product_id = $this->input->post('product_id');

        if (!$image_id || !$product_id) {
            echo json_encode(["status" => "error", "message" => "Invalid request"]);
            return;
        }

        if ($this->product_model->makeFeatured($product_id, $image_id)) {
            echo json_encode(["status" => "success", "message" => "Featured Image Updated."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Cannot Update Featured Image."]);
        }
    }
    public function add($enc_id = null)
    {
        $data['category'] = $this->category_model->getAllCategory();
        $data['units'] = $this->unit_model->getAllUnits();
        if ($enc_id) {
            $id = $this->encryption->decrypt(base64_decode(urldecode($enc_id)));
            $data['product'] = $this->product_model->getSingleProduct($id);
            $data['images'] = $this->product_model->getProductImages($id);
            $data['featuredimage'] = $this->product_model->getFeaturedImages($id);
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
        $this->form_validation->set_rules('description', 'Description', 'required|callback_min_desc');

        if (empty($this->input->post('id'))) {
            if (empty($_FILES['is_featured']['name'])) {
                $this->form_validation->set_rules('is_featured', 'Featured Image', "callback_file_check[is_featured]");
            }
            $this->form_validation->set_rules('alt_featured_text', 'Featured Alt Text', 'required');
        } else {
            if (!empty($this->input->post('uploadedfeaturedimage'))) {
                $this->form_validation->set_rules('uploadedfeaturedimage', 'Product Images', 'callback_file_check[uploadedfeaturedimage]');
            }
            $this->form_validation->set_rules('uploaded_alt_featured_text', 'Featured Alt Text', 'required');
        }

        // modify
        $image_fields = ['images', 'uploadchangeimage'];

        foreach ($image_fields as $field) {
            if (!empty($_FILES[$field]['name'][0])) {
                $this->form_validation->set_rules($field . '[]', ucfirst(str_replace('_', ' ', $field)), 'callback_file_check[' . $field . ']');
            }
        }

        // end modify

        $alt_text = $this->input->post('alt_text');
        $tmp_img_id = $this->input->post('image_id') ?: [];

        // Set rules for alt_text  only if temp images exist
        foreach ($tmp_img_id as $key => $img) {
            if (!empty($img)) {
                $this->form_validation->set_rules("alt_text[$key]", "Alt Text ", "required");
            }
        }
        $images = $_FILES['images']['name'] ?? [];

        $alt = $this->input->post('new_alt_text');
        if (!empty($alt)) {
            foreach ($alt as $key => $img) {
                $this->form_validation->set_rules("new_alt_text[$key]", "Alt Text", "required");
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
                'is_featured',
                'alt_featured_text'
            ];
            foreach ($fields_name as $field) {
                $error = form_error($field);
                if (!empty($error)) {
                    $errors[$field] = $error;
                }
            }

            // others image alt text error message
            if (!empty($alt)) {

                foreach ($alt as $key => $img) {
                    $alt_error = form_error("new_alt_text[$key]");
                    if (!empty($alt_error)) {
                        $errors["new_alt_text[$key]"] = $alt_error;
                    }
                }
            }

            // for update page start
            if (!empty($this->input->post('id'))) {
                $alt_err = form_error('uploaded_alt_featured_text');
                $errors["uploaded_alt_featured_text"] = $alt_err;
            }
            // Collect errors for array fields (alt_text and image_type)
            foreach ($tmp_img_id as $key => $img) {
                if (!empty($img)) {
                    $alt_error = form_error("alt_text[$key]");
                    if (!empty($alt_error)) {
                        $errors["alt_text[$key]"] = $alt_error;
                    }
                }
            }
            // for update page end

            echo json_encode(["status" => "error", "errors" => $errors]);
            return;
        }


        $featured_product = ($this->input->post('is_featured') !== null) ? "0" : "1";
        $product_name = $this->input->post('name');

        // generate slug
        $slug = generate_unique_slug($product_name, 'products');

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
            'is_featured' => $featured_product,
            'slug'         => $slug
        ];

        if (empty($this->input->post('id'))) {
            // ADD MODE
            $product_instant_id = $this->product_model->setProducts($data);

            if (!empty($product_instant_id)) {
                $insert_featured_image_status = false;
                $insert_others_image_status = false;
                $insert_product_status = false;

                $alt_texts = $this->input->post('new_alt_text');

                $perm_folder = FCPATH . 'assets/uploads/products/original/';
                if (!is_dir($perm_folder)) {
                    mkdir($perm_folder, 0755, true);
                }




                // insert other image
                $rowImages = isset($_FILES['images']['name']) ?
                    str_replace(' ', '_', $_FILES['images']['name']) : [];
                $alt = $this->input->post('new_alt_text');

                $perm_folder = FCPATH . 'assets/uploads/products/original/';
                $alt_texts   = $this->input->post('new_alt_text');
                $product_id  = $product_instant_id;

                $result = upload_multiple_product_images(
                    $alt_texts,
                    $perm_folder,
                    $product_id,
                    $this->product_model
                );

                if ($result['status']) {
                    $insert_others_image_status = true;
                } else {
                    $insert_others_image_status = false;
                    foreach ($result['errors'] as $e) {
                        $errors[] = $e;
                    }
                }

                // add new featured image
                $featured_img = isset($_FILES['is_featured']['name']) ?
                    str_replace(' ', '_', $_FILES['is_featured']['name']) : '';

                if ($insert_others_image_status) {
                    if (!empty($featured_img)) {

                        $prefix = 'product_';
                        $unique_file = uniqid();
                        $ext = pathinfo($_FILES['is_featured']['name'], PATHINFO_EXTENSION);

                        $new_file = $prefix . $unique_file . "." . $ext;
                        $destination = $perm_folder . $new_file;
                        $tmp_name = $_FILES['is_featured']['tmp_name'];
                        if (move_uploaded_file($tmp_name, $destination)) {

                            create_image_copy(
                                FCPATH . 'assets/uploads/products/',
                                $new_file,
                                150,
                                150,
                                'thumb'
                            );

                            create_image_copy(
                                FCPATH . 'assets/uploads/products/',
                                $new_file,
                                600,
                                600,
                                'medium'
                            );
                            $alt_featred_text = $this->input->post('alt_featured_text');

                            $featured_image = [
                                'product_id'  => $product_instant_id,
                                'image_name'  => $new_file,
                                'alt_text'    => $alt_featred_text,
                                'is_featured' => 0
                            ];

                            if ($this->product_model->SetProductImages($featured_image)) {
                                $insert_featured_image_status = true;
                            } else {
                                $original = FCPATH . 'assets/uploads/products/original/' . $new_file;
                                $medium   = FCPATH . 'assets/uploads/products/medium/'   . $new_file;
                                $thumb    = FCPATH . 'assets/uploads/products/thumb/'    . $new_file;

                                if (file_exists($original)) unlink($original);
                                if (file_exists($medium)) unlink($medium);
                                if (file_exists($thumb)) unlink($thumb);
                                $errors[] = "DB Featured Image upload failed : $new_file";
                            }
                        } else {
                            $errors[] = "Featured Image upload failed : $destination";
                        }
                    }
                }

                // add main product
                $insert_product_status = true;
                // echo json_encode(["status" => "success", "product_id" => $product_instant_id]);
            } else {
                // echo json_encode(['status' => 'error', 'message' => 'Failed to add product.']);
                $errors[] = "DB product insert failed  : $product_instant_id";
            }

            $response = [];

            if (!empty($errors)) {
                $response = [
                    'status' => 'error',
                    'message' => 'Some operations failed.',
                    'errors' => $errors
                ];
            } elseif ($insert_featured_image_status  && $insert_product_status || $insert_others_image_status) {
                $response = [
                    'status' => 'success',
                    'message' => 'Insert successfully.'
                ];
            }

            elseif (($insert_featured_image_status == false) || ($insert_others_image_status == false)) {
                $response = [
                    'status' => 'error',
                    'message' => 'Image Not inserted.'
                ];
            } elseif ($insert_product_status == false) {
                $response = [
                    'status' => 'success',
                    'message' => 'Product updated successfully.'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'No operation performed.'
                ];
            }

            echo json_encode($response);
            exit;
        } else {
            // UPDATE MODE ON
            $update_status = false;
            $insert_status = false;
            $product_status = false;
            $errors = [];
            $new_alt_text = $this->input->post('new_alt_text');

            $alt_texts = $this->input->post('alt_text');
            $product_id = $this->input->post('id');
            $image_ids = $this->input->post('image_id');


            $old_product = $this->product_model->getSingleProduct($product_id);

            if ($old_product && $old_product->name !== $product_name) {
                // name changed → regenerate slug
                $data['slug'] = generate_unique_slug($product_name, 'products');
            } else {
                // name not changed → remove slug from update
                unset($data['slug']);
            }

            $perm_folder = FCPATH . 'assets/uploads/products/original/';
            $perm_folder_medium = FCPATH . 'assets/uploads/products/medium/';
            $perm_folder_thumb = FCPATH . 'assets/uploads/products/thumb/';

            if (!is_dir($perm_folder)) {
                mkdir($perm_folder, 0755, true);
            }

            $FeaturedImageUpdate = isset($_FILES['uploadedfeaturedimage']['name'])
                ? str_replace(' ', '_', $_FILES['uploadedfeaturedimage'])
                : '';

            $old_img = $this->input->post('oldfeaturedimage');

            $featured_img_id = $this->input->post('featured_image_id');
            // Update Featured Image
            if (!empty($_FILES['uploadedfeaturedimage']['name'])) {

                // $featured_file = $_FILES['uploadedfeaturedimage'];
                $featured_file = $FeaturedImageUpdate;

                // Generate new filename
                $ext = pathinfo($featured_file['name'], PATHINFO_EXTENSION);
                $new_file = 'product_' . uniqid() . '.' . $ext;
                $perm_path = $perm_folder . $new_file;

                // Move uploaded file
                $destination = $perm_folder . $new_file;
                $tmp_name = $_FILES['uploadedfeaturedimage']['tmp_name'];
                if (move_uploaded_file($tmp_name, $destination)) {

                    // Create resized versions using SAME filename
                    create_image_copy(
                        FCPATH . 'assets/uploads/products/',
                        $new_file,
                        150,
                        150,
                        'thumb'
                    );

                    create_image_copy(
                        FCPATH . 'assets/uploads/products/',
                        $new_file,
                        600,
                        600,
                        'medium'
                    );


                    // if (move_uploaded_file($featured_file['tmp_name'], $perm_path)) {

                    $alt_featred_text = $this->input->post('uploaded_alt_featured_text');
                    $featured_img_id = $this->input->post('featured_image_id');
                    $old_img = $this->input->post('oldfeaturedimage');


                    // Prepare update data
                    $update_featured_image_data = [
                        'product_id' => $product_id,
                        'image_name' => $new_file,
                        'alt_text'   => $alt_featred_text,
                        'is_featured' => 0
                    ];

                    // Update DB
                    if ($this->product_model->updateFeaturedImage($update_featured_image_data, $featured_img_id)) {

                        // Delete old image from original folder
                        if (file_exists($perm_folder . $old_img)) {
                            unlink($perm_folder . $old_img);
                        }

                        if (file_exists($perm_folder_medium . $old_img)) {
                            unlink($perm_folder_medium . $old_img);
                        }

                        if (file_exists($perm_folder_thumb . $old_img)) {
                            unlink($perm_folder_thumb . $old_img);
                        }


                        $update_status = true;
                    } else {
                        $original = FCPATH . 'assets/uploads/products/original/' . $new_file;
                        $medium   = FCPATH . 'assets/uploads/products/medium/'   . $new_file;
                        $thumb    = FCPATH . 'assets/uploads/products/thumb/'    . $new_file;

                        if (file_exists($original)) unlink($original);
                        if (file_exists($medium)) unlink($medium);
                        if (file_exists($thumb)) unlink($thumb);
                        $errors[] = "DB Update Featured Image upload failed: $new_file";
                    }
                } else {
                    $errors[] = "Update Featured Image upload local failed : $destination";
                }
            } else {
                $alt_featred_text = $this->input->post('uploaded_alt_featured_text');
                $featured_img_id = $this->input->post('featured_image_id');
                $old_img = $this->input->post('oldfeaturedimage');

                // Prepare update data
                $update_featured_image_data = [
                    'product_id' => $product_id,
                    'image_name' => $old_img,
                    'alt_text'   => $alt_featred_text,
                    'is_featured' => 0
                ];

                // Update DB
                if ($this->product_model->updateFeaturedImage($update_featured_image_data, $featured_img_id)) {

                    $update_status = true;
                } else {
                    $errors[] = "DB insert failed for featured alt text: $alt_featred_text";
                }
            }

            // update others images (newly inserted image only)
            // $insertedImages = str_replace(' ', '_', $_FILES['images']['name']); // Array of filenames (spaces replaced)

            $insertedImages = isset($_FILES['images']['name'])
                ? str_replace(' ', '_', $_FILES['images']['name'])
                : [];


            if (!empty(array_filter($insertedImages))) {

                $perm_folder = FCPATH . 'assets/uploads/products/original/';
                $alt_textss   = $this->input->post('new_alt_text');
                $product_id  = $product_id;

                $result = upload_multiple_product_images(
                    $alt_textss,
                    $perm_folder,
                    $product_id,
                    $this->product_model
                );

                if ($result['status']) {
                    $insert_others_image_status = true;
                } else {
                    $insert_others_image_status = false;
                    foreach ($result['errors'] as $e) {
                        $errors[] = $e;
                    }
                }
            }

            // end inserted image

            if (!empty($image_ids)) {
                foreach ($image_ids as $index => $img_id) {
                    $alt_text = isset($alt_texts[$index]) ? $alt_texts[$index] : '';

                    $image_data = [
                        'alt_text' => $alt_text,
                    ];

                    $insert_alt_type = $this->product_model->updateProductImageData($img_id, $image_data);
                    if ($insert_alt_type) {
                        $update_status = true;
                    } else {
                        $errors[] = "Failed to update ALT TEXT $alt_text";
                    }
                }
            }

            // update page change ohters image and alt text
            $update_images = isset($_FILES['uploadchangeimage']['name']) ?
                str_replace(' ', '_', $_FILES['uploadchangeimage']['name']) : []; //new update image

            $alt_texts = $this->input->post('alt_text');

            if (!empty(array_filter($update_images))) {
                foreach ($update_images as $index => $image) {
                    if (empty($image) || $_FILES['uploadchangeimage']['error'][$index] !== UPLOAD_ERR_OK) {
                        continue; // No new file, skip to next
                    }
                    $image_id = isset($image_ids[$index]) ? $image_ids[$index] : null;
                    $alt_text = isset($alt_texts[$index]) ? $alt_texts[$index] : [];
                    // $current_filename = isset($uploaded_temps[$index]) ? $uploaded_temps[$index] : '';

                    $prefix = 'product_';
                    $unique_file = uniqid();
                    $ext = pathinfo($image, PATHINFO_EXTENSION);
                    $new_file = $prefix . $unique_file . "." . $ext;



                    $destination = $perm_folder . $new_file;
                    $tmp_name = $_FILES['uploadchangeimage']['tmp_name'][$index];
                    if (move_uploaded_file($tmp_name, $destination)) {


                        // Create resized versions using SAME filename
                        create_image_copy(
                            FCPATH . 'assets/uploads/products/',
                            $new_file,
                            150,
                            150,
                            'thumb'
                        );

                        create_image_copy(
                            FCPATH . 'assets/uploads/products/',
                            $new_file,
                            600,
                            600,
                            'medium'
                        );

                        // Prepare data for DB update
                        $image_data = [
                            'image_name' => $new_file, // New filename
                            'alt_text' => $alt_text,
                            'is_featured' => 1
                        ];
                        // Update the existing image record (assuming $image_id is valid)
                        if ($image_id) {
                            $old_image = $this->product_model->getOldImage($image_id);

                            if ($this->product_model->updateProductImageData($image_id, $image_data)) {
                                $update_status = true;
                                if ($old_image && !empty($old_image->image_name)) {

                                    $old_file = $old_image->image_name;

                                    $original = FCPATH . 'assets/uploads/products/original/' . $old_file;
                                    $medium   = FCPATH . 'assets/uploads/products/medium/'   . $old_file;
                                    $thumb    = FCPATH . 'assets/uploads/products/thumb/'    . $old_file;

                                    if (file_exists($original)) unlink($original);
                                    if (file_exists($medium)) unlink($medium);
                                    if (file_exists($thumb)) unlink($thumb);
                                }
                            } else {
                                $original = FCPATH . 'assets/uploads/products/original/' . $new_file;
                                $medium   = FCPATH . 'assets/uploads/products/medium/'   . $new_file;
                                $thumb    = FCPATH . 'assets/uploads/products/thumb/'    . $new_file;

                                if (file_exists($original)) unlink($original);
                                if (file_exists($medium)) unlink($medium);
                                if (file_exists($thumb)) unlink($thumb);
                                // echo json_encode(['status' => 'error', 'message' => 'Failed to update product.']);
                                $errors[] = "Failed to update image for index {$index}.";
                            }
                        }
                    } else {
                        $errors[] = "Update Others Image upload failed : $destination";
                    }
                }
            }

            // Update main product info
            if ($this->product_model->updateProduct($product_id, $data)) {

                $product_status = true;
            } else {
                $errors[] = "Failed to update main product.";
            }

            $response = [];

            if (!empty($errors)) {
                $response = [
                    'status' => 'error',
                    'message' => 'Some operations failed.',
                    'errors' => $errors
                ];
            } elseif ($insert_status) {
                $response = [
                    'status' => 'success',
                    'message' => 'Images inserted successfully.'
                ];
            } elseif ($update_status || $product_status) {
                $response = [
                    'status' => 'update',
                    'message' => 'Product updated successfully.'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'No operation performed.'
                ];
            }

            echo json_encode($response);
            exit;
        }
    }

    // desceription text length validation
    public function min_desc($str)
    {
        $plain = strip_tags($str); // remove HTML tags
        if (strlen($plain) < 100) {
            $this->form_validation->set_message('min_desc', 'The Description must be at least 100 characters.');
            return FALSE;
        }
        return TRUE;
    }

    // Callback for form_validation for multiple image
    public function file_check($str, $param)
    {
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif'];

        // ----------------------------
        // FEATURED IMAGE INSERT (single file)
        // ----------------------------
        if ($param == "is_featured") {

            if (!isset($_FILES['is_featured']) || $_FILES['is_featured']['error'] == 4) {
                $this->form_validation->set_message('file_check', 'Featured image is required.');
                return FALSE;
            }

            $file_name = $_FILES['is_featured']['name'];
            $file_size = $_FILES['is_featured']['size'];
            $tmp_name  = $_FILES['is_featured']['tmp_name'];

            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed_ext)) {
                $this->form_validation->set_message('file_check', 'Only JPG, JPEG, PNG, GIF allowed.');
                return FALSE;
            }

            if ($file_size > 2 * 1024 * 1024) {
                $this->form_validation->set_message('file_check', 'Featured image must be less than 2MB.');
                return FALSE;
            }

            $image_info = @getimagesize($tmp_name);
            if (!$image_info || !in_array($image_info['mime'], $allowed_mimes)) {
                $this->form_validation->set_message('file_check', 'Invalid featured image.');
                return FALSE;
            }

            return TRUE;
        }
        // ----------------------------
        // FEATURED IMAGE UPDATE (single file)
        // ----------------------------
        if ($param == "uploadedfeaturedimage") {

            if (!isset($_FILES['uploadedfeaturedimage']) || $_FILES['uploadedfeaturedimage']['error'] == 4) {
                $this->form_validation->set_message('file_check', 'Featured image is required.');
                return FALSE;
            }

            $file_name = $_FILES['uploadedfeaturedimage']['name'];
            $file_size = $_FILES['uploadedfeaturedimage']['size'];
            $tmp_name  = $_FILES['uploadedfeaturedimage']['tmp_name'];

            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed_ext)) {
                $this->form_validation->set_message('file_check', 'Only JPG, JPEG, PNG, GIF allowed.');
                return FALSE;
            }

            if ($file_size > 2 * 1024 * 1024) {
                $this->form_validation->set_message('file_check', 'Featured image must be less than 2MB.');
                return FALSE;
            }

            $image_info = @getimagesize($tmp_name);
            if (!$image_info || !in_array($image_info['mime'], $allowed_mimes)) {
                $this->form_validation->set_message('file_check', 'Invalid featured image.');
                return FALSE;
            }

            return TRUE;
        }

        // ----------------------------
        // MULTIPLE IMAGES INSERT (images[])
        // ----------------------------
        // If no files uploaded, pass validation (field is optional)
        if (empty($_FILES[$param]['name'][0])) {
            return TRUE;
        }

        foreach ($_FILES[$param]['name'] as $key => $name) {

            if (empty($name)) continue; // skip empty inputs

            $file_name = $name;
            $file_size = $_FILES[$param]['size'][$key];
            $tmp_name  = $_FILES[$param]['tmp_name'][$key];
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed_ext)) {
                $this->form_validation->set_message('file_check', 'Only JPG, JPEG, PNG, GIF allowed.');
                return FALSE;
            }

            if ($file_size > 2 * 1024 * 1024) { // 2MB
                $this->form_validation->set_message('file_check', 'Each image must be less than 2MB.');
                return FALSE;
            }

            $image_info = @getimagesize($tmp_name);
            if (!$image_info || !in_array($image_info['mime'], $allowed_mimes)) {
                $this->form_validation->set_message('file_check', 'Invalid image file.');
                return FALSE;
            }
        }

        return TRUE;
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
        $data = $this->product_model->singleView($id);

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

    // delete product
    public function delete($enc_id)
    {
        // $enc_id=$this->input->post('id');
        $id = $this->encryption->decrypt(base64_decode(urldecode($enc_id)));
        // echo $id;
        $images = $this->product_model->getImages($id);


        $delete = $this->product_model->delete($id);
        if ($delete) {
            foreach ($images as $img) {
                $original = FCPATH . 'assets/uploads/products/original/' . $img->image_name;
                $medium   = FCPATH . 'assets/uploads/products/medium/'   . $img->image_name;
                $thumb    = FCPATH . 'assets/uploads/products/thumb/'    . $img->image_name;

                if (file_exists($original)) unlink($original);
                if (file_exists($medium)) unlink($medium);
                if (file_exists($thumb)) unlink($thumb);
            }
            echo  json_encode([
                'status' => 'success'
            ]);
        } else {
            echo  json_encode([
                'status' => 'error'
            ]);
        }
    }

    // delete tmp image from tmp folder
    public function delete_image()
    {
        $filename = $this->input->post('filename');
        // when user click cross btn the delete from database also
        $id = $this->input->post('id');
        if (!empty($id)) {
            $this->product_model->deleteProductImage($filename);
        }


        $targetDirProducts_original = FCPATH . 'assets/uploads/products/original/';
        $targetDirProducts_medium = FCPATH . 'assets/uploads/products/medium/';
        $targetDirProducts_thumb = FCPATH . 'assets/uploads/products/thumb/';
        $status = false;
        if ($filename && file_exists($targetDirProducts_original . $filename)) {
            unlink($targetDirProducts_original . $filename);
            $status = true;
        }
        if ($filename && file_exists($targetDirProducts_medium . $filename)) {
            unlink($targetDirProducts_medium . $filename);
            $status = true;
        }
        if ($filename && file_exists($targetDirProducts_thumb . $filename)) {
            unlink($targetDirProducts_thumb . $filename);
            $status = true;
        }

        // else {
        //     echo json_encode(['status' => 'error', 'message' => 'File not found.']);
        // }

        if ($status == true) {
            echo json_encode(['status' => 'success', 'message' => 'File found and deleted.']);
        }
    }
}
