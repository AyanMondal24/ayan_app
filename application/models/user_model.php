<?php
class user_model extends CI_Model
{
    function __construct()
    {
        return parent::__construct();
    }

    function add($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id(); // return inserted row id
    }
    function getUserByEmail($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('is_guest', 0);

        return $this->db->get()->row();
    }

    function getUserById($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
    function update($data, $id)
    {
        // $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        $this->db->set('updated_at', date("Y-m-d H:i:s"));
        return $this->db->update('users', $data);
    }

    function getUserByEmailForGuest($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('is_guest', 1);
        $this->db->where('is_guest', 1);
        return $this->db->get()->row();
    }
}
