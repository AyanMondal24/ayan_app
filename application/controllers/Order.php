<?php

class Order extends CI_Controller{
    function __construct()
    {
        parent::__construct();
    }

    function thank_you($order_number = null){
        $data['order_number'] = $order_number;
        load_views('thank_you',$data);
    }
}