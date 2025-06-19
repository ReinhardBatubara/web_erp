<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_tracking
 *
 * @author user
 */
class model_tracking extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_all_process() {
        return $this->db->query("select * from tracking_process order by id asc")->result();
    }

    function get($query) {
        $rows = $this->input->post('rows');
        $page = $this->input->post('page');

        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

    function history_get($query) {
        $rows = $this->input->post('rows');
        $page = $this->input->post('page');

        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $row = array();
        $query .= " limit $rows offset $offset";
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'process_name' => $data->name,
                'startdate' => date('d-m-Y', strtotime($data->date)),
                'stopdate' => date('d-m-Y', strtotime($data->last_date)),
                'duration' => $data->duration
            );
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function get_tracking_process() {
        
    }

    function get_tracking_process_for_combo($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'name' => $data->name
            );
        }
        return json_encode($row);
    }

    function is_valid($processid, $serial) {
        $query = "select tracking_isvalid_serial_process($processid,'$serial') ct";
        $dt = $this->db->query($query)->row();
        return ($dt->ct == 't');
    }

    function insert_batch($data) {
        //return true;
        return $this->db->insert_batch('tracking', $data);
    }

    function update_date($serial, $processid, $status, $date) {
        return $this->db->query("select tracking_update_date('$serial',$processid,'$status','$date')");
    }

}
