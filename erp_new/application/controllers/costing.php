<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of costing
 *
 * @author hp
 */
class costing extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_costing');
    }

    function index() {
        $this->load->view('costing/view');
    }

    function view() {
        $this->load->view('costing/costing');
    }

    function load_detail() {
        $data['costingmaterialgroup'] = $this->model_costing->select_query("select * from costingmaterialgroup order by id asc");
        $this->load->view('costing/load_detail', $data);
    }

    function view_detail() {
        $data['costingmaterialgroup'] = $this->model_costing->select_query("select * from costingmaterialgroup order by id asc");
        $this->load->view('costing/detail', $data);
    }

    function get() {
        $query = "            
            with t as(
            select 
            costing.*,
            model.code item_code,
            model.originalcode original_code,
            model.name,
            model.name item_name,
            model.itemsize_mm_w dw,
            model.itemsize_mm_h dh,
            model.itemsize_mm_d dd,
            model.images,
            employee.name employee_costing_by 
            from costing 
            join model on costing.modelid=model.id 
            left join employee on costing.costingby=employee.id 
            ) select t.* from t where true 
        ";
        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and (t.item_code ilike '%$itemcode%' or t.original_code ilike '%$itemcode%' or t.item_name ilike '%$itemcode%')";
        }

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by t.$sort $order ";
        //echo $query;

        echo $this->model_costing->get($query);
    }

    function get_not_id($costingid) {
        $query = "
                select 
                costing.*,
                model.code,
                model.name,
                model.itemsize_mm_w,
                model.itemsize_mm_h,
                model.itemsize_mm_d,
                model.packagingsize_mm_w,
                model.packagingsize_mm_d,
                model.packagingsize_mm_h 
                from costing 
                join model on costing.modelid=model.id where true 
                and costing.id != $costingid
        ";
        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (model.code ilike '%$q%' or and model.name ilike '%$q%') ";
        }

        $query .= " order by costing.id desc ";
        echo $this->model_costing->get($query);
    }

    function get_material() {
        $costingid = $this->input->post('costingid');
        if (empty($costingid)) {
            $costingid = 0;
        }

        $query = "select * from costingmaterial_get_data_by_costing_id($costingid) where true ";
        $costingmaterialgroupid = $this->input->post('costingmaterialgroupid');
        if (!empty($costingmaterialgroupid)) {
            $query .= " and o_costingmaterialgroupid=$costingmaterialgroupid";
        }
        $query .= " order by o_sequenceid asc";
        echo $this->model_costing->get_material($query);
    }

    function detail_load_price() {
        $costingid = $this->input->post('costingid');
        $query = "select * from costingmaterial_get_data_by_costing_id_load_price($costingid) where true";
        $costingmaterialgroupid = $this->input->post('costingmaterialgroupid');
        if (!empty($costingmaterialgroupid)) {
            $query .= " and o_costingmaterialgroupid=$costingmaterialgroupid";
        }
        $query .= " order by o_sequenceid asc";
        echo $this->model_costing->get_material($query);
    }

    function detail_save_load_price() {
        $id = $this->input->post('id');
        $this->load->model('model_costingmaterial');

        $arr_id = "ARRAY[" . implode(",", $id) . "]";
        if ($this->model_costingmaterial->detail_save_load_price($arr_id)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function save($costingid) {
        $date = $this->input->post('date');
        $modelid = $this->input->post('modelid');
        $rate = $this->input->post('rate');
        $carving = $this->input->post('carving');
        $labour_cost_percentage = $this->input->post('labour_cost_percentage');
        $xfactor_percentage = $this->input->post('xfactor_percentage');
        $overhead_percentage = $this->input->post('overhead_percentage');
        $shipment_cost_expense = $this->input->post('shipment_cost_expense');
        $margin_percentage = $this->input->post('margin_percentage');
        $selling_price_percentage = $this->input->post('selling_price_percentage');

        $data = array(
            "date" => $date,
            "rate" => $rate,
            "carving" => $carving,
            "labour_cost_percentage" => $labour_cost_percentage,
            "xfactor_percentage" => $xfactor_percentage,
            "overhead_percentage" => $overhead_percentage,
            "shipment_cost_expense" => $shipment_cost_expense,
            "margin_percentage" => $margin_percentage,
            "selling_price_percentage" => $selling_price_percentage
        );

        if ($costingid == 0) {
            $data["modelid"] = $modelid;
            $data["costingby"] = $this->session->userdata('id');
            if ($this->model_costing->insert($data)) {
                $costingid = $this->model_costing->get_last_id();
                $file_name = "";
                if (empty($_FILES['fileupload']['name'])) {
                    $file_name = "no-image.jpg";
                } else {
                    $ext = pathinfo($_FILES['fileupload']['name'], PATHINFO_EXTENSION);
                    $file_name = "$costingid-" . date('Ymd_his') . "." . $ext;
                }
                $config['upload_path'] = './files/costing/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 1024 * 8;
                $config['file_name'] = $file_name;
                $this->load->library('upload', $config);
                $msg = "";
                if ($this->upload->do_upload('fileupload')) {
                    $upload_data = $this->upload->data();
                    $data_update = array("imagename" => $upload_data['file_name']);
                } else {
                    $data_update = array("imagename" => "no-image.jpg");
                    $msg = $this->upload->display_errors('', '');
                }

                if ($this->model_costing->update($data_update, array("id" => $costingid))) {
                    echo json_encode(array('success' => true, 'msg' => $msg));
                } else {
                    echo json_encode(array('success' => true, 'msg' => $msg . "," . $this->db->_error_message()));
                }
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_costing->update($data, array("id" => $costingid))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function updateimage($id, $filename) {
        $config['upload_path'] = './files/costing/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024 * 8;

        if ($filename != "no-image.jpg") {
            @unlink("./files/costing/" . $filename);
        }
        $ext = pathinfo($_FILES['fileupload']['name'], PATHINFO_EXTENSION);
        $config['file_name'] = "$id-" . date('Ymd_his') . "." . $ext;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('fileupload')) {
            $upload_data = $this->upload->data();
            $data_update = array("imagename" => $upload_data['file_name']);
            if ($this->model_costing->update($data_update, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            echo json_encode(array('msg' => $this->upload->display_errors('', '')));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_costing->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_save() {
        $id = $this->input->post('id');
        $yield = $this->input->post('yield');
        $cost = $this->input->post('cost');

        $data = array();
        for ($i = 0; $i < count($id); $i++) {
            $data[] = array(
                "id" => $id[$i],
                "yield" => $yield[$i],
                "cost" => $cost[$i]
            );
        }

        $this->load->model('model_costingmaterial');
        if ($this->model_costingmaterial->update_batch($data, 'id')) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_summary() {
        $costingid = $this->input->post('costingid');
        if (empty($costingid)) {
            $costingid = 0;
        }
        echo $this->model_costing->get_summary($costingid);
    }

    function calculate() {
        $costingid = $this->input->post('costingid');
        if ($this->model_costing->calculate($costingid)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_move() {
        $this->load->model('model_costingmaterial');

        $id = $this->input->post('id');
        $costingmaterialgroupid = $this->input->post('costingmaterialgroupid');

        if ($this->model_costingmaterial->update(array("costingmaterialgroupid" => $costingmaterialgroupid), array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_save_material($id) {
        $this->load->model('model_itemwarehousestock');
        $this->load->model('model_costingmaterial');
        $this->load->model('model_model');
        $costingid = $this->input->post('costingid');
        $modelid = $this->input->post('modelid');
        $costingmaterialgroupid = $this->input->post('costingmaterialgroupid');
        $itemid = $this->input->post('itemid');
        $unitcode = $this->input->post('unitcode');
        $yield = $this->input->post('yield');
        $qty = $this->input->post('qty');
        $cost = $this->model_itemwarehousestock->get_sell_price($itemid, $unitcode);

        $data = array(
            "costingmaterialgroupid" => $costingmaterialgroupid,
            "itemid" => $itemid,
            "unitcode" => $unitcode,
            "yield" => $yield,
            "qty" => $qty,
            "cost" => $cost
        );
        if ($id == 0) {
            $data["costingid"] = $costingid;
            $data["modelid"] = $modelid;

            if ($this->model_costingmaterial->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_costingmaterial->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function detail_remove_material() {
        $this->load->model('model_costingmaterial');
        $id = $this->input->post('id');
        if ($this->model_costingmaterial->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function prints($id = 0) {

        $_post_id = $this->input->post('id');
        if (!empty($_post_id)) {
            $id = $_post_id;
        }

        $query = "
            select 
            costing.*,
            model.originalcode,
            model.name,
            model.itemsize_mm_w dw,
            model.itemsize_mm_h dh,
            model.itemsize_mm_d dd,
            model.packagingsize_mm_w pw,
            model.packagingsize_mm_d pd,
            model.packagingsize_mm_h ph,
            model.packagingsize2_mm_w pw2,
            model.packagingsize2_mm_d pd2,
            model.packagingsize2_mm_h ph2,
            model.images model_image,
            (select o_total_cost from costingmaterial_get_data_by_costing_id(costing.id) where o_id = -1) roughmill,
            (select o_total_cost from costingmaterial_get_data_by_costing_id(costing.id) where o_id = -2) machining,
            (select o_total_cost from costingmaterial_get_data_by_costing_id(costing.id) where o_id = -3) assembling,
            (select o_total_cost from costingmaterial_get_data_by_costing_id(costing.id) where o_id = -4) sanding,
            (select o_total_cost from costingmaterial_get_data_by_costing_id(costing.id) where o_id = -5) finishing,
            (select o_total_cost from costingmaterial_get_data_by_costing_id(costing.id) where o_id = -6) upholstery,
            (select o_total_cost from costingmaterial_get_data_by_costing_id(costing.id) where o_id = -7) packing,
employee.name employee_costing_by
            from costing 
            join model on costing.modelid=model.id 
            left join employee on costing.costingby=employee.id 
            where costing.id=$id
        ";
//echo $query;
        $data['costing'] = $this->model_costing->select_row($query);
        $this->load->view('costing/print', $data);
    }

    function approve() {
        $this->load->view('costing/approve');
    }

    function do_approve($costingid) {
        $final_selling_price = $this->input->post('final_selling_price');
        $date_approve = $this->input->post('date');
        $query = "select costing_do_approve($costingid, $final_selling_price,'$date_approve')";

        if ($this->db->query($query)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function set_to_model() {
        $this->load->view('costing/set_to_model');
    }

    function do_set_to_model() {
        $costingid = $this->input->post('costingid');
        $date = $this->input->post('date');
        $modelid = $this->input->post('modelid');

        if ($this->model_costing->do_set_to_model($costingid, $date, $modelid, $this->session->userdata('id'))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_copy_from($costingid, $modelid) {
        $data['costingid'] = $costingid;
        $data['modelid'] = $modelid;
        $data['costingmaterialgroup'] = $this->model_costing->select_query("select * from costingmaterialgroup order by id asc");
        $this->load->view('costing/detail_copy_from', $data);
    }

    function do_detail_copy_from() {
        $categoryid = $this->input->post('categoryid');
        $from_costingid = $this->input->post('from_costingid');
        $to_costingid = $this->input->post('to_costingid');
        $modelid = $this->input->post('modelid');
        if ($this->model_costing->do_detail_copy_from($categoryid, $from_costingid, $to_costingid, $modelid)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function add_raw_material($costingid, $rawcategoryid, $rawtypeid) {
        $data['costingid'] = $costingid;
        $data['rawcategoryid'] = $rawcategoryid;
        $data['rawtypeid'] = $rawtypeid;
        if ($rawtypeid == 1) {
            $this->load->view('rawmaterial/pipa_kotak');
        } else if ($rawtypeid == 2) {
            $this->load->view('rawmaterial/pipa_bulat');
        } else if ($rawtypeid == 3 || $rawtypeid == 5) {
            $this->load->view('rawmaterial/as_kotak');
        } else if ($rawtypeid == 4) {
            $this->load->view('rawmaterial/as_bulat');
        }
    }

    function save_raw_material($costingid, $rawcategoryid, $rawtypeid, $id) {
        $tebalplat = (double) $this->input->post('tebalplat');
        $tebal = (double) $this->input->post('tebal');
        $diameter = (double) $this->input->post('diameter');
        $radius = (double) $this->input->post('radius');
        $lebar = (double) $this->input->post('lebar');
        $panjang = (double) $this->input->post('panjang');
        $qty = (double) $this->input->post('qty');
        $m2 = 0;
        $penampang = 0;
        $kg = 0;

        $bj_besi = 7850; // Kg/M3 
        $bj_stainless = 7750; // Kg/M3
        $bj_kuningan = 8430; // Kg/M3

        $data = array(
            "costingid" => $costingid,
            "rawcategoryid" => $rawcategoryid,
            "rawtypeid" => $rawtypeid,
            "tebalplat" => $tebalplat,
            "tebal" => $tebal,
            "diameter" => $diameter,
            "lebar" => $lebar,
            "radius" => $radius,
            "panjang" => $panjang,
            "qty" => $qty,
        );

        if ($rawtypeid == 1 || $rawtypeid == 3 || $rawtypeid == 5) {
            $m2 = ((2 * ($tebal + $lebar)) * $panjang * $qty) / 1000000;
            if ($rawtypeid == 3 || $rawtypeid == 5) {
                $penampang = ($tebal * $lebar) / 1000000;
                if ($rawtypeid === 5) {
                    $m2 = ((4 * ($tebal + $lebar)) * $panjang * $qty) / 1000000;
                    $penampang = ($tebal * ($lebar * 2)) / 1000000;
                }
                if ($rawcategoryid === 1) {
                    $kg = (($penampang * $panjang) * $qty * $bj_besi) / 1000;
                } else if ($rawcategoryid == 2) {
                    $kg = (($penampang * $panjang) * $qty * $bj_stainless) / 1000;
                } else if ($rawcategoryid == 3) {
                    $kg = (($penampang * $panjang) * $qty * $bj_kuningan) / 1000;
                }
                $data["penampang"] = $penampang;
            } else {
                if ($rawcategoryid == 1) {
                    $kg = (($tebalplat * $m2) / 1000) * $bj_besi;
                    //echo "masuk : " . $rawtypeid . " " . $kg;
                } else {
                    $kg = (($tebalplat * $m2) / 1000) * $bj_stainless;
                }
            }
        } else if ($rawtypeid == 2) {
            $new_radius = $diameter / 2;
            $m2 = ((2 * ($diameter + $new_radius)) * $panjang * $qty) / 1000000;
            $data["radius"] = $new_radius;
            if ($rawcategoryid == 1) {
                $kg = (($tebalplat * $m2) / 1000) * $bj_besi;
            } else if ($rawcategoryid == 2) {
                $kg = (($tebalplat * $m2) / 1000) * $bj_stainless;
            }
        } else if ($rawtypeid == 4) {
            $m2 = (3.14 * $diameter * $panjang) / 1000000;
            $new_radius = $diameter / 2;
            $penampang = (3.14 * ($new_radius * $new_radius)) / 1000000;
            $data["radius"] = $new_radius;
            $data["penampang"] = $penampang;
            if ($rawcategoryid == 1) {
                $kg = (($penampang * $panjang) * $qty * $bj_besi) / 1000;
            } else if ($rawcategoryid == 2) {
                $kg = (($penampang * $panjang) * $qty * $bj_stainless) / 1000;
            } else if ($rawcategoryid == 3) {
                $kg = (($penampang * $panjang) * $qty * $bj_kuningan) / 1000;
            }
        }

        $data["m2"] = round($m2, 2);
        $data["kg"] = round($kg, 2);

        $this->load->model('model_rawmaterial');
        if ($id == 0) {
            if ($this->model_rawmaterial->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_rawmaterial->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function get_raw_material($rawcategoryid, $rawtypeid) {
        $this->load->model('model_rawmaterial');
        $costingid = $this->input->post('costingid');
        if (empty($costingid)) {
            $costingid = 0;
        }
        $query = "
select * from rawmaterial
where rawcategoryid = $rawcategoryid
and rawtypeid = $rawtypeid
and costingid = $costingid
";
        echo $this->model_rawmaterial->get($query);
    }

    function delete_raw_material() {
        $id = $this->input->post("id");
        $this->load->model('model_rawmaterial');
        if ($this->model_rawmaterial->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_total_luas($costingid, $categoryid) {
        $this->load->model('model_rawmaterial');
        echo $this->model_rawmaterial->get_total_luas($costingid, $categoryid);
    }

    function get_total_kg($costingid, $categoryid) {
        $this->load->model('model_rawmaterial');
        echo $this->model_rawmaterial->get_total_kg($costingid, $categoryid);
    }

    function rawmaterial_prints() {
        $costingid = $this->input->post('id');
        if (empty($costingid)) {
            $costingid = 0;
        }
        $query = "
                    select
                    costing.*,
                    model.code,
                    model.code original_code,
                    model.name,
                    model.name item_name,
                    model.itemsize_mm_w dw,
                    model.itemsize_mm_h dh,
                    model.itemsize_mm_d dd
                    from costing
                    join model on costing.modelid = model.id where costing.id = $costingid
                ";
        $data['costing'] = $this->model_costing->select_row($query);
        $data['costingid'] = $costingid;
        $this->load->model('model_rawmaterial');
        $this->load->view('rawmaterial/prints', $data);
    }

    function add_special_material() {
        $data['costingmaterialgroup'] = $this->model_costing->select_query("select * from costingmaterialgroup order by id asc");
        $this->load->view('costing/add_special_material', $data);
    }

    function save_special_material($costingid, $modelid, $id) {
        $costingmaterialgroupid = $this->input->post('costingmaterialgroupid');
        $code = $this->input->post('itemcode');
        $materialdescription = $this->input->post('itemname');
        $unitcode = $this->input->post('unitcode');
        $yield = $this->input->post('yield');
        $qty = $this->input->post('qty');
        $cost = $this->input->post('cost');

        $data = array(
            "costingmaterialgroupid" => $costingmaterialgroupid,
            "unitcode" => $unitcode,
            "yield" => $yield,
            "qty" => $qty,
            "cost" => $cost,
            "materialdescription" => $materialdescription,
            "material_special_code" => $code,
            "special_material" => 'true'
        );
        $this->load->model('model_costingmaterial');

        if ($id == 0) {
            $data["itemid"] = 0;
            $data["costingid"] = $costingid;
            $data["modelid"] = $modelid;
            if ($this->model_costingmaterial->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_costingmaterial->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function product_price_list() {
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "costing/product_price_list"));
        $this->load->view('costing/product_price_list', $data);
    }

    function product_price_list_get() {
        $query = "
            with t as (
            select
            productpricelist.*,
            model.images imagename,
            model.code,
            model.code original_code,
            model.name,
            model.name item_name,
            model.itemsize_mm_w,
            model.itemsize_mm_h,
            model.itemsize_mm_d,
            model.itemsize_inc_w,
            model.itemsize_inc_d,
            model.itemsize_inc_h,
            model.packagingsize_mm_w,
            model.packagingsize_mm_d,
            model.packagingsize_mm_h,
            model.seat_width,
            model.seat_depth,
            model.seat_height,
            model.arm_height
            from productpricelist
            left join model on productpricelist.modelid = model.id
            join costing on productpricelist.costingid=costing.id
            ) select t.* from t where true
        ";
        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $search_option = "%" . str_replace('|', '%|%', $itemcode) . "%";
            $query .= " and (t.code similar to '$search_option' 
                        or t.item_name similar to '$search_option' 
                        or t.original_code similar to '$search_option') ";
        }
        //$query .= " order by t.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        //echo $query;
        echo $this->model_costing->product_price_list_get($query);
    }

    function product_price_list_get_open() {

        $query = "
            select 
            productpricelist.*,
            model.originalcode,
            model.name,
            model.mastercode,
            model.code,
            model.itemsize_mm_w,
            model.itemsize_mm_d,
            model.itemsize_mm_h,
            model.packagingsize_mm_w,
            model.packagingsize_mm_d,
            model.packagingsize_mm_h
            from productpricelist 
            join model on productpricelist.modelid=model.id 
            where model.open=true
        ";

        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (model.originalcode ilike '%$q%' or model.name ilike '%$q%' or 
                             model.mastercode ilike '%$q%' or model.code ilike '%$q%')";
        }

        $query .= " order by model.name asc";

        echo $this->model_costing->get($query);
    }

    function product_price_list_edit() {
        $this->load->view('costing/edit_product_price');
    }

    function product_price_list_update($id) {
        $usd_price = (double) $this->input->post('usd_price');
        $usd_optional_price = (double) $this->input->post('usd_optional_price');
        if ($this->db->update("productpricelist", array("usd_price" => $usd_price, "usd_optional_price" => $usd_optional_price), array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function product_price_list_edit_rate() {
        $dt = $this->db->query("select nominal from kurs limit 1")->row();
        $data['nominal'] = $dt->nominal;
        $this->load->view('costing/edit_rate', $data);
    }

    function product_price_list_update_rate() {
        $nominal = $this->input->post('nominal');
        if ($this->db->query("select costing_update_rate($nominal)")) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function product_price_list_print() {
        $query = "
            with t as (
            select
            productpricelist.*,
            model.code,
            model.code original_code,
            model.originalcode,
            model.name,
            model.name item_name,
            model.itemsize_mm_w,
            model.itemsize_mm_h,
            model.itemsize_mm_d,
            model.itemsize_inc_w,
            model.itemsize_inc_d,
            model.itemsize_inc_h,
            model.packagingsize_mm_w,
            model.packagingsize_mm_d,
            model.packagingsize_mm_h,
            model.seat_width,
            model.seat_depth,
            model.seat_height,
            model.arm_height,
            model.images imagename,
            modelcategory.description category,
            material.description material,
            finishing.description finishing
            from productpricelist
            join model on productpricelist.modelid = model.id
            join costing on productpricelist.costingid=costing.id
            join modelcategory on model.modelcategorycode=modelcategory.code
            left join material on model.materialcode=material.code
            left join finishing on model.finishingcode=finishing.code
            ) select t.* from t where true 
        ";

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $search_option = "%" . str_replace('|', '%|%', $itemcode) . "%";
            $query .= " and (t.code similar to '$search_option' 
                        or t.item_name similar to '$search_option' 
                        or t.original_code similar to '$search_option') ";
        }
        $query .= " order by t.id desc ";

        $data['item'] = $this->db->query($query)->result();
        $this->load->view('costing/product_price_list_print', $data);
    }

    function product_without_price() {
        $this->load->view('costing/product_without_price');
    }

    function product_price_list_excel() {

        $query = "
            with t as (
                select
                productpricelist.*,
                model.code,
                model.code original_code,
                model.originalcode,
                model.name,
                model.name item_name,
                model.itemsize_mm_w,
                model.itemsize_mm_h,
                model.itemsize_mm_d,
                model.itemsize_inc_w,
                model.itemsize_inc_d,
                model.itemsize_inc_h,
                model.packagingsize_mm_w,
                model.packagingsize_mm_d,
                model.packagingsize_mm_h,
                model.seat_width,
                model.seat_depth,
                model.seat_height,
                model.arm_height,
                model.images imagename,
                modelcategory.description category,
                material.description material,
                finishing.description finishing
                from productpricelist
                join model on productpricelist.modelid = model.id
                join costing on productpricelist.costingid=costing.id
                join modelcategory on model.modelcategorycode=modelcategory.code
                left join material on model.materialcode=material.code
                left join finishing on model.finishingcode=finishing.code
         ) select t.* from t where true 
        ";

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $search_option = "%" . str_replace('|', '%|%', $itemcode) . "%";
            $query .= " and (t.code similar to '$search_option' 
                        or t.item_name similar to '$search_option' 
                        or t.original_code similar to '$search_option') ";
        }
        $query .= " order by t.id desc ";

        $item = $this->db->query($query)->result();

        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Product Price List');
        $this->excel->getActiveSheet()->setCellValue('A1', 'NO');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(8);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //merge cell A1 until A2
        $this->excel->getActiveSheet()->mergeCells('A1:A2');
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('B1', 'PRODUCT PHOTO');
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('B1:B2');
        $this->excel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('C1', 'ITEM CODE');
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('C1:C2');
        $this->excel->getActiveSheet()->getStyle('C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('D1', 'ITEM NAME ORIGINAL');
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('D1:D2');
        $this->excel->getActiveSheet()->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('E1', 'ITEM NAME');
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('E1:E2');
        $this->excel->getActiveSheet()->getStyle('E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('F1', 'CATEGORY');
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('F1:F2');
        $this->excel->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('G1', 'MATERIAL');
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('G1:G2');
        $this->excel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('H1', 'FINISHING');
        $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('H1:H2');
        $this->excel->getActiveSheet()->getStyle('H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('I1', 'ITEM SIZE (mm)');
        $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('I1:K1');
        $this->excel->getActiveSheet()->getStyle('I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('I2', 'W');
        $this->excel->getActiveSheet()->getStyle('I2')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('I2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('J2', 'D');
        $this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('K2', 'H');
        $this->excel->getActiveSheet()->getStyle('K2')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('K2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        $this->excel->getActiveSheet()->setCellValue('L1', 'ITEM SIZE  (Inc)');
        $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('L1:N1');
        $this->excel->getActiveSheet()->getStyle('L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('L2', 'W');
        $this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('M2', 'D');
        $this->excel->getActiveSheet()->getStyle('M2')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('M2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('M2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('N2', 'H');
        $this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('O1', 'PACKAGING (mm)');
        $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('O1:Q1');
        $this->excel->getActiveSheet()->getStyle('O1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('O2', 'W');
        $this->excel->getActiveSheet()->getStyle('O2')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('O2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('O2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('P2', 'D');
        $this->excel->getActiveSheet()->getStyle('P2')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('P2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('Q2', 'H');
        $this->excel->getActiveSheet()->getStyle('Q2')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('Q2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('Q2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('R1', 'Seat');
        $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('R1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('R1:U1');
        $this->excel->getActiveSheet()->getStyle('R1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('R2', 'WIDTH');
        $this->excel->getActiveSheet()->getStyle('R2')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('R2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('R2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('S2', 'DEPTH');
        $this->excel->getActiveSheet()->getStyle('S2')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('S2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('S2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('T2', 'HEIGHT');
        $this->excel->getActiveSheet()->getStyle('T2')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('T2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('T2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('U2', 'ARM HEIGHT');
        $this->excel->getActiveSheet()->getStyle('U2')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('U2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('U2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        $this->excel->getActiveSheet()->setCellValue('V1', 'USD PRICE');
        $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('V1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('V1:V2');
        $this->excel->getActiveSheet()->getStyle('V1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('W1', 'USD PRICE (Optional)');
        $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('W1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('W1:W2');
        $this->excel->getActiveSheet()->getStyle('W1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $this->excel->getActiveSheet()->setCellValue('X1', 'IDR PRICE');
        $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('X1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('X1:X2');
        $this->excel->getActiveSheet()->getStyle('X1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $no = 1;
        $rows = 3;
        foreach ($item as $result) {
            $this->excel->getActiveSheet()->getStyle('A' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('A' . $rows, $no++);
            $this->excel->getActiveSheet()->getStyle('A' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $objDrawing = new PHPExcel_Worksheet_Drawing();
            if ($result->imagename != "") {
                $path = 'files/model/' . $result->imagename;
                $objDrawing->setPath($path);
                $objDrawing->setWidthAndHeight(120, 120);
                $objDrawing->setResizeProportional(true);
                $objDrawing->setOffsetX(10);
                $objDrawing->setOffsetY(10);
                $objDrawing->setCoordinates('B' . $rows);
                $objDrawing->setWorksheet($this->excel->getActiveSheet());
            }

            $this->excel->getActiveSheet()->getRowDimension($rows)->setRowHeight(110);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);

            $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);

            $this->excel->getActiveSheet()->getStyle('C' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('C' . $rows, $result->code);
            $this->excel->getActiveSheet()->getStyle('C' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


            $this->excel->getActiveSheet()->getStyle('D' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('D' . $rows, $result->originalcode);
            $this->excel->getActiveSheet()->getStyle('D' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('E' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('E' . $rows, $result->name);
            $this->excel->getActiveSheet()->getStyle('E' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('F' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('F' . $rows, $result->category);
            $this->excel->getActiveSheet()->getStyle('F' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('G' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('G' . $rows, $result->material);
            $this->excel->getActiveSheet()->getStyle('G' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('H' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('H' . $rows, $result->finishing);
            $this->excel->getActiveSheet()->getStyle('H' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('I' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('I' . $rows, $result->itemsize_mm_w);
            $this->excel->getActiveSheet()->getStyle('I' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('J' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('J' . $rows, $result->itemsize_mm_d);
            $this->excel->getActiveSheet()->getStyle('J' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('K' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('K' . $rows, $result->itemsize_mm_h);
            $this->excel->getActiveSheet()->getStyle('K' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('L' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('L' . $rows, $result->itemsize_inc_w);
            $this->excel->getActiveSheet()->getStyle('L' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('M' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('M' . $rows, $result->itemsize_inc_d);
            $this->excel->getActiveSheet()->getStyle('M' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('N' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('N' . $rows, $result->itemsize_inc_h);
            $this->excel->getActiveSheet()->getStyle('N' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('O' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('O' . $rows, $result->packagingsize_mm_w);
            $this->excel->getActiveSheet()->getStyle('O' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('P' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('P' . $rows, $result->packagingsize_mm_d);
            $this->excel->getActiveSheet()->getStyle('P' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('Q' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('Q' . $rows, $result->packagingsize_mm_h);
            $this->excel->getActiveSheet()->getStyle('Q' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('R' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('R' . $rows, ($result->seat_width != 0 ? $result->seat_width : ""));
            $this->excel->getActiveSheet()->getStyle('R' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('S' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('S' . $rows, ($result->seat_depth != 0 ? $result->seat_depth : ""));
            $this->excel->getActiveSheet()->getStyle('S' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('T' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('T' . $rows, ($result->seat_height != 0 ? $result->seat_height : ""));
            $this->excel->getActiveSheet()->getStyle('T' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('U' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('U' . $rows, ($result->arm_height != 0 ? $result->arm_height : ""));
            $this->excel->getActiveSheet()->getStyle('U' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $this->excel->getActiveSheet()->getStyle('V' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('V' . $rows, $result->usd_price);
            $this->excel->getActiveSheet()->getStyle('V' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('V' . $rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $this->excel->getActiveSheet()->getStyle('W' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('W' . $rows, $result->usd_optional_price);
            $this->excel->getActiveSheet()->getStyle('W' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('W' . $rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $this->excel->getActiveSheet()->getStyle('X' . $rows)->getFont()->setSize(8);
            $this->excel->getActiveSheet()->setCellValue('X' . $rows, $result->idr_price);
            $this->excel->getActiveSheet()->getStyle('X' . $rows)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $this->excel->getActiveSheet()->getStyle('X' . $rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $rows++;
        }

        $filename = 'file.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

}
