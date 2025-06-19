<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of carver
 *
 * @author user
 */
class carver extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_carver');
    }

    function index() {
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "carver"));
        $this->load->view('carver/index', $data);
    }

    function get() {

        $name = $this->input->post('name');

        $query = "select * from carver where true ";

        if (!empty($name)) {
            $query .= " and name ilike '%$name%' ";
        }

        $order_specification = " id desc ";
        $query .= " order by $order_specification ";

        echo $this->model_carver->get($query);
    }

    function save() {

        $name = $this->input->post('name');
        $remark = $this->input->post('remark');

        $data = array(
            "name" => $name,
            "remark" => $remark
        );

        if ($this->model_carver->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $name = $this->input->post('name');
        $remark = $this->input->post('remark');

        $data = array(
            "name" => $name,
            "remark" => $remark
        );

        if ($this->model_carver->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_carver->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
