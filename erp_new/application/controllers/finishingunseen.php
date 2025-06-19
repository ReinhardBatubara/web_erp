<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of finishingunseen
 *
 * @author hp
 */
class finishingunseen extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_finishingunseen');
    }

    function index() {
        $this->load->view('model/finishingunseen/view');
    }

    function get() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        $modelid = $this->input->post('modelid');
        if (empty($modelid)) {
            $modelid = 0;
        }

        $query = "select 
        finishingunseen.*,
        item.code,
        item.description materialdescription 
        from finishingunseen 
        left join item on finishingunseen.itemid=item.id";

        $query.= " where finishingunseen.modelid=$modelid order by id asc ";
        //echo $query;
        echo $this->model_finishingunseen->get($page, $rows, $query);
    }

    function save($modelid, $id) {
        $description = $this->input->post('description');
        $itemid = (int) $this->input->post('itemid');
        $area = (double) $this->input->post('area');
        $comment = $this->input->post('comment');
        $size_l = (double) $this->input->post('size_l');
        $size_w = (double) $this->input->post('size_w');
        $qty = (double) $this->input->post('qty');
        $unitcode = $this->input->post('unitcode');
        if ($area == 0) {
            $volume = round((($size_l * $size_w * $qty) / 1000000), 4);
        } else {
            $volume = round(($area / 1000000), 4);
        }

        $data = array(
            'description' => $description,
            'comment' => $comment,
            'modelid' => $modelid,
            'area' => $area,
            'itemid' => $itemid,
            'size_l' => $size_l,
            'size_w' => $size_w,
            'qty' => $qty,
            'volume' => $volume,
            'unitcode' => $unitcode
        );
        if ($id == 0) {
            if ($this->model_finishingunseen->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_finishingunseen->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_finishingunseen->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
