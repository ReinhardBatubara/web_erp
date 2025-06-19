<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_stockout
 *
 * @author user
 */
class model_stockout extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_row_query($query) {
        return $this->db->query($query)->row();
    }

    function select_result_query($query) {
        return $this->db->query($query)->result();
    }

    function get($query) {
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

    function get_with_no_paging($query) {
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $row = array();
        $criteria = $this->db->query($query)->result();

        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function create_direct() {
        $dt = $this->db->query("select stockout_direct_create() as ct")->row();
        return $dt->ct;
    }

    function get_next_id() {
        $query = "select nextval('stockout_id_seq') id";
        return $this->db->query($query)->row()->id;
    }

    function insert($data) {
        return $this->db->insert('stockout', $data);
    }

    function update($data, $where) {
        return $this->db->update('stockout', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('stockout', $where);
    }

    function receive($id) {
        return $this->db->query("select stockout_receive($id)");
    }

    function direct_save($date, $joborderid, $request_by, $remark, $outby) {
        return $this->db->query("select stockout_direct_save('$date', $joborderid, '$request_by', '$remark','$outby')");
    }

    function direct_save_item($stokoutid, $materialwithdrawid, $itemid, $description, $unitcode, $warehouseid, $qty, $mrpid) {
        return $this->db->query("select stockout_direct_save_item($stokoutid,$materialwithdrawid,$itemid, '" . trim($description) . "', '$unitcode', $warehouseid, $qty, $mrpid)");
    }

    function save_from_nota($date, $nota_no, $request_by, $remark, $outby, $subsectionid) {
        return $this->db->query("select stockout_save_from_nota('$date', '$nota_no', '$request_by', '$remark','$outby',$subsectionid)");
    }

    function save_item_from_nota($stockoutid, $itemid, $unitcode, $warehouseid, $qty, $remark) {
        return $this->db->query("select stockout_save_item_from_nota($stockoutid, $itemid, '$unitcode', $warehouseid, $qty,'$remark')");
    }

}
