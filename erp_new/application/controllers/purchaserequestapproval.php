<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchaserequestapproval
 *
 * @author hp
 */
class purchaserequestapproval extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_purchaserequestapproval');
    }

    function index() {
        $this->load->view('purchaserequest/approval/view');
    }

    function get() {
        $purchaserequestid = $this->input->post('purchaserequestid');
        $query = "select 
        purchaserequestapproval.*,
        employee.name as employee
        from purchaserequestapproval 
        join employee 
        on purchaserequestapproval.employeeid=employee.id
        where true ";
        if (empty($purchaserequestid)) {
            $purchaserequestid = 0;
        }
        $query .= " and purchaserequestapproval.purchaserequestid=$purchaserequestid order by id asc ";
        echo $this->model_purchaserequestapproval->get($query);
    }

    function save($purchaserequestid) {

        $checked = $this->input->post('checked');
        $acknowledge = $this->input->post('acknowledge');
        $approved = $this->input->post('approved');

        $data[] = array(
            'purchaserequestid' => $purchaserequestid,
            'employeeid' => $this->session->userdata('id'),
            'outstanding' => 'TRUE'
        );
        $data[] = array(
            'purchaserequestid' => $purchaserequestid,
            'employeeid' => $checked,
            'outstanding' => 'FALSE'
        );

        $data[] = array(
            'purchaserequestid' => $purchaserequestid,
            'employeeid' => $acknowledge,
            'outstanding' => 'FALSE'
        );
        $data[] = array(
            'purchaserequestid' => $purchaserequestid,
            'employeeid' => $approved,
            'outstanding' => "FALSE"
        );
        if ($this->model_purchaserequestapproval->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function action_approve($purchaserequestid, $id, $status) {
        $notes = $this->input->post('notes');
        if ($this->model_purchaserequestapproval->action_approve($purchaserequestid, $id, $status, $notes)) {
            echo json_encode(array(
                'success' => true,
                'approval_changed' => $this->model_purchaserequestapproval->is_change($purchaserequestid, $id, $status, $this->session->userdata('id'))));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function do_change($id) {
        $employeeid = $this->input->post('employeeid');
        $data = array(
            'employeeid' => $employeeid
        );
        if ($this->model_purchaserequestapproval->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function load_dialog() {
        $this->load->view('purchaserequest/approval/pending_or_reject2');
    }

    function load_default_approval_dialog() {
        $this->load->view('purchaserequest/approval/default');
    }

}
