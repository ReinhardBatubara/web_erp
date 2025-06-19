<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchaseorder
 *
 * @author hp
 */
class purchaseorder extends CI_Controller {

//put your code here
    var $option_view;

    public function __construct() {
        parent::__construct();
        $this->load->model('model_purchaseorder');
        $this->load->model('model_purchaseorderdetail');
        $this->load->model('model_menuaccess');
        $this->option_view = $this->model_menuaccess->get_option_view($this->session->userdata('id'), 'purchaseorder');
    }

    function index() {
        $this->load->model('model_department');
        $this->load->model('model_currency');
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "purchaseorder"));
        $data['department'] = $this->model_department->selectAllResult();
        $data['currency'] = $this->model_currency->selectAllResult();
        $this->load->view('purchaseorder/view', $data);
    }

    function get() {

        $query = "
            with purchaseorder as (
                    select 
                    purchaseorder.*,
                    purchaserequest.number purchaserequest,
                    purchaserequest.departmentid,
                    department.name department,
                    vendor.name vendor,
                    ((now()::date - purchaseorder.date::date)) date_diff,
                    (case when purchaseorder.status = 0 then 'New' 
                        when purchaseorder.status = 1 then 'Open' 
                        when purchaseorder.status = 2 then 'Finish'
                        when purchaseorder.status = 3 then 'Close' 
                    end) label_status
                    from purchaseorder 
                    left join purchaserequest on purchaseorder.purchaserequestid=purchaserequest.id 
                    left join department on purchaserequest.departmentid=department.id
                    left join vendor on purchaseorder.vendorid=vendor.id
            ) select purchaseorder.* from purchaseorder where true 
        ";


        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $number = $this->input->post('number');
        $pr = $this->input->post('pr');
        $departmentid = $this->input->post('departmentid');
        $vendorid = $this->input->post('vendorid');
        $status = $this->input->post('status');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and purchaseorder.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and purchaseorder.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and purchaseorder.date = '" . $dateto . "'";
        }if ($number != "") {
            $query .= " and purchaseorder.number ilike '%" . $number . "%'";
        }if (!empty($departmentid)) {
            $query .= " and purchaseorder.departmentid = " . $departmentid;
        }if (!empty($pr)) {
            $query .= " and purchaseorder.purchaserequest ilike '%" . $pr . "%'";
        }if (!empty($vendorid)) {
            $query .= " and purchaseorder.vendorid = " . $vendorid;
        }if ($status != "") {
            $query .= " and purchaseorder.status=" . $status;
        }

        if ($this->session->userdata('id') != 'admin') {
            if ($this->option_view == 0) {
                $query .= " and purchaseorder.create_by='" . $this->session->userdata('id') . "'";
            }
        }
        $sort = $this->input->post('sort');
        $order = $this->input->post('order');

        $query .= " order by purchaseorder.$sort $order ";
//        echo "<pre>$query</pre>";
        echo $this->model_purchaseorder->get($query);
    }

    function get_for_combo() {
        $query = "select 
                purchaseorder.*,
                purchaserequest.number purchaserequest,
                purchaserequest.departmentid,
                department.name department,
                purchaserequest.vendorid,
                vendor.name vendor,
                purchaserequest.currency,
                purchaserequest.total,
                purchaserequest.discount,
                purchaserequest.tax,
                purchaserequest.amount
                from purchaseorder 
                join purchaserequest on purchaseorder.purchaserequestid=purchaserequest.id 
                join department on purchaserequest.departmentid=department.id
                join vendor on purchaserequest.vendorid=vendor.id where purchaseorder.finish=TRUE";
        echo $this->model_purchaseorder->get_for_combo($query);
    }

    function get_available_to_receive_by_warehouse() {
        $query = "select 
                distinct(purchaseorder.id),
                purchaseorder.number,
                purchaseorder.date,
                vendor.name vendor
                from purchaseorderdetail 
                join purchaserequestdetail on 
                purchaseorderdetail.purchaserequestdetailid=purchaserequestdetail.id 
                left join item on purchaserequestdetail.itemid=item.id 
                join purchaseorder on purchaseorderdetail.purchaseorderid=purchaseorder.id
                join purchaserequest on purchaseorder.purchaserequestid=purchaserequest.id
                join vendor on purchaseorder.vendorid=vendor.id
                where purchaseorder.status=1 and
                purchaseorderdetail.qty_ots > 0";
        if ($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') != -1) {
            $query .= " and (purchaserequestdetail.itemid in 
                                (select distinct(itemid) from itemwarehousestock where warehouseid=" . $this->session->userdata('optiongroup') . ")
                             or purchaserequestdetail.itemid is null)";
        }

