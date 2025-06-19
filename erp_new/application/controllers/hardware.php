<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hardware
 *
 * @author hp
 */
class hardware extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_hardware');
    }

    function index() {
        $this->load->view('model/hardware/view');
    }

    function get() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        $modelid = $this->input->post('modelid');
        if (empty($modelid)) {
            $modelid = 0;
        }

        $query = "select 
            hardware.id,
            hardware.modelid,
            hardware.itemid,
            hardware.description,
            hardware.size_l,
            hardware.size_w,
            hardware.size_t,
            hardware.qty,
            hardware.volume,
            hardware.remark,
            hardware.unitcode,
            hardware.total_qty,
            item.code,
            (case 
            when hardware.itemid=0 then hardware.materialdescription 
            else item.description
            end) materialdescription
            from hardware 
            left join item on hardware.itemid=item.id";

        $query.= " where hardware.modelid=$modelid order by id desc ";
        //echo $query;
        echo $this->model_hardware->get($page, $rows, $query);
    }

    function add() {
        $this->load->view('model/hardware/add');
    }
    
    function add2() {
        $this->load->view('model/hardware/add2');
    }

    function save($modelid, $id) {
        $description = $this->input->post('description');
        $itemid = (int) $this->input->post('itemid');
        $size_l = (double) $this->input->post('size_l');
        $size_w = (double) $this->input->post('size_w');
        $size_t = (double) $this->input->post('size_t');
        $qty = (double) $this->input->post('qty');
        $in_total_qty = (double) $this->input->post('total_qty');
        $remark = $this->input->post('remark');
        $unitcode = $this->input->post('unitcode');
        $volume = 0;
        $total_qty = 0;
        if ($unitcode == 'M2') {
            $volume = round((($size_l * $size_w * $qty) / 1000000), 4);
            $total_qty = $volume;
        } else if ($unitcode == 'M3') {
            $volume = round((($size_l * $size_w * $size_t * $qty) / 1000000000), 4);
            $total_qty = $volume;
        } else {
            if ($in_total_qty != 0) {
                $total_qty = $in_total_qty;
            } else {
                $total_qty = $qty;
            }
        }

        $data = array(
            'description' => $description,
            'modelid' => $modelid,
            'itemid' => $itemid,
            'size_l' => $size_l,
            'size_w' => $size_w,
            'size_t' => $size_t,
            'qty' => $qty,
            'volume' => $volume,
            'remark' => $remark,
            'unitcode' => $unitcode,
            'total_qty' => $total_qty
        );
        if ($itemid == 0) {
            $data['materialdescription'] = $this->input->post('materialdescription');
        }
        if ($id == 0) {
            if ($this->model_hardware->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_hardware->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_hardware->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
