<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of additionalmaterial
 *
 * @author user
 */
class additionalmaterial extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_modeladditionalmaterial');
    }

    function index() {
        $this->load->view('model/additionalmaterial/view');
    }

    function get() {
        $modelid = $this->input->post('modelid');
        if (empty($modelid)) {
            $modelid = 0;
        }

        $query = "select 
        modeladditionalmaterial.*,
        item.code,
        item.description materialdescription 
        from modeladditionalmaterial 
        left join item on modeladditionalmaterial.itemid=item.id";
        $query.= " where modeladditionalmaterial.modelid=$modelid order by id desc ";

        //echo $query;
        echo $this->model_modeladditionalmaterial->get($query);
    }
    
    function add(){
        $this->load->view('model/additionalmaterial/add');
    }
    function save($modelid, $id) {
        $description = $this->input->post('description');
        $itemid = (int) $this->input->post('itemid');
        $unitcode = $this->input->post('unitcode');
        $qty = (double) $this->input->post('qty');

        $data = array(
            'description' => $description,
            'modelid' => $modelid,
            'itemid' => $itemid,
            'unitcode' => $unitcode,
            'qty' => $qty
        );

        if ($id == 0) {
            if ($this->model_modeladditionalmaterial->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_modeladditionalmaterial->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_modeladditionalmaterial->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