//        echo $query."<br/>";
        $q = $this->input->post('q');
        if (!empty($q)) {
            $query.= " and purchaseorder.number ilike '%" . $q . "%' ";
        }
        $query .= " order by purchaseorder.date desc ";
        echo $this->model_purchaseorder->get_available_to_receive_by_warehouse($query);
    }

    function get_vendor_ots_delivery() {
        $temp_query = "
                select 
                purchaseorder.vendorid
                from purchaseorderdetail 
                join purchaserequestdetail on 
                purchaseorderdetail.purchaserequestdetailid=purchaserequestdetail.id 
                join purchaseorder on purchaseorderdetail.purchaseorderid=purchaseorder.id
                where purchaseorder.status=1 and
                purchaseorderdetail.qty_ots > 0
        ";
        if ($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') != -1) {
            $temp_query .= " and (purchaserequestdetail.itemid in 
                                (select distinct(itemid) from itemwarehousestock where warehouseid=" . $this->session->userdata('optiongroup') . ")
                             or purchaserequestdetail.itemid is null)";
        }
        $temp_query .= " group by purchaseorder.vendorid";



        $query = "
          with t as (
            $temp_query
          ) select t.vendorid id,vendor.code vendor_code,vendor.name vendor_name 
            from t join vendor on t.vendorid=vendor.id where true 
        ";

        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (vendor.code ilike '%$q%' or vendor.name ilike '%$q%')";
        }

        $result = array();
        $data = "";

        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        echo $data;
    }

    function save($purchaserequestid) {
        //$purchaserequestid = $this->input->post('id');
        $number = $this->input->post('po_number');
        $date = $this->input->post('po_date');
        $terms = $this->input->post('terms');
        $fob = $this->input->post('fob');
        $shipto = $this->input->post('shipto');
        $ship_via = $this->input->post('ship_via');
        $expected_date = $this->input->post('expected_date');
        $vendor_is_taxable = $this->input->post('vendor_is_taxable');
        $rate = $this->input->post('rate');
        $description = $this->input->post('description');

        $data = array(
            'purchaserequestid' => $purchaserequestid,
            'number' => $number,
            'date' => $date,
            'shipto' => $shipto,
            'ship_via' => $ship_via,
            'terms' => $terms,
            'fob' => $fob,
            'expected_date' => $expected_date,
            'vendor_is_taxable' => $vendor_is_taxable,
            'rate' => $rate,
            'description' => $description,
            'create_by' => $this->session->userdata('id')
        );
        if ($this->model_purchaseorder->insert($data)) {
            $poid = $this->model_purchaseorder->get_last_id();
            if ($this->model_purchaseorder->move_pr_item_to_po($purchaserequestid, $poid)) {
                echo json_encode(array('success' => true));
            } else {
                $this->model_purchaseorder->delete(array("id" => $poid));
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {

        $expected_date = $this->input->post('expected_date');

        $data = array(
            "date" => $this->input->post('date'),
            "terms" => $this->input->post('terms'),
            "fob" => $this->input->post('fob'),
            "shipto" => $this->input->post('shipto'),
            "ship_via" => $this->input->post('ship_via'),
            "expected_date" => empty($expected_date) ? null : $expected_date,
            "vendor_is_taxable" => $this->input->post('vendor_is_taxable'),
            "rate" => (int) $this->input->post('rate'),
            "description" => $this->input->post('description'),
        );

        if ($this->model_purchaseorder->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function create() {
        $purchaserequestid = $this->input->post('purchaserequestid');
        $create_by = $this->session->userdata('id');
        if ($this->model_purchaseorder->create($purchaserequestid, $create_by)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function prints($id, $type) {
        $this->load->library('component');
        $this->load->model('model_company');
        $this->load->model('model_purchaseorderdetail');
        $data['company'] = $this->model_company->select();
        $data['purchaseorder'] = $this->model_purchaseorder->select_result_by_id($id);
        $data['purchaseorderdetail'] = $this->model_purchaseorderdetail->select_result_by_purchaseorder_id($id);
        $this->load->view('purchaseorder/print', $data);
    }

    function open() {
        $data = array(
            "status" => $this->input->post('status')
        );
        $message = "";
        $this->db->trans_start();
        if ($this->model_purchaseorder->update($data, array("id" => $this->input->post('id')))) {
            if (!$this->model_purchaseorderdetail->open_close_by_purchase_order_id($this->input->post('id'), $this->input->post('status'))) {
                $message .= $this->db->_error_message();
            }
        } else {
            $message .= $this->db->_error_message();
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $message));
        }
    }

    function search_form() {
        $this->load->model('model_department');
        $data['department'] = $this->model_department->selectAllResult();
        $this->load->view('purchaseorder/search_form', $data);
    }

    function outstanding_item() {
        $this->load->view('purchaseorder/outstanding_receive');
    }

    function get_outstanding_item() {
        $query = "select 
                purchaseorderdetail.*,
                purchaserequestdetail.itemid,
                item.code item_code,
                item.description item_description,
                purchaserequestdetail.unitcode,
                purchaseorder.number po_number,
                purchaserequest.number pr_number,
                purchaseorder.vendorid,
                vendor.name vendor
                from purchaseorderdetail
                join purchaserequestdetail on purchaseorderdetail.purchaserequestdetailid=purchaserequestdetail.id
                join purchaseorder on purchaseorderdetail.purchaseorderid=purchaseorder.id
                join purchaserequest on purchaseorder.purchaserequestid=purchaserequest.id
                join item on purchaserequestdetail.itemid=item.id
                join vendor on purchaseorder.vendorid=vendor.id 
                where purchaseorder.status = 1";

        $item_code = $this->input->post('item_code');
        if (!empty($item_code)) {
            $query .= " and item.code ilike '%$item_code%'";
        }
        $item_description = $this->input->post('item_description');
        if (!empty($item_description)) {
            $query .= " and item.description ilike '%$item_description%'";
        }
        $po_number = $this->input->post('po_number');
        if (!empty($po_number)) {
            $query .= " and purchaseorder.number ilike '%$po_number%'";
        }
        $pr_number = $this->input->post('pr_number');
        if (!empty($pr_number)) {
            $query .= " and purchaserequest.number ilike '%$pr_number%'";
        }
        $vendorid = $this->input->post('vendorid');
        if (!empty($vendorid)) {
            $query .= " and purchaseorder.vendorid=" . $vendorid;
        }

        echo $this->model_purchaseorder->get_outstanding($query);
    }

    function print_outstanding_item() {
        $query = "select 
                purchaseorderdetail.*,
                purchaserequestdetail.itemid,
                item.code item_code,
                item.description item_description,
                purchaserequestdetail.unitcode,
                purchaseorder.number po_number,
                purchaserequest.number pr_number,
                purchaseorder.vendorid,
                vendor.name vendor
                from purchaseorderdetail
                join purchaserequestdetail on purchaseorderdetail.purchaserequestdetailid=purchaserequestdetail.id
                join purchaseorder on purchaseorderdetail.purchaseorderid=purchaseorder.id
                join purchaserequest on purchaseorder.purchaserequestid=purchaserequest.id
                join item on purchaserequestdetail.itemid=item.id
                join vendor on purchaseorder.vendorid=vendor.id 
                where purchaseorder.status = 1";

        $item_code = $this->input->post('item_code');
        if (!empty($item_code)) {
            $query .= " and item.code ilike '%$item_code%'";
        }
        $item_description = $this->input->post('item_description');
        if (!empty($item_description)) {
            $query .= " and item.description ilike '%$item_description%'";
        }
        $po_number = $this->input->post('po_number');
        if (!empty($po_number)) {
            $query .= " and purchaseorder.number ilike '%$po_number%'";
        }
        $pr_number = $this->input->post('pr_number');
        if (!empty($pr_number)) {
            $query .= " and purchaserequest.number ilike '%$pr_number%'";
        }
        $vendorid = $this->input->post('vendorid');
        if (!empty($vendorid)) {
            $query .= " and purchaseorder.vendorid=" . $vendorid;
        }

        $data['poitem'] = $this->db->query($query)->result();
        $this->load->view('purchaseorder/print_outstanding_receive', $data);
    }

    function outstanding() {
        $this->load->view('purchaseorder/outstanding');
    }

    function print_detail() {
        
    }

    function close_po_item() {
        $this->load->view('purchaseorder/close_po_item');
    }

    function print_report() {
        $query = "with pod as (
                select
                purchaseorderdetail.*,
                purchaseorder.number po_number,
                purchaseorder.date po_date,
                (department.code || ' - ' || department.name)  department,
                purchaserequest.number pr_number,
                purchaserequestdetail.vendorid, 
                purchaserequestdetail.itemid,
                item.code itemcode,
                item.description itemdescription,
                purchaserequestdetail.unitcode,
                purchaserequestdetail.qty request_qty,
                purchaserequestdetail.price,
                (purchaseorderdetail.qty * purchaserequestdetail.price) subtotal,
                purchaserequestdetail.currency,
                purchaserequestdetail.discount,
                purchaserequestdetail.ppn,
                purchaserequestdetail.amount,
                purchaserequestdetail.total,
                emp.name name_requested,
                itemgroup.name item_group,
                vendor.name vendor_name,
                purchaserequestdetail.materialrequisitiondetailid,
                materialrequisition.number mr_number,
                (purchaseorderdetail_get_receiving_status(purchaseorderdetail.id)) receive_status
                from purchaseorderdetail 
                join purchaserequestdetail on 
                purchaseorderdetail.purchaserequestdetailid=purchaserequestdetail.id 
                join item on purchaserequestdetail.itemid=item.id 
                join vendor on purchaserequestdetail.vendorid=vendor.id
                join purchaseorder on purchaseorderdetail.purchaseorderid=purchaseorder.id
                join purchaserequest on purchaserequestdetail.purchaserequestid=purchaserequest.id
                left join materialrequisitiondetail on purchaserequestdetail.materialrequisitiondetailid=materialrequisitiondetail.id
                left join materialrequisition on materialrequisitiondetail.materialrequisitionid=materialrequisition.id
                left join department on materialrequisition.departmentid=department.id
                left join employee emp on materialrequisition.requestedby=emp.id
                left join itemgroup on item.groupid=itemgroup.id
                where true
        ) select pod.* from pod where true ";

        $mr_number = $this->input->post('mr_number');
        if (!empty($mr_number)) {
            $query .= " and pod.mr_number ilike '%$mr_number%'";
        }

        $po_number = $this->input->post('po_number');
        if (!empty($po_number)) {
            $query .= " and pod.po_number ilike '%$po_number%'";
        }

        $pr_number = $this->input->post('pr_number');
        if (!empty($pr_number)) {
            $query .= " and pod.pr_number ilike '%$pr_number%'";
        }

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and (pod.code ilike '%" . $itemcode . "%' or pod.description ilike '%" . $itemcode . "%')";
        }

        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and pod.po_date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and pod.po_date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and pod.po_date = '" . $dateto . "'";
        }

        $departmentid = $this->input->post('departmentid');
        if (!empty($departmentid)) {
            $query .= " and pod.departmentid = " . $departmentid;
        }

        $vendorid = $this->input->post('vendorid');
        if (!empty($vendorid)) {
            $query .= " and pod.vendorid = " . $vendorid;
        }


        $currency = $this->input->post('currency');
        if (!empty($currency)) {
            $query .= " and pod.currency = '" . $currency . "'";
        }

        $po_status = $this->input->post('po_status');
        if ($po_status != "") {
            $query .= " and pod.status=" . $po_status;
        }

        $item_receive_status = $this->input->post('item_receive_status');
        $item_receive_status = (empty($item_receive_status)) ? "0" : $item_receive_status;
        if ($item_receive_status != "0") {
            if ($item_receive_status == "2") {
                $query .= " and pod.qty_ots > 0";
            } else {
                $query .= " and pod.qty_ots <= 0";
            }
        }
        $query .= " order by pod.id desc ";

        $this->load->model('model_company');
        $data['company'] = $this->model_company->select();
        $data['data'] = $this->db->query($query)->result();
        $this->load->view('purchaseorder/print_report', $data);
    }

    function change_vendor() {
        $this->load->view('purchaseorder/change_vendor');
    }

    function update_vendor() {
        $data = array(
            "vendorid" => $this->input->post('vendorid'),
            "currency" => $this->input->post('currency'),
            "change_vendor_remark" => $this->input->post('change_vendor_remark')
        );

        if ($this->model_purchaseorder->update($data, array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
