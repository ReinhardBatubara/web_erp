<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of solidwood
 *
 * @author hp
 */
class solidwood extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_solidwood');
    }

    function index() {
        $this->load->view('model/solidwood/view');
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
        solidwood.*,
        item.code,
        item.description materialdescription 
        from solidwood 
        left join item on solidwood.itemid=item.id 
        where solidwood.modelid=$modelid order by id desc ";
        echo $this->model_solidwood->get($query);
    }

    function add($parent) {
        $required = "";
        if ($parent != 0) {
            $required = "required";
        }
        $data['required'] = $required;
        $this->load->view('model/solidwood/add', $data);
    }

    function save($modelid, $parentid, $id) {
        $description = $this->input->post('description');
        $itemid = (int) $this->input->post('itemid');
        $finishedsize_l = (double) $this->input->post('finishedsize_l');
        $finishedsize_w = (double) $this->input->post('finishedsize_w');
        $finishedsize_t = (double) $this->input->post('finishedsize_t');
        $qty = (double) $this->input->post('qty');
        $rawsize_l = $finishedsize_l + 30;
        $rawsize_w = $finishedsize_w + 10;
        $rawsize_t = $finishedsize_t + 10;
        $remark = $this->input->post('remark');
        $unitcode = $this->input->post('unitcode');

        $vol_finished = round((($finishedsize_l * $finishedsize_w * $finishedsize_t * $qty) / 1000000000), 4);
        $vol_raw = round((($rawsize_l * $rawsize_w * $rawsize_t * $qty) / 1000000000), 4);

        $data = array(
            'modelid' => $modelid,
            'parentid' => $parentid,
            'itemid' => $itemid,
            'description' => $description,
            'finishedsize_l' => $finishedsize_l,
            'finishedsize_w' => $finishedsize_w,
            'finishedsize_t' => $finishedsize_t,
            'qty' => $qty,
            'rawsize_l' => $rawsize_l,
            'rawsize_w' => $rawsize_w,
            'rawsize_t' => $rawsize_t,
            'vol_finished' => $vol_finished,
            'vol_raw' => $vol_raw,
            'remark' => $remark,
            'unitcode' => $unitcode
        );
        if ($id == 0) {
            if ($this->model_solidwood->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_solidwood->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_solidwood->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function make_as_path() {
        $id = $this->input->post('id');
        $data = array("parentid" => 0);
        if ($this->model_solidwood->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function make_as_child($id, $modelid) {
        $data['modelid'] = $modelid;
        $data['id'] = $id;
        $this->load->view('model/solidwood/make_as_child', $data);
    }

    function do_make_as_child() {
        $data = array("parentid" => $this->input->post('parentid'));
        if ($this->model_solidwood->update($data, array("id" => $this->input->post('childid')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
