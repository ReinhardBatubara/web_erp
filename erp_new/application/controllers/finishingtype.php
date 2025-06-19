<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of finishingtype
 *
 * @author user
 */
class finishingtype extends CI_Controller {

  //put your code here
  public function __construct() {
    parent::__construct();
    $this->load->model('model_finishingtype');
  }

  function index() {
    $this->load->model('model_user');
    $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "finishingtype"));
    $this->load->view('finishingtype/view', $data);
  }

  function get() {

    $query = "
            with t as 
            (
                select 
                finishingtype.*,
                (case 
                        when finishingtype.positionid=1 then 'SEEN FACE AREA'
                        when finishingtype.positionid=2 then 'TOP AREA'
                        when finishingtype.positionid=3 then 'UN-SEEN FACE'
                end) position_name
                from finishingtype
            ) select * from t where true
        ";

    $name = $this->input->post('name');
    if (!empty($name)) {
      $query .=" and t.name ilike '%$name%'";
    }
    $positionid = $this->input->post('positionid');
    if (!empty($positionid)) {
      $query .= " and t.positionid=$positionid";
    }
//        $query .= " order by t.id desc ";

    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";
    //echo $query;
    echo $this->model_finishingtype->get($query);
  }

  function get_by_position($positionid) {
    $query = "
            with t as 
            (
                select 
                finishingtype.*,
                (case 
                        when finishingtype.positionid=1 then 'SEEN FACE AREA'
                        when finishingtype.positionid=2 then 'TOP AREA'
                        when finishingtype.positionid=3 then 'UN-SEEN FACE'
                end) position_name
                from finishingtype
            ) select t.* from t where t.positionid=$positionid order by t.id desc
        ";
    //echo $query;
    echo $this->model_finishingtype->get($query);
  }

  function get_by_position2($positionid) {
    $query = "
            select
        finishingtype.id finishingtypeid,
        finishingtype.name finishingtypename
        from finishingtype where positionid = $positionid order by finishingtype.name asc
        ";
    //echo $query;
    echo $this->model_finishingtype->get($query);
  }

  function save() {
    $name = $this->input->post('name');
    $positionid = $this->input->post('positionid');
    $remark = $this->input->post('remark');

    $data = array(
        "name" => $name,
        "positionid" => $positionid,
        "remark" => $remark
    );

    if ($this->model_finishingtype->insert($data)) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function update($id) {
    $name = $this->input->post('name');
    $positionid = $this->input->post('positionid');
    $remark = $this->input->post('remark');

    $data = array(
        "name" => $name,
        "positionid" => $positionid,
        "remark" => $remark
    );

    if ($this->model_finishingtype->update($data, array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function delete() {
    $id = $this->input->post('id');
    if ($this->model_finishingtype->delete(array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function material_get() {
    $finishingtypeid = $this->input->post('finishingtypeid');

    if (empty($finishingtypeid)) {
      $finishingtypeid = 0;
    }
    $query = "
            with t as(
                select 
                finishingtypematerial.*,
                item.code itemcode,
                item.description itemdescription
                from finishingtypematerial 
                join item on finishingtypematerial.itemid=item.id
                where finishingtypematerial.finishingtypeid = $finishingtypeid
            ) select t.* from t where true
        ";

    $itemcode = $this->input->post('itemcode');
    if (!empty($itemcode)) {
      $query .=" and t.itemcode ilike '%$itemcode%'";
    }
    $itemdescription = $this->input->post('itemdescription');
    if (!empty($itemdescription)) {
      $query .=" and t.itemdescription ilike '%$itemdescription%'";
    }

    //  $query .= " order by t.id desc ";

    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";
    echo $this->model_finishingtype->get($query);
  }

  function material_add() {
    $this->load->view('finishingtype/add_material');
  }

  function material_save($finishingtypeid) {
    $itemid = $this->input->post('itemid');
    $unitcode = $this->input->post('unitcode');
    $qty = $this->input->post('qty');
    $remark = $this->input->post('remark');

    $data = array(
        "finishingtypeid" => $finishingtypeid,
        "itemid" => $itemid,
        "unitcode" => $unitcode,
        "qty" => $qty,
        "remark" => $remark
    );

    if ($this->model_finishingtype->material_insert($data)) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function material_update($id) {
    $itemid = $this->input->post('itemid');
    $unitcode = $this->input->post('unitcode');
    $qty = $this->input->post('qty');
    $remark = $this->input->post('remark');

    $data = array(
        "itemid" => $itemid,
        "unitcode" => $unitcode,
        "qty" => $qty,
        "remark" => $remark
    );

    if ($this->model_finishingtype->material_update($data, array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function material_delete() {
    $id = $this->input->post('id');
    if ($this->model_finishingtype->material_delete(array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

}

?>
