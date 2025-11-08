<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Load admin views with header and footer
 * @param string $main_view The main content view (e.g., 'single_view')
 * @param array $data Data to pass to the views
 */
function load_admin_views($main_view, $data = [])
{
    $CI =& get_instance();  // Get CodeIgniter instance
    
    $CI->load->view('admin/includes/header', $data);
    $CI->load->view('admin/' . $main_view, $data);  // Assumes main views are in 'admin/'
    $CI->load->view('admin/includes/footer', $data);
}