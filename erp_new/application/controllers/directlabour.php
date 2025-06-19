<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of directlabour
 *
 * @author hp
 */
class directlabour extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_directlabour');
    }

    function index() {
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "directlabour"));
        $this->load->view('directlabour/view', $data);
    }

    function get() {

        $unit = $this->input->post('unit');
        $curr = $this->input->post('curr');
        $description = $this->input->post('description');

        $query = "select * from directlabour where true ";

        if (!empty($unit)) {
            $query .= " and  unit ilike '%$code%' ";
        }if (!empty($curr)) {
            $query .= " and curr ilike '%$name%' ";
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

        echo $this->model_directlabour->get($query);
    }

    function save() {

        $unit = $this->input->post('unit');
        $curr = $this->input->post('curr');
        $description = $this->input->post('description');
        $price = (double)$this->input->post('price');
        $percentage = (double)$this->input->post('percentage');

        $data = array(
            "unit" => $unit,
            "curr" => $curr,
            "price" => $price,
            "percentage" => $percentage,
            "description" => $description
        );

        if ($this->model_directlabour->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $unit = $this->input->post('unit');
        $curr = $this->input->post('curr');
        $description = $this->input->post('description');
        $price = (double)$this->input->post('price');
        $percentage = (double)$this->input->post('percentage');

        $data = array(
            "unit" => $unit,
            "curr" => $curr,
            "price" => $price,
            "percentage" => $percentage,
            "description" => $description
        );

        if ($this->model_directlabour->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_directlabour->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}

?>
