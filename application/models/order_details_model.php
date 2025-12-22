<?php

class order_details_model extends CI_Model
{
    function __construct()
    {
        return parent::__construct();
    }

    function create($data)
    {
        return $this->db->insert('order_details', $data);
    }
}
