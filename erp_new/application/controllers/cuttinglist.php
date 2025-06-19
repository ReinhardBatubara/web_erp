<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cuttinglist
 *
 * @author user
 */
class cuttinglist extends CI_Controller {

  //put your code here
  public function __construct() {
    parent::__construct();
    $this->load->model('model_cuttinglist');
  }

  function index() {
    $this->load->view('cuttinglist/view');
  }

  function get() {
    $query = "
            with t as (
                select 
                cuttinglist.*,
                joborder.joborder_no,
                model.code item_code,
                model.name item_name
                from cuttinglist 
                join joborder on cuttinglist.joborderid=joborder.id
                join model on cuttinglist.modelid=model.id
            ) select t.* from t where true 
            
        ";

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');
    if ($datefrom != "" && $dateto != "") {
      $query .= " and t.date between '" . $datefrom . "' and '" . $dateto . "'";
    }if ($datefrom != "" && $dateto == "") {
      $query .= " and t.date = '" . $datefrom . "'";
    }if ($datefrom == "" && $dateto != "") {
      $query .= " and t.date = '" . $dateto . "'";
    }
    $jo_number = $this->input->post('jo_number');
    if (!empty($jo_number)) {
      $query .= " and t.joborder_no ilike '%" . $number . "%'";
    }
    $item_code_name = $this->input->post('item_code_name');
    if (!empty($item_code_name)) {
      $query .= " and (t.item_code ilike '%" . $item_code_name . "%' or t.item_name ilike '%" . $item_code_name . "%')";
    }
    $woodcategory = $this->input->post('woodcategory');
    if (!empty($woodcategory)) {
      $query .= " and t.woodcategory='" . $woodcategory . "'";
    }
    //$query .= " order by t.id desc ";

    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";
    echo $this->model_cuttinglist->get($query);
  }

  function get_woodcategory() {
    $query = "
            select distinct woodcategory from cuttinglist
        ";
    echo $this->model_cuttinglist->get($query);
  }

  function add() {
    $this->load->view('cuttinglist/add');
  }

  function save($id) {
    $qty = $this->input->post('qty');
    $final_size = $this->input->post('final_size');
    $raw_size = $this->input->post('raw_size');
    $total_final_size = $final_size * $qty;
    $total_raw_size = $raw_size * $qty;

    $data = array(
        'date' => $this->input->post('date'),
        'joborderid' => $this->input->post('joborderid'),
        'modelid' => $this->input->post('modelid'),
        'qty' => $qty,
        'woodcategory' => $this->input->post('woodcategory'),
        'final_size' => $final_size,
        'raw_size' => $raw_size,
        'total_final_size' => $total_final_size,
        'total_raw_size' => $total_raw_size
    );

    if ($id == 0) {
      if ($this->model_cuttinglist->insert($data)) {
        echo json_encode(array('success' => true));
      }
      else {
        echo json_encode(array('msg' => $this->db->_error_message()));
      }
    }
    else {
      if ($this->model_cuttinglist->update($data, array("id" => $id))) {
        echo json_encode(array('success' => true));
      }
      else {
        echo json_encode(array('msg' => $this->db->_error_message()));
      }
    }
  }

  function delete() {
    $id = $this->input->post('id');
    if ($this->model_cuttinglist->delete(array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

}

?>
