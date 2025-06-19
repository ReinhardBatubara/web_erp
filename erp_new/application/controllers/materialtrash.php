<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of materialtrash
 *
 * @author user
 */
class materialtrash extends CI_Controller {

  //put your code here
  public function __construct() {
    parent::__construct();
    $this->load->model('model_materialtrash');
  }

  function index() {
    $this->load->view('materialtrash/view');
  }

  function get() {
    $query = "select 
                materialtrash.*,
                item.code,
                item.description materialdescription,
                to_char(materialtrash.date,'DD-MM-YYYY') date_f,
                (case when item.category = 1 then 'Local' when item.category = 2 then 'Import' when item.category = 3 then 'Mix' end) category_f
                from materialtrash join item
                on materialtrash.itemid=item.id 
                where true ";
    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');
    $itemcode = $this->input->post('itemcode');
    $itemname = $this->input->post('itemname');
    $category = $this->input->post('category');

    if ($datefrom != "" && $dateto != "") {
      $query .= " and materialtrash.date between '" . $datefrom . "' and '" . $dateto . "'";
    }if ($datefrom != "" && $dateto == "") {
      $query .= " and materialtrash.date = '" . $datefrom . "'";
    }if ($datefrom == "" && $dateto != "") {
      $query .= " and materialtrash.date = '" . $dateto . "'";
    }if (!empty($itemcode)) {
      $query .= " and item.code ilike '%$itemcode%' ";
    }if (!empty($itemname)) {
      $query .= " and item.description ilike '%$itemname%' ";
    }if (!empty($category)) {
      $query .= " and (item.category=$category)";
    }
        $query .=" order by materialtrash.id desc ";
    //echo $query;

//    $sort = $this->input->post('sort');
//    $order = $this->input->post('order');
//    $query .= " order by $sort $order ";
    echo $this->model_materialtrash->get($query);
  }

  function save($id) {
    $data = array(
        "date" => $this->input->post('date'),
        "itemid" => $this->input->post('itemid'),
        "unitcode" => $this->input->post('unitcode'),
        "qty" => $this->input->post('qty'),
        "remark" => $this->input->post('remark')
    );

    if ($id == 0) {
      if ($this->model_materialtrash->insert($data)) {
        echo json_encode(array('success' => true));
      }
      else {
        echo json_encode(array('msg' => $this->db->_error_message()));
      }
    }
    else {
      if ($this->model_materialtrash->update($data, array("id" => $id))) {
        echo json_encode(array('success' => true));
      }
      else {
        echo json_encode(array('msg' => $this->db->_error_message()));
      }
    }
  }

  function delete() {
    $id = $this->input->post('id');
    if ($this->model_materialtrash->delete(array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

}

?>
