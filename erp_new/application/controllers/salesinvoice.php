<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of salesinvoice
 *
 * @author hp
 */
class salesinvoice extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_salesinvoice');
        $this->load->model('model_salesinvoicedetail');
    }

    function index() {
        $this->load->view('salesinvoice/layout');
    }

    function view() {
        $this->load->view('salesinvoice/view');
    }

    function get() {
        echo $this->model_salesinvoice->get();
    }

    function get_data_total($id) {
        $query = "select 
            salesinvoice.*,
            (select salesinvoice_get_po_item(salesinvoice.id)) po_no,
            customer.name customer_name,
            to_char(salesinvoice.invoice_date, 'DD-MM-YYYY') invoice_date_format,
            (case when salesinvoice.ship_date is not null then to_char(salesinvoice.ship_date, 'DD-MM-YYYY') end) ship_date_format
            from salesinvoice
            join customer on salesinvoice.customerid=customer.id where salesinvoice.id=$id";
        echo $this->model_salesinvoice->get_total_data($query);
    }

    function add() {
        $this->load->model('model_customer');
        $this->load->model('model_shipvia');
        $this->load->model('model_currency');
        $data['customer'] = $this->model_customer->selectAllResult();
        $data['shipvia'] = $this->model_shipvia->selectAllResult();
        $data['currency'] = $this->model_currency->selectAllResult();
        $this->load->view('salesinvoice/add', $data);
    }

    function save() {

        $data = array(
            'invoice_date' => $this->input->post('invoice_date'),
            'customerid' => $this->input->post('customerid'),
            'bill_to' => $this->input->post('bill_to'),
            'ship_to' => $this->input->post('ship_to'),
            'ship_date' => $this->input->post('ship_date'),
            'ship_via' => $this->input->post('ship_via'),
            'terms' => $this->input->post('terms'),
            'currency' => $this->input->post('currency'),
            'description' => $this->input->post('description')
        );

        if ($this->model_salesinvoice->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {

        $data = array(
            'invoice_date' => $this->input->post('invoice_date'),
            'bill_to' => $this->input->post('bill_to'),
            'ship_to' => $this->input->post('ship_to'),
            'ship_date' => $this->input->post('ship_date'),
            'ship_via' => $this->input->post('ship_via'),
            'terms' => $this->input->post('terms'),
            'currency' => $this->input->post('currency'),
            'description' => $this->input->post('description'),
            'say' => $this->input->post('say'),
            'subtotal' => (double) $this->input->post('subtotal'),
            'discount' => (double) $this->input->post('discount'),
            'tax' => (double) $this->input->post('tax'),
            'totalinvoice' => (double) $this->input->post('totalinvoice'),
            'downpayment' => (double) $this->input->post('downpayment'),
            'balancepayment' => (double) $this->input->post('balancepayment')
        );

        if ($this->model_salesinvoice->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit($id) {
        $this->load->model('model_customer');
        $this->load->model('model_shipvia');
        $this->load->model('model_currency');
        $data['customer'] = $this->model_customer->selectAllResult();
        $data['shipvia'] = $this->model_shipvia->selectAllResult();
        $data['currency'] = $this->model_currency->selectAllResult();
        $data['salesinvoiceid'] = $id;
        $this->load->view('salesinvoice/edit', $data);
    }

    function prints() {
        $id = $this->input->post('id');
        $this->load->library('component');
        $this->load->model('model_company');
        $data['company'] = $this->model_company->select();
        $data['salesinvoice'] = $this->model_salesinvoice->select_by_id($id);
        $data['salesinvoicedetail'] = $this->model_salesinvoicedetail->select_by_sales_invoice_id($id);
        $this->load->view('salesinvoice/print', $data);
    }

    function do_load_customer_order_item() {
        $customerid = $this->input->post('customerid');
        $query = "select 
                so_detail.*,
                so.sonumber,
                model.code itemcode,
                model.name itemdescription
                from salesorderdetail so_detail
                join salesorder so on so_detail.salesorderid=so.id
                join model on so_detail.modelid=model.id 
                where so.orderby=" . $customerid;
        //echo $query;
        echo $this->model_salesinvoice->get($query);
    }

    function view_detail() {
        $this->load->view('salesinvoice/detail/view');
    }

    function get_detail() {
        $salesinvoiceid = $this->input->post('salesinvoiceid');

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
        echo $this->model_salesinvoicedetail->get($query);
    }

    function get_detail2($salesinvoiceid) {
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
        echo $this->model_salesinvoicedetail->get($query);
    }

    function add_detail($customerid) {
        $data['customerid'] = $customerid;
        $data['salesorderdetailid'] = 0;
        $data['id'] = 0;
        $this->load->view('salesinvoice/detail/add', $data);
    }

    function save_detail($salesinvoiceid) {
        $data = array(
            'salesinvoiceid' => $salesinvoiceid,
            'salesorderdetailid' => $this->input->post('salesorderdetailid'),
            'qty' => $this->input->post('qty'),
            'unitprice' => $this->input->post('unitprice'),
            'discount' => $this->input->post('discount'),
            'tax' => $this->input->post('tax'),
            'amount' => $this->input->post('amount'),
            'subtotal' => ((int) $this->input->post('qty') * (double) $this->input->post('unitprice'))
        );
        if ($this->model_salesinvoicedetail->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit_detail($id, $salesorderdetailid, $customerid) {
        $data['customerid'] = $customerid;
        $data['salesorderdetailid'] = $salesorderdetailid;
        $data['id'] = $id;
        $this->load->view('salesinvoice/detail/add', $data);
    }

    function update_detail($id) {
        $data = array(
            'salesorderdetailid' => $this->input->post('salesorderdetailid'),
            'qty' => $this->input->post('qty'),
            'unitprice' => $this->input->post('unitprice'),
            'discount' => $this->input->post('discount'),
            'tax' => $this->input->post('tax'),
            'amount' => $this->input->post('amount'),
            'subtotal' => ((int) $this->input->post('qty') * (double) $this->input->post('unitprice'))
        );
        if ($this->model_salesinvoicedetail->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete_detail() {
        if ($this->model_salesinvoicedetail->delete(array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_sales_order_detail_ots($id, $salesorderdetailid) {
        echo $this->model_salesinvoicedetail->get_real_ots($id, $salesorderdetailid);
    }

}
