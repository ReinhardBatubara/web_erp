<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mirror
 *
 * @author hp
 */
class mirror extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_mirror');
    }

    function index() {
        $this->load->view('model/mirror/view');
    }

    function get() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        $modelid = $this->input->post('modelid');
        if (empty($modelid)) {
            $modelid = 0;
        }

        $query = "select 
        mirror.*,
        item.code,
        item.description materialdescription 
        from mirror 
        left join item on mirror.itemid=item.id";

        $query.= " where mirror.modelid=$modelid order by id desc ";
        //echo $query;
        echo $this->model_mirror->get($page, $rows, $query);
    }

    function add() {
        $this->load->view('model/mirror/add');
    }

    function save($modelid, $id) {
        $description = $this->input->post('description');
        $itemid = (int) $this->input->post('itemid');
        $size_l = (double) $this->input->post('size_l');
        $size_w = (double) $this->input->post('size_w');
        $size_t = (double) $this->input->post('size_t');
        $qty = (double) $this->input->post('qty');
        $unitcode = $this->input->post('unitcode');
        $remark = $this->input->post('remark');
        $volume = round((($size_l * $size_w * $qty) / 1000000), 4);

        $total_qty = $qty;
        if ($unitcode == 'M2') {
            $total_qty = $volume;
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
            'unitcode' => $unitcode,
            'remark' => $remark,
            'total_qty' => $total_qty
        );
        if ($id == 0) {
            if ($this->model_mirror->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_mirror->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_mirror->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
