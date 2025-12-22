<?php

class coupon_model extends CI_Model
{
    function __construct()
    {
        return parent::__construct();
    }

    public function setCoupon($data)
    {
        return  $this->db->insert('coupons', $data);
    }


    public function getCouponByCode($coupon_code)
    {
        return $this->db
            ->where('code', $coupon_code)
            ->get('coupons')
            ->row();
    }
    public function getCouponById($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('coupons')
            ->row();
    }

    public function getCoupons()
    {
        $this->db->select('*');
        $this->db->from('coupons');
        return $this->db->get()->result();
    }

    public function updateCoupon($id,$data)
    {
        $this->db->where('id', $id);
       return $this->db->update('coupons',$data);
    }
    public function couponDelete($id){
      return $this->db->delete('coupons', ['id' => $id]);
    }
}
