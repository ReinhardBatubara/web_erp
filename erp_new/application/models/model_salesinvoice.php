<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_salesinvoice
 *
 * @author user
 */
class model_salesinvoice extends CI_Model {

  //put your code here
  public function __construct() {
    parent::__construct();
  }

  function select_by_id($id) {
    $query = "select 
            salesinvoice.*,
            (select salesinvoice_get_po_item(salesinvoice.id)) po_no,
            customer.name customer_name,
            to_char(salesinvoice.invoice_date, 'DD-MM-YYYY') invoice_date_format,
            (case when salesinvoice.ship_date is not null then to_char(salesinvoice.ship_date, 'DD-MM-YYYY') end) ship_date_format
            from salesinvoice
            join customer on salesinvoice.customerid=customer.id 
            where salesinvoice.id=$id";



    return $this->db->query($query)->row();
  }

  function get() {

    $query = "select 
            salesinvoice.*,
            (select salesinvoice_get_po_item(salesinvoice.id)) po_no,
            customer.name customer_name,
            to_char(salesinvoice.invoice_date, 'DD-MM-YYYY') invoice_date_format,
            (case when salesinvoice.ship_date is not null then to_char(salesinvoice.ship_date, 'DD-MM-YYYY') end) ship_date_format
            from salesinvoice
            join customer on salesinvoice.customerid=customer.id";

    $invoice_no = $this->input->post('invoice_no');
    if (!empty($invoice_no)) {
      $query .= " and salesinvoice.invoice_no ilike '%$invoice_no%' ";
    }

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');
    if ($datefrom != "" && $dateto != "") {
      $query .= " and salesinvoice.date between '" . $datefrom . "' and '" . $dateto . "'";
    }if ($datefrom != "" && $dateto == "") {
      $query .= " and salesinvoice.date = '" . $datefrom . "'";
    }if ($datefrom == "" && $dateto != "") {
      $query .= " and salesinvoice.date = '" . $dateto . "'";
    }
    $customer_name = $this->input->post('customer_name');
    if (!empty($customer_name)) {
      $query .= " and customer.name ilike '%$customer_name%' ";
    }

//        echo $query;

    $page = $this->input->post('page');
    $rows = $this->input->post('rows');
    $result = array();

    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";
    if (!empty($page) && !empty($rows)) {
      $offset = ($page - 1) * $rows;
      $result['total'] = $this->db->query($query)->num_rows();
      $query .= " limit $rows offset $offset";
    }

    $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
    return json_encode($result);
  }

  function get_total_data($query) {
    $dt = $this->db->query($query)->row();
    return $dt->subtotal . "|" . $dt->discount . "|" . $dt->tax . "|" . $dt->totalinvoice . "|" . $dt->downpayment . "|" . $dt->balancepayment;
  }

  function insert($data) {
    return $this->db->insert('salesinvoice', $data);
  }

  function update($data, $where) {
    return $this->db->update('salesinvoice', $data, $where);
  }

  function delete($where) {
    return $this->db->delete('salesinvoice', $where);
  }

}

?>
