<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_purchaserequestdetail
 *
 * @author hp
 */
class model_purchaserequestdetail extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get_by_item($query) {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $row = array();
        $query .= " limit $rows offset $offset";
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'purchaserequestid' => $data->purchaserequestid,
                'pr_number' => $data->pr_number,
                'pr_date' => $data->pr_date,
                'itemid' => $data->itemid,
                'itemcode' => $data->itemcode,
                'itemdescription' => $data->itemdescription,
                'description' => $data->itemdescription,
                'code' => $data->itemcode,
                'unitcode' => $data->unitcode,
                'qty' => $data->qty,
                'vendor' => $data->vendor,
                'vendorid' => $data->vendorid,
                'currency' => $data->currency,
                'total' => number_format($data->total, '2', '.', ''),
                'price' => number_format($data->price, '2', '.', ''),
                'discount' => number_format($data->discount, '2', '.', ''),
                'tax' => number_format($data->ppn, '2', '.', ''),
                'amount' => number_format($data->amount, '2', '.', ''),
                'department' => $data->department,
                'mr_number' => $data->mr_number,
                'pricecomparisonid' => $data->pricecomparisonid
            );
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
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

    function select_result_by_purchase_request_id($purchaserequestid) {
        $query = "select 
            purchaserequestdetail.*,
            vendor.name vendor,
            item.code itemcode,
            item.description itemdescription
            from purchaserequestdetail 
            join item on purchaserequestdetail.itemid=item.id
            left join vendor on purchaserequestdetail.vendorid=vendor.id 
            where purchaserequestdetail.purchaserequestid=$purchaserequestid";
        return $this->db->query($query)->result();
    }

    function get_last_id() {
        $query = "select id from purchaserequestdetail order by id desc limit 1";
        $dt = $this->db->query($query)->row();
        return $dt->id;
    }

    function insert($data) {
        return $this->db->insert('pr_item_temp_merge', $data);
        //return $this->db->insert('purchaserequestdetail', $data);
    }

    function update($data, $where) {
        return $this->db->update('purchaserequestdetail', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('purchaserequestdetail', $where);
    }

    function insert_batch($data) {
        //return $this->db->insert_batch('pr_item_temp_merge', $data);
        return $this->db->insert_batch('purchaserequestdetail', $data);
    }

}
