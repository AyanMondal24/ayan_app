<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Long, reversible, and URL-safe encoder/decoder
 * No %, /, +, or = characters
 */
function load_admin_views($main_view, $data = [])
{
    $CI =& get_instance();  // Get CodeIgniter instance
    
    $CI->load->view('admin/includes/header', $data);
    $CI->load->view('admin/' . $main_view, $data);  // Assumes main views are in 'admin/'
    $CI->load->view('admin/includes/footer', $data);
}

function load_views($main_view, $data = [])
{
    $CI =& get_instance();  // Get CodeIgniter instance
    
    $CI->load->view('includes/header', $data);
    $CI->load->view($main_view, $data);  // Assumes main views are in 'admin/'
    $CI->load->view('includes/footer', $data);
}


function upload_image($field_name, $upload_path = 'products', $old_image = '', $prefix = 'product_')
{
    $CI =& get_instance();
    
    // Default return
    $response = [
        'status' => false,
        'file_name' => $old_image,
        'error' => null
    ];

    // If no file selected, return old image
    if (empty($_FILES[$field_name]['name'])) {
        $response['status'] = true;
        return $response;
    }

    $unique_id = uniqid();
    $config['upload_path']   = FCPATH . 'assets/uploads/' . $upload_path;
    $config['allowed_types'] = 'jpeg|jpg|png|gif';
    $config['max_size']      = 2048;
    $config['encrypt_name']  = FALSE;
    $config['file_name']     = $prefix . $unique_id;

    $CI->load->library('upload', $config);

    if ($CI->upload->do_upload($field_name)) {
        $uploadData = $CI->upload->data();
        $response['status'] = true;
        $response['file_name'] = $uploadData['file_name'];
    } else {
        $response['error'] = strip_tags($CI->upload->display_errors());
    }

    return $response;
}
