<?php
class order_model extends CI_Model
{
    function __construct()
    {
        return parent::__construct();
    }

    function create($data)
    {
        $this->db->insert('orders', $data);
        return $this->db->insert_id();  // return last insert ID
    }

    function updateOrderNumber($order_number, $order_id)
    {
        $this->db->where('id', $order_id);
        return $this->db->update('orders', ["order_number" => $order_number]);
    }

    // get all orders data using user id 
    function getOrders($user_id)
    {
        $this->db->select('
        or.id AS order_id,
        GROUP_CONCAT(
            CONCAT(p.name, " (", c.name, ")")
            SEPARATOR ", "
        ) AS product_names,
        or.final_amount,
        or.order_status
    ');

        $this->db->from('order_details ord');
        $this->db->join('orders or', 'or.id = ord.order_id');
        $this->db->join('products p', 'p.id = ord.product_id', 'inner');
        $this->db->join('category c', 'c.id = p.category', 'inner');

        $this->db->where('or.user_id', $user_id);
        $this->db->group_by('or.id');

        return $this->db->get()->result();
    }


    // get all orders data for admin

    function getAllOrdersAdmin()
    {
        $this->db->select('
        o.id AS order_id,
        o.order_number,
        CONCAT(u.fname, " ", u.lname) AS customer_name,
        COUNT(od.id) AS total_items,
        o.total_amount,
        o.coupon_discount,
        o.final_amount,
        o.payment_method,
        o.payment_status,
        o.order_status,
        o.created_at
    ');

        $this->db->from('orders o');
        $this->db->join('users u', 'u.id = o.user_id', 'left');
        $this->db->join('order_details od', 'od.order_id = o.id', 'left');

        $this->db->group_by('o.id');
        $this->db->order_by('o.created_at', 'DESC');

        return $this->db->get()->result();
    }


    function getOrderItems($order_id)
    {
        $this->db->select('
        od.quantity,
        od.total,
        p.id AS product_id,
        p.name AS product_name,
        p.price,
        pi.image_name
    ');

        $this->db->from('order_details od');
        $this->db->join('products p', 'p.id = od.product_id');
        $this->db->join('product_image pi', 'pi.product_id = p.id', 'left');
        $this->db->where('pi.is_featured', 0);
        $this->db->where('od.order_id', $order_id);
        $this->db->group_by('od.id');

        return $this->db->get()->result();
    }

    function getOrderSummary($order_id)
    {
        $this->db->select('
        o.b_fname,
        o.b_lname,
        o.b_state,
        o.b_address,
        o.b_city,
        o.b_country,
        o.b_pin,
        o.b_landmark,
        o.b_phone,
        o.is_shipping_same,
        o.s_fname,
        o.s_lname,
        o.s_state,
        o.s_address,
        o.s_city,
        o.s_country,
        o.s_pin,
        o.s_landmark,
        o.s_phone,

        o.id as order_id,
        o.order_number,
        o.payment_method,
        o.payment_intent_id,
        o.transaction_id,
        o.payment_status,
        o.order_status,
        o.created_at as order_created,
        o.updated_at as order_updated,
        SUM(od.quantity * od.price) AS listing_price,

        c.code AS coupon_code,
        c.discount_type,
        c.discount_value
    ');
        $this->db->from('orders o');
        $this->db->join('order_details od', 'od.order_id = o.id', 'inner');
        $this->db->join('coupons c', 'c.id = o.coupon_id', 'left');
        $this->db->where('o.id', $order_id);
        $this->db->group_by('o.id');

        return $this->db->get()->row();
    }

    public function updateOrderStatus($orderId, $status)
    {
        return $this->db
            ->where('id', $orderId)
            ->update('orders', [
                'order_status' => $status,
                'updated_at'   => date('Y-m-d H:i:s')
            ]);
    }


    public function updatePaymentIntent($order_id, $intent_id)
    {
        if (empty($order_id) || empty($intent_id)) {
            return false; // safety check
        }

        $data = [
            'payment_intent_id' => $intent_id
        ];

        $this->db->where('id', $order_id);
        return $this->db->update('orders', $data); // returns true or false
    }

    public function markPaymentSuccess($intent_id, $txn_id)
    {
        $order = $this->db
            ->where('payment_intent_id', $intent_id)
            ->get('orders')
            ->row();

        if (!$order) {
            return false;
        }

        $this->db
            ->where('payment_intent_id', $intent_id)
            ->update('orders', [
                'order_status'   => 'success',
                'transaction_id' => $txn_id,
                'payment_status' => 'paid'
            ]);

        return $order->id;
    }


    function getOrderPaymentStatusById($order_id)
    {
        $this->db->select('payment_status');
        $this->db->from('orders');
        $this->db->where('id', $order_id);
        return $this->db->get()->row();
    }

    function getPaymentMethod($order_id)
    {
        $this->db->select('payment_method');
        $this->db->from('orders');
        $this->db->where('id', $order_id);
        return $this->db->get()->row();
    }
}
