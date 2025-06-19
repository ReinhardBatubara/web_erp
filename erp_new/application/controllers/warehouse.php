<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of warehouse
 *
 * @author hp
 */
class warehouse extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_warehouse');
    }

    function index() {
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "warehouse"));
        $this->load->view('warehouse/view', $data);
    }

    function get() {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $description = $this->input->post('description');

        $query = "select * from warehouse where true ";

        if (!empty($code)) {
            $query .= " and code ilike '%$code%' ";
        }if (!empty($name)) {
            $query .= " and name ilike '%$name%' ";
        }if (!empty($description)) {
            $query .= " and description ilike '%$description%' ";
        }


        $order_specification = " id desc ";

        $query .= " order by $order_specification ";

        echo $this->model_warehouse->get($query);
    }

    function get_filter($warehouseid) {
        $query = "select * from warehouse where id !=$warehouseid";
        echo $this->model_warehouse->get($query);
    }

    function save() {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $description = $this->input->post('description');

        $data = array(
            "code" => $code,
            "name" => $name,
            "description" => $description
        );

        if ($this->model_warehouse->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $description = $this->input->post('description');

        $data = array(
            "code" => $code,
            "name" => $name,
            "description" => $description
        );

        if ($this->model_warehouse->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_warehouse->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}

?>
