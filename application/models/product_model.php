<?php

class product_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function setProducts($data)
    {
        $this->db->insert('products', $data);
        return $this->db->insert_id();
    }
    public function getProducts($limit, $start)
    {
        $this->db->select('p.id,p.name AS product_name,p.price,p.quantity,p.status,p.is_available,CONCAT(p.status,"/",p.is_available) AS status_combine,p.unit_id,c.name AS category_name,u.short_name');
        $this->db->from('products p');
        $this->db->join('category c', 'c.id=p.category', 'inner');
        $this->db->join('product_unit u', 'u.id=p.unit_id', 'inner');
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'ASC');
        return $this->db->get()->result();
    }

    // for pagination total row count
    public function totalProducts($status = null)
    {
        if (!empty($status)) {
            $this->db->where('status', $status);
        }
        return $this->db->count_all_results('products');
    }

    //admin single view 
    public function singleView($enc_id)
    {
        $this->db->select('p.id,p.name AS product_name,p.description,p.price,p.category,p.quantity,p.status,p.is_available,p.created_at,c.name AS category_name,u.short_name');
        $this->db->from('products p');
        $this->db->join('category c', 'c.id = p.category', 'inner');
        $this->db->join('product_unit u', 'u.id = p.unit_id', 'inner');
        // $this->db->join('product_image i', 'i.product_id = p.id', 'inner');
        $this->db->where('p.id', $enc_id);
        $product = $this->db->get()->row();

        // Fetch product images as array
        $this->db->select('image_name, image_type, alt_text, sort_order');
        $this->db->from('product_image');
        $this->db->where('product_id', $enc_id);
        $images = $this->db->get()->result_array();

        // Merge & return
        return [
            'product' => $product,
            'images'  => $images
        ];
    }

    // for showing data on  edit page 
    public function getSingleProduct($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row();
    }
    //update query pass
    public function updateProduct($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    // delete query 
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }

    // for uploading image  into product image 
    public  function SetProductImages($data)
    {
        return $this->db->insert('product_image', $data);
    }
    //show image details on update form 
    public function getProductImages($id)
    {
        $this->db->select('*');
        $this->db->from('product_image');
        return $this->db->where('product_id', $id)->get()->result();
    }

    // in ptoduct update page only image table update 
    public function insertProductImage($data)
    {
        return $this->db->insert('product_image', $data);
    }
    // in ptoduct update page when user click cross button delete image table  
    public function deleteProductImage($image_file_name)
    {
        $this->db->where('image_name', $image_file_name);
        return $this->db->delete('product_image');
    }

    // update only single field in image table 
    public function updateProductImageData($id, $image_data)
    {
        $this->db->where('id', $id);
        return $this->db->update('product_image', $image_data);
    }

    // get old image from image table for unline from parmanent folder products/ 
    public function getOldImage($image_id)
    {
        return $this->db
            ->select('*')
            ->from('product_image')
            ->where('id', $image_id)
            ->get()
            ->row(); // returns a single object (use ->row_array() for array)
    }


    // website getAllproducts
    public function getAllproducts($limit, $offset, $category_name = null)
    {
        $this->db->select('
        p.name AS product_name,
        p.description,
        p.price,
        p.is_available,
        p.status,
        c.name AS category_name,
        u.short_name,
        u.name AS unit_name,
        i.image_name,
        i.image_type,
        i.alt_text,
        i.product_id
        ');
        $this->db->from('products p');
        $this->db->join('category c', 'c.id=p.category', 'inner');
        $this->db->join('product_unit u', 'u.id=p.unit_id', 'inner');
        $this->db->join('product_image i', 'i.product_id=p.id', 'inner');
        $this->db->where('i.image_type', 'main');
        $this->db->where('p.status', 0);
        $this->db->limit($limit, $offset);

        if (!empty($category_name) && $category_name !== 'all') {
            $this->db->where('LOWER(c.name)', strtolower($category_name));
        }
        return $this->db->get()->result();
    }

    public function totalProductByCategory($category_name)
    {
        if ($category_name == 'all' || $category_name == '') {
            return $this->db->where('status', 0)->count_all_results('products');
        }

        // here table join for check category name 
        $this->db->select('
        p.name,
        p.status,
        p.category,
        c.name
        ');
        $this->db->from('products p');
        $this->db->join('category c','c.id=p.category','inner');
        $this->db->where('c.name',$category_name);
        $this->db->where('p.status', 0);
        return $this->db->count_all_results();
    }
}
