<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of materialrequisition
 *
 * @author hp
 */
class materialrequisition extends CI_Controller {

//put your code here
    var $option_view;

    public function __construct() {
        parent::__construct();
        $this->load->model('model_menuaccess');
        $this->load->model('model_materialrequisition');
        $this->option_view = $this->model_menuaccess->get_option_view($this->session->userdata('id'), 'materialrequisition');
    }

    function index() {
        $this->load->view('materialrequisition/index');
    }

    function view() {
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "materialrequisition"));
        $this->load->model('model_department');
        $data['department'] = $this->model_department->selectAllResult();
        $this->load->view('materialrequisition/view', $data);
    }

    function get() {
        $query = "
            with mr as(
                    select 
                    mr.*,
                    (department.code || ': ' || department.name) department,
                    (case when mr.status = 0 then 'Not Submitted' else 'Submitted' end) status_label,
                    employee.name employeerequest,
                    joborder.project_no,
                    joborder.project_name from 
                    materialrequisition mr 
                    left join department on mr.departmentid=department.id 
                    left join employee on mr.requestedby=employee.id 
                    left join joborder on mr.joborderid=joborder.id where true
            )select mr.* from mr where true 
        ";

        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $number = $this->input->post('number');
        $departmentid = $this->input->post('departmentid');
        $jonumber = $this->input->post('jonumber');
        if ($datefrom != "" && $dateto != "") {
            $query .= " and mr.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and mr.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and mr.date = '" . $dateto . "'";
        }if ($number != "") {
            $query .= " and mr.number ilike '%" . $number . "%'";
        }if ($departmentid != "") {
            $query .= " and mr.departmentid = " . $departmentid;
        }
        if ($this->session->userdata('id') != 'admin' && $this->session->userdata('department') != 7 && $this->option_view != 1) {
            if ($this->option_view == 1) {
                $query .= " and mr.departmentid = " . $this->session->userdata('department');
            } else {
                $query .= " and mr.requestedby='" . $this->session->userdata('id') . "'";
            }
        }
        if (!empty($jonumber)) {
            $query .= " and mr.job_no ilike '%" . $jonumber . "%'";
        }

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        //echo $this->session->userdata('department');
//        $query .= " order by mr.$sort $order ";
        $query .= " order by mr.id desc ";
        //   echo $query;
        echo $this->model_materialrequisition->get($query);
    }

    function get_by_item_outstanding() {
        $query = "with t as (
                    select 
                    materialrequisition.id,
                    materialrequisition.number,
                    materialrequisition.date,
                    (to_char(materialrequisition.date, 'dd-mm-yyyy')) date_format,
                    materialrequisition.required_date,
                    (case when materialrequisition.required_date is not null then to_char(materialrequisition.required_date,'dd-mm-yyyy') end) required_date_format,
                    (select sum(qty_ots) from materialrequisitiondetail where materialrequisitionid=materialrequisition.id) qty_ots
                    from materialrequisition
                ) select t.* from t where t.qty_ots > 0";

        $q = $this->input->post("q");
        if (!empty($q)) {
            $query .= " and t.number ilike '%$q%'";
        }

        $query .= " order by t.id asc ";

        echo $this->model_materialrequisition->get($query);
    }

    function add() {
        $this->load->view('materialrequisition/add2');
    }

    function add_from_jo() {
        $this->load->view('materialrequisition/add');
    }

    function save() {

        $required_date = $this->input->post('required_date');
        $required_date = (empty($required_date) ? null : $required_date);
        $joborderid = (int) $this->input->post('joborderid');
        $data = array(
            "date" => $this->input->post('date'),
            "job_no" => $this->input->post('job_no'),
            "remark" => $this->input->post('remark'),
            "departmentid" => $this->session->userdata('department'), //Change with department session
            "requestedby" => $this->session->userdata('id'), //Change with session id
            "joborderid" => $joborderid,
            "required_date" => $required_date
        );

        if ($this->model_materialrequisition->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $data = array(
            "date" => $this->input->post('date'),
            "job_no" => $this->input->post('job_no'),
            "remark" => $this->input->post('remark')
        );

        if ($this->model_materialrequisition->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_materialrequisition->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function send() {
        $id = $this->input->post('id');
        $data = array(
            "status" => 1
        );

        if ($this->model_materialrequisition->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function search_form() {
        $this->load->model('model_department');
        $data['department'] = $this->model_department->selectAllResult();
        $this->load->view('materialrequisition/search_form', $data);
    }

    function outstanding() {
        $this->load->view('materialrequisition/outstanding');
    }

    function get_outstanding() {
        
    }

    function dialog_item_search_from_jo($joborderid) {
        $data['joborderid'] = $joborderid;
        $this->load->view('materialrequisition/add_from_joborder', $data);
    }

}
