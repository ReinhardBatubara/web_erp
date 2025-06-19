<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of groups
 *
 * @author hp
 */
class groups extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_groups');
    }

    function index() {
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "groups"));
        $this->load->view('groups/view', $data);
    }

    function get() {

        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $description = $this->input->post('description');

        $query = "select * from groups where true ";

        if (!empty($code)) {
            $query .= " and codes ilike '%$code%' ";
        }if (!empty($name)) {
            $query .= " and names ilike '%$name%' ";
        }if (!empty($description)) {
            $query .= " and descriptions ilike '%$description%' ";
        }

        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (codes ilike '%$q%' or names ilike '%$q%' or descriptions ilike '%$q%') ";
        }

//        $query .= " order by $order_specification ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        if(!empty($sort) && !empty($order)){
            $query .= " order by $sort $order ";
        }else{
            $query .= " order by id desc";
        }
        

        echo $this->model_groups->get($query);
    }

    function save() {
        $code = $this->input->post('codes');
        $name = $this->input->post('names');
        $description = $this->input->post('descriptions');

        $data = array(
            "codes" => $code,
            "names" => $name,
            "descriptions" => $description
        );

        if ($this->model_groups->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $code = $this->input->post('codes');
        $name = $this->input->post('names');
        $description = $this->input->post('descriptions');

        $data = array(
            "codes" => $code,
            "names" => $name,
            "descriptions" => $description
        );

        if ($this->model_groups->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_groups->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}

?>
