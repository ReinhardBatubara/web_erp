<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_salesorder
 *
 * @author hp
 */
class model_salesorder extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_by_id($id) {
        $query = "
            select 
            salesorder.*,
            to_char(salesorder.date, 'DD-MM-YYYY') date_format,
            to_char(salesorder.shipdate, 'DD-MM-YYYY') shipdate_format,
            customer.name customerorder,
            bankaccount.account_number,
            bankaccount.account_name,
            bankaccount.bank,
            bankaccount.currency,
            bankaccount.bank_address,
            bankaccount.swift_code,
            (select name from customer where id=salesorder.shipto) customershipto,
            (select salesorder_get_count_process_to_job_order(salesorder.id)) process_to_jo,
            employee.name preparedby,
            (select name from employee where id=salesorder.approved_by) approvedby
            from salesorder
            left join customer on salesorder.orderby=customer.id 
            left join employee on salesorder.prepared_by=employee.id
            left join bankaccount on salesorder.bankaccountid=bankaccount.id
            where salesorder.id=$id
        ";
        return $this->db->query($query)->row();
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

    function get_available_for_combogrid($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'sonumber' => $data->sonumber,
                'date' => $data->date,
                'date_f' => date('d-m-Y', strtotime($data->date)),
                'po_no' => $data->po_no,
                'orderby' => $data->orderby,
                'customerorder' => $data->customerorder,
            );
        }
        return json_encode($row);
    }

    function insert($data) {
        return $this->db->insert('salesorder', $data);
    }

    function update($data, $where) {
        return $this->db->update('salesorder', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('salesorder', $where);
    }

    function do_revision($salesorderid, $remark) {
        return $this->db->query("select salesorder_do_revision($salesorderid, '$remark')");
    }

}
