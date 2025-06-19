<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_pricecomparison
 *
 * @author hp
 */
class model_pricecomparison extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get($query) {

        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        $result = array();
        $row = array();

        if (!empty($page) || !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
        }

        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'purchaserequestdetailid' => $data->purchaserequestdetailid,
                'vendorid' => $data->vendorid,
                'vendor' => $data->vendor,
                'price' => number_format($data->price, '2', '.', ''),
                'notes' => $data->notes,
                'currency' => $data->currency,
                'used' => $data->used,
                'discount' => number_format($data->discount, '2', '.', ''),
                'ppn' => number_format($data->ppn, '2', '.', ''),
                'total' => number_format($data->total, '2', '.', ''),
                'amount' => number_format($data->amount, '2', '.', ''),
                'pricecomparisonid' => $data->id);
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function select_result_by_purchase_request_detail_id($purchaserequestdetailid) {
        $query = "select 
            pricecomparison.*,
            vendor.name vendor
            from pricecomparison
            join vendor on pricecomparison.vendorid=vendor.id 
            where pricecomparison.purchaserequestdetailid = $purchaserequestdetailid";
        return $this->db->query($query)->result();
    }

    function insert($data) {
        return $this->db->insert('pricecomparison', $data);
    }

    function update($data, $where) {
        return $this->db->update('pricecomparison', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('pricecomparison', $where);
    }

}
