<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upholstry
 *
 * @author hp
 */
class upholstry extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_upholstry');
    }

    function index() {
        $this->load->view('model/upholstry/view');
    }

    function get() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        $modelid = $this->input->post('modelid');
        if (empty($modelid)) {
            $modelid = 0;
        }

        $query = "select 
        upholstry.*,
        item.code,
        item.description materialdescription 
        from upholstry 
        left join item on upholstry.itemid=item.id";

        $query.= " where upholstry.modelid=$modelid order by id desc ";
        //echo $query;
        echo $this->model_upholstry->get($page, $rows, $query);
    }

    function add() {
        $this->load->view('model/upholstry/add');
    }

    function save($modelid, $id) {
        $description = $this->input->post('description');
        $itemid = (int) $this->input->post('itemid');
        $size_l = (double) $this->input->post('size_l');
        $size_w = (double) $this->input->post('size_w');
        $size_t = (double) $this->input->post('size_t');
        $qty = (double) $this->input->post('qty');
        $in_total_qty = (double) $this->input->post('total_qty');
        $unitcode = $this->input->post('unitcode');
        $remark = $this->input->post('remark');

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
            'total_qty' => $total_qty,
            'remark' => $remark
        );
        if ($id == 0) {
            if ($this->model_upholstry->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_upholstry->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_upholstry->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
