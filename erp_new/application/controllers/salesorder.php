<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of salesorder
 *
 * @author hp
 */
class salesorder extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_salesorder');
        $this->load->model('model_salesorderdetail');
    }

    function index() {
        $this->load->model('model_customer');
        $this->load->model('model_shipvia');
        $data['customer'] = $this->model_customer->selectAllResult();
        $data['shipvia'] = $this->model_shipvia->selectAllResult();
        $this->load->view('salesorder/view', $data);
    }

    function load_search_form() {
        $this->load->model('model_customer');
        $this->load->model('model_shipvia');
        $data['customer'] = $this->model_customer->selectAllResult();
        $data['shipvia'] = $this->model_shipvia->selectAllResult();
        $this->load->view('salesorder/search_form', $data);
    }

    function get() {

        $query = "select 
        salesorder.*,
        to_char(salesorder.date, 'DD-MM-YYYY') date_format,
        to_char(salesorder.shipdate, 'DD-MM-YYYY') shipdate_format,
        customer.name customerorder,
        bankaccount.account_number,
        bankaccount.account_name,
        bankaccount.bank,
        bankaccount.currency,
        (select name from customer where id=salesorder.shipto) customershipto,
        (select salesorder_get_count_process_to_job_order(salesorder.id)) process_to_jo,
        employee.name preparedby,
        (select name from employee where id=salesorder.approved_by) approvedby
        from salesorder
        left join customer on salesorder.orderby=customer.id 
        left join employee on salesorder.prepared_by=employee.id
        left join bankaccount on salesorder.bankaccountid=bankaccount.id
        where true";

        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and salesorder.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and salesorder.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and salesorder.date = '" . $dateto . "'";
        }
        $orderby = $this->input->post('orderby');
        if (!empty($orderby)) {
            $query .= " and salesorder.orderby = " . $orderby;
        }


        $po_no = $this->input->post('po_no');
        if (!empty($po_no)) {
            $po_no = "'%" . str_replace("|", "%','%", $po_no) . "%'";
            $query .= " and salesorder.po_no ilike any(array[$po_no])";
        }
        $sonumber = $this->input->post('sonumber');
        if (!empty($sonumber)) {
            $sonumber = "'%" . str_replace("|", "%','%", $sonumber) . "%'";
            $query .= " and salesorder.sonumber ilike any(array[$sonumber])";
        }
        $shipto = $this->input->post('shipto');
        if (!empty($shipto)) {
            $query .= " and salesorder.shipto = " . $shipto;
        }
