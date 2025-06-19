<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of subsection
 *
 * @author hp
 */
class subsection extends CI_Controller {

  //put your code here
  public function __construct() {
    parent::__construct();
    $this->load->model('model_subsection');
  }

  function index() {
    $this->load->model('model_user');
    $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "subsection"));
    $this->load->view('subsection/view', $data);
  }

  function get() {

    $code = $this->input->post('code');
    $name = $this->input->post('name');
    $description = $this->input->post('description');

    $query = "select * from subsection where true ";

    if (!empty($code)) {
      $query .= " and code ilike '%$code%' ";
    }if (!empty($name)) {
      $query .= " and name ilike '%$name%' ";
    }if (!empty($description)) {
      $query .= " and description ilike '%$description%' ";
    }

    $order_specification = " id desc ";
//        $query .= " order by $order_specification ";
    $sort = $this->input->post('sort');
    $order = $this->input->post('order') == "" ? " id" : $this->input->post('order');
    $query .= " order by $sort $order ";
    //echo $query;
    echo $this->model_subsection->get($query);
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

    if ($this->model_subsection->insert($data)) {
      echo json_encode(array('success' => true));
    }
    else {
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

    if ($this->model_subsection->update($data, array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function delete() {
    $id = $this->input->post('id');
    if ($this->model_subsection->delete(array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

}

?>
