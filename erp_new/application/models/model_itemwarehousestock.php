<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_itemwarehousestock
 *
 * @author hp
 */
class model_itemwarehousestock extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get($id) {
        
        $itemid = $this->input->post('itemid');
        if (empty($itemid)) {
            $itemid = 0;
        }

        $query = "select 
        itemwarehousestock.*,
        warehouse.name warehouse
        from itemwarehousestock
        join warehouse on itemwarehousestock.warehouseid=warehouse.id 
        where (itemwarehousestock.itemid=$itemid or itemwarehousestock.itemid=$id)";

        if ($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') != -1) {
            $query .= " and itemwarehousestock.warehouseid=" . $this->session->userdata('optiongroup');
        }

        $query .=" order by itemwarehousestock.warehouseid asc,itemwarehousestock.itemunitpriceid asc ";
        
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

    function set_store($itemid, $warehouseid) {
        return $this->db->query("select itemwarehousestock_set_store($itemid,$warehouseid)");
    }

    function update($data, $where) {
        return $this->db->update('itemwarehousestock', $data, $where);
    }

    function get_warehouse_for_combo_by_item_id($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->warehouseid,
                'text' => $data->warehousename
            );
        }
        return json_encode($row);
    }

    function get_stock($itemid, $unitcode, $warehouseid) {
        $this->db->select('qty');
        $this->db->from('itemwarehousestock');
        $this->db->where('itemid', $itemid);
        $this->db->where('unitcode', $unitcode);
        $this->db->where('warehouseid', $warehouseid);
        $dt = $this->db->get()->row();
        return (empty($dt) ? 0 : $dt->qty);
    }

    function get_sell_price($itemid, $unitcode) {
        return $this->db->query("select item_get_sell_price_by_unitcode($itemid,'$unitcode') ct")->row()->ct;
    }

    function delete($where) {
        return $this->db->delete('itemwarehousestock', $where);
    }

}