//        $query.= " order by salesorder.id desc";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";

        // echo $query . "<br>";
        echo $this->model_salesorder->get($query);
    }

    function get_available_for_combogrid() {
        $query = "with t as(
                select 
                salesorder.*,
                customer.name customerorder,
                (select name from customer where id=salesorder.shipto) customershipto,
                (select sum(ots) from salesorderdetail where salesorderid=salesorder.id) ots
                from salesorder
                left join customer on salesorder.orderby=customer.id
                ) select * from t where ots > 0 and t.open=true";
        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and t.sonumber ilike '%$q%'";
        }
        $query.= " order by t.id desc";

        echo $this->model_salesorder->get_available_for_combogrid($query);
    }

    function unpaid_downpayment() {
        $this->load->view('salesorder/unpaid_downpayment');
    }

    function get_unpaid_down_payment() {
        $query = "select 
        salesorder.*,
        to_char(salesorder.date, 'DD-MM-YYYY') date_format,
        to_char(salesorder.shipdate, 'DD-MM-YYYY') shipdate_format,
        customer.name customerorder,
        bankaccount.account_number,
        bankaccount.account_name,
        bankaccount.bank,
        bankaccount.currency,
        (select name from customer where id=salesorder.shipto) customershipto,
        (select salesorder_get_count_process_to_job_order(salesorder.id)) process_to_jo,
        employee.name preparedby,
        (select name from employee where id=salesorder.approved_by) approvedby
        from salesorder
        left join customer on salesorder.orderby=customer.id 
        left join employee on salesorder.prepared_by=employee.id
        left join bankaccount on salesorder.bankaccountid=bankaccount.id
        where down_payment_date is null ";
        
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        if ($datefrom != "" && $dateto != "") {
            $query .= " and salesorder.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and salesorder.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and salesorder.date = '" . $dateto . "'";
        }
        
        $orderby = $this->input->post('customerid');
        if (!empty($orderby)) {
            $query .= " and salesorder.orderby = " . $orderby;
        }
        
        $sonumber = $this->input->post('so_no');
        if (!empty($sonumber)) {
            $sonumber = "'%" . str_replace("|", "%','%", $sonumber) . "%'";
            $query .= " and salesorder.sonumber ilike any(array[$sonumber])";
        }
        $po_no = $this->input->post('po_no');
        if (!empty($po_no)) {
            $po_no = "'%" . str_replace("|", "%','%", $po_no) . "%'";
            $query .= " and salesorder.po_no ilike any(array[$po_no])";
        }
        
        
        echo $this->model_salesorder->get($query);
    }

    function must_shipping() {
        $this->load->view('salesorder/must_shipping');
    }

    function get_available_item() {

        $salesorderid = $this->input->post('salesorderid');

        if (empty($salesorderid)) {
            $salesorderid = 0;
        }

        $query = "select 
                salesorderdetail.*,
                model.mastercode,
                model.originalcode,
                model.code,
                model.name,
                material.description material,
                finishing.description finishing,
                (select salesorderdetail_get_amount_by_id(salesorderdetail.id)) amount
                from 
                salesorderdetail join model  
                on salesorderdetail.modelid=model.id 
                left join material on salesorderdetail.materialcode = material.code 
                left join finishing on salesorderdetail.finishingcode=finishing.code 
                where salesorderdetail.salesorderid = $salesorderid 
                and salesorderdetail.ots > 0";

        $code = $this->input->post('code');
        if (!empty($code)) {
            $query .= " and model.code ilike '%" . trim($code) . "%'";
        }
        $name = $this->input->post('name');
        if (!empty($name)) {
            $query .= " and model.name ilike '%" . trim($name) . "%'";
        }

        //echo $query;
        echo $this->model_salesorderdetail->get($query);
    }

    function input() {
        $this->load->view('salesorder/add');
    }

    function edit_price() {
        $this->load->view('salesorder/edit_price');
    }

    function set_down_payment() {
        $this->load->view('salesorder/set_down_payment');
    }

    function save() {
        $date = $this->input->post('date');
        $po_no = $this->input->post('po_no');
        $orderby = $this->input->post('orderby');
        $address_orderby = $this->input->post('address_orderby');
        $shipto = $this->input->post('shipto');
        $address_shipto = $this->input->post('address_shipto');
        $shipdate = $this->input->post('shipdate');
        $shipvia = $this->input->post('shipvia');
        $terms = $this->input->post('terms');
        $salesman = $this->input->post('salesman');
        $bankaccountid = $this->input->post('bankaccountid');
        $description = $this->input->post('description');
        if (empty($shipvia)) {
            $shipvia = NULL;
        }

        $data = array(
            'date' => $date,
            'po_no' => $po_no,
            'orderby' => $orderby,
            'address_orderby' => $address_orderby,
            'shipto' => $shipto,
            'address_shipto' => $address_shipto,
            'shipdate' => $shipdate,
            'shipvia' => $shipvia,
            'terms' => $terms,
            'salesman' => $salesman,
            'bankaccountid' => $bankaccountid,
            'description' => $description
        );

        if ($this->model_salesorder->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {

        $date = $this->input->post('date');
        $po_no = $this->input->post('po_no');
        $orderby = $this->input->post('orderby');
        $address_orderby = $this->input->post('address_orderby');
        $shipto = $this->input->post('shipto');
        $address_shipto = $this->input->post('address_shipto');
        $shipdate = $this->input->post('shipdate');
        $shipvia = $this->input->post('shipvia');
        $terms = $this->input->post('terms');
        $salesman = $this->input->post('salesman');
        $bankaccountid = $this->input->post('bankaccountid');
        $description = $this->input->post('description');
        if (empty($shipvia)) {
            $shipvia = NULL;
        }

        $data = array(
            'date' => $date,
            'po_no' => $po_no,
            'orderby' => $orderby,
            'address_orderby' => $address_orderby,
            'shipto' => $shipto,
            'address_shipto' => $address_shipto,
            'shipdate' => $shipdate,
            'shipvia' => $shipvia,
            'terms' => $terms,
            'salesman' => $salesman,
            'bankaccountid' => $bankaccountid,
            'description' => $description
        );

        if ($this->model_salesorder->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update_price($id) {
        $discount = $this->input->post('discount');
        $ppn = $this->input->post('ppn');

        $data = array(
            'discount' => $discount,
            'ppn' => $ppn
        );

        if ($this->model_salesorder->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_salesorder->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_input() {
        $this->load->view('salesorderdetail/add');
    }

    function view_detail() {
        $this->load->view('salesorderdetail/view');
    }

    function detail_get() {

        $salesorderid = $this->input->post('salesorderid');
        if (empty($salesorderid)) {
            $salesorderid = 0;
        }

        $query = "
            select 
            salesorderdetail.*,
            model.mastercode,
            model.originalcode,
            model.code,
            model.name,
            finishing.description finishing,
            material.description material,
            top.description top,
            mirrorglass.description mirrorglass,
            foam.description foam,
            interliner.description interliner,
            fabric.description fabric,
            furring.description furring,
            accessories.description accessories,
            (select salesorderdetail_get_amount_by_id(salesorderdetail.id)) amount
            from 
            salesorderdetail join model  
            on salesorderdetail.modelid=model.id 
            left join finishing on salesorderdetail.finishingcode=finishing.code
            left join material on salesorderdetail.materialcode=material.code
            left join top on salesorderdetail.topcode=top.code
            left join mirrorglass on salesorderdetail.mirrorglasscode=mirrorglass.code
            left join foam on salesorderdetail.foamcode=foam.code
            left join interliner on salesorderdetail.interlinercode=interliner.code
            left join fabric on salesorderdetail.fabriccode=fabric.code
            left join furring on salesorderdetail.furringcode=furring.code
            left join accessories on salesorderdetail.accessoriescode=accessories.code 
            where salesorderdetail.salesorderid = $salesorderid         
        ";

        $code = $this->input->post('code');
        if (!empty($code)) {
            $query .= " and model.code ilike '%" . trim($code) . "%'";
        }
        $name = $this->input->post('name');
        if (!empty($name)) {
            $query .= " and model.name ilike '%" . trim($name) . "%'";
        }
        $query .= " order by salesorderdetail.id desc ";
        //echo $query;
        echo $this->model_salesorderdetail->get($query);
    }

    function detail_save($salesorderid) {
        $modelid = $this->input->post('modelid');
        $unitprice = (double) $this->input->post('unitprice');
        $qty = (int) $this->input->post('qty');
        $discount = (double) $this->input->post('discount');
        $tax = (double) $this->input->post('tax');
        $remark = $this->input->post('remark');
        $customer_code = $this->input->post('customer_code');

        $data = array(
            "salesorderid" => $salesorderid,
            "modelid" => $modelid,
            "qty" => $qty,
            "unitprice" => $unitprice,
            "discount" => $discount,
            "tax" => $tax,
            "ots" => $qty,
            "invoice_ots" => $qty,
            "remark" => $remark,
            "customer_code" => $customer_code
        );

        if ($this->model_salesorderdetail->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_update($id) {

        $modelid = $this->input->post('modelid');
        $unitprice = (double) $this->input->post('unitprice');
        $qty = (int) $this->input->post('qty');
        $discount = (double) $this->input->post('discount');
        $tax = (double) $this->input->post('tax');
        $remark = $this->input->post('remark');
        $customer_code = $this->input->post('customer_code');

        $data = array(
            "modelid" => $modelid,
            "qty" => $qty,
            "unitprice" => $unitprice,
            "discount" => $discount,
            "tax" => $tax,
            "remark" => $remark,
            "customer_code" => $customer_code
        );

        if ($this->model_salesorderdetail->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_delete() {
        $id = $this->input->post('id');
        if ($this->model_salesorderdetail->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function process($id) {
        $data['salesorderid'] = $id;
        $this->load->view('salesorder/process', $data);
    }

    function do_process() {
        $approved_by = $this->input->post('approved_by');
        $salesorderid = $this->input->post('salesorderid');

        $data = array(
            'approved_by' => $approved_by,
            'open' => 'TRUE',
            'prepared_by' => $this->session->userdata('id')
        );

        if ($this->model_salesorder->update($data, array("id" => $salesorderid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function cancel($id) {
        $data['salesorderid'] = $id;
        $this->load->view('salesorder/cancel', $data);
    }

    function do_cancel() {
        $salesorderid = $this->input->post('salesorderid');
        $reason_to_cancel = $this->input->post('reason_to_cancel');

        $data = array(
            'reason_to_cancel' => $reason_to_cancel,
            'cancel' => 'TRUE'
        );

        if ($this->model_salesorder->update($data, array("id" => $salesorderid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function cancel_detail($id) {
        $this->load->model('model_salesorderdetail');
        $data['salesorderdetailid'] = $id;
        $data['salesorderdetail'] = $this->model_salesorderdetail->select_by_id($id);
        $this->load->view('salesorderdetail/cancel', $data);
    }

    function do_cancel_detail() {
        $this->load->model('model_salesorderdetail');
        $salesorderdetailid = $this->input->post('salesorderdetailid');
        $ots = (int) $this->input->post('ots');
        $qty = (int) $this->input->post('qty');
        $reason_to_cancel = $this->input->post('reason_to_cancel');
        $new_ots = $ots - $qty;

        $data = array(
            'reason_to_cancel' => $reason_to_cancel,
            'ots' => $new_ots
        );

        if ($this->model_salesorderdetail->update($data, array("id" => $salesorderdetailid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_available_detail_by_customer($id, $customerid, $salesorderdetailid) {
        $query = "with t as (select 
        salesorderdetail.id,
        salesorder.sonumber,
        salesorderdetail.unitprice,
        salesorderdetail.discount,
        salesorderdetail.tax,
        salesorderdetail.amount,
        salesorderdetail.total_amount,
        (case 
        when salesorderdetail.id = $salesorderdetailid then 
                (salesorderdetail.invoice_ots + (select qty from salesinvoicedetail where id=$id)::integer) 
        else salesorderdetail.invoice_ots
        end) as invoice_ots,
        model.code modelcode,
        model.name modelname
        from 
        salesorderdetail join salesorder on salesorderdetail.salesorderid=salesorder.id 
        join model on salesorderdetail.modelid=model.id 
        where salesorder.orderby=$customerid and salesorderdetail.invoice_ots > 0 
        or salesorderdetail.id=$salesorderdetailid) select t.*,t.invoice_ots as si_temp_ots from t;";
        //echo $query;
        echo $this->model_salesorderdetail->get($query);
    }

    function revision($salesorderid) {
        $data['salesorderid'] = $salesorderid;
        $this->load->view('salesorder/revision', $data);
    }

    function do_revision() {
        $salesorderid = $this->input->post('salesorderid');
        $remark = $this->input->post('remark');
        if ($this->model_salesorder->do_revision($salesorderid, $remark)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function save_down_payment($salesorderid) {
        $data = array(
            "down_payment_date" => $this->input->post('down_payment_date'),
            "down_payment_nominal" => (double) $this->input->post('down_payment_nominal')
        );

        if ($this->model_salesorder->update($data, array("id" => $salesorderid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function prints($salesorderid, $type) {
        $id = $salesorderid;
        $this->load->library('component');
        $this->load->model('model_company');
        $data['type'] = $type;
        $data['company'] = $this->model_company->select();
        $data['salesorder'] = $this->model_salesorder->select_by_id($id);
        $data['salesorderdetail'] = $this->model_salesorderdetail->select_by_sales_order_id($id);
        $this->load->view('salesorder/print', $data);
    }

    function history() {
        $this->load->view('salesorder/history');
    }

    function history_get() {
        $query = "
                with t as (
                select 
                salesorderdetail.id,
                salesorder.date,
                salesorder.sonumber,
                salesorder.orderby customerid,
                customer.name customer,
                salesorderdetail.qty,
                salesorderdetail.unitprice price,
                (salesorderdetail.qty * salesorderdetail.unitprice) total_price,
                bankaccount.currency,
                model.code itemcode,
                model.name itemdescription,
                (salesorderdetail_get_count_shipped(salesorderdetail.id)) qty_ship
                from 
                salesorderdetail
                join model on salesorderdetail.modelid=model.id
                join salesorder on salesorderdetail.salesorderid=salesorder.id
                join customer on salesorder.orderby=customer.id
                left join bankaccount on salesorder.bankaccountid=bankaccount.id
                ) select t.*,(t.qty - t.qty_ship) balance_qty from t
                where true
            ";
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and t.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and t.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and t.date = '" . $dateto . "'";
        }

        $sonumber = $this->input->post('sonumber');

        if (!empty($sonumber)) {
            $query .= " and t.sonumber ilike '%$sonumber%'";
        }
        $item = $this->input->post('item');
        if (!empty($item)) {
            $query .= " and (t.code ilike '%$item%' or t.name ilike '%$item%')";
        }
        $customerid = $this->input->post('customerid');
        if (!empty($customerid)) {
            $query .= " and t.customerid=$customerid ";
        }

        //$query .= " order by t.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
//        echo $query;
        echo $this->model_salesorder->get($query);
    }

    function detail_edit_finishing($salesorderdetailid) {
        $data['salesorderdetailid'] = $salesorderdetailid;
        $this->load->view('salesorderdetail/edit_finishing', $data);
    }

    function detail_get_finishingseen($salesorderdetaild) {
        $query = "
            select 
            salesorderdetailfinishingseen.*,
            modelfinishingseen.description,
            finishingtype.name finishingtypename
            from salesorderdetailfinishingseen
            join modelfinishingseen on salesorderdetailfinishingseen.finishingseenid=modelfinishingseen.id
            join finishingtype on salesorderdetailfinishingseen.finishingtypeid=finishingtype.id 
            where salesorderdetailfinishingseen.salesorderdetailid=$salesorderdetaild
            order by salesorderdetailfinishingseen.id asc
        ";
        echo $this->model_salesorder->get($query);
    }

    function detail_get_finishingtop($salesorderdetaild) {
        $query = "
            select 
            salesorderdetailfinishingtop.*,
            finishingtop.description,
            finishingtype.name finishingtypename
            from salesorderdetailfinishingtop
            join finishingtop on salesorderdetailfinishingtop.finishingtopid=finishingtop.id
            join finishingtype on salesorderdetailfinishingtop.finishingtypeid=finishingtype.id 
            where salesorderdetailfinishingtop.salesorderdetailid=$salesorderdetaild 
            order by salesorderdetailfinishingtop.id asc
        ";
        echo $this->model_salesorder->get($query);
    }

    function detail_get_finishingunseen($salesorderdetaild) {
        $query = "
            select 
            salesorderdetailfinishingunseen.*,
            modelfinishingunseen.description,
            finishingtype.name finishingtypename
            from salesorderdetailfinishingunseen
            join modelfinishingunseen on salesorderdetailfinishingunseen.finishingunseenid=modelfinishingunseen.id
            join finishingtype on salesorderdetailfinishingunseen.finishingtypeid=finishingtype.id 
            where salesorderdetailfinishingunseen.salesorderdetailid=$salesorderdetaild
            order by salesorderdetailfinishingunseen.id asc
        ";
        echo $this->model_salesorder->get($query);
    }

    function detail_update_finishing() {
        $seen = $this->input->post('seen');
        $top = $this->input->post('top');
        $unseen = $this->input->post('unseen');

        $err_message = "";

        if (!empty($seen)) {
            for ($i = 0; $i < count($seen); $i++) {
                list($id, $finishingtypeid) = explode("#", $seen[$i]);
                if (!$this->model_salesorderdetail->finishing_seen_update(array("finishingtypeid" => $finishingtypeid), array("id" => $id))) {
                    $err_message = json_encode(array('msg' => $this->db->_error_message()));
                }
            }
        }

        if (!empty($unseen)) {
            for ($i = 0; $i < count($unseen); $i++) {
                list($id, $finishingtypeid) = explode("#", $unseen[$i]);
                if (!$this->model_salesorderdetail->finishing_unseen_update(array("finishingtypeid" => $finishingtypeid), array("id" => $id))) {
                    $err_message = json_encode(array('msg' => $this->db->_error_message()));
                }
            }
        }

        if (!empty($top)) {
            for ($i = 0; $i < count($top); $i++) {
                list($id, $finishingtypeid) = explode("#", $top[$i]);
                if (!$this->model_salesorderdetail->finishing_top_update(array("finishingtypeid" => $finishingtypeid), array("id" => $id))) {
                    $err_message = json_encode(array('msg' => $this->db->_error_message()));
                }
            }
        }

        if ($err_message == "") {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $err_message));
        }
    }

    function detail_edit_specification($salesorderdetailid) {
        $data["salesorderdetailid"] = $salesorderdetailid;
        $this->load->view('salesorderdetail/edit_specification', $data);
    }

    function detail_update_specification($salesorderdetailid) {
        $data = array(
            "accessoriescode" => $this->input->post('accessoriescode'),
            "fabriccode" => $this->input->post('fabriccode'),
            "finishingcode" => $this->input->post('finishingcode'),
            "foamcode" => $this->input->post('foamcode'),
            "furringcode" => $this->input->post('furringcode'),
            "interlinercode" => $this->input->post('interlinercode'),
            "materialcode" => $this->input->post('materialcode'),
            "mirrorglasscode" => $this->input->post('mirrorglasscode'),
            "topcode" => $this->input->post('topcode')
        );

        $msg = "";
        $this->db->trans_start();
        if (!$this->model_salesorderdetail->update($data, array("id" => $salesorderdetailid))) {
            $msg = $this->db->_error_message();
        } else {
            if (!$this->db->update('joborderitem', $data, array("salesorderdetailid" => $salesorderdetailid))) {
                $msg = $this->db->_error_message();
            }
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            // generate an error... or use the log_message() function to log your error
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $msg));
        }
    }

    function detail_upholstry($salesorderdetailid, $modelid) {
        $data['salesorderdetailid'] = $salesorderdetailid;
        $data['modelid'] = $modelid;
        $this->load->view('salesorderdetail/upholstry', $data);
    }

    function detail_get_upholstry($salesorderdetailid, $modelid) {
        $query = "
          with t as (
            select
            upholstry.id upholstryid,
            upholstry.modelid,
            upholstry.description,
            upholstry.itemid upholstry_itemid,
            upholstry.unitcode upholstry_unitcode,
            item.code std_mat_item_code,
            item.description std_mat_item_description,
            upholstry.total_qty,
            upholstry.unitcode 
            from upholstry 
            join item on upholstry.itemid=item.id 
            where upholstry.modelid = $modelid 
            and upholstry.id not in (select upholstryid from so_detail_upholstry_delete where salesorderdetailid=$salesorderdetailid)
    ) select t.*,t_sod_uph.so_detail_upholstry_itemid,t_sod_uph.upholstry_unitcode,t_sod_uph.upd_mat_itemcode,t_sod_uph.upd_mat_item_description 
    from t left join (
	    select 
	    so_detail_upholstry.salesorderdetailid,
	    so_detail_upholstry.modelid,
	    so_detail_upholstry.upholstryid,
	    so_detail_upholstry.itemid so_detail_upholstry_itemid,
	    so_detail_upholstry.unitcode upholstry_unitcode,
	    item.code upd_mat_itemcode,
	    item.description upd_mat_item_description
	    from so_detail_upholstry 
	    join item on so_detail_upholstry.itemid=item.id 
	    where so_detail_upholstry.salesorderdetailid=$salesorderdetailid
    ) t_sod_uph on t.upholstryid=t_sod_uph.upholstryid
        ";
        echo $this->model_salesorder->get($query);
    }

    function detail_edit_upholstry() {
        $this->load->view('salesorderdetail/edit_upholstry');
    }

    function detail_update_upholstry($salesorderdetailid, $modelid, $upholstryid) {
        $itemid = $this->input->post('itemid');
        $unitcode = $this->input->post('unitcode');
        if ($this->model_salesorderdetail->update_upholstry($salesorderdetailid, $modelid, $upholstryid, $itemid, $unitcode)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function permanent_delete_upholstry() {
        $data = array(
            'salesorderdetailid' => $this->input->post('salesorderdetailid'),
            'modelid' => $this->input->post('modelid'),
            'upholstryid' => $this->input->post('upholstryid'),
            'itemid' => $this->input->post('itemid'),
            'unitcode' => $this->input->post('unitcode')
        );
        if ($this->db->insert("so_detail_upholstry_delete", $data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_delete_upholstry() {
        $salesorderdetailid = $this->input->post('salesorderdetailid');
        $modelid = $this->input->post('modelid');
        $upholstryid = $this->input->post('upholstryid');
        if ($this->db->delete("so_detail_upholstry", array("salesorderdetailid" => $salesorderdetailid, 'modelid' => $modelid, 'upholstryid' => $upholstryid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function restore_upholstry() {
        $salesorderdetailid = $this->input->post('salesorderdetailid');
        if ($this->db->delete("so_detail_upholstry_delete", array('salesorderdetailid' => $salesorderdetailid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_preview($salesorderid, $type) {
        $id = $salesorderid;
        $this->load->library('component');
        $this->load->model('model_company');
        $data['type'] = $type;
        $data['company'] = $this->model_company->select();
        $data['salesorder'] = $this->model_salesorder->select_by_id($id);
        $data['salesorderdetail'] = $this->model_salesorderdetail->select_by_sales_order_id($id);
        $this->load->view('salesorder/detail_preview', $data);
    }

    function history_print() {
        $query = "
                with t as (
                select 
                salesorderdetail.id,
                salesorder.date,
                salesorder.sonumber,
                salesorder.orderby customerid,
                customer.name customer,
                salesorderdetail.qty,
                salesorderdetail.unitprice price,
                (salesorderdetail.qty * salesorderdetail.unitprice) total_price,
                bankaccount.currency,
                model.code itemcode,
                model.name itemdescription,
                finishing.description finishing,
                model.itemsize_mm_w width,
                model.itemsize_mm_d depth,
                model.itemsize_mm_h height,
                (salesorderdetail_get_count_shipped(salesorderdetail.id)) qty_ship
                from 
                salesorderdetail
                join model on salesorderdetail.modelid=model.id
                join salesorder on salesorderdetail.salesorderid=salesorder.id
                join customer on salesorder.orderby=customer.id
                left join bankaccount on salesorder.bankaccountid=bankaccount.id
                left join finishing on salesorderdetail.finishingcode=finishing.code
                ) select t.*,(t.qty - t.qty_ship) balance_qty from t
                where true
            ";
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and t.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and t.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and t.date = '" . $dateto . "'";
        }

        $sonumber = $this->input->post('sonumber');

        if (!empty($sonumber)) {
            $query .= " and t.sonumber ilike '%$sonumber%'";
        }
        $item = $this->input->post('item');
        if (!empty($item)) {
            $query .= " and (t.code ilike '%$item%' or t.name ilike '%$item%')";
        }
        $customerid = $this->input->post('customerid');
        if (!empty($customerid)) {
            $query .= " and t.customerid=$customerid ";
        }

        $query .= " order by t.id desc ";
        $data['datefrom'] = $datefrom;
        $data['dateto'] = $dateto;
        $this->load->model('model_company');
        $data['company'] = $this->model_company->select();
        $data['item'] = $this->db->query($query)->result();
        $this->load->view('salesorder/history_print', $data);
    }

    function history_excel() {
        $query = "
                with t as (
                select 
                salesorderdetail.id,
                salesorder.date,
                salesorder.sonumber,
                salesorder.orderby customerid,
                customer.name customer,
                salesorderdetail.qty,
                salesorderdetail.unitprice price,
                (salesorderdetail.qty * salesorderdetail.unitprice) total_price,
                bankaccount.currency,
                model.code itemcode,
                model.name itemdescription,
                finishing.description finishing,
                model.itemsize_mm_w width,
                model.itemsize_mm_d depth,
                model.itemsize_mm_h height,
                (salesorderdetail_get_count_shipped(salesorderdetail.id)) qty_ship
                from 
                salesorderdetail
                join model on salesorderdetail.modelid=model.id
                join salesorder on salesorderdetail.salesorderid=salesorder.id
                join customer on salesorder.orderby=customer.id
                left join bankaccount on salesorder.bankaccountid=bankaccount.id
                left join finishing on salesorderdetail.finishingcode=finishing.code
                ) select t.*,(t.qty - t.qty_ship) balance_qty from t
                where true
            ";
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and t.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and t.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and t.date = '" . $dateto . "'";
        }

        $sonumber = $this->input->post('sonumber');

        if (!empty($sonumber)) {
            $query .= " and t.sonumber ilike '%$sonumber%'";
        }
        $item_desc = $this->input->post('item');
        if (!empty($item_desc)) {
            $query .= " and (t.code ilike '%$item_desc%' or t.name ilike '%$item_desc%')";
        }
        $customerid = $this->input->post('customerid');
        if (!empty($customerid)) {
            $query .= " and t.customerid=$customerid ";
        }

        $query .= " order by t.id desc ";
        $this->load->model('model_company');
        $company = $this->model_company->select();
        $item = $this->db->query($query)->result();
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Sales Order History');

        $this->excel->getActiveSheet()->setCellValue('A2', $company->name);
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A2:L2');
        $this->excel->getActiveSheet()->getRowDimension(2)->setRowHeight(18);

        $this->excel->getActiveSheet()->setCellValue('A3', $company->address);
        $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->mergeCells('A3:L3');
        $this->excel->getActiveSheet()->getRowDimension(3)->setRowHeight(36);

        $this->excel->getActiveSheet()->setCellValue('A4', 'Sales Order History');
        $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A4:L4');
        $this->excel->getActiveSheet()->getRowDimension(4)->setRowHeight(30);

        $this->excel->getActiveSheet()->setCellValue('A5', "From: " . date('d M Y', strtotime($datefrom)) . " To: " . date('d M Y', strtotime($dateto)));
        $this->excel->getActiveSheet()->getStyle('A5')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A5:L5');
        $this->excel->getActiveSheet()->getRowDimension(4)->setRowHeight(20);

        $this->excel->getActiveSheet()->getRowDimension(7)->setRowHeight(22);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
        $this->excel->getActiveSheet()->setCellValue('A7', 'No');
        $this->excel->getActiveSheet()->getStyle('A7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $this->excel->getActiveSheet()->setCellValue('B7', 'Customer Name');
        $this->excel->getActiveSheet()->getStyle('B7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('B7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
        $this->excel->getActiveSheet()->setCellValue('C7', 'SO NO');
        $this->excel->getActiveSheet()->getStyle('C7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('C7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('C7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(9);
        $this->excel->getActiveSheet()->setCellValue('D7', 'Order Date');
        $this->excel->getActiveSheet()->getStyle('D7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('D7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('D7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
        $this->excel->getActiveSheet()->setCellValue('E7', 'Item Code');
        $this->excel->getActiveSheet()->getStyle('E7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('E7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $this->excel->getActiveSheet()->setCellValue('F7', 'Item Description');
        $this->excel->getActiveSheet()->getStyle('F7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('F7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('F7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $this->excel->getActiveSheet()->setCellValue('G7', 'Finishing');
        $this->excel->getActiveSheet()->getStyle('G7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('G7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('G7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(6);
        $this->excel->getActiveSheet()->setCellValue('H7', 'W');
        $this->excel->getActiveSheet()->getStyle('H7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('H7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('H7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(6);
        $this->excel->getActiveSheet()->setCellValue('I7', 'D');
        $this->excel->getActiveSheet()->getStyle('I7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('I7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('I7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(6);
        $this->excel->getActiveSheet()->setCellValue('J7', 'H');
        $this->excel->getActiveSheet()->getStyle('J7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('J7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('J7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(6);
        $this->excel->getActiveSheet()->setCellValue('K7', 'Qty');
        $this->excel->getActiveSheet()->getStyle('K7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('K7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('K7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(9);
        $this->excel->getActiveSheet()->setCellValue('L7', 'Unit Price');
        $this->excel->getActiveSheet()->getStyle('L7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('L7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('L7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(9);
        $this->excel->getActiveSheet()->setCellValue('M7', 'Total Price');
        $this->excel->getActiveSheet()->getStyle('M7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('M7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('M7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(9);
        $this->excel->getActiveSheet()->setCellValue('N7', 'Currency');
        $this->excel->getActiveSheet()->getStyle('N7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('N7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('N7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(9);
        $this->excel->getActiveSheet()->setCellValue('O7', 'Qty Shipped');
        $this->excel->getActiveSheet()->getStyle('O7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('O7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('O7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(9);
        $this->excel->getActiveSheet()->setCellValue('P7', 'Balance Qty');
        $this->excel->getActiveSheet()->getStyle('P7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('P7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('P7')->getFont()->setBold(true);

        $row = 7;
        if (!empty($item)) {
            $row++;
            $no = 1;
            foreach ($item as $result) {
                $this->excel->getActiveSheet()->getRowDimension($row)->setRowHeight(11);
                $this->excel->getActiveSheet()->setCellValue('A' . $row, $no++);
                $this->excel->getActiveSheet()->getStyle('A' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('B' . $row, $result->customer);
                $this->excel->getActiveSheet()->getStyle('B' . $row)->getFont()->setSize(8);

                $this->excel->getActiveSheet()->setCellValue('C' . $row, $result->sonumber);
                $this->excel->getActiveSheet()->getStyle('C' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('C' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('D' . $row, date('d M Y', strtotime($result->date)));
                $this->excel->getActiveSheet()->getStyle('D' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('D' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('E' . $row, $result->itemcode);
                $this->excel->getActiveSheet()->getStyle('E' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('E' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                $this->excel->getActiveSheet()->setCellValue('F' . $row, $result->itemdescription);
                $this->excel->getActiveSheet()->getStyle('F' . $row)->getFont()->setSize(8);

                $this->excel->getActiveSheet()->setCellValue('G' . $row, $result->finishing);
                $this->excel->getActiveSheet()->getStyle('G' . $row)->getFont()->setSize(8);

                $this->excel->getActiveSheet()->setCellValue('H' . $row, $result->width);
                $this->excel->getActiveSheet()->getStyle('H' . $row)->getFont()->setSize(8);

                $this->excel->getActiveSheet()->setCellValue('I' . $row, $result->depth);
                $this->excel->getActiveSheet()->getStyle('I' . $row)->getFont()->setSize(8);

                $this->excel->getActiveSheet()->setCellValue('J' . $row, $result->height);
                $this->excel->getActiveSheet()->getStyle('J' . $row)->getFont()->setSize(8);

                $this->excel->getActiveSheet()->setCellValue('K' . $row, $result->qty);
                $this->excel->getActiveSheet()->getStyle('K' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('K' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('L' . $row, number_format($result->price, 2, '.', ','));
                $this->excel->getActiveSheet()->getStyle('L' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('L' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $this->excel->getActiveSheet()->setCellValue('M' . $row, number_format($result->total_price, 2, '.', ','));
                $this->excel->getActiveSheet()->getStyle('M' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('M' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $this->excel->getActiveSheet()->setCellValue('N' . $row, $result->currency);
                $this->excel->getActiveSheet()->getStyle('N' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('N' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('O' . $row, $result->qty_ship);
                $this->excel->getActiveSheet()->getStyle('O' . $row)->getFont()->setSize(8);

                $this->excel->getActiveSheet()->setCellValue('P' . $row, $result->balance_qty);
                $this->excel->getActiveSheet()->getStyle('P' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('P' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $row++;
            }
        }

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $this->excel->getActiveSheet()->getStyle('A7:P' . $row)->applyFromArray($styleArray);


        $filename = 'file.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

}
