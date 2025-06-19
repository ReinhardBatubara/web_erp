<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelprocess
 *
 * @author user
 */
class modelprocess extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_modelprocess');
    }

    function get_by_modelid($modelid) {

        $query = "
            select 
            modelprocess.id,
            modelprocess.modelid,
            modelprocess.processid,
            (select modelprocess_get_stock(modelprocess.modelid,modelprocess.processid)) stock,
            tracking_process.name process
            from modelprocess 
            join tracking_process on modelprocess.processid=tracking_process.id 
            where modelprocess.modelid=$modelid order by id asc
        ";
        //echo $query;
        echo $this->model_modelprocess->get($query);
    }

    function get_for_combo($modelid) {
        $query = "select 
        modelprocess.*,
        tracking_process.name process
        from modelprocess 
        join tracking_process on modelprocess.processid=tracking_process.id 
        where modelprocess.modelid=$modelid order by id asc";
        //echo $query;
        echo $this->model_modelprocess->get_for_combo($query);
    }

    function get_stock_out() {
        $query = "select 
                modelprocessstockout.*,
                to_char(modelprocessstockout.date, 'DD-MM-YYYY') date_f,
                model.code modelcode,
                model.name modelname,
                tracking_process.name processname,
                joborder.joborder_no
                from modelprocessstockout
                join model on modelprocessstockout.modelid=model.id
                join joborder on modelprocessstockout.joborderid=joborder.id
                left join tracking_process on modelprocessstockout.processid=tracking_process.id
                order by modelprocessstockout.id desc";
        echo $this->model_modelprocess->get($query);
    }

    function create_stock_out() {
        $this->load->view('model/create_stock_out');
    }

    function save_stock_out($id) {
        $data = array(
            'date' => $this->input->post('date'),
            'joborderid' => $this->input->post('joborderid'),
            'modelid' => $this->input->post('modelid'),
            'processid' => (int) $this->input->post('processid'),
            'qty' => $this->input->post('qty'),
            'remark' => $this->input->post('remark'),
        );

        if ($id == 0) {
            if ($this->model_modelprocess->insert_stock_out($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_modelprocess->update_stock_out($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete_stock_out() {
        $id = $this->input->post('id');
        if ($this->model_modelprocess->delete_stock_out(array('id' => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
