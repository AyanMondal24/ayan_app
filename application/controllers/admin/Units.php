<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Units extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('unit_model');
        $this->load->helper('common');
        $this->load->library('encryption');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function add($enc_id = null)
    {
        if (!empty($enc_id)) {
            $id = $this->encryption->decrypt(base64_decode(urldecode($enc_id)));

            $data['unit'] = $this->unit_model->getSingleDataById($id);
            // print_r($data['unit']);
            // die();
            $data['title'] = "Update Units";
            load_admin_views('add_unit', $data);
        } else {
            $data['title'] = "Adding Units";
            load_admin_views('add_unit', $data);
        }
    }
    public function store()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('short_name', 'Short Name', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $errors = [];
            $fields = ['name', 'short_name', 'status'];
            foreach ($fields as $field) {
                $error_msg = form_error($field);
                if (!empty($error_msg)) {
                    $errors[$field] = $error_msg;
                }
            }
            echo json_encode(["status" => "error", "errors" => $errors, "message" => 'Required All Field.']);
            return;
        }

        $data = [
            "name" => $this->input->post('name'),
            "short_name" => $this->input->post('short_name'),
            "status" => $this->input->post('status')
        ];

        if (empty($this->input->post('id'))) {
            // if id null its means comming data for add  
            $setData = $this->unit_model->setData($data);
            if ($setData) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data Submitted.'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Data Not Submitted.'
                ]);
            }
        } else {
            // update 
            $id = $this->input->post('id');
            $updateData = $this->unit_model->updateData($data, $id);
            if ($updateData) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data Updated.'
                ]);
                // return;
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Data Not Updated.'
                ]);
            }
        }
    }

    function index()
    {
        $data['units'] = $this->unit_model->getUnits();
        load_admin_views('view_unit', $data);
    }
    function delete($enc_id)
    {
        $id = $this->encryption->decrypt(base64_decode(urldecode($enc_id)));

        $delete = $this->unit_model->deleteData($id);
        // var_dump($delete);
        // die();
        if ($delete) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Data Deleted.'
            ]);
         
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Data Not Deleted.'
            ]);
        }
    }
}
