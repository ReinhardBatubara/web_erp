<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelfinishingunseen
 *
 * @author user
 */
class modelfinishingunseen extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_modelfinishingunseen');
    }

    function index() {
        $this->load->view('model/modelfinishingunseen/view');
    }

    function get() {
        $modelid = $this->input->post('modelid');
        if (empty($modelid)) {
            $modelid = 0;
        }

        $query = "
            select 
            modelfinishingunseen.*,
            finishingtype.name finishing_type_name 
            from modelfinishingunseen 
            left join finishingtype on modelfinishingunseen.finishingtypeid=finishingtype.id
            where modelfinishingunseen.modelid=$modelid order by id desc
        ";
        echo $this->model_modelfinishingunseen->get($query);
    }

    function add() {
        $this->load->view('model/modelfinishingunseen/add');
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

        if ($this->model_modelfinishingunseen->insert($data)) {
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

        if ($this->model_modelfinishingunseen->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_modelfinishingunseen->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_detail_material() {
        $modelfinishingunseenid = $this->input->post("modelfinishingunseenid");
        $query = "select * from modelfinishingunseen_get_detail_material($modelfinishingunseenid)";
        echo $this->model_modelfinishingunseen->get($query);
    }

}

?>
