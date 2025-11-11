<?php
class category_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    // product add form dropdown 
    function getAllCategory()
    {
        $this->db->select('name, MIN(id) as id');
        $this->db->from('category');
        $this->db->group_by('name');
        return $this->db->get()->result();
    }
    // insert new category 
    function setCategory($data)
    {
        return $this->db->insert('category', $data);
    }

    // category view 
    function getCategory($limit,$offset)
    {
        $this->db->select('id,name,image');
        $this->db->from('category');
        $this->db->limit($limit,$offset);
        $this->db->order_by('id','ASE');
        return $this->db->get()->result();
    }

    // for pagination get total data 
    function getTotalCategory(){
        return $this->db->count_all('category');
    }
    
    function getSingleCategory($id){
        $this->db->where('id',$id);
        return $this->db->get('category')->row();
    }

     //update query
    public function updateCategory($id,$data){
        $this->db->where('id',$id);
        return $this->db->update('category',$data);
    }
}
