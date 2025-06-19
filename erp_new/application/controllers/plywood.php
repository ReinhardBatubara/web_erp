<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of plywood
 *
 * @author hp
 */
class plywood extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_plywood');
    }

    function index() {
        $this->load->view('model/plywood/view');
    }

    function get($modelid_ = "") {
        $modelid = $this->input->post('modelid');
        if (empty($modelid)) {
            $modelid = 0;
        }

        if ($modelid_ != "") {
            $modelid = $modelid_;
        }

        $query = "select 
        plywood.*,
        item.code,
        item.description materialdescription 
        from plywood 
        left join item on plywood.itemid=item.id 
        where plywood.modelid=$modelid order by id desc";

        echo $this->model_plywood->get($query);
    }

    function add($parent) {
        $required = "";
        if ($parent != 0) {
            $required = "required";
        }
        $data['required'] = $required;
        $this->load->view('model/plywood/add', $data);
    }

    function save($modelid, $parentid, $id) {
        $description = $this->input->post('description');
        $itemid = (int) $this->input->post('itemid');
        $size_l = (double) $this->input->post('size_l');
        $size_w = (double) $this->input->post('size_w');
        $size_t = (double) $this->input->post('size_t');
        $qty = (double) $this->input->post('qty');

        $in_total_qty = (double) $this->input->post('total_qty');

        $unitcode = $this->input->post('unitcode');
        $remark = $this->input->post('remark');


        $volume = round((($size_l * $size_w * $qty) / 1000000), 4);
        $total_qty = 0;

        $total_qty = 0;
        if ($unitcode == 'M2') {
            $total_qty = $volume;
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
            'volume' => $volume,
            'unitcode' => $unitcode,
            'total_qty' => $total_qty,
            'remark' => $remark
        );

        if ($id == 0) {
            $data['parentid'] = $parentid;
            if ($this->model_plywood->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_plywood->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_plywood->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function make_as_path() {
        $id = $this->input->post('id');
        $data = array("parentid" => 0);
        if ($this->model_plywood->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function make_as_child($id, $modelid) {
        $data['modelid'] = $modelid;
        $data['id'] = $id;
        $this->load->view('model/plywood/make_as_child', $data);
    }

    function do_make_as_child() {
        $data = array("parentid" => $this->input->post('parentid'));
        if ($this->model_plywood->update($data, array("id" => $this->input->post('childid')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
