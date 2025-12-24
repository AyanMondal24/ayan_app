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
        $this->db->where('p.id', $enc_id);
        $product = $this->db->get()->row();

        // Fetch product images as array
        $this->db->select('image_name, alt_text,is_featured');
        $this->db->from('product_image');
        $this->db->where('product_id', $enc_id);
        $this->db->where('is_featured', '1');
        $this->db->limit(5);
        $images_without_featured_img = $this->db->get()->result_array();


        $this->db->select('image_name, alt_text,is_featured');
        $this->db->from('product_image');
        $this->db->where('product_id', $enc_id);
        $this->db->where('is_featured', '0');
        $images_with_featured_img = $this->db->get()->row();


        // Merge & return
        return [
            'product' => $product,
            'images'  => $images_without_featured_img,
            'featured_images'  => $images_with_featured_img
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
    // get only featured image 
    public function getFeaturedImages($id)
    {
        $this->db->select('*');
        $this->db->from('product_image');
        return $this->db->where('product_id', $id)->where('is_featured', '0')->get()->row();
    }
    public function updateFeaturedImage($data, $id)
    {
        return $this->db
            ->where('id', $id)     // product_image.id
            ->update('product_image', $data);
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
            ->select('image_name')
            ->from('product_image')
            ->where('id', $image_id)
            ->get()
            ->row(); // returns a single object (use ->row_array() for array)
    }


    // website getAllproducts
    public function getAllproducts($category_name = null, $limit = null, $featured_product = null)
    {
        $this->db->select('
        p.id,
        p.name AS product_name,
        p.description,
        p.price,
        p.is_available,
        p.status,
        c.name AS category_name,
        u.short_name,
        u.name AS unit_name,
        i.image_name,
        i.alt_text,
        i.product_id
        ');
        $this->db->from('products p');
        $this->db->join('category c', 'c.id=p.category', 'inner');
        $this->db->join('product_unit u', 'u.id=p.unit_id', 'inner');
        $this->db->join('product_image i', 'i.product_id=p.id', 'inner');
        // $this->db->where('i.image_type', 'main');
        $this->db->where('p.status', 0);
        $this->db->where('i.is_featured', 0);

        if (!empty($category_name) && $category_name !== 'all') {
            $this->db->where('LOWER(c.name)', strtolower($category_name));
        }
        if (!empty($featured_product) && $featured_product == '0') {
            $this->db->where('p.is_featured', $featured_product);
        }
        $this->db->order_by('p.id', 'DESC');
        // Limit (optional)
        if (!empty($limit)) {
            $this->db->limit($limit);
        }
        return $this->db->get()->result();
    }

    // shop page 
    public function getShopProducts($limit, $offset, $category_name = null, $search = null, $price = null)
    {
        $this->db->select('
        p.id as product_id,
        p.name AS product_name,
        p.description,
        p.price,
        p.is_available,
        p.status,
        c.name AS category_name,
        u.short_name,
        u.name AS unit_name,
        i.image_name,
        i.alt_text,
        i.product_id
        ');
        $this->db->from('products p');
        $this->db->join('category c', 'c.id=p.category', 'inner');
        $this->db->join('product_unit u', 'u.id=p.unit_id', 'inner');
        $this->db->join('product_image i', 'i.product_id=p.id', 'inner');
        // $this->db->where('i.image_type', 'main');
        $this->db->where('p.status', 0);
        $this->db->where('p.is_available', 0);
        $this->db->where('i.is_featured', 0);

        if (!empty($category_name) && $category_name !== 'all') {
            $this->db->where('LOWER(c.name)', strtolower($category_name));
        }
        if (!empty($price)) {
            $this->db->where('p.price <=', $price);
        }
        if (!empty($search)) {
            $this->db->like('p.name', $search);
        }

        $this->db->order_by('p.id', 'DESC');
        // Limit (optional)
        if (!empty($limit)) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get()->result();
    }


    public function countTotalProduct($category_name = null, $search = null, $price = null)
    {
        $this->db->from('products p');
        $this->db->join('category c', 'c.id = p.category', 'inner');

        // Status filter (active products)
        $this->db->where('p.status', 0);

        // Category filter
        if (!empty($category_name) && $category_name != 'all') {
            $this->db->where('c.name', $category_name);
        }

        if (!empty($price)) {
            $this->db->where('p.price <=', $price);
        }
        // Search filter
        if (!empty($search)) {
            $this->db->like('p.name', $search);
        }

        return $this->db->count_all_results();
    }

    // make featured image 
    public function makeFeatured($product_id, $image_id)
    {
        // Set all to normal
        $this->db->where('product_id', $product_id);
        $this->db->update('product_image', ['is_featured' => 1]);

        // Set selected to featured
        $this->db->where('id', $image_id);
        return $this->db->update('product_image', ['is_featured' => 0]);
    }
    // fetch only image name using product id for delete image from local
    public function getImages($id)
    {
        $this->db->select('image_name');
        $this->db->from('product_image');
        return $this->db->where('product_id', $id)->get()->result();
    }
    public function getProductById($id)
    {
        $this->db->select('
        p.id as product_id,
        p.name AS product_name,
        p.description,
        p.price,
        c.name AS category_name,
        u.short_name,
        i.image_name,
        i.alt_text
        ');
        $this->db->from('products p');
        $this->db->join('category c', 'c.id=p.category', 'inner');
        $this->db->join('product_unit u', 'u.id=p.unit_id', 'inner');
        $this->db->join('product_image i', 'i.product_id=p.id', 'inner');

        $this->db->where('i.is_featured', 0);
        $this->db->where('p.id', $id);
        return $this->db->get()->row();
    }
    public function getProductByIds($id)
    {
        $this->db->select('
        p.id as product_id,
        p.name AS product_name,
        p.description,
        p.price,
        c.name AS category_name,
        u.short_name,
        i.image_name,
        i.alt_text
        ');
        $this->db->from('products p');
        $this->db->join('category c', 'c.id=p.category', 'inner');
        $this->db->join('product_unit u', 'u.id=p.unit_id', 'inner');
        $this->db->join('product_image i', 'i.product_id=p.id', 'inner');

        $this->db->where('i.is_featured', 0);
        $this->db->where_in('p.id', $id);
        return $this->db->get()->result();
    }


    //  sum of all quantity 
    function totalProduct()
    {
        // Example using CodeIgniter / PHP
        $this->db->select_sum('quantity');
        $this->db->where('status', 0); // optional
        $this->db->where('is_available', 0); // optional
        $query = $this->db->get('products');
        $result = $query->row();
        return $total_available = $result->quantity;
    }
}
