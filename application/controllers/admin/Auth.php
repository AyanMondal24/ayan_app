<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('image_helper');
        $this->load->model('admin_model');
    }

    function login()
    {
        // If already logged in, go to dashboard
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
            return;
        }
        $this->load->view('admin/auth/login');
    }
    function signup()
    {
        $this->load->view('admin/auth/signup');

        // load_admin_views('auth/signup');
    }

    function storeSignup()
    {
        $this->form_validation->set_rules('first_name', 'First Name ', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name ', 'required');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[admins.email]', [
            'is_unique' => 'This email already exists. Please use another one.'
        ]);

        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('image', 'Image', 'callback_validate_image');
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[8]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/]',
            array(
                'regex_match' => 'Password must contain at least 1 uppercase, 1 lowercase, 1 number and 1 special character.'
            )
        );

        $this->form_validation->set_rules(
            'cpassword',
            'Confirm Password',
            'required|matches[password]',
            array(
                'matches' => 'Confirm Password does not match with Password.'
            )
        );

        if ($this->form_validation->run() == false) {
            $errors = [];
            $fields = ['first_name', 'last_name', 'email', 'image', 'phone', 'password', 'cpassword'];
            foreach ($fields as $field) {
                $error = form_error($field);
                if (!empty($error)) {
                    $errors[$field] = $error;
                }
            }
            echo json_encode([
                'status' => 'validation_error',
                'data' => $errors
            ]);
            return;
        }


        $password = $this->input->post('password');
        $confirm_password = $this->input->post('cpassword');

        if ($password !== $confirm_password) {
            echo json_encode([
                "status" => 'error',
                "message" => "Password do not match."
            ]);
            return;
            // return $this->set_page("error", "Password do not match.");
        }


        if (!empty($_FILES['image']['name'])) {

            $upload_dir = FCPATH . 'assets/uploads/admin_img/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }


            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $unique_name = "img_" . date("Ymd_His") . "_" . uniqid() . "." . $ext;

            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['file_name']     = $unique_name;
            $config['overwrite']     = FALSE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {

                $data      = $this->upload->data();
                $file_path = $data['full_path'];
                $image     = $data['file_name'];

                // make thumb & overwrite same image
                resize_image_single($file_path, 150, 150);

                $data = [
                    "fname" => $this->input->post('first_name'),
                    "lname" => $this->input->post('last_name'),
                    "email" => $this->input->post('email'),
                    "phone" => $this->input->post('phone'),
                    "password" => password_hash($password, PASSWORD_DEFAULT),
                    "image" => $image,
                    "created_at" => date('Y-m-d H:i:s'),
                    "updated_at" => date('Y-m-d H:i:s')
                ];


                if ($this->admin_model->create($data)) {
                    echo json_encode([
                        "status"  => "success",
                        "message" => 'Signup Completed.',
                        "redirect" => base_url('admin/Auth/login') // send redirect url
                    ]);
                    return;
                } else {
                    echo json_encode([
                        "status" => 'error',
                        "message" => 'Signup Not Complete.'
                    ]);
                    return;
                }
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => $this->upload->display_errors()
            ]);
            return;
        }
    }

    function checkLogin()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === false) {
            $errors = [];
            $fields = ['email', 'password'];
            foreach ($fields as $field) {
                $error = form_error($field);
                if (!empty($error)) {
                    $errors[$field] = $error;
                }
            }
            echo json_encode([
                'status' => 'error',
                'errors' => $errors
            ]);
            return;
        }

        $email    = $this->input->post('email');
        $password = $this->input->post('password');

        $admin = $this->admin_model->getByEmail($email);
        if (!$admin) {
            echo json_encode([
                'status' => 'error',
                'errors' => ['email' => 'Email not registered']
            ]);
            return;
            // return $this->set_page("error", "Email not registered.");
        }
        if (!password_verify($password, $admin->password)) {
            echo json_encode([
                'status' => 'error',
                'errors' => ['password' => "Passsword Not Match"]
            ]);
            return;
            // return $this->set_page('error', 'Incorrect password.');
        }
        $this->session->set_userdata([
            'admin_id' => $admin->id,
            'email'   => $admin->email,
            'admin_logged_in' => TRUE
        ]);

        // $redirectTo = $this->input->post('redirect_to') ?? 'home';

        // switch ($redirectTo) {
        //     case "checkout":
        //         $redirect_url = base_url("Checkout/index");
        //         break;
        //     default:
        //         $redirect_url =  base_url("Home/index"); // default login location
        // }


        echo json_encode([
            "status"  => "success",
            "message" => 'Login Successful.',
            "redirect" => base_url("admin/Home")
 // send redirect url
        ]);
        // return $this->set_page('success', 'Login Successful.', 'login');
    }


    function validate_image()
    {
        if (!isset($_FILES['image']) || $_FILES['image']['error'] == 4) {
            $this->form_validation->set_message('validate_image', 'Image is required');
            return false;
        }

        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];

        // Check MIME type
        if (!in_array($_FILES['image']['type'], $allowed_types)) {
            $this->form_validation->set_message('validate_image', 'Only JPG, JPEG, PNG files are allowed');
            return false;
        }
        // Check file size (2MB)
        if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
            $this->form_validation->set_message('validate_image', 'Image must be less than 2MB');
            return false;
        }
        // Verify it's a real image
        if (!@getimagesize($_FILES['image']['tmp_name'])) {
            $this->form_validation->set_message('validate_image', 'Uploaded file must be a valid image');
            return false;
        }
        return true;
    }

    public function logout()
    {
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('admin_logged_in');
        $this->session->sess_destroy();
      
        redirect('admin/dashboard');
    }
}
