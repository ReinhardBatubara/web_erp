<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of process
 *
 * @author user
 */
class process extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_modelprocess');
    }

    function index() {
        $this->load->view('model/process/view');
    }

    function get() {
        $query = "select 
                modelprocess.*,
                tracking_process.name process
                from modelprocess 
                join tracking_process on modelprocess.processid=tracking_process.id where true ";
        $modelid = $this->input->post('modelid');
        if (empty($modelid)) {
            $modelid = 0;
        }
        $query .= " and modelprocess.modelid=$modelid order by modelprocess.processid asc";

        //echo $query;
        echo $this->model_modelprocess->get($query);
    }

    function save($modelid, $id) {
        $processid = $this->input->post('processid');
//        $materialgroupid = $this->input->post('materialgroupid');
        $stock = (int) $this->input->post('stock');
//        $arrmaterialgroupid = "{" . implode(',', $materialgroupid) . "}";

        $data = array(
            "modelid" => $modelid,
            "processid" => $processid,
            "stock" => $stock,
//            "materialgroupid" => $arrmaterialgroupid
        );

        if ($id == 0) {
            if ($this->model_modelprocess->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_modelprocess->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_modelprocess->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
