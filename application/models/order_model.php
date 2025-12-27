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

        GROUP_CONCAT(p.name SEPARATOR ", ") AS product_names,

        /* SAFE subtotal */
        SUM(ord.quantity * ord.price) AS subtotal,

        /* SAFE coupon calculation */
        CASE
            WHEN coupon.id IS NULL THEN SUM(ord.quantity * ord.price)

            WHEN coupon.discount_type = "percentage"
                THEN SUM(ord.quantity * ord.price)
                     - (SUM(ord.quantity * ord.price) * coupon.discount_value / 100)

            ELSE
                SUM(ord.quantity * ord.price) - coupon.discount_value
        END AS final_amount,

        or.order_status,
        or.payment_method,
        or.order_number,
        or.payment_status,
        or.created_at,

        coupon.code,
        coupon.discount_type,
        coupon.discount_value
    ');

        $this->db->from('order_details ord');
        $this->db->join('orders or', 'or.id = ord.order_id');
        $this->db->join('coupons coupon', 'coupon.id = or.coupon_id', 'left');
        $this->db->join('products p', 'p.id = ord.product_id');

        $this->db->where('or.user_id', $user_id);
        $this->db->where('or.order_status !=', 'canceled');
        $this->db->group_by('or.id');

        return $this->db->get()->result();
    }


    // count total orders for pagination 

    function countTotalOrder($search = null, $filterBy = null, $filterValue = null)
    {
        $this->db->select('COUNT(DISTINCT o.id) AS total_rows', false);
        $this->db->from('orders o');
        $this->db->join('order_details od', 'od.order_id = o.id', 'left');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('o.order_number', $search);
            $this->db->or_like('o.b_fname', $search);
            $this->db->or_like('o.b_lname', $search);
            $this->db->or_like('o.payment_method', $search);
            $this->db->or_like('o.payment_status', $search);
            $this->db->or_like('o.order_status', $search);
            $this->db->or_like('o.created_at', $search);
            $this->db->group_end();
        }

        if (!empty($filterBy) && !empty($filterValue)) {

            // ONLY FILTERING, NOT SORTING
            if (!in_array($filterValue, ['ASC', 'DESC'])) {
                $this->db->where('o.' . $filterBy, $filterValue);
            }
        }

        $query = $this->db->get()->row();
        return (int) $query->total_rows;
    }

    // getting orders
    function getAllOrdersAdmin($limit, $offset, $search = null, $filterBy = null, $filterValue = null)
    {
        $this->db->select('
        o.id AS order_id,
        o.order_number,
        CONCAT(o.b_fname, " ", o.b_lname) AS customer_name,
        SUM(od.quantity) AS total_items,
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

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('o.order_number', $search);
            $this->db->or_like('o.b_fname', $search);
            $this->db->or_like('o.b_lname', $search);
            $this->db->or_like('o.payment_method', $search);
            $this->db->or_like('o.payment_status', $search);
            $this->db->or_like('o.order_status', $search);
            $this->db->or_like('o.created_at', $search);
            $this->db->group_end();
        }

        $this->db->group_by('o.id');

        if (!empty($filterBy) && !empty($filterValue)) {

            if (in_array($filterValue, ['ASC', 'DESC'])) {

                if ($filterBy === 'customer') {
                    $this->db->order_by('o.b_fname', $filterValue);
                    $this->db->order_by('o.b_lname', $filterValue);
                } elseif ($filterBy === 'total_items') {
                    $this->db->order_by('total_items', $filterValue);
                } elseif ($filterBy === 'order_date') {
                    $this->db->order_by('o.created_at', $filterValue);
                } elseif ($filterBy === 'order_number') {
                    $this->db->order_by('o.order_number', $filterValue);
                } elseif ($filterBy === 'final_amount') {
                    $this->db->order_by('o.final_amount', $filterValue);
                } else {
                    $this->db->order_by('o.created_at', 'DESC');
                }
            }
            //filtering
            else {
                $this->db->where('o.' . $filterBy, $filterValue);
                $this->db->order_by('o.created_at', 'DESC');
            }
        } else {
            // DEFAULT
            $this->db->order_by('o.created_at', 'DESC');
        }

        $this->db->limit($limit, $offset);

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
        o.b_email as order_b_email,
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
        o.s_email as order_s_email,

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
                'order_status'   => 'confirmed',
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

    function update_order_status($order_id, $status)
    {
        $this->db->where('id', $order_id);
        return $this->db->update('orders', [
            'order_status' => $status,
            'updated_at'   => date('Y-m-d H:i:s')
        ]);
    }

    function update($data, $order_id)
    {
        $this->db->where('id', $order_id);
        return  $this->db->update('orders', $data);
    }
}
