<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index(){

        if($this->session->userdata('admin_logged_in')){
            $id=$this->session->userdata('admin_id');
            $data['admin']=$this->admin_model->getAdminById($id);
            load_admin_views('home',$data);
            return;
        }

        load_admin_views('home');
    }
}
?>
