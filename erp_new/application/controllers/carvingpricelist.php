<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of carvingpricelist
 *
 * @author user
 */
class carvingpricelist extends CI_Controller {

  //put your code here
  public function __construct() {
    parent::__construct();
    $this->load->model('model_carvingpricelist');
  }

  function index() {
    $this->load->view('carvingpricelist/view');
  }

  function get() {
    $query = "
            with t as (
                select
                carvingpricelist.*,
                employee.name name_approved_by,
                model.originalcode,
                model.code,
                model.name,
                model.itemsize_mm_w,
                model.itemsize_mm_h,
                model.itemsize_mm_d,
                model.images imagename
                from carvingpricelist
                left join model on carvingpricelist.modelid = model.id
                left join employee on carvingpricelist.approved_by=employee.id
            ) select t.* from t where true
        ";
    $itemcode = $this->input->post('itemcode');
    if (!empty($itemcode)) {
      $search_option = "%" . str_replace('|', '%|%', $itemcode) . "%";
      $query .= " and (t.code similar to '$search_option' 
                        or t.name similar to '$search_option' 
                        or t.originalcode similar to '$search_option') ";
    }

//        $query .= " order by t.id desc ";
    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";

    echo $this->model_carvingpricelist->get($query);
  }

  function add() {
    $this->load->view('carvingpricelist/add');
  }

  function save($id) {

    $data = array(
        "price" => (double) $this->input->post('price'),
        "modelid" => $this->input->post('modelid'),
        "date_approve" => $this->input->post('date_approve'),
        "approved_by" => $this->input->post('approved_by'),
        "remark" => $this->input->post('remark')
    );

    if ($id == 0) {
      if ($this->model_carvingpricelist->insert($data)) {
        echo json_encode(array('success' => true));
      }
      else {
        echo json_encode(array('msg' => $this->db->_error_message()));
      }
    }
    else {
      if ($this->model_carvingpricelist->update($data, array("id" => $id))) {
        echo json_encode(array('success' => true));
      }
      else {
        echo json_encode(array('msg' => $this->db->_error_message()));
      }
    }
  }

  function delete() {
    $id = $this->input->post('id');
    if ($this->model_carvingpricelist->delete(array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

}

?>
