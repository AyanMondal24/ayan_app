<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $directory = strtolower($this->router->fetch_directory());
        $class     = strtolower($this->router->fetch_class());
        $method    = strtolower($this->router->fetch_method());

      
        // Allow Auth controller and dashboard
        if ($directory === 'admin/' && in_array($class, ['auth', 'dashboard'])) {
            return;
        }


        // Protect admin area
        if ($directory === 'admin/' && !$this->session->userdata('admin_logged_in')) {
            // redirect('admin/auth/login');
            redirect('admin/Dashboard');
        }
    }
}
