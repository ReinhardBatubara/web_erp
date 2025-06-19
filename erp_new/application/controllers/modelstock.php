<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelstock
 *
 * @author user
 */
class modelstock extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_model');
    }

    function index() {
        $this->load->view('model/view_stock_new');
    }

    function model_stock() {
        $this->load->view('model/model_stock');
    }

    function get_model_stock() {
        $query = "select 
                model.*,
                model.id modelid,
                modelcategory.description modelcategory,
                finishing.description finishing,
                material.description material,
                top.description top,
                mirrorglass.description mirrorglass,
                foam.description foam,
                interliner.description interliner,
                fabric.description fabric,
                furring.description furring,
                accessories.description accessories
                from model
                join modelcategory on model.modelcategorycode=modelcategory.code
                left join finishing on model.finishingcode=finishing.code
                left join material on model.materialcode=material.code
                left join top on model.topcode=top.code
                left join mirrorglass on model.mirrorglasscode=mirrorglass.code
                left join foam on model.foamcode=foam.code
                left join interliner on model.interlinercode=interliner.code
                left join fabric on model.fabriccode=fabric.code
                left join furring on model.furringcode=furring.code
                left join accessories on model.accessoriescode=accessories.code 
                where true";

        $modelcode = $this->input->post('modelcode');
        if (!empty($modelcode)) {
            $query .= " and model.code ilike '%" . trim($modelcode) . "%'";
        }

        $modelname = $this->input->post('modelname');
        if (!empty($modelname)) {
            $query .= " and model.name ilike '%" . $modelname . "%'";
        }

        $modelcategorycode = $this->input->post('modelcategorycode');
        if (!empty($modelcategorycode)) {
            $query .= " and model.modelcategorycode='" . $modelcategorycode . "'";
        }

        // $query .= " order by model.id desc";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        //echo $query;
        echo $this->model_model->get($query);
    }

    function process_stock() {
        $this->load->view('model/process_stock');
    }

    function get_process_stock() {
        $query = "select 
                modelprocess.*,
                model.originalcode modelcode,
                tracking_process.name processname
                from modelprocess 
                join model on modelprocess.modelid=model.id
                join tracking_process on modelprocess.processid=tracking_process.id
                where true ";
        $modelid = $this->input->post('modelid');
        if (!empty($modelid)) {
            $query .= " and modelprocess.modelid=" . $modelid;
        }

        $modelcode = $this->input->post('modelcode');
        if (!empty($modelcode)) {
            $query .= " and model.code ilike '%" . trim($modelcode) . "%'";
        }
        $processid = $this->input->post('processid');
        if (!empty($processid)) {
            $query .= " and modelprocess.processid=" . $processid;
        }

        $query .= " order by modelprocess.id asc";
        //echo $query;
        echo $this->model_model->get($query);
    }

    function update_model_stock($modelid) {
        $data = array(
            "stock" => $this->input->post('stock')
        );
        if ($this->model_model->update($data, array("id" => $modelid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update_model_process_stock($processid) {

        $this->load->model('model_modelprocess');

        $data = array(
            "stock" => $this->input->post('stock')
        );
        if ($this->model_modelprocess->update($data, array("id" => $processid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function stock_out() {
        $this->load->view('model/stock_out');
    }

}

?>
