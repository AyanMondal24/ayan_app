<?php
class category_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    function getAllCategory()
    {
        $this->db->select('name, MIN(id) as id');
        $this->db->from('category');
        $this->db->group_by('name');
        return $this->db->get()->result();
    }
    function setCategory($data)
    {
        return $this->db->insert('category', $data);
    }

    function getCategory()
    {
        $this->db->select('id,name,image');
        $this->db->from('category');
        return $this->db->get()->result();
    }
}
