<?php
class Home extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        
    }

    public function index(){
        $this->load->view('admin/includes/header');
        $this->load->view('admin/home');
        $this->load->view('admin/includes/footer');
    }
}
?>