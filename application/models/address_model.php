<?php

class address_model extends CI_Model
{
    function __construct()
    {
        return parent::__construct();
    }

    function create($data)
    {
        $this->db->insert('address', $data);
        return $this->db->insert_id(); // returns last inserted ID
    }


    function getAddressByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from('address');
        $this->db->where('user_id', $user_id);
        return $this->db->get()->row();
    }
    function update($data, $id)
    {
        unset($data['updated_at']);
        // $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->set('updated_at', date("Y-m-d H:i:s"));
        return $this->db->update('address', $data);
    }

    public function getAddressByUserIdcheck($user_id)
    {
        $this->db->select('a.id,a.user_id');
        $this->db->from('address a');
        $this->db->join('users u', 'u.id=a.user_id', 'inner');
        $this->db->where('u.is_guest', 1);
        $this->db->where('a.user_id', $user_id);
        return $this->db->get()->row();
    }
}
