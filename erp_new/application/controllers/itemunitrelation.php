<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of itemunitrelation
 *
 * @author hp
 */
class itemunitrelation extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_itemunitrelation');
    }

    function get() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $itemid = $this->input->post('itemid');

        $query = "select itemunitrelation.* 
                from itemunitrelation where true ";
        if (empty($itemid)) {
            $itemid = 0;
        }
        $query .= " and itemunitrelation.itemid=$itemid order by itemunitrelation.id asc";
        echo $this->model_itemunitrelation->get($page, $rows, $query);
    }

    function save($itemid) {
        $unitfrom = $this->input->post('unitfrom');
        $unitto = $this->input->post('unitto');
        $value = $this->input->post('value');

//        echo $unitfrom . "#" . $unitto;

        if ($unitfrom != $unitto) {
            if ($this->model_itemunitrelation->is_valid($itemid, $unitfrom, $unitto)) {
                $data = array(
                    'itemid' => $itemid,
                    'unitfrom' => $unitfrom,
                    'unitto' => $unitto,
                    'value' => $value
                );
                if ($this->model_itemunitrelation->insert($data)) {
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('msg' => $this->db->_error_message()));
                }
            } else {
                echo json_encode(array('msg' => 'The Unit Already Have Relation'));
            }
        } else {
            echo json_encode(array('msg' => 'Not Allow Relation With Same Unit'));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_itemunitrelation->delete(array('id' => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
