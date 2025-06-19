<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of itemwarehousestock
 *
 * @author hp
 */
class itemwarehousestock extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_itemwarehousestock');
    }

    function get($id = 0) {
        echo $this->model_itemwarehousestock->get($id);
    }

    function set_store() {
        $itemid = $this->input->post('itemid');
        $warehouseid = $this->input->post('warehouseid');
        if ($this->model_itemwarehousestock->set_store($itemid, $warehouseid)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $data = array(
            'rack' => $this->input->post('rack'),
            'qty' => (double) $this->input->post('qty')
        );

        if ($this->model_itemwarehousestock->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_warehouse_for_combo_by_item_id($itemid) {
        $query = "select 
                distinct(itemwarehousestock.warehouseid),
                warehouse.name warehousename
                from itemwarehousestock 
                join warehouse on itemwarehousestock.warehouseid=warehouse.id 
                where itemid=$itemid";

        echo $this->model_itemwarehousestock->get_warehouse_for_combo_by_item_id($query);
    }

    function get_stock($itemid, $unitcode, $warehouseid) {
        echo $this->model_itemwarehousestock->get_stock($itemid, $unitcode, $warehouseid);
    }

    function remove() {
        $id = $this->input->post('id');
        if ($this->model_itemwarehousestock->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
