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

    public function updateToken($data, $id)
    {
        $this->db->where('id', $id);
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

    public function getAllUsers($limit, $offset, $sort_column = null, $sort_order = null, $searchval = null, $userType = null)
    {
        $allowedSorts = [
            'name'     => "CONCAT(fname, ' ', lname)",
            'email'    => "email",
            'mobile'   => "mobile",
            'created_at'   => "created_at",
            'id'       => "id"
        ];

        if (!$sort_column || !isset($allowedSorts[$sort_column])) {
            $sort_column = 'id';
        }

        $this->db->select('*');
        $this->db->from('users');

        if (!empty($sort_column) && !empty($sort_order)) {
            $this->db->order_by($allowedSorts[$sort_column], $sort_order, false);
        }

        if (!empty($searchval)) {
            $this->db->group_start()
                ->like('id', $searchval)
                ->or_like('fname', $searchval)
                ->or_like('lname', $searchval)
                ->or_like('email', $searchval)
                ->or_like('mobile', $searchval)
                ->group_end();
        }

        if ($userType !== '' && $userType !== null) {
            $this->db->where('is_guest', (int)$userType);
        }

        $this->db->limit((int)$limit, (int)$offset);

        return $this->db->get()->result();
    }


    public function update_status($user_id, $status)
    {
        return $this->db
            ->where('id', $user_id)
            ->update('users', [
                'status' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    }
    public function total_data($searchval = null, $userType = null)
    {
        $this->db->from('users');

        if (!empty($searchval)) {
            $this->db->group_start()
                ->like('id', $searchval)
                ->or_like('fname', $searchval)
                ->or_like('lname', $searchval)
                ->or_like('email', $searchval)
                ->or_like('mobile', $searchval)
                ->group_end();
        }

        if ($userType !== '' && $userType !== null) {
            $this->db->where('is_guest', (int)$userType);
        }

        return $this->db->count_all_results();
    }

    //    for  reset pass
    public function getDataByToken($token)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('reset_token', $token);
        return $this->db->get()->row();
    }

    public function update_pass($data, $token, $user_id)
    {
        $this->db->where('id', $user_id);
        $this->db->where('reset_token', $token);
        return $this->db->update('users', $data);
    }
    public function getByVerifyToken($token)
    {
        return $this->db->where('email_verify_token', $token)
            ->get('users')
            ->row();
    }

    public function verifyUser($id)
    {
        return $this->db->where('id', $id)->update('users', [
            'is_verified' => 1,
            'email_verify_token' => NULL,
            'email_token_expiry' => NULL
        ]);
    }

    public function get_latest_users($limit = 4)
    {
        return $this->db
            ->order_by('id', 'DESC')   // or created_at
            ->limit($limit)
            ->where('is_guest',0)
            ->get('users')
            ->result();
    }
}
