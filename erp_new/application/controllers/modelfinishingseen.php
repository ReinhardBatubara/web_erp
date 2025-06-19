<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelfinishingseen
 *
 * @author user
 */
class modelfinishingseen extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_modelfinishingseen');
    }

    function index() {
        $this->load->view('model/modelfinishingseen/view');
    }

    function get() {
        $modelid = $this->input->post('modelid');
        if (empty($modelid)) {
            $modelid = 0;
        }

        $query = "
            select 
            modelfinishingseen.*,
            finishingtype.name finishing_type_name 
            from modelfinishingseen 
            left join finishingtype on modelfinishingseen.finishingtypeid=finishingtype.id
            where modelfinishingseen.modelid=$modelid order by id desc
        ";
        echo $this->model_modelfinishingseen->get($query);
    }

    function add() {
        $this->load->view('model/modelfinishingseen/add');
    }

    function save($modelid) {
        $area = (double) $this->input->post('area');
        $size_l = (double) $this->input->post('size_l');
        $size_w = (double) $this->input->post('size_w');
        $qty = (double) $this->input->post('qty');

        if ($area == 0) {
            $total_area = round((($size_l * $size_w * $qty) / 1000000), 4);
        } else {
            $total_area = round((($area * $qty) / 1000000), 4);
        }

        $data = array(
            "modelid" => $modelid,
            "finishingtypeid" => $this->input->post('finishingtypeid'),
            "description" => $this->input->post("description"),
            "area" => $area,
            "size_l" => $size_l,
            "size_w" => $size_w,
            "qty" => $qty,
            "total_area" => $total_area,
            "remark" => $this->input->post("remark")
        );

        if ($this->model_modelfinishingseen->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $area = (double) $this->input->post('area');
        $size_l = (double) $this->input->post('size_l');
        $size_w = (double) $this->input->post('size_w');
        $qty = (double) $this->input->post('qty');

        if ($area == 0) {
            $total_area = round((($size_l * $size_w * $qty) / 1000000), 4);
        } else {
            $total_area = round((($area * $qty) / 1000000), 4);
        }

        $data = array(
            "finishingtypeid" => $this->input->post('finishingtypeid'),
            "description" => $this->input->post("description"),
            "area" => $area,
            "size_l" => $size_l,
            "size_w" => $size_w,
            "qty" => $qty,
            "total_area" => $total_area,
            "remark" => $this->input->post("remark")
        );

        if ($this->model_modelfinishingseen->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_modelfinishingseen->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_detail_material() {
        $modelfinishingseenid = $this->input->post("modelfinishingseenid");
        $query = "select * from modelfinishingseen_get_detail_material($modelfinishingseenid)";
        echo $this->model_modelfinishingseen->get($query);
    }

}

?>
