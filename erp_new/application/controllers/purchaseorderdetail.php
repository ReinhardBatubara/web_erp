<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchaseorderdetail
 *
 * @author hp
 */
class purchaseorderdetail extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_purchaseorderdetail');
    }

    function index() {
        $this->load->view('purchaseorder/view_by_item');
    }

    function get_all() {
        $query = "with pod as (
                select
                purchaseorderdetail.*,
                purchaseorder.number po_number,
                purchaseorder.date po_date,
                (department.code || ': ' || department.name)  department,
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
                vendor.name vendor,
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
                left join department on purchaserequest.departmentid=department.id
                left join materialrequisitiondetail on purchaserequestdetail.materialrequisitiondetailid=materialrequisitiondetail.id
                left join materialrequisition on materialrequisitiondetail.materialrequisitionid=materialrequisition.id
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

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');

        $query .= " order by pod.$sort $order ";

        //echo $query;
        echo $this->model_purchaseorderdetail->get($query);
    }

    function get() {

        $purchaseorderid = $this->input->post('purchaseorderid');
        if (empty($purchaseorderid)) {
            $purchaseorderid = 0;
        }

        $query = "select 
                purchaseorderdetail.*,t.purchaserequestid,t.itemid,
                t.vendorid,t.currency,t.price,t.discount,
                t.ppn,t.amount,t.unitcode,t.total,t.itemcode,
                t.itemdescription,
                (purchaseorderdetail.qty * t.price) subtotal,        
                (purchaseorderdetail_get_receiving_status(purchaseorderdetail.id)) receive_status
                from purchaseorderdetail
                join (
                        select * from purchaserequestdetail_get()
                ) t 
                on purchaseorderdetail.purchaserequestdetailid=t.id 
                where purchaseorderdetail.purchaseorderid=$purchaseorderid";

        $itemcode = $this->input->post('itemcode');
        $description = $this->input->post('description');

        if ($itemcode != "") {
            $query .= " and t.itemcode ilike '%" . $itemcode . "%' ";
        }if ($description != "") {
            $query .= " and t.itemdescription ilike '%" . $description . "%' ";
        }

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        //echo $query;
        echo $this->model_purchaseorderdetail->get($query);
    }

    function get_available_to_receive_by_warehouse() {

        $purchaseorderid = $this->input->post('purchaseorderid');
        if (empty($purchaseorderid)) {
            $purchaseorderid = 0;
        }
        $query = "select 
                purchaseorderdetail.*,t.purchaserequestid,t.itemid,
                t.vendorid,t.currency,t.price,t.discount,
                t.ppn,t.amount,t.unitcode,t.total,t.itemcode,
                t.itemdescription
                from purchaseorderdetail
                join (
                        select * from purchaserequestdetail_get()
                ) t 
                on purchaseorderdetail.purchaserequestdetailid=t.id 
                where purchaseorderdetail.purchaseorderid=" . $purchaseorderid . " 
                    and purchaseorderdetail.qty_ots > 0";
        if ($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') != -1) {
            $query .= " and (t.itemid in (select distinct(itemid) from itemwarehousestock where warehouseid=" . $this->session->userdata('optiongroup') . ") 
                         or t.itemid=0)";
        }
        //echo $query;
        echo $this->model_purchaseorderdetail->get($query);
    }

    function get_not_deliver_by_vendor($vendorid) {
        $query = "
                select 
                purchaseorderdetail.*,
                t.purchaserequestid,
                t.itemid,
                t.vendorid,
                t.currency,
                t.price,
                t.discount,
                t.ppn,t.amount,t.unitcode,t.total,t.itemcode,
                t.itemdescription,
                po.number po_no,
                po.date po_date
                from purchaseorderdetail
                join (
                        select * from purchaserequestdetail_get()
                ) t 
                on purchaseorderdetail.purchaserequestdetailid=t.id
                join purchaseorder po on purchaseorderdetail.purchaseorderid=po.id 
                where t.vendorid=$vendorid 
                and purchaseorderdetail.qty_ots > 0 and purchaseorderdetail.status='open'
            ";
        if ($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') != -1) {
            $query .= " and (t.itemid in (select distinct(itemid) from itemwarehousestock where warehouseid=" . $this->session->userdata('optiongroup') . ") 
                         or t.itemid=0)";
        }
        //echo $query;
        echo $this->model_purchaseorderdetail->get($query);
    }

    function search_form() {
        $this->load->view('purchaseorder/detail_search_form');
    }

    function search_form_po_by_item() {
        $this->load->model('model_department');
        $this->load->model('model_currency');
        $data['department'] = $this->model_department->selectAllResult();
        $data['currency'] = $this->model_currency->selectAllResult();
        $this->load->view('purchaseorder/search_form_po_by_item', $data);
    }

    function change_status() {
        $poitem = $this->input->post('poitem');
        $status = $this->input->post('status');
        $data = array();
        for ($i = 0; $i < count($poitem); $i++) {
            $data[] = array(
                "id" => $poitem[$i],
                "status" => $status
            );
        }
        if ($this->model_purchaseorderdetail->update_batch($data, "id")) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function do_close() {
        $poitem = $arr_id = "ARRAY[" . implode(",", $this->input->post('poitem')) . "]";
        $status = $this->input->post('status');
        $option_price = $this->input->post('option_price');
        if ($this->model_purchaseorderdetail->do_close($poitem, $status, $option_price)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
