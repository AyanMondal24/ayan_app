<?php

class unit_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    // show data to  product add page
    function getAllUnits()
    {
        $this->db->select('short_name,min(id) as id');
        $this->db->from('product_unit');
        $this->db->group_by('short_name');
        return $this->db->get()->result();
    }
    // inserting units 
    function setData($data)
    {
        return $this->db->insert('product_unit', $data);
    }

    // unit view 
    function getUnits()
    {
        $this->db->select('*');
        $this->db->from('product_unit');
        return $this->db->get()->result();
    }

    //unit edit 

    function getSingleDataById($id)
    {
        return $this->db
            ->select('*')
            ->from('product_unit')
            ->where('id', $id)
            ->get()
            ->row();     // returns single object
    }
    // update unit 
    function updateData($data, $id)
    {
        return $this->db
            ->where('id', $id)
            ->update('product_unit', $data);
    }
    // delete 
    function deleteData($id)
    {
        $this->db
            ->where('id', $id)
            ->delete('product_unit');
        return  $this->db->affected_rows();
    }
}
