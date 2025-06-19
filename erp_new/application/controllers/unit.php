<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of unit
 *
 * @author hp
 */
class unit extends CI_Controller {

  //put your code here
  public function __construct() {
    parent::__construct();
    $this->load->model('model_unit');
  }

  function index() {
    $this->load->model('model_user');
    $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "unit"));
    $this->load->view('unit/view', $data);
  }

  function get() {
    $code = $this->input->post('code');
    $name = $this->input->post('name');
    $remark = $this->input->post('remark');

    $query = "select * from unit where true ";

    if (!empty($code)) {
      $query .= " and codes ilike '%$code%' ";
    }if (!empty($name)) {
      $query .= " and names ilike '%$name%' ";
    }if (!empty($remark)) {
      $query .= " and remark ilike '%$remark%' ";
    }

    $q = $this->input->post('q');

    if ($q) {
      $query .= " and (codes ilike '%$q%' or names ilike '%$q%' or remark ilike '%$q%')";
    }
    $order_specification = " id desc ";

//        $query .= " order by $order_specification ";

    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $order_specification ";

    echo $this->model_unit->get($query);
  }

  function save() {
    $code = $this->input->post('codes');
    $name = $this->input->post('names');
    $remark = $this->input->post('remark');

    $data = array(
        "codes" => $code,
        "names" => $name,
        "remark" => $remark
    );

    if ($this->model_unit->insert($data)) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function update($id) {
    $code = $this->input->post('codes');
    $name = $this->input->post('names');
    $remark = $this->input->post('remark');

    $data = array(
        "codes" => $code,
        "names" => $name,
        "remark" => $remark
    );

    if ($this->model_unit->update($data, array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function delete() {
    $id = $this->input->post('id');
    if ($this->model_unit->delete(array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

}

?>
