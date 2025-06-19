<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author hp
 */
class model extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_model');
    }

    function index() {
        $this->load->view('model/layout');
    }

    function view() {
        $this->load->view('model/view');
    }

    function get() {
        $query = "select 
                model.*,
                model.id modelid,
                modelcategory.description modelcategory,
                finishing.description finishing,
                material.description material,
                top.description top,
                mirrorglass.description mirrorglass,
                foam.description foam,
                interliner.description interliner,
                fabric.description fabric,
                furring.description furring,
                accessories.description accessories,
                costing.final_selling_price,
                employee.name employee_created
                from model
                left join modelcategory on model.modelcategorycode=modelcategory.code
                left join finishing on model.finishingcode=finishing.code
                left join material on model.materialcode=material.code
                left join top on model.topcode=top.code
                left join mirrorglass on model.mirrorglasscode=mirrorglass.code
                left join foam on model.foamcode=foam.code
                left join interliner on model.interlinercode=interliner.code
                left join fabric on model.fabriccode=fabric.code
                left join furring on model.furringcode=furring.code
                left join accessories on model.accessoriescode=accessories.code 
                left join costing on model.id=costing.modelid
                left join employee on model.create_by=employee.id
                where true ";

        $code = $this->input->post('model_code_s');
        if (!empty($code)) {
            $query .= " and model.code ilike '%" . trim($code) . "%'";
        }
        $mastercode = $this->input->post('model_mastercode_s');
        if (!empty($mastercode)) {
            $query .= " and model.mastercode ilike '%" . trim($mastercode) . "%'";
        }
        $originalcode = $this->input->post('model_originalcode_s');
        if (!empty($originalcode)) {
            $query .= " and model.originalcode ilike '%" . trim($originalcode) . "%'";
        }

        $name = $this->input->post('model_name_s');
        if (!empty($name)) {
            $query .= " and model.name ilike '%" . $name . "%'";
        }

        $categorycode = $this->input->post('model_categorycode_s');
        if (!empty($categorycode)) {
            $query .= " and model.modelcategorycode='" . $categorycode . "'";
        }

        $finishingcode = $this->input->post('model_finishingcode_s');
        if (!empty($finishingcode)) {
            $query .= " and model.finishingcode='" . $finishingcode . "'";
        }

        $materialcode = $this->input->post('model_materialcode_s');
        if (!empty($materialcode)) {
            $query .= " and model.materialcode='" . $materialcode . "'";
        }

        $topcode = $this->input->post('model_topcode_s');
        if (!empty($topcode)) {
            $query .= " and model.topcode='" . $topcode . "'";
        }
        $mirrorglasscode = $this->input->post('model_mirrorglasscode_s');
        if (!empty($mirrorglasscode)) {
            $query .= " and model.mirrorglasscode='" . $mirrorglasscode . "'";
        }
        $foamcode = $this->input->post('model_foamcode_s');
        if (!empty($foamcode)) {
            $query .= " and model.foamcode='" . $foamcode . "'";
        }
        $interlinercode = $this->input->post('model_interlinercode_s');
        if (!empty($interlinercode)) {
            $query .= " and model.interlinercode='" . $interlinercode . "'";
        }
        $fabriccode = $this->input->post('model_fabriccode_s');
        if (!empty($fabriccode)) {
            $query .= " and model.fabriccode='" . $fabriccode . "'";
        }
        $furringcode = $this->input->post('model_furringcode_s');
        if (!empty($furringcode)) {
            $query .= " and model.furringcode='" . $furringcode . "'";
        }
        $accessoriescode = $this->input->post('model_accessoriescode_s');
        if (!empty($accessoriescode)) {
            $query .= " and model.accessoriescode='" . $accessoriescode . "'";
        }

        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (model.originalcode ilike '%$q%' or model.name ilike '%$q%' or 
                             model.mastercode ilike '%$q%' or model.code ilike '%$q%')";
        }

        $status = $this->input->post("status");
        //echo $status."sa";
        if ($status !== -1 && $status !== "") {
//            echo 'bvn';
            if ($status == 1) {
                $query .= " and model.open=true ";
            }if ($status == 0) {
                //$query .= " and model.open=false ";
            }

            if ($status == 2) {
                $query .= " and model.complete=1";
            }if ($status == 3) {
                $query .= " and model.complete=0";
            }
        }
