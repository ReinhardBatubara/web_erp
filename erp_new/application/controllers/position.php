<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of position
 *
 * @author hp
 */
class position extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_position');
    }

    function index() {
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "position"));
        $this->load->view('position/view', $data);
    }

    function get() {

        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $description = $this->input->post('description');

        $query = "select * from position where true ";

        if (!empty($code)) {
            $query .= " and code ilike '%$code%' ";
        }if (!empty($name)) {
            $query .= " and name ilike '%$name%' ";
        }if (!empty($description)) {
            $query .= " and description ilike '%$description%' ";
        }

//        $query .= " order by id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        
        if (!empty($sort)) {
            $query .= " order by $sort $order ";
        } else {
            $query .= " order by id desc ";
        }

        echo $this->model_position->get($query);
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

        if ($this->model_position->insert($data)) {
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

        if ($this->model_position->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_position->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}

?>
