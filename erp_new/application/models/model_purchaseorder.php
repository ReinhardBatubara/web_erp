<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_purchaseorder
 *
 * @author hp
 */
class model_purchaseorder extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_result_by_id($id) {
        $query = "select 
                purchaseorder.*,
                purchaserequest.number purchaserequest,
                purchaserequest.departmentid,
                department.name department,
                purchaserequest.vendorid,
                vendor.name vendor,
                vendor.address vendoraddress,
                vendor.phone vendor_phone
                from purchaseorder 
                join purchaserequest on purchaseorder.purchaserequestid=purchaserequest.id 
                left join department on purchaserequest.departmentid=department.id
                left join vendor on purchaseorder.vendorid=vendor.id where purchaseorder.id=$id";
        return $this->db->query($query)->row();
    }

    function get($query) {

        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $query .= " limit $rows offset $offset";
        $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
        return json_encode($result);
    }

    function get_for_combo($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'number' => $data->number,
                'date_modify' => date('d-m-Y', strtotime($data->date)),
                'vendor' => $data->vendor
            );
        }
        return json_encode($row);
    }

    function get_available_to_receive_by_warehouse($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'number' => $data->number,
                'date_modify' => date('d-m-Y', strtotime($data->date)),
                'vendor' => $data->vendor
            );
        }
        return json_encode($row);
    }

    function insert($data) {
        return $this->db->insert('purchaseorder', $data);
    }

    function update($data, $where) {
        return $this->db->update('purchaseorder', $data, $where);
    }

    function move_pr_item_to_po($purchaserequestid, $poid) {
        return $this->db->query("select purchaseorder_move_pr_item_to_po($purchaserequestid, $poid)");
    }

    function get_last_id() {
        $query = "select id from purchaseorder order by id desc limit 1";
        $dt = $this->db->query($query)->row();
        return $dt->id;
    }

    function delete($where) {
        return $this->db->delete('purchaseorder', $where);
    }

    function create($purchaserequestid, $create_by) {
        return $this->db->query("select purchaseorder_create($purchaserequestid,'$create_by')");
    }

    function get_outstanding($query) {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $query .= " limit $rows offset $offset";
        $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
        return json_encode($result);
    }

}
