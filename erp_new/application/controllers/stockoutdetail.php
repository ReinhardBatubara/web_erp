<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class stockoutdetail extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('model_stockoutdetail');
  }

  function index() {
    $this->load->view('stockout/detail/view');
  }

  function search_dialog() {
    $this->load->view('stockout/detail/search');
  }

  function get() {
    $query = "
            with t as (
                select 
                stockoutdetail.id,
                stockoutdetail.stockoutid,
                stockoutdetail.materialwithdrawdetailid,
                stockoutdetail.qty,
                stockoutdetail.warehouseid,
                stockoutdetail.mrpid,
                stockoutdetail.remark,
                (case when stockoutdetail.itemid != 0 then stockoutdetail.itemid else materialwithdrawdetail.itemid end) itemid,
                (case when stockoutdetail.itemid != 0 then stockoutdetail.unitcode else materialwithdrawdetail.unitcode end) unitcode
                from
                stockoutdetail
                left join materialwithdrawdetail on stockoutdetail.materialwithdrawdetailid=materialwithdrawdetail.id
                left join item on materialwithdrawdetail.itemid=item.id where true 
            ) select t.*,item.code itemcode,item.description itemdescription from t 
            left join item on t.itemid=item.id where true 
  ";
    $stockoutid = $this->input->post('stockoutid');
    $code = $this->input->post('code');
    $description = $this->input->post('description');

    if (empty($stockoutid)) {
      $stockoutid = 0;
    }
    if (!empty($code)) {
      $query .= " and t.itemcode ilike '%" . $code . "%' ";
    }if (!empty($description)) {
      $query .= " and t.itemdescription ilike '%" . $description . "%' ";
    }

    $query .= " and t.stockoutid=$stockoutid";
//        $query .= " order by t.id asc";      
    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";
    //echo $query;
    echo $this->model_stockoutdetail->get($query);
  }

  function update($id) {
    $data = array(
        "qty" => $this->input->post('qty'),
        "remark" => $this->input->post('remark')
    );
    if ($this->model_stockoutdetail->update($data, array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function delete() {
    if ($this->model_stockoutdetail->delete(array("id" => $this->input->post('id')))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

}
