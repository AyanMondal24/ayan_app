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
    public function totalProducts()
    {
        return $this->db->count_all('products');
    }

    //admin single view 
    public function singleView($enc_id)
    {
        $this->db->select('p.id,p.name AS product_name,p.description,p.price,p.img,p.category,p.quantity,p.status,p.is_available,p.created_at,c.name AS category_name');
        $this->db->from('products p');
        $this->db->join('category c', 'c.id = p.category', 'inner');
        $this->db->where('p.id', $enc_id);
        return $this->db->get()->row();
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

    // delete query pass
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }

    // for uploading image  into product image pass
    public  function SetProductImages($data)
    {
        return $this->db->insert('product_image', $data);
    }
    //show image details on update form pass
    public function getProductImages($id)
    {
        $this->db->select('*');
        $this->db->from('product_image');
        return $this->db->where('product_id', $id)->get()->result();
    }

    // in ptoduct update page only image table update pass
    public function insertProductImage($data)
    {
        return $this->db->insert('product_image', $data);
    }
    // in ptoduct update page when user click cross button delete image table  pass
    public function deleteProductImage($image_file_name)
    {
        $this->db->where('image_name', $image_file_name);
        return $this->db->delete('product_image');
    }

    // update only single field in image table pass
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
}
