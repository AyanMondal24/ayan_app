<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller{
    function __construct()
    {
         parent::__construct();
         $this->load->model('category_model');
         $this->load->model('product_model');

    }
    public function index($product_slug, $category_slug)
    {
        // 1. Get category by slug
        $category = $this->category_model->getBySlug($category_slug);
        if (!$category) show_404();

        // 2. Get product by slug + category_id
        $product = $this->product_model->getBySlug($product_slug, $category->id);
        if (!$product) show_404();

        $data=$this->product_model->singleView($product->product_id);

        $data['products'] = $this->product_model->getProductBasedOnCategory($category->id,$product->product_id);

        load_views('product_view',$data);

    }
}
