<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of goodsreceivedetail
 *
 * @author hp
 */
class goodsreceivedetail extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_goodsreceivedetail');
    }

    function index() {
        
    }

    function get() {
        $goodsreceiveid = $this->input->post('goodsreceiveid');

        $query = "
                select 
                goodsreceivedetail.*,
                t.itemid,
                t.itemcode,
                t.itemdescription,
                t.unitcode,
                purchaseorder.number po_no
                from goodsreceivedetail 
                join purchaseorderdetail on goodsreceivedetail.purchaseorderdetailid=purchaseorderdetail.id
                join purchaserequestdetail on purchaseorderdetail.purchaserequestdetailid=purchaserequestdetail.id
                join purchaseorder on purchaseorderdetail.purchaseorderid=purchaseorder.id
                join (
                select * from purchaserequestdetail_get()
                ) t on t.id=purchaserequestdetail.id 
                where goodsreceivedetail.goodsreceiveid=$goodsreceiveid";

        $itemcode = $this->input->post('code');
        $description = $this->input->post('description');

        if ($itemcode != "") {
            $query .= " and t.itemcode ilike '%" . $itemcode . "%' ";
        }if ($description != "") {
            $query .= " and t.itemdescription ilike '%" . $description . "%' ";
        }

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        echo $this->model_goodsreceivedetail->get($query);
    }

    function get_2($goodsreceiveid) {
        $query = "select 
                goodsreceivedetail.*,t.itemid,t.itemcode,t.itemdescription,t.unitcode
                from goodsreceivedetail join 
                purchaseorderdetail on goodsreceivedetail.purchaseorderdetailid=purchaseorderdetail.id
                join purchaserequestdetail on purchaseorderdetail.purchaserequestdetailid=purchaserequestdetail.id
                join (
                        select * from purchaserequestdetail_get()
                ) t on t.id=purchaserequestdetail.id 
                where goodsreceivedetail.goodsreceiveid=$goodsreceiveid";
        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (t.itemcode ilike '%" . $itemcode . "%' or t.itemdescription ilike '%" . $description . "%') ";
        }
        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        echo $this->model_goodsreceivedetail->get($query);
    }

    function insert($gr_id) {
        $data = array(
            "goodsreceiveid" => $gr_id,
            "purchaseorderdetailid" => $this->input->post('purchaseorderdetailid'),
            "qty" => $this->input->post('qty'),
            "warehouseid" => $this->input->post('warehouseid'),
            "remark" => $this->input->post('remark')
        );
        if ($this->db->insert("goodsreceivedetail", $data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $data = array(
            "qty" => $this->input->post('qty'),
            "remark" => $this->input->post('remark')
        );
        if ($this->db->update("goodsreceivedetail", $data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
