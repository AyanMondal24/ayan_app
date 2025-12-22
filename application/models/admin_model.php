<?php
class admin_model extends CI_Model
{
    function __construct()
    {
        return parent::__construct();
    }

    public function getByEmail($email)
    {
        return $this->db
            ->where('email', $email)
            // ->where('status', 1)
            ->get('admins')
            ->row();
    }

    public function create($data)
    {
        return $this->db->insert('admins', $data);
    }

    
    function getAdminById($id)
    {
        $this->db->select('*');
        $this->db->from('admins');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }
}
