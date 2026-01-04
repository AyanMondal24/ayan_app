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
    public function getBestSellingProduct()
    {
        return $this->db
            ->select('
            p.id,
            p.name,
            p.price,
            SUM(od.quantity) AS total_sold,
            MAX(pi.image_name) AS image,
            MAX(pi.alt_text) AS alt_text
        ')
            ->from('order_details od')
            ->join('products p', 'p.id = od.product_id')
            ->join('orders o', 'o.id = od.order_id')
            ->join(
                'product_image pi',
                'pi.product_id = p.id AND pi.is_featured = 0',
                'left'
            )
            ->where('o.order_status', 'confirmed')
            ->group_by('p.id')
            ->order_by('total_sold', 'DESC')
            ->limit(6)
            ->get()
            ->result();
    }
}
