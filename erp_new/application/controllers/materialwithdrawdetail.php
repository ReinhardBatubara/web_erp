<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of materialwithdrawdetail
 *
 * @author hp
 */
class materialwithdrawdetail extends CI_Controller {

  //put your code here
  public function __construct() {
    parent::__construct();
    $this->load->model('model_materialwithdrawdetail');
  }

  function index() {
    $this->load->model('model_user');
    $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "materialwithdraw"));
    $this->load->view('materialwithdraw/detail/view', $data);
  }

  function get() {
    $materialwithdrawid = $this->input->post('materialwithdrawid');
    if (empty($materialwithdrawid)) {
      $materialwithdrawid = 0;
    }

    $query = "select 
                materialwithdrawdetail.*, 
                materialwithdrawdetail.itemid,
                mrp.ots_withdraw,
                item.code itemcode,
                item.description itemdescription,
                materialwithdrawdetail.unitcode,
                materialwithdrawdetail.qty
                from materialwithdrawdetail 
                join item on materialwithdrawdetail.itemid=item.id 
                left join mrp on materialwithdrawdetail.mrpid=mrp.id
                where materialwithdrawdetail.materialwithdrawid=$materialwithdrawid";

    $itemcode = $this->input->post('itemcode');
    $description = $this->input->post('description');

    if ($itemcode != "") {
      $query .= " and item.code ilike '%" . $itemcode . "%' ";
    }if ($description != "") {
      $query .= " and item.description ilike '%" . $description . "%' ";
    }
    // $query .= " order by materialwithdrawdetail.id desc";

    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";
    //echo $query;
    echo $this->model_materialwithdrawdetail->get($query);
  }

  function get_available_to_out_by_warehouse() {
    $materialwithdrawid = $this->input->post('materialwithdrawid');
    if (empty($materialwithdrawid)) {
      $materialwithdrawid = 0;
    }

    $query = "select 
            materialwithdrawdetail.*,
            item.code itemcode,
            item.description itemdescription
            from materialwithdrawdetail 
            join item on materialwithdrawdetail.itemid=item.id
            and materialwithdrawdetail.materialwithdrawid=" . $materialwithdrawid;
    if ($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') != -1) {
      $query .= " and (materialwithdrawdetail.itemid in (select itemid from itemwarehousestock where warehouseid=" . $this->session->userdata('optiongroup') . "))";
    }
    //echo $query;
    echo $this->model_materialwithdrawdetail->get_option($query);
  }

  function save($materialwithdrawid) {
    $data = array(
        "materialwithdrawid" => $materialwithdrawid,
        "itemid" => $this->input->post('itemid'),
        "unitcode" => $this->input->post('unitcode'),
        "qty" => $this->input->post('qty'),
        "qty_ots" => $this->input->post('qty')
    );

    if ($this->model_materialwithdrawdetail->insert($data)) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function update($id) {
    $data = array(
        "itemid" => $this->input->post('itemid'),
        "unitcode" => $this->input->post('unitcode'),
        "qty" => $this->input->post('qty'),
        "qty_ots" => $this->input->post('qty'),
        "mrpid" => (int) $this->input->post('mrpid')
    );

    if ($this->model_materialwithdrawdetail->update($data, array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function delete() {
    $id = $this->input->post('id');
    if ($this->model_materialwithdrawdetail->delete(array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function get_item_table_by_warehouse($id) {
    $this->load->view('materialwithdraw/detail/table_item');
  }

  function add_from_joborder($joborderid) {
    $data['joborderid'] = $joborderid;
    $this->load->view('materialwithdraw/detail/add_from_joborder', $data);
  }

  function save_from_joborder($materialwithdrawid) {
    $mrpid = $this->input->post('mrpid');
    $itemid = $this->input->post('itemid');
    $unitcode = $this->input->post('unitcode');
    $qty = $this->input->post('qty');
    $data = array();
    for ($i = 0; $i < count($mrpid); $i++) {
      if ($itemid[$i] != "") {
        $data[] = array(
            "materialwithdrawid" => $materialwithdrawid,
            "mrpid" => $mrpid[$i],
            "itemid" => $itemid[$i],
            "unitcode" => $unitcode[$i],
            "qty" => $qty[$i],
            "qty_ots" => $qty[$i]
        );
      }
    }

    if ($this->model_materialwithdrawdetail->insert_batch($data)) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function edit_from_joborder($joborderid) {
    $data['joborderid'] = $joborderid;
    $this->load->view('materialwithdraw/detail/edit_from_joborder', $data);
  }

}
