<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_purchaseorderdetail
 *
 * @author hp
 */
class model_purchaseorderdetail extends CI_Model {

//put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_result_by_purchaseorder_id($purchaseorderid) {
        $query = "select t.* from purchaserequestdetail_get() t where t.purchaseorderid=$purchaseorderid";
        return $this->db->query($query)->result();
    }

    function update_batch($data, $ndex) {
        return $this->db->update_batch("purchaseorderdetail ", $data, $ndex);
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

    function open_close_by_purchase_order_id($purchaseorderid, $status) {
        //echo "select purchaseorderdetail_open_and_close($purchaseorderid,'$status')";
        return $this->db->query("select purchaseorderdetail_open_and_close($purchaseorderid,'$status')");
    }

    function do_close($poitem, $status, $option_price) {
        $query = "select purchaseorderdetail_do_close($poitem, '$status', $option_price)";
        return $this->db->query($query);
    }

}
