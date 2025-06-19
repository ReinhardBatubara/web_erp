<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of materialwithdraw
 *
 * @author hp
 */
class materialwithdraw extends CI_Controller {

  var $option_view;

  //put your code here
  public function __construct() {
    parent::__construct();
    $this->load->model('model_materialwithdraw');
    $this->load->model('model_menuaccess');
    $this->option_view = $this->model_menuaccess->get_option_view($this->session->userdata('id'), 'materialwithdraw');
  }

  function index() {
    $this->load->model('model_user');
    $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "materialwithdraw"));
    $this->load->model('model_department');
    $data['department'] = $this->model_department->selectAllResult();
    $this->load->view("materialwithdraw/view", $data);
  }

  function get() {

    $query = "
            with mw as (
                select 
                mw.*,
                joborder.joborder_no,
                (department.code || ': ' || department.name) department,
                employee.name employeerequest from 
                materialwithdraw mw
                left join department on mw.departmentid=department.id 
                left join employee on mw.requestedby=employee.id 
                left join joborder on mw.joborderid=joborder.id
            ) select mw.* from mw where true 
        ";

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');
    $number = $this->input->post('number');
    $departmentid = $this->input->post('departmentid');
    $jonumber = $this->input->post('jonumber');

    if (!empty($jonumber)) {
      $query .= " and mw.joborder_no ilike '%" . $jonumber . "%'";
    }
    if ($datefrom != "" && $dateto != "") {
      $query .= " and mw.date between '" . $datefrom . "' and '" . $dateto . "'";
    }if ($datefrom != "" && $dateto == "") {
      $query .= " and mw.date = '" . $datefrom . "'";
    }if ($datefrom == "" && $dateto != "") {
      $query .= " and mw.date = '" . $dateto . "'";
    }if ($number != "") {
      $query .= " and mw.number ilike '%" . $number . "%'";
    }if ($departmentid != "") {
      $query .= " and mw.departmentid = " . $departmentid;
    }


    if ($this->session->userdata('id') != 'admin') {
      if ($this->option_view == 0) {
        $query .= " and mw.requestedby='" . $this->session->userdata('id') . "' "; //Filter by request
      }
      else if ($this->option_view == 2) {
        $query .= " and mw.departmentid=" . $this->session->userdata('department');
      }
      else if ($this->option_view == 1) {
        //View All
      }
    }
    $sort = $this->input->post('sort');
    $order = $this->input->post('order');

    $query .= " order by mw.$sort $order ";
    //echo $query . "<hr>";
    echo $this->model_materialwithdraw->get($query);
  }

  function get_available_warehouse() {
    $query = "with t as (
                    select 
                    materialwithdraw.*,
                    department.name department,
                    employee.name employeerequest,
                    (select sum(qty_ots) from materialwithdrawdetail 
                    where materialwithdrawid=materialwithdraw.id) ots
                    from materialwithdraw 
                    join department on materialwithdraw.departmentid=department.id
                    join employee on materialwithdraw.requestedby=employee.id 
                    where materialwithdraw.submited=TRUE
                ) select * from t where ots > 0";

    $q = $this->input->post('q');

    if (!empty($q)) {
      $query .= " and t.number ilike '%" . $q . "%'";
    }
    //echo $query;
    $p_page = $this->input->post('page');
    if (!empty($p_page)) {
      echo $this->model_materialwithdraw->get($query);
    }
    else {
      echo $this->model_materialwithdraw->get_available_warehouse($query);
    }
  }

  function get_list_to_out() {
    $query = "select 
            distinct materialwithdrawdetail.materialwithdrawid id,
            materialwithdraw.date,
            materialwithdraw.number,
            materialwithdraw.departmentid,
            materialwithdraw.requestedby,
            materialwithdraw.submited,
            department.name department,
            employee.name employeerequest,
            materialwithdraw.must_receive_at,
            materialwithdraw.remark
            from 
            materialwithdrawdetail 
            join item on materialwithdrawdetail.itemid=item.id
            join materialwithdraw on materialwithdrawdetail.materialwithdrawid=materialwithdraw.id
            join employee on materialwithdraw.requestedby=employee.id
            join department on materialwithdraw.departmentid=department.id
            left join itemwarehousestock on materialwithdrawdetail.itemid=itemwarehousestock.itemid
            where materialwithdrawdetail.qty_ots > 0";
    if ($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') != -1) {
      $query .= " and itemwarehousestock.warehouseid=" . $this->session->userdata('optiongroup');
    }
    //echo $query;
    echo $this->model_materialwithdraw->get($query);
  }

  function save() {

    $data = array(
        "date" => $this->input->post('date'),
        "must_receive_at" => $this->input->post('must_receive_at'),
        "remark" => $this->input->post('remark'),
        "joborderid" => (int) $this->input->post('joborderid'),
        "departmentid" => $this->session->userdata('department'), //Change with department session
        "requestedby" => $this->session->userdata('id') //Change with session id
    );

    if ($this->model_materialwithdraw->insert($data)) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function update($id) {
    $data = array(
        "date" => $this->input->post('date'),
        "must_receive_at" => $this->input->post('must_receive_at'),
        "joborderid" => (int) $this->input->post('joborderid'),
        "remark" => $this->input->post('remark'),
    );

    if ($this->model_materialwithdraw->update($data, array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function delete() {
    $id = $this->input->post('id');
    if ($this->model_materialwithdraw->delete(array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function submit() {
    $id = $this->input->post('id');
    $data = array(
        "submited" => 'TRUE'
    );
    if ($this->model_materialwithdraw->update($data, array("id" => $id))) {
      echo json_encode(array('success' => true));
    }
    else {
      echo json_encode(array('msg' => $this->db->_error_message()));
    }
  }

  function dialog_item_search_from_jo($joborderid) {
    $data['joborderid'] = $joborderid;
    $this->load->view('materialwithdraw/add_from_joborder', $data);
  }

}
