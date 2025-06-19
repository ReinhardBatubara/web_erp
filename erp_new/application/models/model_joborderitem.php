<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_joborderitem
 *
 * @author user
 */
class model_joborderitem extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get($query) {
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $row = array();
        $criteria = $this->db->query($query)->result();
        $total = 0;
        foreach ($criteria as $data) {
            $row[] = $data;
            $total += $data->qty;
        }
        $footer = array(array('qty' => $total));
        $result = array_merge($result, array('rows' => $row, 'footer' => $footer));
        return json_encode($result);
    }

    function get2($query) {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
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

    function insert($data) {
        return $this->db->insert('joborderitem', $data);
    }

    function insert_batch($data) {
        return $this->db->insert_batch('joborderitem', $data);
    }

    function update($data, $where) {
        return $this->db->update('joborderitem', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('joborderitem', $where);
    }

    function item_barcode_update_batch($data, $index) {
        return $this->db->update_batch('joborderitembarcode', $data, $index);
    }

    function do_make_stock_item($serial, $position) {
        $query = "select tracking_do_make_stock_item('{" . $serial . "}','{" . $position . "}')";
        //echo $query;
        return $this->db->query($query);
    }

    function do_back_item($serial, $positionid, $date) {
        $query = "select tracking_do_back_item('{" . $serial . "}',$positionid,'$date')";
        //echo $query;
        return $this->db->query($query);
    }

    function get_serial_by_id_joib($id) {
        $query = "select joborderitembarcode.serial from joborderitembarcode where id=$id";
        //echo $query;
        $dt = $this->db->query($query)->row();
        return (!empty($dt->serial) ? $dt->serial : '');
    }
    
    function select_all_position($id){
        $query = "
            select t.positionid,count(t.positionid) qty, tp.name tracking_process_name
            from tracking_get() t join tracking_process tp on t.positionid=tp.id
            where t.joborderitemid=$id
            group by t.positionid,tp.name   
        ";
        return $this->db->query($query)->result();
    }

}
