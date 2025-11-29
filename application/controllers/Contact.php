<?php

class Contact extends CI_Controller{
    function __construct()
    {
         parent::__construct();
         $this->load->helper('common');
    }

    function index(){
		load_views('contact');
    }
}