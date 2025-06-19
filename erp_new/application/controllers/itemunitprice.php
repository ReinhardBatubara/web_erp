<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of itemunitprice
 *
 * @author hp
 */
class itemunitprice extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_itemunitprice');
    }

    function get() {
        $itemid = $this->input->post('itemid');

        $query = "select itemunitprice.* 
                from itemunitprice where true ";
        if (empty($itemid)) {
            $itemid = 0;
        }
        $query .= " and itemunitprice.itemid=$itemid order by itemunitprice.id asc";
        echo $this->model_itemunitprice->get($query);
    }

    function get_remote_unit($itemid) {
        $query = "select itemunitprice.* 
                    from itemunitprice where itemunitprice.itemid=$itemid and id > (select id from itemunitprice where itemunitprice.itemid=$itemid order by id asc limit 1)
                    order by id asc";
        //echo $query;
        echo $this->model_itemunitprice->get_remote_unit($query);
    }

    function get_all_unit($itemid) {
        $query = "select itemunitprice.* 
                    from itemunitprice where itemunitprice.itemid=$itemid";
        echo $this->model_itemunitprice->get_remote_unit($query);
    }

    function save($itemid) {
        $unitcode = $this->input->post('unitcode');
        $originalprice = $this->input->post('originalprice');
        $sellprice = $this->input->post('sellprice');
        $currency = $this->input->post('currency');

        $data = array(
            "itemid" => $itemid,
            "unitcode" => $unitcode,
            "originalprice" => (double) $originalprice,
            "sellprice" => (double) $sellprice,
            "currency" => $currency,
            "rate" => (double) $this->input->post('rate')
        );

        if ($this->model_itemunitprice->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        $itemid = $this->input->post('itemid');
        $unitcode = $this->input->post('unitcode');
        $this->load->model('model_itemunitrelation');
        if ($this->model_itemunitrelation->not_exist($itemid, $unitcode)) {
            if ($this->model_itemunitprice->delete(array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            echo json_encode(array('msg' => 'Error delete because the unit exist in unit relation'));
        }
    }

}
