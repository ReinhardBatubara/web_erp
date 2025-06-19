<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of materialrequisitiondetail
 *
 * @author hp
 */
class materialrequisitiondetail extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_materialrequisitiondetail');
    }

    function index() {
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "materialrequisition"));
        $this->load->view('materialrequisition/detail/view', $data);
    }

    function get() {
        $materialrequisitionid = $this->input->post('materialrequisitionid');
        if (empty($materialrequisitionid)) {
            $materialrequisitionid = 0;
        }

        $query = "select 
                materialrequisitiondetail.*, 
                materialrequisitiondetail.itemid,
                mrp.ots_requisition,
                item.code itemcode,
                item.description itemdescription
                from materialrequisitiondetail 
                join item on materialrequisitiondetail.itemid=item.id
                left join mrp on materialrequisitiondetail.mrpid=mrp.id 
                where materialrequisitiondetail.materialrequisitionid=$materialrequisitionid";

        $itemcode = $this->input->post('itemcode');
        $description = $this->input->post('description');

        if ($itemcode != "") {
            $query .= " and item.code ilike '%" . $itemcode . "%' ";
        }if ($description != "") {
            $query .= " and item.description ilike '%" . $description . "%' ";
        }

//        $query .= " order by materialrequisitiondetail.id desc";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";

        //echo $query;
        echo $this->model_materialrequisitiondetail->get($query);
    }

    function add() {
        $this->load->view('materialrequisition/detail/add');
    }

    function save($mrid) {
        $data = array(
            "materialrequisitionid" => $mrid,
            "itemid" => $this->input->post('itemid'),
            "unitcode" => $this->input->post('unitcode'),
            "qty" => $this->input->post('qty'),
            "qty_ots" => $this->input->post('qty'),
            "requiredfor" => $this->input->post('requiredfor'),
            "mrpid" => (int) $this->input->post('mrpid')
        );
        if ($this->model_materialrequisitiondetail->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $data = array(
            "itemid" => $this->input->post('itemid'),
            "unitcode" => $this->input->post('unitcode'),
            "qty" => $this->input->post('qty'),
            "qty_ots" => $this->input->post('qty'),
            "requiredfor" => $this->input->post('requiredfor'),
            "mrpid" => (int) $this->input->post('mrpid')
        );

        if ($this->model_materialrequisitiondetail->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_materialrequisitiondetail->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_outstanding() {
        $materialrequisitionid = $this->input->post('materialrequisitionid');

        $query = "select 
                materialrequisitiondetail.id, 
                materialrequisition.number mr_no,
                materialrequisitiondetail.itemid,
                item.code itemcode,
                item.description itemdescription,
                materialrequisitiondetail.unitcode,
                materialrequisitiondetail.qty qty_request,
                materialrequisitiondetail.qty_ots
                from materialrequisitiondetail 
                join item on materialrequisitiondetail.itemid=item.id 
                join materialrequisition on 
                materialrequisitiondetail.materialrequisitionid=materialrequisition.id 
                where materialrequisitiondetail.qty_ots > 0";
        if (!empty($materialrequisitionid)) {
            $query .= " and materialrequisition.id = $materialrequisitionid";
        }

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and item.code ilike '%$itemcode%'";
        }
        $itemdescription = $this->input->post('itemdescription');
        if (!empty($itemdescription)) {
            $query .= " and item.description ilike '%$itemdescription%'";
        }

        $item_code_desc = $this->input->post('item_code_desc');
        if (!empty($item_code_desc)) {
            $query .= " and (item.code ilike '%$item_code_desc%' or item.description ilike '%$item_code_desc%')";
        }

//        echo $query;
        echo $this->model_materialrequisitiondetail->get($query);
    }

    function add_from_jo($joborderid) {
        $data['joborderid'] = $joborderid;
        $this->load->view('materialrequisition/detail/add_from_jo', $data);
    }

    function list_material_jo($joborderid) {
        $data['joborderid'] = $joborderid;
        $this->load->view('materialrequisition/detail/list_material_jo', $data);
    }

    function save_from_list_jo($mrid) {
        $mrpid = $this->input->post('mrpid');
        $itemid = $this->input->post('itemid');
        $unitcode = $this->input->post('unitcode');
        $qty = $this->input->post('qty');
        $data = array();
        for ($i = 0; $i < count($mrpid); $i++) {
            $data[] = array(
                "materialrequisitionid" => $mrid,
                "itemid" => $itemid[$i],
                "unitcode" => $unitcode[$i],
                "qty" => $qty[$i],
                "qty_ots" => $qty[$i],
                "mrpid" => (int) $mrpid[$i]
            );
        }

        if ($this->model_materialrequisitiondetail->insert_batch($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function change_status() {
        $mrdetailid = $this->input->post('mrdetailid');
        $status = $this->input->post('status');
        $data = array();
        for ($i = 0; $i < count($mrdetailid); $i++) {
            $data[] = array(
                "id" => $mrdetailid[$i],
                "status" => $status
            );
        }
        if ($this->model_materialrequisitiondetail->update_batch($data, "id")) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
