<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_purchaserequestapproval
 *
 * @author hp
 */
class model_purchaserequestapproval extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_all_by_purchaserequest_id($purchaserequestid) {
        $query = "
            select 
            purchaserequestapproval.*,
            employee.name employee_name
            from purchaserequestapproval
            join employee on purchaserequestapproval.employeeid=employee.id
            where purchaserequestapproval.purchaserequestid=$purchaserequestid 
            order by purchaserequestapproval.id asc
        ";
//        echo $query;
        return $this->db->query($query)->result();
    }

    function get($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        $status_array = array('Waiting', 'Approved', 'Pending', 'Reject');

        foreach ($criteria as $data) {
            $status_remark = "";
            if ($data->outstanding == 't') {
                if ($data->status != 0) {
                    $status_remark = $status_array[$data->status];
                } else {
                    $status_remark = 'Outstanding';
                }
            } else {
                $status_remark = $status_array[$data->status];
            }
            $time_approve = (!empty($data->timeapprove)) ? date('d-m-Y H:i', strtotime($data->timeapprove)) : '';
            $row[] = array(
                'id' => $data->id,
                'employeeid' => $data->employeeid,
                'employee' => $data->employee,
                'id_employee' => $data->employee . " / " . $data->employeeid,
                'status' => $data->status,
                'status_remark' => $status_remark,
                'outstanding' => $data->outstanding,
                'timeapprove' => $time_approve
            );
        }
        return json_encode($row);
    }

    function insert($data) {
        return $this->db->insert_batch('purchaserequestapproval', $data);
    }

    function update($data, $where) {
        return $this->db->update('purchaserequestapproval', $data, $where);
    }

    function action_approve($purchaserequestid, $id, $status, $notes) {
        return $this->db->query("select purchaserequestapproval_action_approve($purchaserequestid, $id, $status, '$notes')");
    }

    function is_change($purchaserequestid, $id, $status, $last_approval) {
        return $this->db->query("select purchaserequestapproval_is_change($purchaserequestid, $id, $status,'$last_approval') ct")->row()->ct;
    }

}
