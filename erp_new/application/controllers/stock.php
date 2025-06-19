<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of stock
 *
 * @author hp
 */
class stock extends CI_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model("model_stock");
    }

    function get_by_item() {
        $itemid = $this->input->post('itemid');

        $query = "select 
                stock.*,
                warehouse.name warehousename,
                unit.code as unitcode
                from stock 
                join warehouse on stock.warehouseid=warehouse.id 
                join unit on stock.unitfrom =unit.id where true ";
        
        if (empty($itemid)) {
            $itemid = 0;
        }
        $query .= "  and itemid=$itemid ";
        $query.=" order by stock.warehouseid, stock.id asc ";
        echo $this->model_stock->get_by_item($query);
    }

}
