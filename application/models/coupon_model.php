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
}
