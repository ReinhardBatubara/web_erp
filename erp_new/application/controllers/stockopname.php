<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class stockopname extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('stockopname/index');
    }

    function header() {
        $this->load->view('stockopname/header');
    }

    function get() {
        $this->load->model('model_stockopname');
        echo $this->model_stockopname->get();
    }

    function input() {
        $this->load->view('stockopname/input');
    }

    function save($id) {
        $this->load->model('model_stockopname');
        $data = array(
            "date" => $this->input->post('date'),
            "warehouseid" => $this->input->post('warehouseid'),
            "description" => $this->input->post('description')
        );

        if ($id == 0) {
            $data['user_inserted'] = $this->session->userdata('id');
            if ($this->model_stockopname->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            $data['user_updated'] = $this->session->userdata('id');
            $data['time_updated'] = "now()";
            if ($this->model_stockopname->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $this->load->model('model_stockopname');
        if ($this->model_stockopname->delete(array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function posting() {
        $this->load->model('model_stockopname');
        if ($this->model_stockopname->posting($this->input->post("id"))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function prints() {
        $this->load->model('model_stockopname');
        $this->load->model('model_company');
        $data['stockopname'] = $this->model_stockopname->get("result");
        $data['stockopname_detail'] = $this->model_stockopname->detail_get("result");
        $data['company'] = $this->model_company->select();
        $this->load->view('stockopname/print', $data);
    }

    function detail() {
        $this->load->view('stockopname/detail');
    }

    function detail_get() {
        $this->load->model('model_stockopname');
        echo $this->model_stockopname->detail_get();
    }

    function detail_input($warehouseid) {
        $this->load->view('stockopname/detail_input', array("warehouseid" => $warehouseid));
    }

    function detail_save($id, $stockopnameid) {
        $this->load->model('model_stockopname');
        $data = array(
            "itemid" => $this->input->post("itemid"),
            "unitcode" => $this->input->post("unitcode"),
            "stock" => $this->input->post("stock"),
            "real_stock" => $this->input->post("real_stock"),
            "difference" => $this->input->post("difference")
        );

        if ($id == 0) {
            $data["stockopnameid"] = $stockopnameid;
            $data['user_inserted'] = $this->session->userdata('id');
            if ($this->model_stockopname->detail_insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            $data['user_updated'] = $this->session->userdata('id');
            $data['time_updated'] = "now()";
            if ($this->model_stockopname->detail_update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function detail_delete() {
        $this->load->model('model_stockopname');
        if ($this->model_stockopname->detail_delete(array("id" => $this->input->post("id")))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
