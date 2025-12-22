<?php

class Coupons extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('common');
        $this->load->helper('image');
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->load->model('coupon_model');
    }

    function index()
    {
        $data['coupons'] = $this->coupon_model->getCoupons();
        load_admin_views('view_coupon', $data);
    }
    function add($enc_id = null)
    {

        if (empty($enc_id)) {
            $data['title'] = "Add Coupon";
            load_admin_views('add_coupon', $data);
        } else {
            $data['title'] = "Update Coupon";
            $decoded = base64_decode(urldecode($enc_id));
            $id = $this->encryption->decrypt($decoded);


            $data['coupons'] = $this->coupon_model->getCouponById($id);
            load_admin_views('add_coupon', $data);
        }
    }
    function store()
    {
        $this->form_validation->set_rules('code', 'Coupon Code', 'required');
        $this->form_validation->set_rules('discount_type', 'Discount Type', 'required');
        $this->form_validation->set_rules(
            'discount_value',
            'Discount Value',
            'required|regex_match[/^\d+(\.\d{1,2})?$/]',
            array('regex_match' => 'The %s must be a valid number.')
        );
        $this->form_validation->set_rules(
            'start_date',
            'Start Date',
            'callback_valid_start_date'
        );

        $this->form_validation->set_rules(
            'expiry_date',
            'Expiry Date',
            'callback_valid_expiry_date'
        );
        $this->form_validation->set_rules('discount_type', ' Discount', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        if (!empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Image', 'callback_image_check');
        }

        if ($this->form_validation->run() == false) {
            $errors = [];
            $field = ['code', 'discount_type', 'discount_value', 'start_date', 'expiry_date',  'status', 'image'];

            foreach ($field as $item) {
                $error = form_error($item);
                if (!empty($error)) {
                    $errors[$item] = $error;
                }
            }
            echo json_encode([
                "status" => "error",
                "errors" => $errors
            ]);
            return;
        }

        $folder = FCPATH . 'assets/uploads/coupons/original/';
        $id = $this->input->post('c_id');
       
        $old_img = $this->input->post('old_img');

        // if (empty($id)) {

        $image_file ='';
        if (!empty($_FILES['image']['name'])) {
            $prefix = "coupon_";
            $unique_name = uniqid();
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $new_file = $prefix . $unique_name . '.' . $ext;
            $destination = $folder . $new_file;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                $image_file = $new_file;
                // Create resized versions using SAME filename
                create_image_copy(
                    FCPATH . 'assets/uploads/coupons/',
                    $new_file,
                    150,
                    150,
                    'thumb'
                );

                create_image_copy(
                    FCPATH . 'assets/uploads/coupons/',
                    $new_file,
                    600,
                    600,
                    'medium'
                );
            }
        }else{
            $image_file= $old_img;
        }

        $data = [
            "code" => $this->input->post('code'),
            "discount_type" => $this->input->post('discount_type'),
            "discount_value" => $this->input->post('discount_value'),
            "min_purchase" => $this->input->post('min_purchase'),
            "start_date" => $this->input->post('start_date'),
            "expiry_date" => $this->input->post('expiry_date'),
            "status" => $this->input->post('status'),
            "image" => $image_file
        ];

        // $data['coupons']=;
        if (empty($id)) {
            if ($this->coupon_model->setCoupon($data)) {
                // add 
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Coupon Saved.'
                ]);
            } else {
                $original = FCPATH . 'assets/uploads/coupons/original/' . $image_file;
                $medium   = FCPATH . 'assets/uploads/coupons/medium/'   . $image_file;
                $thumb    = FCPATH . 'assets/uploads/coupons/thumb/'    . $image_file;

                if (file_exists($original)) unlink($original);
                if (file_exists($medium)) unlink($medium);
                if (file_exists($thumb)) unlink($thumb);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'DB Coupon Save Faild.'
                ]);
            }

        } else {
            // update 
            if ($this->coupon_model->updateCoupon($id,$data)) {
                if(!empty($_FILES['image']['name'])){

                    $original = FCPATH . 'assets/uploads/coupons/original/' . $old_img;
                    $medium   = FCPATH . 'assets/uploads/coupons/medium/'   . $old_img;
                    $thumb    = FCPATH . 'assets/uploads/coupons/thumb/'    . $old_img;
                    
                    if (file_exists($original)) unlink($original);
                    if (file_exists($medium)) unlink($medium);
                    if (file_exists($thumb)) unlink($thumb);
                }
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Coupon Updated.'
                ]);
            } else {
                $original = FCPATH . 'assets/uploads/coupons/original/' . $image_file;
                $medium   = FCPATH . 'assets/uploads/coupons/medium/'   . $image_file;
                $thumb    = FCPATH . 'assets/uploads/coupons/thumb/'    . $image_file;

                if (file_exists($original)) unlink($original);
                if (file_exists($medium)) unlink($medium);
                if (file_exists($thumb)) unlink($thumb);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Update DB Coupon Save Faild.'
                ]);
            }
        }

       
    }

    public function image_check()
    {
        // if (empty($_FILES['image']['name'])) {
        //     $this->form_validation->set_message('image_check', 'Image is required.');
        //     return FALSE;
        // }

        // $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif'];
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $tmp_name  = $_FILES['image']['tmp_name'];

        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed_ext)) {
            $this->form_validation->set_message('image_check', 'Only JPG, JPEG, PNG, GIF allowed.');
            return FALSE;
        }

        if ($file_size > 2 * 1024 * 1024) {
            $this->form_validation->set_message('image_check', 'Image must be less than 2MB.');
            return FALSE;
        }

        $image_info = @getimagesize($tmp_name);
        if (!$image_info || !in_array($image_info['mime'], $allowed_mimes)) {
            $this->form_validation->set_message('image_check', 'Invalid image.');
            return FALSE;
        }

        return TRUE;
    }

    public function valid_start_date($date)
    {
        if (empty($date)) {
            return TRUE;
        }
        $timestamp = strtotime($date);

        if ($timestamp === false) {
            $this->form_validation->set_message('valid_start_date', 'Start Date is not valid.');
            return false;
        }

        if ($timestamp < strtotime(date("Y-m-d"))) {
            $this->form_validation->set_message('valid_start_date', 'Start Date cannot be a past date.');
            return false;
        }

        return true;
    }

    public function valid_expiry_date($date)
    {
        if (empty($date)) {
            return TRUE;
        }
        $timestamp = strtotime($date);

        if ($timestamp === false) {
            $this->form_validation->set_message('valid_expiry_date', 'Expiry Date is not valid.');
            return false;
        }

        if ($timestamp < strtotime(date("Y-m-d"))) {
            $this->form_validation->set_message('valid_expiry_date', 'Expiry Date cannot be a past date.');
            return false;
        }

        return true;
    }
    public function delete($enc_id){
        $id=$this->encryption->decrypt(base64_decode(urldecode($enc_id)));
        if($this->coupon_model->couponDelete($id)){
            echo json_encode([
               'status'=>'success',
            ]);
        }else{
             echo json_encode([
               'status'=>'error',
            ]);
        }
    }
}