//        echo $query;
//        exit;
        if ($this->session->userdata('department') == 4) {
            $query .= " and employee.departmentid=" . $this->session->userdata('department');
        }

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');

        if (empty($sort)) {
            $sort = "id";
        }if (empty($order)) {
            $order = "desc";
        }

        $query .= " order by model.$sort $order";

//        echo $query;
        echo $this->model_model->get($query);
    }

    function get_open() {
        $query = "select 
                model.*,
                model.id modelid,
                modelcategory.description modelcategory,
                finishing.description finishing,
                material.description material,
                top.description top,
                mirrorglass.description mirrorglass,
                foam.description foam,
                interliner.description interliner,
                fabric.description fabric,
                furring.description furring,
                accessories.description accessories,
                costing.final_selling_price
                from model
                join modelcategory on model.modelcategorycode=modelcategory.code
                left join finishing on model.finishingcode=finishing.code
                left join material on model.materialcode=material.code
                left join top on model.topcode=top.code
                left join mirrorglass on model.mirrorglasscode=mirrorglass.code
                left join foam on model.foamcode=foam.code
                left join interliner on model.interlinercode=interliner.code
                left join fabric on model.fabriccode=fabric.code
                left join furring on model.furringcode=furring.code
                left join accessories on model.accessoriescode=accessories.code 
                left join costing on model.id=costing.modelid
                left join employee on model.create_by=employee.id
                where model.open=true ";

        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (model.originalcode ilike '%$q%' or model.name ilike '%$q%' or 
                             model.mastercode ilike '%$q%' or model.code ilike '%$q%')";
        }

        $query .= " order by model.id desc";

        //echo $query;
        echo $this->model_model->get($query);
    }

    function get_ready() {
        $query = "select 
        model.*,
        model.id modelid,
        modelcategory.description modelcategory,
        finishing.description finishing,
        material.description material,
        top.description top,
        mirrorglass.description mirrorglass,
        foam.description foam,
        interliner.description interliner,
        fabric.description fabric,
        furring.description furring,
        accessories.description accessories,
        costing.selling_price,
        costing.selling_price unitprice,
        costing.currency
        from costing 
        join model on costing.modelid=model.id
        join modelcategory on model.modelcategorycode=modelcategory.code
        left join finishing on model.finishingcode=finishing.code
        left join material on model.materialcode=material.code
        left join top on model.topcode=top.code
        left join mirrorglass on model.mirrorglasscode=mirrorglass.code
        left join foam on model.foamcode=foam.code
        left join interliner on model.interlinercode=interliner.code
        left join fabric on model.fabriccode=fabric.code
        left join furring on model.furringcode=furring.code
        left join accessories on model.accessoriescode=accessories.code 
        where true";
        $query .= " order by model.id desc";
        echo $this->model_model->get_ready($query);
    }

    function add() {
        $this->load->view('model/add');
    }

    function save($id) {

        $originalcode = $this->input->post('originalcode');
        $name = $this->input->post('name');
        $mastercode = $this->input->post('mastercode');
        $code = $this->input->post('code');
        $modelcategorycode = $this->input->post('modelcategorycode');
        $finishingcode = $this->input->post('finishingcode');
        $materialcode = $this->input->post('materialcode');
        $topcode = $this->input->post('topcode');
        $mirrorglasscode = $this->input->post('mirrorglasscode');
        $foamcode = $this->input->post('foamcode');
        $interlinercode = $this->input->post('interlinercode');
        $fabriccode = $this->input->post('fabriccode');
        $furringcode = $this->input->post('furringcode');
        $accessoriescode = $this->input->post('accessoriescode');
        $itemsize_mm_w = (double) $this->input->post('itemsize_mm_w');
        $itemsize_mm_d = (double) $this->input->post('itemsize_mm_d');
        $itemsize_mm_h = (double) $this->input->post('itemsize_mm_h');
        $itemsize_inc_w = round(($itemsize_mm_w / 25.2), 2);
        $itemsize_inc_d = round(($itemsize_mm_d / 25.2), 2);
        $itemsize_inc_h = round(($itemsize_mm_h / 25.2), 2);
        $packagingsize_mm_w = (double) $this->input->post('packagingsize_mm_w');
        $packagingsize_mm_d = (double) $this->input->post('packagingsize_mm_d');
        $packagingsize_mm_h = (double) $this->input->post('packagingsize_mm_h');
        $packagingsize_inc_w = round(($packagingsize_mm_w / 25.2), 2);
        $packagingsize_inc_d = round(($packagingsize_mm_d / 25.2), 2);
        $packagingsize_inc_h = round(($packagingsize_mm_h / 25.2), 2);
        $packagingsize2_mm_w = (double) $this->input->post('packagingsize2_mm_w');
        $packagingsize2_mm_d = (double) $this->input->post('packagingsize2_mm_d');
        $packagingsize2_mm_h = (double) $this->input->post('packagingsize2_mm_h');
        $packagingsize2_inc_w = round(($packagingsize2_mm_w / 25.2), 2);
        $packagingsize2_inc_d = round(($packagingsize2_mm_d / 25.2), 2);
        $packagingsize2_inc_h = round(($packagingsize2_mm_h / 25.2), 2);

        $seat_width = (double) $this->input->post('seat_width');
        $seat_depth = (double) $this->input->post('seat_depth');
        $seat_height = (double) $this->input->post('seat_height');
        $arm_height = (double) $this->input->post('arm_height');


        $data = array(
            'originalcode' => $originalcode,
            'name' => $name,
            'mastercode' => $mastercode,
            'code' => $code,
            'modelcategorycode' => $modelcategorycode,
            'finishingcode' => $finishingcode,
            'materialcode' => $materialcode,
            'topcode' => $topcode,
            'mirrorglasscode' => $mirrorglasscode,
            'foamcode' => $foamcode,
            'interlinercode' => $interlinercode,
            'fabriccode' => $fabriccode,
            'furringcode' => $furringcode,
            'accessoriescode' => $accessoriescode,
            'itemsize_mm_w' => $itemsize_mm_w,
            'itemsize_mm_d' => $itemsize_mm_d,
            'itemsize_mm_h' => $itemsize_mm_h,
            'itemsize_inc_w' => $itemsize_inc_w,
            'itemsize_inc_d' => $itemsize_inc_d,
            'itemsize_inc_h' => $itemsize_inc_h,
            'packagingsize_mm_w' => $packagingsize_mm_w,
            'packagingsize_mm_d' => $packagingsize_mm_d,
            'packagingsize_mm_h' => $packagingsize_mm_h,
            'packagingsize_inc_w' => $packagingsize_inc_w,
            'packagingsize_inc_d' => $packagingsize_inc_d,
            'packagingsize_inc_h' => $packagingsize_inc_h,
            'packagingsize2_mm_w' => $packagingsize2_mm_w,
            'packagingsize2_mm_d' => $packagingsize2_mm_d,
            'packagingsize2_mm_h' => $packagingsize2_mm_h,
            'packagingsize2_inc_w' => $packagingsize2_inc_w,
            'packagingsize2_inc_d' => $packagingsize2_inc_d,
            'packagingsize2_inc_h' => $packagingsize2_inc_h,
            'seat_width' => $seat_width,
            'seat_depth' => $seat_depth,
            'seat_height' => $seat_height,
            'arm_height' => $arm_height
        );
        if ($id == 0) {
            $data['create_by'] = $this->session->userdata('id');
            if ($this->model_model->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_model->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_model->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function close() {
        $id = $this->input->post('id');
        $data = array(
            "open" => 'false'
        );
        if ($this->model_model->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function open() {
        $id = $this->input->post('id');
        $data = array(
            "open" => 'true'
        );
        if ($this->model_model->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function complete() {
        $id = $this->input->post('id');
        $data = array(
            "complete" => '1'
        );
        if ($this->model_model->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function dialog_search_list($form) {
        $data['form'] = $form;
        $this->load->view('model/dialog_search_list', $data);
    }

    function get_available_for_costing() {
        $query = "select 
                model.*,
                modelcategory.description modelcategory,
                finishing.description finishing,
                material.description material,
                top.description top,
                mirrorglass.description mirrorglass,
                foam.description foam,
                interliner.description interliner,
                fabric.description fabric,
                furring.description furring,
                accessories.description accessories
                from model
                left join modelcategory on model.modelcategorycode=modelcategory.code
                left join finishing on model.finishingcode=finishing.code
                left join material on model.materialcode=material.code
                left join top on model.topcode=top.code
                left join mirrorglass on model.mirrorglasscode=mirrorglass.code
                left join foam on model.foamcode=foam.code
                left join interliner on model.interlinercode=interliner.code
                left join fabric on model.fabriccode=fabric.code
                left join furring on model.furringcode=furring.code
                left join accessories on model.accessoriescode=accessories.code 
                where true and model.id not in (select modelid from costing) 
                and model.open = true";

        $q = $this->input->post('q');

        if (!empty($q)) {
            $query .= " and (model.originalcode ilike '%$q%' or model.name ilike '%$q%' or 
                             model.mastercode ilike '%$q%' or model.code ilike '%$q%')";
        }
//        echo $query;
        echo $this->model_model->get_for_combo($query);
    }

    function product_without_price_get() {
        $query = "select 
                model.*,
                modelcategory.description modelcategory,
                finishing.description finishing,
                material.description material,
                top.description top,
                mirrorglass.description mirrorglass,
                foam.description foam,
                interliner.description interliner,
                fabric.description fabric,
                furring.description furring,
                accessories.description accessories
                from model
                join modelcategory on model.modelcategorycode=modelcategory.code
                left join finishing on model.finishingcode=finishing.code
                left join material on model.materialcode=material.code
                left join top on model.topcode=top.code
                left join mirrorglass on model.mirrorglasscode=mirrorglass.code
                left join foam on model.foamcode=foam.code
                left join interliner on model.interlinercode=interliner.code
                left join fabric on model.fabriccode=fabric.code
                left join furring on model.furringcode=furring.code
                left join accessories on model.accessoriescode=accessories.code 
                where true and model.id not in (select modelid from costing) 
                and model.open = true";

        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (model.code ilike '%" . trim($q) . "%'
                        or model.mastercode ilike '%" . trim($q) . "%' 
                        or model.originalcode ilike '%" . trim($q) . "%'
                        or model.name ilike '%" . trim($q) . "%')";
        }
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        echo $data;
    }

    function layout_detail() {
        $this->load->view('model/detaillayout/view');
    }

    function detail_layout() {
        $this->load->view('model/detail_layout');
    }

    function updateimage($id, $filename) {
        $config['upload_path'] = './files/model/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024 * 8;

        if ($filename != "no-image.jpg") {
            @unlink("./files/model/" . $filename);
        }
        $ext = pathinfo($_FILES['fileupload']['name'], PATHINFO_EXTENSION);
        $config['file_name'] = "$id-" . date('Ymd_his') . "." . $ext;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('fileupload')) {
            $upload_data = $this->upload->data();
            if ($this->model_model->update(array("images" => $upload_data['file_name']), array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            echo json_encode(array('msg' => $this->upload->display_errors('', '')));
        }
    }

    function copy($id) {
        $data['modelid'] = $id;
        $this->load->view('model/copy', $data);
    }

    function do_copy() {
        $code = $this->input->post('code');
        $mastercode = $this->input->post('mastercode');
        $modelid = $this->input->post('modelid');
        $name = $this->input->post('name');
        $originalcode = $this->input->post('originalcode');
        if ($this->model_model->do_copy($modelid, $code, $mastercode, $originalcode, $name)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_material_group_for_combo() {
        $this->load->model('model_modelmaterialgroup');
        $name = $this->input->post('q');
        $query = "select 
                modelmaterialgroup.*
                from modelmaterialgroup where true ";
        if ($name != "") {
            $query .= " and modelmaterialgroup.name ilike '%$name%'";
        }
        echo $this->model_modelmaterialgroup->get_material_group_for_combo($query);
    }

    function generate_bom() {
        $id = $this->input->post('id');
        if ($this->model_model->generate_bom($id)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_layout_save($modelid) {
        $this->load->model('model_modeldataillayout');

        $title = $this->input->post('title');

        $config['upload_path'] = './files/model/detaillayout/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024 * 8;
        $ext = pathinfo($_FILES['fileupload']['name'], PATHINFO_EXTENSION);
        $config['file_name'] = date('Ymd_his') . "." . $ext;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('fileupload')) {
            $upload_data = $this->upload->data();
            if ($this->model_modeldataillayout->insert(array(
                        "modelid" => $modelid,
                        "title" => $title,
                        "imagename" => $upload_data['file_name'],
                    ))) {
                echo json_encode(array('success' => true));
            } else {
                @unlink('./files/model/detaillayout/' . $upload_data['file_name']);
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            echo json_encode(array('msg' => $this->upload->display_errors('', '')));
        }
    }

    function get_detail_layout() {

        $this->load->model('model_modeldataillayout');

        $modelid = $this->input->post('modelid');
        if (empty($modelid)) {
            $modelid = 0;
        }
        $query = "select * from modeldataillayout where modelid=$modelid order by id desc";
        echo $this->model_modeldataillayout->get($query);
    }

    function detail_layout_delete() {

        $this->load->model('model_modeldataillayout');
        $id = $this->input->post('id');

        $imagename = $this->input->post('imagename');
        if (file_exists('./files/model/detaillayout/' . $imagename)) {
            if (@unlink('./files/model/detaillayout/' . $imagename)) {
                if ($this->model_modeldataillayout->delete(array("id" => $id))) {
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('msg' => $this->db->_error_message()));
                }
            } else {
                echo json_encode(array('msg' => 'Faild to remove image'));
            }
        } else {
            if ($this->model_modeldataillayout->delete(array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function load_search_form() {
        $this->load->view('model/dialog_search');
    }

    function view_bom($modelid) {
        $data['modelid'] = $modelid;
        $this->load->model('model_unit');
        $data['unit'] = $this->model_unit->selectAllResult();
        $this->load->view('model/view_bom', $data);
    }

    function get_bom($modelid) {
        $query = "with t as (
                select 
                itemid,
                unitcode,
                sum(qty) qty
                from modelmaterialsummary where modelid=$modelid group by itemid,unitcode
                )select t.*,item.code itemcode,item.description itemdescription 
                from t join item on t.itemid=item.id where true ";
        $itemcode = $this->input->post('itemcode');
        $itemdescription = $this->input->post('itemdescription');
        $unitcode = $this->input->post('unitcode');

        if (!empty($itemcode)) {
            $query .= " and item.code ilike '%" . $itemcode . "%' ";
        }if (!empty($itemdescription)) {
            $query .= " and item.description ilike '%" . $itemcode . "%' ";
        }if (!empty($unitcode)) {
            $query .= " and t.unitcode = '" . $unitcode . "'";
        }

        $query .= " order by t.itemid asc";
        echo $this->model_model->get($query);
    }

    function bom_print($modelid) {
        $query = "with t as (
                select 
                itemid,
                unitcode,
                sum(qty) qty
                from modelmaterialsummary where modelid=$modelid group by itemid,unitcode
                )select t.*,item.code itemcode,item.description itemdescription 
                from t join item on t.itemid=item.id where true ";
        $itemcode = $this->input->post('itemcode');
        $itemdescription = $this->input->post('itemdescription');
        $unitcode = $this->input->post('unitcode');

        if (!empty($itemcode)) {
            $query .= " and item.code ilike '%" . $itemcode . "%' ";
        }if (!empty($itemdescription)) {
            $query .= " and item.description ilike '%" . $itemcode . "%' ";
        }if (!empty($unitcode)) {
            $query .= " and t.unitcode = '" . $unitcode . "'";
        }

        $query .= " order by t.itemid asc ";
        $data['material'] = $this->db->query($query)->result();
        $this->load->view('model/bom_print', $data);
    }

    function prints($id = 0) {
        $post_model_id = $this->input->post('id');
        if (!empty($post_model_id)) {
            $id = $post_model_id;
        }
        $this->load->model('model_solidwood');
        $data['solidwood'] = $this->model_solidwood->select_by_model_id($id);
        $this->load->model('model_plywood');
        $data['plywood'] = $this->model_plywood->select_by_model_id($id);
        $this->load->model('model_mirror');
        $data['mirror'] = $this->model_mirror->select_by_model_id($id);
        $this->load->model('model_hardware');
        $data['hardware'] = $this->model_hardware->select_by_model_id($id);
        $this->load->model('model_upholstry');
        $data['upholstry'] = $this->model_upholstry->select_by_model_id($id);

        $this->load->model('model_modelfinishingseen');
        $data['finishingseen'] = $this->model_modelfinishingseen->select_by_model_id($id);

        $this->load->model('model_modelfinishingunseen');
        $data['finishingunseen'] = $this->model_modelfinishingunseen->select_by_model_id($id);

        $this->load->model('model_finishingtop');
        $data['finishingtop'] = $this->model_finishingtop->select_by_model_id($id);

        $this->load->model('model_packaging');
        $data['packaging'] = $this->model_packaging->select_by_model_id($id);
        $this->load->model('model_modeladditionalmaterial');
        $data['additionalmaterial'] = $this->model_modeladditionalmaterial->select_by_model_id($id);
        $data['model'] = $this->model_model->select_by_id($id);
        $this->load->view('model/prints', $data);
    }

    function get_process_stock50() {
        $query = "
            with t as (
            select 
            joborderitembarcode.id,
            joborderitembarcode.serial,
            joborderitembarcode.modelid,
            joborderitembarcode.stock_in_processid,
            joborderitembarcode.joborderid,
            model.code model_code,
            model.name model_name,
            tracking_process.name process_name
            from joborderitembarcode
            join model on joborderitembarcode.modelid=model.id
            join tracking_process on joborderitembarcode.stock_in_processid=tracking_process.id
            where stock_in_processid != 0  and joborderitembarcode.id not in (
                        select joborderitembarcode_reference_id from 
                        joborderitembarcode where joborderitembarcode_reference_id != 0
                ) and joborderitembarcode.active=true
            ) select * from t where true 
        ";

        $modelid = $this->input->post('modelid');
        if (!empty($modelid)) {
            $query .= " and t.modelid=" . trim($modelid) . "";
        }
        $processid = $this->input->post('processid');
        if (!empty($processid)) {
            $query .= " and t.stock_in_processid=" . trim($processid) . "";
        }
        $serial_number = $this->input->post("serial_number");
        if (!empty($serial_number)) {
            $query .= " and t.serial ilike '%" . $serial_number . "%'";
        }

//        $query .= " order by t.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        echo $this->model_model->get($query);
    }

    function print_stock50() {
        $query = "
            with t as (
            select 
            joborderitembarcode.id,
            joborderitembarcode.serial,
            joborderitembarcode.modelid,
            joborderitembarcode.stock_in_processid,
            joborderitembarcode.joborderid,
            model.code model_code,
            model.name model_name,
            tracking_process.name process_name
            from joborderitembarcode
            join model on joborderitembarcode.modelid=model.id
            join tracking_process on joborderitembarcode.stock_in_processid=tracking_process.id
            where stock_in_processid != 0  and joborderitembarcode.id not in (
                        select joborderitembarcode_reference_id from 
                        joborderitembarcode where joborderitembarcode_reference_id != 0
                ) and joborderitembarcode.active=true
            ) select * from t where true 
        ";

        $modelid = $this->input->post('modelid');
        if (!empty($modelid)) {
            $query .= " and t.modelid=" . trim($modelid) . "";
        }
        $processid = $this->input->post('processid');
        if (!empty($processid)) {
            $query .= " and t.stock_in_processid=" . trim($processid) . "";
        }
        $serial_number = $this->input->post("serial_number");
        if (!empty($serial_number)) {
            $query .= " and t.serial ilike '%" . $serial_number . "%'";
        }

        $query .= " order by t.id desc ";
        $this->load->model('model_company');
        $data['company'] = $this->model_company->select();
        $data['model_process'] = $this->db->query($query)->result();
        $this->load->view('model/print_process_stock50',$data);
    }

    function add_stock50() {
        $this->load->view('model/add_stock50');
    }

    function save_stock50() {
        $data = array(
            "serial" => $this->input->post('serial'),
            "modelid" => $this->input->post('modelid'),
            "stock_in_processid" => $this->input->post('processid')
        );
        if ($this->db->insert("joborderitembarcode", $data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete_stock50() {
        $id = $this->input->post('id');
        if ($this->db->delete("joborderitembarcode", array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function remove_stock50() {
        $id = $this->input->post('id');
        if ($this->db->update("joborderitembarcode", array("stock_in_processid" => 0), array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function load_image($image) {
        echo "<img src='files/model/" . $image . "' style='padding-top: 20px; max-width: 150px;max-height: 150px;'/>";
    }

    function export_to_excel() {

        $query = "select 
                model.*,
                 modelcategory.description modelcategory,
                model.id modelid,
                modelcategory.description modelcategory,
                finishing.description finishing,
                material.description material,
                top.description top,
                mirrorglass.description mirrorglass,
                foam.description foam,
                interliner.description interliner,
                fabric.description fabric,
                furring.description furring,
                accessories.description accessories,
                costing.final_selling_price,
                employee.name employee_created
                from model
                join modelcategory on model.modelcategorycode=modelcategory.code
                left join finishing on model.finishingcode=finishing.code
                left join material on model.materialcode=material.code
                left join top on model.topcode=top.code
                left join mirrorglass on model.mirrorglasscode=mirrorglass.code
                left join foam on model.foamcode=foam.code
                left join interliner on model.interlinercode=interliner.code
                left join fabric on model.fabriccode=fabric.code
                left join furring on model.furringcode=furring.code
                left join accessories on model.accessoriescode=accessories.code 
                left join costing on model.id=costing.modelid
                left join employee on model.create_by=employee.id
                where true ";

        $code = $this->input->post('model_code_s');
        if (!empty($code)) {
            $query .= " and model.code ilike '%" . trim($code) . "%'";
        }
        $mastercode = $this->input->post('model_mastercode_s');
        if (!empty($mastercode)) {
            $query .= " and model.mastercode ilike '%" . trim($mastercode) . "%'";
        }
        $originalcode = $this->input->post('model_originalcode_s');
        if (!empty($originalcode)) {
            $query .= " and model.originalcode ilike '%" . trim($originalcode) . "%'";
        }

        $name = $this->input->post('model_name_s');
        if (!empty($name)) {
            $query .= " and model.name ilike '%" . $name . "%'";
        }

        $categorycode = $this->input->post('model_categorycode_s');
        if (!empty($categorycode)) {
            $query .= " and model.modelcategorycode='" . $categorycode . "'";
        }

        $finishingcode = $this->input->post('model_finishingcode_s');
        if (!empty($finishingcode)) {
            $query .= " and model.finishingcode='" . $finishingcode . "'";
        }

        $materialcode = $this->input->post('model_materialcode_s');
        if (!empty($materialcode)) {
            $query .= " and model.materialcode='" . $materialcode . "'";
        }

        $topcode = $this->input->post('model_topcode_s');
        if (!empty($topcode)) {
            $query .= " and model.topcode='" . $topcode . "'";
        }
        $mirrorglasscode = $this->input->post('model_mirrorglasscode_s');
        if (!empty($mirrorglasscode)) {
            $query .= " and model.mirrorglasscode='" . $mirrorglasscode . "'";
        }
        $foamcode = $this->input->post('model_foamcode_s');
        if (!empty($foamcode)) {
            $query .= " and model.foamcode='" . $foamcode . "'";
        }
        $interlinercode = $this->input->post('model_interlinercode_s');
        if (!empty($interlinercode)) {
            $query .= " and model.interlinercode='" . $interlinercode . "'";
        }
        $fabriccode = $this->input->post('model_fabriccode_s');
        if (!empty($fabriccode)) {
            $query .= " and model.fabriccode='" . $fabriccode . "'";
        }
        $furringcode = $this->input->post('model_furringcode_s');
        if (!empty($furringcode)) {
            $query .= " and model.furringcode='" . $furringcode . "'";
        }
        $accessoriescode = $this->input->post('model_accessoriescode_s');
        if (!empty($accessoriescode)) {
            $query .= " and model.accessoriescode='" . $accessoriescode . "'";
        }



        if ($this->session->userdata('department') == 4) {
            $query .= " and employee.departmentid=" . $this->session->userdata('department');
        }
        $query .= " order by model.id desc";

        //echo $query;
        $this->load->library('excel');
        $data['model'] = $this->db->query($query)->result();
        $this->load->view('model/export_to_excel', $data);
    }

}
