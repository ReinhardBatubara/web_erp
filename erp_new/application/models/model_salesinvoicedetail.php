<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_salesinvoicedetail
 *
 * @author user
 */
class model_salesinvoicedetail extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_by_sales_invoice_id($salesinvoiceid) {
        $query = "select 
        salesinvoicedetail.*,
        salesorder.sonumber,
        model.code modelcode,
        model.name modelname
        from salesinvoicedetail
        join salesorderdetail on salesinvoicedetail.salesorderdetailid=salesorderdetail.id
        join salesorder on salesorderdetail.salesorderid=salesorder.id
        join model on salesorderdetail.modelid=model.id 
        where salesinvoicedetail.salesinvoiceid=$salesinvoiceid";
        return $this->db->query($query)->result();
    }

    function get($query) {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();

        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
        }

        $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
        return json_encode($result);
    }

    function insert($data) {
        return $this->db->insert('salesinvoicedetail', $data);
    }

    function update($data, $where) {
        return $this->db->update('salesinvoicedetail', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('salesinvoicedetail', $where);
    }

    function get_real_ots($id, $salesorderdetailid) {
        $query = "select salesinvoicedetail_get_real_ots($id,$salesorderdetailid) ct";
        //echo $query;
        return $this->db->query($query)->row()->ct;
    }

}

?>
