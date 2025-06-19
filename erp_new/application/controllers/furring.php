<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of furring
 *
 * @author hp
 */
class furring extends CI_Controller {

  //put your code here
  public function __construct() {
    parent::__construct();
    $this->load->model('model_furring');
  }

  function index() {
    $this->load->model('model_user');
    $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "furring"));
    $this->load->view('furring/view', $data);
  }

  function get() {
    $page = $this->input->post('page');
    $rows = $this->input->post('rows');

    $code = $this->input->post('code');
    $description = $this->input->post('description');

    $query = "select * from furring where true ";

    if (!empty($code)) {
      $query .= " and code ilike '%$code%' ";
    }if (!empty($description)) {
      $query .= " and description ilike '%$description%' ";
    }

    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";
    //echo $query;
    echo $this->model_furring->get($page, $rows, $query);
  }

  function get_remote_data() {
    $q = $this->input->post('q');
    $query = "select * from furring where true ";
    if (!empty($q)) {
      $query .= " and code ilike '%$q%' or description ilike '%$q%'";
    }
    echo $this->model_furring->get_remote_data($query);
  }

  function save() {
    $code = $this->input->post('code');
    $description = $this->input->post('description');

    $data = array(
        "code" => $code,
        "description" => $description
    );

    if ($this->model_furring->insert($data)) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function update($code) {
    $newcode = $this->input->post('code');
    $description = $this->input->post('description');

    $data = array(
        "code" => $newcode,
        "description" => $description
    );

    if ($this->model_furring->update($data, array("code" => $code))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function delete() {
    $code = $this->input->post('code');
    if ($this->model_furring->delete(array("code" => $code))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

}
