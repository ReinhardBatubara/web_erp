<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of packaging
 *
 * @author hp
 */
class packaging extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_packaging');
    }

    function index() {
        $this->load->view('model/packaging/view');
    }

    function get() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        $modelid = $this->input->post('modelid');
        if (empty($modelid)) {
            $modelid = 0;
        }

        $query = "select 
        packaging.*,
        item.code,
        item.description materialdescription 
        from packaging 
        left join item on packaging.itemid=item.id";

        $query.= " where packaging.modelid=$modelid order by id desc ";
        
        //echo $query;
        echo $this->model_packaging->get($query);
    }

    function add($parent) {
        $required = "";
        if ($parent != 0) {
            $required = "required";
        }
        $data['required'] = $required;
        $this->load->view('model/packaging/add', $data);
    }

    function save($modelid, $parentid, $id) {
        $description = $this->input->post('description');
        $itemid = (int) $this->input->post('itemid');
        $size_l = (double) $this->input->post('size_l');
        $size_w = (double) $this->input->post('size_w');
        $size_t = (double) $this->input->post('size_t');
        $unitcode = $this->input->post('unitcode');
        $qty = (double) $this->input->post('qty');
        $remark = $this->input->post('remark');
        $in_total_qty = (double) $this->input->post('total_qty');

        $volume_m2 = round((($size_l * $size_w * $qty) / 1000000), 4);
        $volume_m3 = round((($size_l * $size_w * $size_t * $qty) / 1000000000), 4);

        $total_qty = 0;

        if ($unitcode == 'M2') {
            $total_qty = $volume_m2;
        } else if ($unitcode == 'M3') {
            $total_qty = $volume_m3;
        } else {
            if ($in_total_qty != 0) {
                if ($in_total_qty == -1) {
                    $total_qty = 0;
                } else {
                    $total_qty = $in_total_qty;
                }
            } else {
                $total_qty = $qty;
            }
        }

        $data = array(
            'parentid' => $parentid,
            'description' => $description,
            'modelid' => $modelid,
            'itemid' => $itemid,
            'size_l' => $size_l,
            'size_w' => $size_w,
            'size_t' => $size_t,
            'qty' => $qty,
            'volume_m2' => $volume_m2,
            'volume_m3' => $volume_m3,
            'unitcode' => $unitcode,
            'remark' => $remark,
            'total_qty' => (double) $total_qty
        );
        if ($id == 0) {
            if ($this->model_packaging->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_packaging->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_packaging->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
