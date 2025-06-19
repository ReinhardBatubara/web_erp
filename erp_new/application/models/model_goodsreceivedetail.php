<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_goodsreceivedetail
 *
 * @author hp
 */
class model_goodsreceivedetail extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_by_goodsreceiveid($goodsreceiveid) {

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

        return $this->db->query($query)->result();
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

    function insert_batch($data) {
        return $this->db->insert_batch('goodsreceivedetail', $data);
    }

    function insert($data) {
        return $this->db->insert('goodsreceivedetail', $data);
    }

}
