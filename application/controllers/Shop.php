<?php
class Shop extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('common');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->library('pagination');
    }

    public function index()
    {
        $config = [];
        $config['base_url'] = base_url("Shop/index/");
        $config['total_rows'] = $this->product_model->totalProducts();
        $config['per_page'] = 9;
        $config['uri_segments'] = 3;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        if ($this->input->is_ajax_request()) {
            $category_name = $this->input->post('category_name');
            $search = $this->input->post('search');
            $price = $this->input->post('price');
            $offset =  $this->input->post('offset') ?? 0;

            $config['total_rows'] = $this->product_model->countTotalProduct($category_name, $search, $price);
            $this->pagination->initialize($config);

            $products = $this->product_model->getShopProducts($config['per_page'], $offset, $category_name, $search, $price);

            $html = $this->load->view('ajax_products', ['shopProducts' => $products, 'category_name' => $category_name], TRUE);

            echo json_encode([
                'html' => $html,
                'pagination' => $this->pagination->create_links()
            ]);
            return;
        }
        $data['products'] = $this->product_model->getShopProducts($config['per_page'], $offset);
        $data['total_product'] = $this->product_model->totalProducts();
        $data['category'] = $this->category_model->getAllCategoryWithProductCount();
        $data['pagination'] = $this->pagination->create_links();
         $data['search'] = $this->input->post('home_search');
        load_views('shop', $data);
    }
}
