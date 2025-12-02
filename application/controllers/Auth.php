<?php

class Auth extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        
    }
    function login(){
        load_views('login_form');
    }
}