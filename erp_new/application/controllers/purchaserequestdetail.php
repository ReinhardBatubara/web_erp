<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchaserequestdetail
 *
 * @author hp
 */
class purchaserequestdetail extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_purchaserequestdetail');
    }

    function index() {
        $this->load->view('purchaserequest/view_by_item');
    }

    function get_by_item() {
        $query = "with pr_item as (
                    select 
                    purchaserequestdetail.*,
                    purchaserequest.number pr_number,
                    purchaserequest.date pr_date,
                    purchaserequest.departmentid,
                    vendor.name vendor,
                    item.code itemcode,
                    item.description itemdescription,
                    materialrequisition.number mr_number,
                    (department.code || ': ' || department.name)  department
                    from purchaserequestdetail 
                    left join item on purchaserequestdetail.itemid=item.id
                    join purchaserequest on purchaserequestdetail.purchaserequestid=purchaserequest.id
                    left join department on purchaserequest.departmentid=department.id
                    left join vendor on purchaserequestdetail.vendorid=vendor.id 
                    left join materialrequisitiondetail on purchaserequestdetail.materialrequisitiondetailid=materialrequisitiondetail.id
                    left join materialrequisition on materialrequisitiondetail.materialrequisitionid=materialrequisition.id
            ) select pr_item.* from pr_item where true ";

        $mr_number = $this->input->post('mr_number');
        if (!empty($mr_number)) {
            $query .= " and pr_item.mr_number ilike '%$mr_number%'";
        }

        $pr_number = $this->input->post('pr_number');
        if (!empty($pr_number)) {
            $query .= " and pr_item.pr_number ilike '%$pr_number%'";
        }

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and pr_item.itemcode ilike '%" . $itemcode . "%' ";
        }

        $itemdescription = $this->input->post('itemdescription');
        if (!empty($itemdescription)) {
            $query .= " and pr_item.itemdescription ilike '%" . $itemdescription . "%' ";
        }

        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and pr_item.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and pr_item.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and pr_item.date = '" . $dateto . "'";
        }

        $departmentid = $this->input->post('departmentid');
        if (!empty($departmentid)) {
            $query .= " and pr_item.departmentid = " . $departmentid;
        }

        $vendorid = $this->input->post('vendorid');
        if (!empty($vendorid)) {
            $query .= " and pr_item.vendorid = " . $vendorid;
        }


        $currency = $this->input->post('currency');
        if (!empty($currency)) {
            $query .= " and pr_item.currency = '" . $currency . "'";
        }

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');

        $query .= " order by pr_item.$sort $order ";
        
        //echo $query;
        echo $this->model_purchaserequestdetail->get_by_item($query);
    }

    function search_form_pr_by_item() {
        $this->load->model('model_department');
        $this->load->model('model_currency');
        $data['department'] = $this->model_department->selectAllResult();
        $data['currency'] = $this->model_currency->selectAllResult();
        $this->load->view('purchaserequest/search_form_pr_by_item', $data);
    }

    function view_detail() {
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "purchaserequest"));
        $this->load->view('purchaserequest/detail/view', $data);
    }

    function get() {

        $purchaserequestid = $this->input->post('purchaserequestid');

        /* $query = "select 
          purchaserequestdetail.*,
          vendor.name vendor,
          item.code itemcode,
          item.description itemdescription
          from purchaserequestdetail
          left join item on purchaserequestdetail.itemid=item.id
          left join vendor on purchaserequestdetail.vendorid=vendor.id where true"; */

        $query = "select t.* from purchaserequestdetail_get() t where true";

        $purchaserequestid = (empty($purchaserequestid)) ? 0 : $purchaserequestid;

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and t.code ilike '%$itemcode%' ";
        }
        $description = $this->input->post('description');
        if (!empty($description)) {
            $query .= " and t.description ilike '%$description%' ";
        }

        $query .= " and t.purchaserequestid=$purchaserequestid 
                    order by t.id desc";
        //echo $query;
        echo $this->model_purchaserequestdetail->get($query);
    }

    function save($purchaserequestid) {
        $itemid = $this->input->post('itemid');
        $qty = (double) $this->input->post('qty');
        $unitcode = $this->input->post('unitcode');

        $data = array(
            'purchaserequestid' => $purchaserequestid,
            'itemid' => $itemid,
            'qty' => $qty,
            'unitcode' => $unitcode
        );
        if ($this->model_purchaserequestdetail->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update_item($id) {
        $itemid = $this->input->post('itemid');
        $qty = (double) $this->input->post('qty');
        $unitcode = $this->input->post('unitcode');
        $data = array(
            'itemid' => $itemid,
            'qty' => $qty,
            'unitcode' => $unitcode
        );
        if ($this->model_purchaserequestdetail->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit_vendor_price($pritemid, $pricecomparisonid) {
        $data['pritemid'] = $pritemid;
        $data['pricecomparisonid'] = $pricecomparisonid;
        $this->load->view('purchaserequest/detail/edit_vendor_price', $data);
    }

    function update_vendor_price($pritemid) {
        $pricecomparisonid = $this->input->post('pricecomparisonid');
        $vendorid = $this->input->post('vendorid');
        $price = (double) $this->input->post('price');
        $discount = (double) $this->input->post('discount');
        $tax = (double) $this->input->post('tax');

        $data = array(
            'pricecomparisonid' => $pricecomparisonid,
            'vendorid' => $vendorid,
            'price' => $price,
            'ppn' => $tax,
            'discount' => $discount
        );

        if ($this->model_purchaserequestdetail->update($data, array("id" => $pritemid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id, $vendorid) {
        $qty = (double) $this->input->post('qty');
        $price = (double) $this->input->post('price');
        $discount = (double) $this->input->post('discount');
        $tax = (double) $this->input->post('tax');

        $subtotal = $qty * $price;
        $amount = (($subtotal + $tax) - $discount);

        $data = array(
            'qty' => $qty,
            'price' => $price,
            'total' => $subtotal,
            'discount' => $discount,
            'ppn' => $tax,
            'amount' => $amount
        );

        $data_price_comparison = array(
            'price' => $price,
            'discount' => $discount,
            'total' => $subtotal,
            'ppn' => $tax,
            'amount' => $amount);

        $error_msg = '';

        $this->load->model('model_pricecomparison');
        $this->db->trans_start(TRUE);
        if (!$this->model_purchaserequestdetail->update($data, array("id" => $id))) {
            $error_msg .= $this->db->_error_message();
        }
        if (!$this->model_pricecomparison->update($data_price_comparison, array("purchaserequestdetailid" => $id, "vendorid" => $vendorid))) {
            $error_msg .= $this->db->_error_message();
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(array('msg' => $error_msg));
        } else {
            echo json_encode(array('success' => true));
        }
    }

    function edit($pritemid) {
        $data['pritemid'] = $pritemid;
        $this->load->view('purchaserequest/detail/edit', $data);
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_purchaserequestdetail->delete(array('id' => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function add_from_requisition($purchaserequestid) {
        $data['purchaserequestid'] = $purchaserequestid;
        $this->load->view('purchaserequest/detail/add_from_requisition', $data);
    }

    function save_from_requisition() {
        $purchaserequestid = $this->input->post('purchaserequestid');
        $materialrequisitiondetailid = $this->input->post('materialrequisitiondetailid');
        $itemid = $this->input->post('itemid');
        $unitcode = $this->input->post('unitcode');
        $qty = $this->input->post('qty');
        $data = array();
        for ($i = 0; $i < count($materialrequisitiondetailid); $i++) {
            $data[] = array(
                "purchaserequestid" => $purchaserequestid,
                "materialrequisitiondetailid" => $materialrequisitiondetailid[$i],
                "itemid" => $itemid[$i],
                "unitcode" => $unitcode[$i],
                "qty" => $qty[$i]
            );
        }

        if ($this->model_purchaserequestdetail->insert_batch($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function add_outsource() {
        $this->load->view('purchaserequest/detail/add_outsource');
    }

    function save_outsource($purchaserequestid) {
        $modelid = $this->input->post('modelid');
        $outsource_type = $this->input->post('outsource_type');
        $description = $this->input->post('description');
        $qty = $this->input->post('qty');
        $data = array(
            'purchaserequestid' => $purchaserequestid,
            'modelid' => $modelid,
            'outsource_type' => $outsource_type,
            'outsource_description' => $description,
            'qty' => $qty,
            'unitcode' => 'PCS'
        );
        if ($this->model_purchaserequestdetail->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_all_detail_item($pritemid) {
        $query = "
            select 
            t.*,
            mr.number mr_no
            from pr_item_temp_merge_get() t 
            left join materialrequisitiondetail mr_detail on t.materialrequisitiondetailid=mr_detail.id
            left join materialrequisition mr on mr_detail.materialrequisitionid=mr.id 
            where t.purchaserequestdetailid = $pritemid  
        ";

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and t.itemcode ilike '%$itemcode%' ";
        }
        $description = $this->input->post('description');
        if (!empty($description)) {
            $query .= " and t.itemdescription ilike '%$description%' ";
        }

        $item_code_desc = $this->input->post('item_code_desc');
        if (!empty($item_code_desc)) {
            $query .= " and (t.itemcode ilike '%$item_code_desc%' or t.itemdescription ilike '%$item_code_desc%')";
        }

        $query .= " order by t.id desc";
//        echo $query;
        echo $this->model_purchaserequestdetail->get($query);
    }

    function pritem_delete() {
        if ($this->db->delete('pr_item_temp_merge', array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function set_price() {
        $this->load->model('model_currency');
        $data['currency'] = $this->model_currency->selectAllResult();
        $this->load->view('purchaserequest/detail/set_price', $data);
    }

    function do_set_price($pritem_id) {
        $expired_date = $this->input->post('expired_date');

        $data = array(
            "vendorid" => $this->input->post('vendorid'),
            "currency" => $this->input->post('currency'),
            "price" => (double) $this->input->post('price'),
            "discount_percent" => (double) $this->input->post('discount_percent'),
            "ppn_percent" => (double) $this->input->post('ppn_percent')
        );

        if ($this->model_purchaserequestdetail->update($data, array("id" => $pritem_id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit_item() {
        $this->load->view('purchaserequest/detail/edit_item');
    }

    function do_edit_item($id) {
        $data = array("qty" => $this->input->post('qty'));
        if ($this->db->update("purchaserequestdetail", $data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
//        if ($this->db->update("pr_item_temp_merge", $data, array("id" => $id))) {
//            echo json_encode(array('success' => true));
//        } else {
//            echo json_encode(array('msg' => $this->db->_error_message()));
//        }
    }

}
