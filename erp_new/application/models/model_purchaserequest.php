<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_purchaserequest
 *
 * @author hp
 */
class model_purchaserequest extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get($query) {
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
                'number' => $data->number,
                'date' => $data->date,
                'date_format' => date('d-m-Y', strtotime($data->date)),
                'departmentid' => $data->departmentid,
                'department' => $data->departmentcode . ': ' . $data->department,
                'departmentcode' => $data->departmentcode,
                'countattachment' => $data->countattachment,
                'countcomment' => $data->countcomment,
                'countpurchaseorder' => $data->counterpurchaseorder,
                'countitem' => $data->countitem,
                'employeeidrequest' => $data->employeeidrequest,
                'employeerequest' => $data->employeerequest,
                'vendorid' => $data->vendorid,
                'vendor' => $data->vendor,
                'currency' => $data->currency,
                'countapproval' => $data->countapproval,
                'complete_approve' => $data->complete_approve,
                'purchaserequestapprovalid' => $data->purchaserequestapprovalid,
                'purchaserequestapprovalemployeeid' => $data->purchaserequestapprovalemployeeid,
                'approvalcomplete' => $data->approvalcomplete,
                'total' => number_format($data->total, 2, '.', ''),
                'discount' => number_format($data->discount, 2, '.', ''),
                'amount' => number_format($data->amount, 2, '.', ''),
                'tax' => number_format($data->tax, 2, '.', ''),
                'total_amount' => $data->total_amount,
                'remark' => $data->remark,
                'status' => $data->status,
                'mr_number_list' => $data->mr_number_list
            );
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function get_default_aprroval() {
        $dt = $this->db->get('purchaserequestdefaultapproval')->row();
        return (empty($dt) ? '# # #' : $dt->checked . '#' . $dt->acknowledge . '#' . $dt->approved);
    }

    function select_result_by_id($id) {
        return $this->db->get_where('purchaserequest', array("id" => $id))->row();
    }

    function save_default_aprroval($data) {
        return $this->db->update('purchaserequestdefaultapproval', $data);
    }

    function insert($data) {
        return $this->db->insert('purchaserequest', $data);
    }

    function update($data, $where) {
        return $this->db->update('purchaserequest', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('purchaserequest', $where);
    }

    function get_last_id() {
        $dt = $this->db->query("select id from purchaserequest order by id desc limit 1")->row();
        return $dt->id;
    }

}
