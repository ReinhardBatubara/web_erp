<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class model_salesorderdetail extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function select_by_id($id) {
        return $this->db->query("select * from salesorderdetail where id=$id")->row();
    }

    function select_by_sales_order_id($salesorderid) {
        $query = "
            select 
            salesorderdetail.*,
            model.mastercode,
            model.originalcode,
            model.code,
            model.name,
            model.itemsize_mm_w,
            model.itemsize_mm_d,
            model.itemsize_mm_h,
            model.images,
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
            where salesorderdetail.salesorderid = $salesorderid order by salesorderdetail.id asc
        ";
        return $this->db->query($query)->result();
    }

    function get($query) {
        $salesorderid = $this->input->post('salesorderid');
        if (empty($salesorderid)) {
            $salesorderid = 0;
        }
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $qty_total = $this->db->query("select sum(qty) qty_total from salesorderdetail where salesorderid=$salesorderid")->row()->qty_total;
            $footer = array(array('name' => '<b>Total</b>', 'qty' => $qty_total));
            $result = array_merge($result, array('rows' => $this->db->query($query)->result(), 'footer' => $footer));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

    function insert($data) {
        return $this->db->insert('salesorderdetail', $data);
    }

    function update($data, $where) {
        return $this->db->update('salesorderdetail', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('salesorderdetail', $where);
    }

    function finishing_seen_update($data, $where) {
        return $this->db->update('salesorderdetailfinishingseen', $data, $where);
    }

    function finishing_top_update($data, $where) {
        return $this->db->update('salesorderdetailfinishingtop', $data, $where);
    }

    function finishing_unseen_update($data, $where) {
        return $this->db->update('salesorderdetailfinishingunseen', $data, $where);
    }

    function finishing_seen_update_batch($data, $index) {
        return $this->db->update_batch('salesorderdetailfinishingseen', $data, $index);
    }

    function finishing_top_update_batch($data, $index) {
        return $this->db->update_batch('salesorderdetailfinishingtop', $data, $index);
    }

    function finishing_unseen_update_batch($data, $index) {
        return $this->db->update_batch('salesorderdetailfinishingunseen', $data, $index);
    }

    function select_finishing_seen($salesorderdetailid) {
        $query = "
            select 
            salesorderdetailfinishingseen.*,
            modelfinishingseen.description,
            finishingtype.name finishingtypename
            from salesorderdetailfinishingseen
            join modelfinishingseen on salesorderdetailfinishingseen.finishingseenid=modelfinishingseen.id
            join finishingtype on salesorderdetailfinishingseen.finishingtypeid=finishingtype.id 
            where salesorderdetailfinishingseen.salesorderdetailid=$salesorderdetailid
            order by salesorderdetailfinishingseen.id asc
        ";
        return $this->db->query($query)->result();
    }

    function select_finishing_top($salesorderdetailid) {
        $query = "
            select 
            salesorderdetailfinishingtop.*,
            finishingtop.description,
            finishingtype.name finishingtypename
            from salesorderdetailfinishingtop
            join finishingtop on salesorderdetailfinishingtop.finishingtopid=finishingtop.id
            join finishingtype on salesorderdetailfinishingtop.finishingtypeid=finishingtype.id 
            where salesorderdetailfinishingtop.salesorderdetailid=$salesorderdetailid 
            order by salesorderdetailfinishingtop.id asc
        ";
        return $this->db->query($query)->result();
    }

    function select_finishing_unseen($salesorderdetailid) {
        $query = "
            select 
            salesorderdetailfinishingunseen.*,
            modelfinishingunseen.description,
            finishingtype.name finishingtypename
            from salesorderdetailfinishingunseen
            join modelfinishingunseen on salesorderdetailfinishingunseen.finishingunseenid=modelfinishingunseen.id
            join finishingtype on salesorderdetailfinishingunseen.finishingtypeid=finishingtype.id 
            where salesorderdetailfinishingunseen.salesorderdetailid=$salesorderdetailid
            order by salesorderdetailfinishingunseen.id asc
        ";
        return $this->db->query($query)->result();
    }

    function update_upholstry($salesorderdetailid, $modelid, $upholstryid, $itemid, $unitcode) {
        $query = "select salesorderdetail_update_upholstry($salesorderdetailid,$modelid, $upholstryid, $itemid, '$unitcode')";
        //echo $query;
        return $this->db->query($query);
    }

}
