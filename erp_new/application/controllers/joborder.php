<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of joborder
 *
 * @author hp
 */
class joborder extends CI_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_joborder');
        $this->load->model('model_joborderitem');
    }

    function index() {
        $this->load->view('joborder/layout');
    }

    function view() {
        $this->load->view('joborder/view');
    }

    function get() {
        $query = "select 
        joborder.*,
        to_char(joborder.date, 'DD-MM-YYYY') date_f,
        to_char(joborder.release_date, 'DD-MM-YYYY') release_date_f,
        to_char(joborder.expected_delivery_date, 'DD-MM-YYYY') expected_delivery_date_f,
        case joborder.status
                when 0 then 'Not Submited'
                when 1 then 'Not Released'
                when 2 then 'Not Released'
                when 3 then 'Released'
                else 'Finish'
        end as status_remark
        from joborder where true ";

        $number = $this->input->post('number');
        if (!empty($number)) {
            $query .= " and joborder.joborder_no ilike '%$number%'";
        }
        $order_type = $this->input->post('order_type');
        if (!empty($order_type)) {
            $query .= " and joborder.order_type ilike '$order_type'";
        }
        $status = $this->input->post('status');
        if ($status != "") {
            if ($status == 1) {
                $query .= " and joborder.status in (1,2)";
            } else {
                $query .= " and joborder.status in ($status)";
            }
        }

//        $query .= " order by id desc ";
        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";

        echo $this->model_joborder->get($query);
    }

    function get_for_mrp() {
        $query = "
            select 
            joborder.*,
            case joborder.final_mrp
                    when false then 'Not Submitted (New)'
                    else 'Submitted'
            end as status_remark
            from joborder where joborder.status > 0        
        ";

// $query .= " order by joborder.id desc";

        $status = $this->input->post('jostatus');
        $jonumber = $this->input->post('jonumber');
        $projectname = $this->input->post('projectname');
        $order_type = $this->input->post('order_type');
        if (!empty($status)) {
            $query .= " and joborder.final_mrp = " . $status;
        }
        if (!empty($jonumber)) {
            $query .= " and joborder.joborder_no ilike '%" . $jonumber . "%'";
        }
        if (!empty($projectname)) {
            $query .= " and joborder.project_name ilike '%" . $projectname . "%'";
        }
        if (!empty($order_type)) {
            $query .= " and joborder.order_type = '" . $order_type . "'";
        }
// echo $query;
        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        echo $this->model_joborder->get($query);
    }

    function get_available() {
        $query = "select 
                joborder.*,
                to_char(joborder.date, 'DD-MM-YYYY') date_f,
                to_char(joborder.release_date, 'DD-MM-YYYY') release_date_f,
                to_char(joborder.expected_delivery_date, 'DD-MM-YYYY') expected_delivery_date_f
                from joborder where true and joborder.status in (2,3)";
        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (joborder.joborder_no ilike '%$q%' or joborder.project_no ilike '%$q%' or joborder.project_name ilike '%$q%') ";
        }

        $query .= " order by id desc";
        echo $this->model_joborder->get($query);
    }

    function get_final_mrp() {
        $query = "select 
                joborder.*,
                to_char(joborder.date, 'DD-MM-YYYY') date_f,
                to_char(joborder.release_date, 'DD-MM-YYYY') release_date_f,
                to_char(joborder.expected_delivery_date, 'DD-MM-YYYY') expected_delivery_date_f
                from joborder where true and joborder.final_mrp=true and joborder.status != 4";
        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (joborder.joborder_no ilike '%$q%' or joborder.project_no ilike '%$q%' or joborder.project_name ilike '%$q%') ";
        }

        $query .= " order by id desc";
        echo $this->model_joborder->get($query);
    }

    function save($id) {
        $project_no = $this->input->post('project_no');
        $project_name = $this->input->post('project_name');
        $order_type = $this->input->post('order_type');
        $week = $this->input->post('week');
        $remark = $this->input->post('remark');
        $data = array(
            'project_no' => $project_no,
            'project_name' => $project_name,
            'order_type' => $order_type,
            'week' => $week,
            'remark' => $remark
        );

        if ($id == 0) {
            if ($this->model_joborder->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_joborder->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_joborder->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function generate_barcode() {
        $id = $this->input->post('id');
        if ($this->model_joborder->generate_barcode($id)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function print_barcode($id) {

        $query = "
            select 
            joborderitembarcode.id joborderitembarcodeid,
            joborderitembarcode.joborderitemid,
            joborderitembarcode.serial,
            joborderitembarcode.joborderitembarcode_reference_id,
            joborderitembarcode.joborderoutsourceid,
            joborderitembarcode.pillow,
            joborderitembarcode.hardware,
            model.originalcode,
            model.name item_name,
            model.mastercode master_code,
            model.code item_code,
            model.itemsize_mm_w,
            model.itemsize_mm_d,
            model.itemsize_mm_h,
            model.images imagename,
            joborder.joborder_no,
            joborder.project_name,
            joborder.order_type,
            salesorder.sonumber,
            salesorder.po_no,
            to_char(salesorder.shipdate, 'DD/MM/YYYY') ship_date,
            finishing.description finishing_description,
            material.description material_description,
            top.description top_description,
            mirrorglass.description mirrorglass_description,
            foam.description foam_description,
            interliner.description interliner_description,
            fabric.description fabric_description,
            furring.description furring_description,
            accessories.description accessories_description,
            salesorderdetail.remark sod_remark,
            customer.code customer_code,
            customer.name customer_name,
            vendor.name joborder_outsource_vendor_name
            from joborderitembarcode 
            join model on joborderitembarcode.modelid=model.id
            join joborder on joborderitembarcode.joborderid=joborder.id
            join joborderitem on joborderitembarcode.joborderitemid=joborderitem.id
            left join joborderoutsource on joborderitembarcode.joborderoutsourceid=joborderoutsource.id
            left join vendor on joborderoutsource.vendorid=vendor.id
            left join salesorder on joborderitem.salesorderid=salesorder.id
            left join finishing on joborderitembarcode.finishingcode = finishing.code
            left join mirrorglass on joborderitembarcode.mirrorglasscode=mirrorglass.code
            left join foam on joborderitembarcode.foamcode=foam.code
            left join fabric on joborderitembarcode.fabriccode=fabric.code
            left join interliner on joborderitembarcode.interlinercode=interliner.code
            left join furring on joborderitembarcode.furringcode=furring.code
            left join accessories on joborderitembarcode.accessoriescode=accessories.code
            left join material on joborderitembarcode.materialcode=material.code
            left join top on joborderitembarcode.topcode=top.code
            left join salesorderdetail on joborderitem.salesorderdetailid=salesorderdetail.id
            left join customer on salesorder.orderby=customer.id
            where joborderitembarcode.joborderid=$id 
        ";
        $serial = $this->input->post('serials');
        if (!empty($serial)) {
//            echo $serial;
            $new_str = str_replace(str_split('[]"'), '', $serial);
            $new_str = str_replace(',', '|', $new_str);
//            echo $new_str;
            $query .= " and joborderitembarcode.serial similar to '%($new_str)%'";
        }

        $query .= " order by joborderitembarcode.id desc ";
//        echo $query;
        $data['job_item_serial'] = $this->model_joborder->select_serial_item_query($query);
        $this->load->view('joborder/view_serial', $data);
    }

    function item_view() {
        $this->load->view('joborder/item/view');
    }

    function item_get() {
        $joborderid = $this->input->post('joborderid');
        if (empty($joborderid)) {
            $joborderid = 0;
        }
        $query = "select 
                joborderitem.*,
                model.originalcode,
                model.name modelname,
                model.mastercode,
                model.code modelcode,
                model.itemsize_mm_w,
                model.itemsize_mm_d,
                model.itemsize_mm_h,
                material.description material,
                top.description top,
                mirrorglass.description mirrorglass,
                foam.description foam,
                interliner.description interliner,
                fabric.description fabric,
                furring.description furring,
                accessories.description accessories,
                salesorder.sonumber,
                salesorder.po_no,
                customer.name customer
                from joborderitem 
                join model on joborderitem.modelid=model.id
                left join salesorder on joborderitem.salesorderid=salesorder.id
                left join customer on salesorder.orderby=customer.id
                left join material on joborderitem.materialcode=material.code
                left join top on joborderitem.topcode=top.code
                left join mirrorglass on joborderitem.mirrorglasscode=mirrorglass.code
                left join foam on joborderitem.foamcode=foam.code
                left join interliner on joborderitem.interlinercode=interliner.code
                left join fabric on joborderitem.fabriccode=fabric.code
                left join furring on joborderitem.furringcode=furring.code
                left join accessories on joborderitem.accessoriescode=accessories.code
                where joborderitem.joborderid=$joborderid";

        $code_name = $this->input->post('code_name');
        if (!empty($code_name)) {
            $query .= " and (model.name ilike '%$code_name%' or model.code ilike '%$code_name%')";
        }
        $po = $this->input->post('po');
        if (!empty($po)) {
            $query .= " and salesorder.po_no ilike '%$po%'";
        }
        $customer = $this->input->post('customer');
        if (!empty($customer)) {
            $query .= " and (customer.name ilike '%$customer%' or customer.code ilike '%$customer%')";
        }

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
//echo $query;
        echo $this->model_joborderitem->get($query);
    }

    function item_get_distinct($joborderid = 0) {
        $query = "
            with t as (
                select 
                modelid,
                sum(qty) qty 
                from joborderitem where joborderid=$joborderid
                group by modelid
                ) select t.*,
                        model.originalcode,
                        model.name modelname,
                        model.mastercode,
                        model.code modelcode,
                        model.itemsize_mm_w,
                        model.itemsize_mm_d,
                        model.itemsize_mm_h 
                from t join model on t.modelid=model.id
                ";
//          echo $query;
        echo $this->model_joborderitem->get2($query);
    }

    function item_get_for_combo($joborderid) {
        $query = "select 
                joborderitem.*,
                model.originalcode,
                model.name modelname,
                model.mastercode,
                model.code modelcode,
                model.itemsize_mm_w,
                model.itemsize_mm_d,
                model.itemsize_mm_h,
                salesorder.sonumber
                from joborderitem 
                join model on joborderitem.modelid=model.id
                left join salesorder on joborderitem.salesorderid=salesorder.id
                where joborderitem.joborderid=$joborderid ";
//        echo $query;
        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (model.code ilike '%$q%' or model.originalcode ilike '%$q%' or model.name ilike '%$q%')";
        }
        echo $this->model_joborderitem->get2($query);
    }

    function item_add() {
        $this->load->view('joborder/item/add');
    }

    function item_add2() {
        $this->load->view('joborder/item/add2');
    }

    function item_save2($joborderid) {
        $data = array(
            "joborderid" => $joborderid,
            "modelid" => $this->input->post('modelid'),
            "qty" => $this->input->post('qty'),
            "final_processid" => $this->input->post('final_processid'),
            "type" => $this->input->post('order_type')
        );

        if ($this->model_joborderitem->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function item_save() {
        $joborderid = $this->input->post('joborderid');
        $salesorderdetailid = $this->input->post('salesorderdetailid');
        $modelid = $this->input->post('modelid');
        $salesorderid = $this->input->post('salesorderid');
        $qty = $this->input->post('qty');

        $data = array();

        for ($i = 0; $i < count($salesorderdetailid); $i++) {
            $data[] = array(
                "joborderid" => $joborderid,
                "salesorderid" => $salesorderid[$i],
                "salesorderdetailid" => $salesorderdetailid[$i],
                "modelid" => $modelid[$i],
                "qty" => $qty[$i],
                "type" => "Order"
            );
        }

        if ($this->model_joborderitem->insert_batch($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function item_remove() {
        $id = $this->input->post('id');
        if ($this->model_joborderitem->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function release($id) {
        $data['joborderid'] = $id;
        $this->load->view('joborder/release', $data);
    }

    function do_release() {
        $joborderid = $this->input->post('joborderid');
        $release_date = $this->input->post('release_date');
        $release_by = $this->input->post('release_by');
        $expected_delivery_date = $this->input->post('expected_delivery_date');

        $data = array(
            'release_date' => $release_date,
            'release_by' => $release_by,
            'expected_delivery_date' => $expected_delivery_date,
            'released' => 'TRUE',
            'status' => 3
        );

        if ($this->model_joborder->update($data, array("id" => $joborderid))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function allocated_process() {
        $this->load->view('joborder/allocated_process');
    }

    function get_allocated_process() {

        $joborderid = $this->input->post('joborderid');

        if (empty($joborderid)) {
            $joborderid = 0;
        }

        $query = "select 
        joborderitemprocess.*,
        model.code modelcode,
        model.name modelname,
        tracking_process.name process
        from joborderitemprocess 
        join joborderitem on joborderitemprocess.joborderitemid=joborderitem.id
        join joborder on joborderitem.joborderid=joborder.id
        join model on joborderitemprocess.modelid=model.id
        join tracking_process on joborderitemprocess.processid=tracking_process.id 
        where joborder.id=$joborderid";

        $joborderitemid = $this->input->post('joborderitemid');
        if (!empty($joborderitemid)) {
            $query .= " and joborderitemprocess.joborderitemid=" . $joborderitemid;
        }

        $query .= " order by joborderitemprocess.processid asc";

        $this->load->model('model_joborderitemprocess');

//        $sort = $this->input->post('sort');
//        $order = $this->input->post('order');
//        $query .= " order by $sort $order ";
//        echo $query;
        echo $this->model_joborderitemprocess->get($query);
    }

    function add_on_process($id, $modelid) {
        $data['joborderitemid'] = $id;
        $data['modelid'] = $modelid;
        $this->load->view('joborder/add_on_process', $data);
    }

    function save_on_process() {
        $joborderitemid = $this->input->post('joborderitemid');
        $modelid = $this->input->post('modelid');
        $modelprocessid = $this->input->post('modelprocessid');
        $processid = $this->input->post('processid');
        $qty = $this->input->post('qty');

        $data = array(
            "joborderitemid" => $joborderitemid,
            "modelid" => $modelid,
            "modelprocessid" => $modelprocessid,
            "processid" => $processid,
            "qty" => $qty
        );

        $this->load->model('model_joborderitemprocess');
        if ($this->model_joborderitemprocess->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit_on_process($joborderitemprocessid, $modelid) {
        $data = array();
        $data['id'] = $joborderitemprocessid;
        $data['modelid'] = $modelid;
        $this->load->model('model_joborderitemprocess');
        $query = "select 
            joborderitemprocess.*,
            tracking_process.name process,
            modelprocess.stock
            from joborderitemprocess 
            join tracking_process on joborderitemprocess.processid=tracking_process.id
            join modelprocess on joborderitemprocess.modelprocessid=modelprocess.id 
            where joborderitemprocess.id=$joborderitemprocessid";
//echo $query;
        $data['joborderitemprocess'] = $this->model_joborderitemprocess->select_query($query)->row();
        $this->load->view('joborder/edit_on_process', $data);
    }

    function update_on_process() {

        $id = $this->input->post('id');
        $modelid = $this->input->post('modelid');
        $modelprocessid = $this->input->post('modelprocessid');
        $processid = $this->input->post('processid');
        $qty = $this->input->post('qty');

        $data = array(
            "modelid" => $modelid,
            "modelprocessid" => $modelprocessid,
            "processid" => $processid,
            "qty" => $qty
        );
        $this->load->model('model_joborderitemprocess');
        if ($this->model_joborderitemprocess->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete_on_process() {
        $id = $this->input->post('id');
        $this->load->model('model_joborderitemprocess');
        if ($this->model_joborderitemprocess->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function generate_mrp() {
        $id = $this->input->post('id');
        if ($this->model_joborder->generate_mrp($id)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function view_mrp($joborderid) {
        $data['joborderid'] = $joborderid;
        $this->load->view('joborder/view_mrp', $data);
    }

    function get_mrp($joborderid_g = 0) {

        $joborderid = $this->input->post('joborderid');
        if (empty($joborderid)) {
            $joborderid = $joborderid_g;
        }

        $query = "select 
                mrp.*,
                item.code itemcode,
                item.description itemdescription 
                from mrp 
                join item on mrp.itemid=item.id 
                where mrp.joborderid=$joborderid";
        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and item.code ilike '%" . $itemcode . "%' ";
        }

        $itemdescription = $this->input->post('itemdescription');
        if (!empty($itemdescription)) {
            $query .= " and item.description ilike '%" . $itemdescription . "%' ";
        }

        $code_description = $this->input->post('code_description');
        if (!empty($code_description)) {
            $query .= " and ( item.code ilike '%" . $code_description . "%' or item.description ilike '%" . $code_description . "%') ";
        }

        $q = $this->input->post('q');

        if (!empty($q)) {
            $query .= " and ( item.code ilike '%" . $q . "%' or item.description ilike '%" . $q . "%') ";
        }


//$query .= " order by item.id asc";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
//echo $query;
        echo $this->model_joborder->get($query);
    }

    function save_mrp() {
        $id = $this->input->post("id");
        $allowance_qty = $this->input->post("allowance_qty");

        $data = array();
        for ($i = 0; $i < count($id); $i++) {
            $data[] = array(
                "id" => $id[$i],
                "allowance_qty" => (double) $allowance_qty[$i]
            );
        }

        if ($this->model_joborder->update_batch($data, "id")) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function outsource() {
        $this->load->view('joborder/outsource/view');
    }

    function outsource_get() {
        $joborderid = $this->input->post('joborderid');
        if (empty($joborderid)) {
            $joborderid = 0;
        }
        $query = "select 
                joborderoutsource.*,
                model.code modelcode,
                model.name modelname,
                outsourcetype.name outsourcetype,
                joborder.id joborderid,
                vendor.name vendor
                from joborderoutsource
                join joborderitem on joborderoutsource.joborderitemid=joborderitem.id
                join joborder on joborderitem.joborderid=joborder.id
                join outsourcetype on joborderoutsource.outsourcetypeid=outsourcetype.id
                join model on joborderitem.modelid=model.id
                left join vendor on joborderoutsource.vendorid=vendor.id 
                where joborder.id=$joborderid";


        $this->load->model('model_joborderoutsource');

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        echo $this->model_joborderoutsource->get($query);
    }

    function outsource_save() {
        $joborderitemid = $this->input->post('joborderitemid');
        $qty = $this->input->post('qty');
        $type = $this->input->post('type');
        $vendorid = $this->input->post('vendorid');
        $include_material = $this->input->post('include_material');
        $include_material = (empty($include_material) ? 'true' : $include_material);
        $this->load->model('model_joborderoutsource');
        $data = array(
            "joborderitemid" => $joborderitemid,
            "qty" => $qty,
            "outsourcetypeid" => $type,
            "vendorid" => $vendorid,
            "include_material" => $include_material
        );
        if ($this->model_joborderoutsource->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function outsource_delete() {
        $id = $this->input->post('id');
        $this->load->model('model_joborderoutsource');
        if ($this->model_joborderoutsource->delete(array('id' => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function print_mrp() {
        $joborderid = $this->input->post('joborderid');
        $query = "select 
                mrp.*,
                item.code itemcode,
                item.description itemdescription 
                from mrp 
                join item on mrp.itemid=item.id 
                where mrp.joborderid=$joborderid order by item.id asc";
        $data['mrp'] = $this->db->query($query)->result();
        $data["joborder"] = $this->model_joborder->select_by_id($joborderid);
        $this->load->model('model_company');
        $data['company'] = $this->model_company->select();
        $this->load->view('joborder/print_mrp', $data);
    }

    function item_edit_form() {
        $this->load->view('joborder/item/edit');
    }

    function update_qty() {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');

        if ($this->model_joborderitem->update(array("qty" => $qty), array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function routing_card() {
        $this->load->view('joborder/routing_card');
    }

    function submit_to_create_mrp() {
        $id = $this->input->post('id');
        $data = array(
            "status" => 1
        );
        if ($this->model_joborder->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function mark_mrp_as_final() {
        $id = $this->input->post('id');
        $data = array(
            "final_mrp" => 'true'
        );
        if ($this->model_joborder->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_barcode($text = "0", $size = "45", $orientation = "horizontal", $code_type = "code128") {

        $code_string = "";
// Translate the $text into barcode the correct $code_type
        if (strtolower($code_type) == "code128") {
            $chksum = 104;
// Must not change order of array elements as the checksum depends on the array's key to validate final code
            $code_array = array(" " => "212222", "!" => "222122", "\"" => "222221", "#" => "121223", "$" => "121322", "%" => "131222", "&" => "122213", "'" => "122312", "(" => "132212", ")" => "221213", "*" => "221312", "+" => "231212", "," => "112232", "-" => "122132", "." => "122231", "/" => "113222", "0" => "123122", "1" => "123221", "2" => "223211", "3" => "221132", "4" => "221231", "5" => "213212", "6" => "223112", "7" => "312131", "8" => "311222", "9" => "321122", ":" => "321221", ";" => "312212", "<" => "322112", "=" => "322211", ">" => "212123", "?" => "212321", "@" => "232121", "A" => "111323", "B" => "131123", "C" => "131321", "D" => "112313", "E" => "132113", "F" => "132311", "G" => "211313", "H" => "231113", "I" => "231311", "J" => "112133", "K" => "112331", "L" => "132131", "M" => "113123", "N" => "113321", "O" => "133121", "P" => "313121", "Q" => "211331", "R" => "231131", "S" => "213113", "T" => "213311", "U" => "213131", "V" => "311123", "W" => "311321", "X" => "331121", "Y" => "312113", "Z" => "312311", "[" => "332111", "\\" => "314111", "]" => "221411", "^" => "431111", "_" => "111224", "\`" => "111422", "a" => "121124", "b" => "121421", "c" => "141122", "d" => "141221", "e" => "112214", "f" => "112412", "g" => "122114", "h" => "122411", "i" => "142112", "j" => "142211", "k" => "241211", "l" => "221114", "m" => "413111", "n" => "241112", "o" => "134111", "p" => "111242", "q" => "121142", "r" => "121241", "s" => "114212", "t" => "124112", "u" => "124211", "v" => "411212", "w" => "421112", "x" => "421211", "y" => "212141", "z" => "214121", "{" => "412121", "|" => "111143", "}" => "111341", "~" => "131141", "DEL" => "114113", "FNC 3" => "114311", "FNC 2" => "411113", "SHIFT" => "411311", "CODE C" => "113141", "FNC 4" => "114131", "CODE A" => "311141", "FNC 1" => "411131", "Start A" => "211412", "Start B" => "211214", "Start C" => "211232", "Stop" => "2331112");
            $code_keys = array_keys($code_array);
            $code_values = array_flip($code_keys);
            for ($X = 1; $X <= strlen($text); $X++) {
                $activeKey = substr($text, ($X - 1), 1);
                $code_string .= $code_array[$activeKey];
                $chksum = ($chksum + ($code_values[$activeKey] * $X));
            }
            $code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

            $code_string = "211214" . $code_string . "2331112";
        } elseif (strtolower($code_type) == "code39") {
            $code_array = array("0" => "111221211", "1" => "211211112", "2" => "112211112", "3" => "212211111", "4" => "111221112", "5" => "211221111", "6" => "112221111", "7" => "111211212", "8" => "211211211", "9" => "112211211", "A" => "211112112", "B" => "112112112", "C" => "212112111", "D" => "111122112", "E" => "211122111", "F" => "112122111", "G" => "111112212", "H" => "211112211", "I" => "112112211", "J" => "111122211", "K" => "211111122", "L" => "112111122", "M" => "212111121", "N" => "111121122", "O" => "211121121", "P" => "112121121", "Q" => "111111222", "R" => "211111221", "S" => "112111221", "T" => "111121221", "U" => "221111112", "V" => "122111112", "W" => "222111111", "X" => "121121112", "Y" => "221121111", "Z" => "122121111", "-" => "121111212", "." => "221111211", " " => "122111211", "$" => "121212111", "/" => "121211121", "+" => "121112121", "%" => "111212121", "*" => "121121211");

// Convert to uppercase
            $upper_text = strtoupper($text);

            for ($X = 1; $X <= strlen($upper_text); $X++) {
                $code_string .= $code_array[substr($upper_text, ($X - 1), 1)] . "1";
            }

            $code_string = "1211212111" . $code_string . "121121211";
        } elseif (strtolower($code_type) == "code25") {
            $code_array1 = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
            $code_array2 = array("3-1-1-1-3", "1-3-1-1-3", "3-3-1-1-1", "1-1-3-1-3", "3-1-3-1-1", "1-3-3-1-1", "1-1-1-3-3", "3-1-1-3-1", "1-3-1-3-1", "1-1-3-3-1");

            for ($X = 1; $X <= strlen($text); $X++) {
                for ($Y = 0; $Y < count($code_array1); $Y++) {
                    if (substr($text, ($X - 1), 1) == $code_array1[$Y])
                        $temp[$X] = $code_array2[$Y];
                }
            }

            for ($X = 1; $X <= strlen($text); $X+=2) {
                if (isset($temp[$X]) && isset($temp[($X + 1)])) {
                    $temp1 = explode("-", $temp[$X]);
                    $temp2 = explode("-", $temp[($X + 1)]);
                    for ($Y = 0; $Y < count($temp1); $Y++)
                        $code_string .= $temp1[$Y] . $temp2[$Y];
                }
            }

            $code_string = "1111" . $code_string . "311";
        } elseif (strtolower($code_type) == "codabar") {
            $code_array1 = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "-", "$", ":", "/", ".", "+", "A", "B", "C", "D");
            $code_array2 = array("1111221", "1112112", "2211111", "1121121", "2111121", "1211112", "1211211", "1221111", "2112111", "1111122", "1112211", "1122111", "2111212", "2121112", "2121211", "1121212", "1122121", "1212112", "1112122", "1112221");

// Convert to uppercase
            $upper_text = strtoupper($text);

            for ($X = 1; $X <= strlen($upper_text); $X++) {
                for ($Y = 0; $Y < count($code_array1); $Y++) {
                    if (substr($upper_text, ($X - 1), 1) == $code_array1[$Y])
                        $code_string .= $code_array2[$Y] . "1";
                }
            }
            $code_string = "11221211" . $code_string . "1122121";
        }

// Pad the edges of the barcode
        $code_length = 20;
        for ($i = 1; $i <= strlen($code_string); $i++)
            $code_length = $code_length + (integer) (substr($code_string, ($i - 1), 1));

        if (strtolower($orientation) == "horizontal") {
            $img_width = $code_length;
            $img_height = $size;
        } else {
            $img_width = $size;
            $img_height = $code_length;
        }

        $image = imagecreate($img_width, $img_height);
        $black = imagecolorallocate($image, 0, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);

        imagefill($image, 0, 0, $white);

        $location = 10;
        for ($position = 1; $position <= strlen($code_string); $position++) {
            $cur_size = $location + ( substr($code_string, ($position - 1), 1) );
            if (strtolower($orientation) == "horizontal")
                imagefilledrectangle($image, $location, 0, $cur_size, $img_height, ($position % 2 == 0 ? $white : $black));
            else
                imagefilledrectangle($image, 0, $location, $img_width, $cur_size, ($position % 2 == 0 ? $white : $black));
            $location = $cur_size;
        }
// Draw barcode to the screen
        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);
    }

    function get_item_outstanding_withdraw($joborderid) {
        $query = "select 
                mrp.id,
                mrp.ots_withdraw ots,
                mrp.itemid,
                mrp.unitcode,
                item.code itemcode,
                item.description itemdescription,
                item.moq
                from mrp 
                join item on mrp.itemid=item.id 
                where mrp.joborderid=$joborderid and mrp.ots_withdraw > 0 ";
        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and item.code ilike '%" . $itemcode . "%' ";
        }

        $itemdescription = $this->input->post('itemdescription');
        if (!empty($itemdescription)) {
            $query .= " and item.description ilike '%" . $itemdescription . "%' ";
        }

        $query .= " order by item.id asc";
//echo $query;
        echo $this->model_joborder->get($query);
    }

    function get_item_outstanding_requisition($joborderid) {
        $query = "select 
                mrp.id,
                mrp.ots_requisition ots,
                mrp.ots_requisition qty,
                mrp.itemid,
                mrp.unitcode,
                item.code itemcode,
                item.description itemdescription,
                item.moq
                from mrp 
                join item on mrp.itemid=item.id 
                where mrp.joborderid=$joborderid and mrp.ots_requisition > 0 ";
        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and item.code ilike '%" . $itemcode . "%' ";
        }

        $itemdescription = $this->input->post('itemdescription');
        if (!empty($itemdescription)) {
            $query .= " and item.description ilike '%" . $itemdescription . "%' ";
        }

        $query .= " order by item.id asc";

        echo $this->model_joborder->get($query);
    }

    function material_to_outsource($joborderid, $status) {
        $data['joborderid'] = $joborderid;
        $data['disabled'] = ($status == 0 ? "" : "disabled");
        $this->load->view('joborder/material_to_outsource', $data);
    }

    function material_to_oursource_get($joborderid) {
        $query = "
                select 
                joborderitemtooutsource.*,
                item.code,
                item.description materialdescription
                from joborderitemtooutsource 
                join item on joborderitemtooutsource.itemid=item.id 
                where joborderid=$joborderid 
            ";

        $itemcode = $this->input->post('itemcode');
        $itemdescription = $this->input->post('itemdescription');
        if (!empty($itemcode)) {
            $query .= " and item.code ilike '%$itemcode%' ";
        }if (!empty($itemdescription)) {
            $query .= " and item.description ilike '%$itemdescription%' ";
        }
        $query .= " order by joborderitemtooutsource.id desc ";
        echo $this->model_joborder->get($query);
    }

    function material_to_outsource_add() {
        $this->load->view('joborder/material_to_outsource_add');
    }

    function material_to_outsource_save($joborderid, $id) {
        $data = array(
            "itemid" => $this->input->post('itemid'),
            "unitcode" => $this->input->post('unitcode'),
            "qty" => $this->input->post('qty'),
            "remark" => $this->input->post('remark')
        );
        if ($id == 0) {
            $data["joborderid"] = $joborderid;
            if ($this->model_joborder->material_to_outsource_insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_joborder->material_to_outsource_update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function material_to_oursource_delete() {
        $id = $this->input->post('id');
        if ($this->model_joborder->material_to_outsource_delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function configure_on_process($joborderid) {
        $data['joborderid'] = $joborderid;
        $this->load->view('joborder/configure_on_process', $data);
    }

    function get_on_process_item($joborderid) {
        $query = "select 
        joborderitembarcode.id,
        joborderitembarcode.serial,
        joborderitembarcode.joborderitemprocessid,
        salesorder.sonumber,
        salesorder.po_no,
        joborderitembarcode.joborderoutsourceid,
        joborderitembarcode.joborderitemprocessid,
        joborderitembarcode.stock_in_processid,        
        joborderitembarcode.modelid,
        model.code itemcode,
        model.name itemname,
        customer.name customer,
        joborderitemprocess.processid,
        tracking_process.name processname,
        t_ref.serial ref_stock_serial,
        t_track.name start_process
        from joborderitembarcode 
        join joborder on joborderitembarcode.joborderid=joborder.id
        join joborderitem on joborderitembarcode.joborderitemid=joborderitem.id
        left join salesorder on joborderitem.salesorderid=salesorder.id
        left join customer on salesorder.orderby=customer.id
        join model on joborderitembarcode.modelid=model.id
        left join joborderitemprocess on joborderitembarcode.joborderitemprocessid=joborderitemprocess.id
        left join tracking_process on joborderitemprocess.processid=tracking_process.id
        left join (select id,serial from joborderitembarcode where id in (
                        select joborderitembarcode_reference_id from joborderitembarcode where joborderitembarcode.joborderid=$joborderid
                        )
                ) t_ref on joborderitembarcode.joborderitembarcode_reference_id=t_ref.id
        left join (select * from tracking_process) t_track on joborderitembarcode.production_start_processid=t_track.id
        where joborderitembarcode.joborderitemprocessid != 0 and joborderitembarcode.joborderid=$joborderid order by joborderitembarcode.id asc ";
        echo $this->model_joborder->get($query);
    }

    function view_detail_item($joborderid) {
        $data['joborderid'] = $joborderid;
        $this->load->model('model_tracking');
        $data['tracking_process'] = $this->model_tracking->select_all_process();
        $this->load->view('joborder/view_detail_item', $data);
    }

    function get_detail_item($joborderid) {

        $joborderid_ = $this->input->post('joborderid');
        if (!empty($joborderid_)) {
            $joborderid = $joborderid_;
        }

        $query = "
        with t as (
                select 
                joborderitembarcode.*,
                salesorder.sonumber,
                salesorder.po_no,
                joborderitembarcode.joborderoutsourceid,
                joborderitembarcode.joborderitemprocessid,
                joborderitembarcode.stock_in_processid,
                joborderitembarcode.pillow,
                joborderitembarcode.hardware,
                model.code itemcode,
                model.name itemname,
                customer.name customer,
                finishing.description finishing,
                material.description material,
                top.description top,
                mirrorglass.description mirrorglass,
                foam.description foam,
                interliner.description interliner,
                fabric.description fabric,
                furring.description furring,
                accessories.description accessories,
                (select joborderitem_is_finish(joborderitembarcode.serial)) finish,
                (select tracking_get_position_id(joborderitembarcode.serial)) positionid,
                (select tracking_get_position(joborderitembarcode.serial)) positions,
                salesorder.orderby,
                vendor.name joborder_outsource_vendor_name
                from joborderitembarcode 
                join joborder on joborderitembarcode.joborderid=joborder.id
                join joborderitem on joborderitembarcode.joborderitemid=joborderitem.id
                left join salesorder on joborderitem.salesorderid=salesorder.id
                left join customer on salesorder.orderby=customer.id
                left join joborderoutsource on joborderitembarcode.joborderoutsourceid=joborderoutsource.id
                left join vendor on joborderoutsource.vendorid=vendor.id
                join model on joborderitembarcode.modelid=model.id
                left join finishing on joborderitembarcode.finishingcode=finishing.code
                left join material on joborderitembarcode.materialcode=material.code
                left join top on joborderitembarcode.topcode=top.code
                left join mirrorglass on joborderitembarcode.mirrorglasscode=mirrorglass.code
                left join foam on joborderitembarcode.foamcode=foam.code
                left join interliner on joborderitembarcode.interlinercode=interliner.code
                left join fabric on joborderitembarcode.fabriccode=fabric.code
                left join furring on joborderitembarcode.furringcode=furring.code
                left join accessories on joborderitembarcode.accessoriescode=accessories.code
                where joborderitembarcode.joborderid=$joborderid
                order by joborderitembarcode.id desc 
        ) select t.*,
            (case when t.ship_date is not null then 'Shipping' else t.positions end ) status  
        from t where true
        ";
        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and t.itemcode ilike '%$itemcode%'";
        }
        $itemname = $this->input->post('itemname');
        if (!empty($itemname)) {
            $query .= " and t.itemname ilike '%$itemname%'";
        }
        $itemcode_or_name = $this->input->post('itemcode_or_name');
        if (!empty($itemcode_or_name)) {
            $query .= " and (t.itemcode ilike '%$itemcode_or_name%' or t.itemname ilike '%$itemcode_or_name%')";
        }
        $serial = $this->input->post('serial');
        if (!empty($serial)) {
//            $temp_serial = str_replace("|", ",", $serial);
            $query .= " and t.serial similar to '%($serial)%'";
        }
        $so = $this->input->post('so');
        if (!empty($so)) {
            $query .= " and t.sonumber ilike '%$so%'";
        }
//echo $query;
        $status = $this->input->post('status');
        if ($status != 0) {
            if (in_array($status, array(1, 2, 3, 4, 5, 6, 7))) {
                $query .= " and t.positionid=" . $status;
                if ($status == 7) {
                    $query .= " and t.finish=false ";
                }
            } else {
                if ($status == 8) {
                    $query .= " and t.finish=true and t.ship_date is null";
                } else if ($status == 9) {
                    $query .= " and t.finish=true and t.ship_date is not null";
                }
            }
        }
        $customer_id = $this->input->post('customer_id');
        if (!empty($customer_id)) {
            $query .= " and t.orderby=" . $customer_id;
        }
//        echo $query;
        echo $this->model_joborder->get($query);
    }

    function set_reference_item_on_process($joborderitembarcode, $modelid, $processid) {
        $data['joborderitembarcode'] = $joborderitembarcode;
        $data['modelid'] = $modelid;
        $data['processid'] = $processid;
        $this->load->view('joborder/set_reference_item_on_process', $data);
    }

    function get_item_detail_stock_by_process($modelid, $processid) {
        $query = "select 
                joborderitembarcode.*
                from joborderitembarcode
                where 
                modelid=$modelid and stock_in_processid=$processid 
                and joborderitembarcode.id not in (
                        select joborderitembarcode_reference_id from 
                        joborderitembarcode where joborderitembarcode_reference_id != 0
                ) ";
//echo $query;
        echo $this->model_joborder->get($query);
    }

    function do_set_reference_item_on_process($id) {
        $data = array(
            "joborderitembarcode_reference_id" => $this->input->post('joborderitembarcodeid'),
            "production_start_processid" => $this->input->post('processid')
        );
        if ($this->model_joborder->update_joborderitembarcode($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit_specification_item($serial) {
        $data["serial"] = $serial;
        $this->load->view('joborder/edit_specification_item', $data);
    }

    function update_specification_item($serial) {
        $data = array(
            "accessoriescode" => $this->input->post('accessoriescode'),
            "fabriccode" => $this->input->post('fabriccode'),
            "finishingcode" => $this->input->post('finishingcode'),
            "foamcode" => $this->input->post('foamcode'),
            "furringcode" => $this->input->post('furringcode'),
            "interlinercode" => $this->input->post('interlinercode'),
            "materialcode" => $this->input->post('materialcode'),
            "mirrorglasscode" => $this->input->post('mirrorglasscode'),
            "topcode" => $this->input->post('topcode'),
            "pillow" => $this->input->post('pillow'),
            "hardware" => $this->input->post('hardware')
        );

        if ($this->model_joborder->update_joborderitembarcode($data, array("serial" => $serial))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function item_shipment() {
        $this->load->view('joborder/shipment');
    }

    function do_item_shipment() {
        $this->load->model('model_joborderitem');

        $ship_date = $this->input->post('date');
        $serial = $this->input->post('serial');
        $data = array();

        for ($i = 0; $i < count($serial); $i++) {
            $data[] = array(
                "serial" => $serial[$i],
                "ship_date" => $ship_date
            );
        }

        if ($this->model_joborderitem->item_barcode_update_batch($data, 'serial')) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function do_close() {
        $id = $this->input->post('id');
        if ($this->model_joborder->update(array("status" => 4), array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function joborderitemprocess_is_complete_reference($jobordeid) {
        echo $this->model_joborder->joborderitemprocess_is_complete_reference($jobordeid);
    }

    function view_outsource() {
        $this->load->view('joborder/view_outsource');
    }

    function get_all_outsource($flag = "") {
        $query = "with t as (
                select 
                joborderoutsource.*,
                joborder.joborder_no,
                model.code modelcode,
                model.name modelname,
                outsourcetype.name outsourcetype,
                joborder.id joborderid,
                vendor.name vendor
                from joborderoutsource
                join joborderitem on joborderoutsource.joborderitemid=joborderitem.id
                join joborder on joborderitem.joborderid=joborder.id
                join outsourcetype on joborderoutsource.outsourcetypeid=outsourcetype.id
                join model on joborderitem.modelid=model.id
                left join vendor on joborderoutsource.vendorid=vendor.id
                ) select t.* from t where true ";

        $jo_no = $this->input->post('jo_no');
        if (!empty($jo_no)) {
            $query .= " and t.joborder_no ilike '%$jo_no%' ";
        }
        $item_code_name = $this->input->post('item_code_name');
        if (!empty($item_code_name)) {
            $query .= " and (t.modelcode ilike '%$item_code_name%' or t.modelname ilike '%$item_code_name%')";
        }
        $type = $this->input->post('type');
        if (!empty($type)) {
            $query .= " and t.outsourcetypeid=$type ";
        }
        $vendorid = $this->input->post('vendorid');
        if (!empty($vendorid)) {
            $query .= " and t.vendorid=$vendorid ";
        }

        $status = $this->input->post('status');
        if (!empty($status) && $status != '0') {
            $query .= " and t.receive=$status";
        }

        if (!empty($flag)) {
            $query .= " and t.receive=false";
        }

// $query .= " order by t.receive asc,t.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        if (!empty($sort) && !empty($order)) {
            $query .= " order by $sort $order ";
        } else {
            $query .= " order by t.id asc ";
        }


        $this->load->model('model_joborderoutsource');
        echo $this->model_joborderoutsource->get($query);
    }

    function receive_outsource() {
        $this->load->view('joborder/receive_outsource');
    }

    function outsource_do_receive($id) {
        $data = array(
            "receive" => 'true',
            "date_receive" => $this->input->post('date'),
            "remark" => $this->input->post('remark')
        );
        if ($this->db->update('joborderoutsource', $data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function outsource_do_revert() {
        $id = $this->input->post('id');
        $data = array(
            "receive" => 'false',
            "date_receive" => null,
            "remark" => ''
        );
        if ($this->db->update('joborderoutsource', $data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function print_sticker($joborderid) {
        $data['joborderid'] = $joborderid;
        $this->load->view('joborder/print_sticker_window', $data);
//        $this->load->view('joborder/print_sticker', $data);
    }

    function get_customer($joborderid) {
        $query = "
            with t as (
            select 
            distinct salesorder.shipto id
            from joborder 
            join joborderitem on joborderitem.joborderid=joborder.id 
            join salesorderdetail on joborderitem.salesorderdetailid=salesorderdetail.id
            join salesorder on salesorderdetail.salesorderid=salesorder.id
            where joborder.id=$joborderid
            ) select t.id,customer.code,customer.name from t join customer on t.id=customer.id
        ";
        echo $this->model_joborder->get($query);
    }

    function do_print_sticker($joborderid) {
        $customerid = $this->input->post('customerid');
        $query = "
          with t as(
            select 
            trck.id,
            trck.joborderitemid,
            trck.joborderid,
            trck.modelid,
            trck.serial,
            trck.jo_no,
            trck.salesorderid,
            trck.so_no,
            trck.po_no,
            trck.customerid,
            trck.modelcode,
            trck.modelname,
            trck.size_w,
            trck.size_d,
            trck.size_h,
            trck.packing_size_w,
            trck.packing_size_d,
            trck.packing_size_h,
            trck.pack_out,
            trck.ship_date,
            finishing.description finishing,
            fabric.description fabric,
            mirrorglass.description mirror,
            customer.name customer_ship_to,
            customer.address customer_address_ship_to,
            salesorder.address_shipto
            from tracking_get() trck
            join joborderitembarcode on trck.serial=joborderitembarcode.serial
            join salesorder on trck.salesorderid=salesorder.id
            join customer on salesorder.shipto = customer.id
            left join finishing on joborderitembarcode.finishingcode=finishing.code
            left join fabric on joborderitembarcode.fabriccode=fabric.code
            left join mirrorglass on joborderitembarcode.mirrorglasscode=mirrorglass.code
            where trck.salesorderid is not null
            )select t.*,model.originalcode,customer.code customer_code,model.images,
            salesorderdetail.customer_code item_customer_code
            from t join model on t.modelid=model.id
            join customer on t.customerid=customer.id 
            left join joborderitem on t.joborderitemid=joborderitem.id
            left join salesorderdetail on joborderitem.salesorderdetailid=salesorderdetail.id
        where true and t.joborderid=$joborderid and customer.id=$customerid  
        ";
        $serial = $this->input->post('serial');
        if (!empty($serial)) {
//            $query .= " and joborderitembarcode.serial similar to '%($new_str)%'";
            $new_str = str_replace(str_split('[]"'), '', $serial);
            $new_str = str_replace(',', '|', $new_str);
            $query .= " and t.serial similar to '%($new_str)%'";
        }

        $query .= "  order by t.serial asc ";
//        echo $query;//exit;

        $data['item'] = $this->db->query($query)->result();
        $data['companylogo'] = $this->input->post('companylogo');
        $data['madein'] = $this->input->post('madein');
        $data['remark'] = $this->input->post('remark');
        $data['item_code_display'] = $this->input->post('item_code_display');
        $this->load->view('joborder/sticker_print', $data);
    }

    function print_barcode_custom($joborderid) {
        $data['joborderid'] = $joborderid;
        $this->load->view('joborder/print_barcode_custom', $data);
    }

    function critical() {
        $this->load->view('joborder/critical_so');
    }

    function critical_so_print() {
        $query = "
        select 
            trck.id,trck.joborderitemid,trck.joborderid,trck.modelid,trck.serial,trck.jo_no,
            trck.salesorderid,trck.so_no,trck.po_no,trck.customerid,
            trck.modelcode,trck.modelname,trck.size_w,trck.size_d,trck.size_h,trck.packing_size_w,
            trck.packing_size_d,trck.packing_size_h,trck.pack_out,trck.ship_date,salesorder.shipdate expected_ship_date,
            model.originalcode,customer.code customer_code,customer.name customer_name,(salesorder.shipdate - now()::date) remaining_time            
        from tracking_get() trck
        join joborderitembarcode on trck.serial=joborderitembarcode.serial
        join salesorder on trck.salesorderid=salesorder.id
        join model on trck.modelid=model.id
        join customer on trck.customerid=customer.id 
        where trck.salesorderid is not null and trck.ship_date is null 
        and ((salesorder.shipdate - now()::date) < 21)  
        ";

        $serial = $this->input->post('serial');
        if (!empty($serial)) {
            $query .= " and trck.serial ilike '%$serial%'";
        }

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and (trck.modelcode ilike '%$itemcode%' or trck.modelname ilike '%$itemcode%' or model.originalcode ilike '%$itemcode%')";
        }

        $jo_no = $this->input->post('jo_no');
        if (!empty($jo_no)) {
            $query .= " and trck.jo_no ilike '%$jo_no%'";
        }
        $so_no = $this->input->post('so_no');
        if (!empty($so_no)) {
            $query .= " and trck.so_no ilike '%$so_no%'";
        }
        $po_no = $this->input->post('po_no');
        if (!empty($po_no)) {
            $query .= " and trck.po_no ilike '%$po_no%'";
        }
        $customerid = $this->input->post('customerid');
        if (!empty($customerid)) {
            $query .= " and trck.customerid=$customerid ";
        }
        $query .= " order by remaining_time asc ";
        $this->load->model('model_company');
        $data['company'] = $this->model_company->select();
        $data['product'] = $this->db->query($query)->result();
        $this->load->view('joborder/critical_so_print', $data);
    }

    function view_outsource_outstanding() {
        $this->load->view('joborder/outsource/outstanding');
    }

    function critical_jo() {
        $this->load->view('joborder/critical_jo');
    }

    function critical_jo_order_print() {
        $query = "
        with t as(
            select trck.*,
            joborder.expected_delivery_date,
            (joborder.expected_delivery_date - now()::date) exp_day_diff
            from tracking_get() trck
            join joborderitembarcode on trck.serial=joborderitembarcode.serial
            join joborder on trck.joborderid=joborder.id
            where trck.ship_date is null and trck.salesorderid is not null and trck.pack_out is not null
        )select t.*,model.originalcode,customer.code customer_code
        from t join model on t.modelid=model.id
        join customer on t.customerid=customer.id 
        where t.exp_day_diff < 21";

        $serial = $this->input->post('serial');
        if (!empty($serial)) {
            $query .= " and t.serial ilike '%$serial%'";
        }

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and (t.modelcode ilike '%$itemcode%' or t.modelname ilike '%$itemcode%' or model.originalcode ilike '%$itemcode%')";
        }

        $jo_no = $this->input->post('jo_no');
        if (!empty($jo_no)) {
            $query .= " and t.jo_no ilike '%$jo_no%'";
        }

        $so_no = $this->input->post('so_no');
        if (!empty($so_no)) {
            $query .= " and t.so_no ilike '%$so_no%'";
        }
        $po_no = $this->input->post('po_no');
        if (!empty($po_no)) {
            $query .= " and t.po_no ilike '%$po_no%'";
        }
        $customerid = $this->input->post('customerid');
        if (!empty($customerid)) {
            $query .= " and t.customerid=$customerid ";
        }

        $query .= " order by t.exp_day_diff asc ";
        $this->load->model('model_company');
        $data['company'] = $this->model_company->select();
        $data['product'] = $this->db->query($query)->result();
        $this->load->view('joborder/critical_jo_order_print', $data);
    }

    function prints($joborderid) {
        
        $query = "
            select joborder.week,joborder.expected_delivery_date,joborder.project_name,joborderitem.*,model.originalcode,model.name modelname,model.mastercode,model.code modelcode,model.itemsize_mm_w,
            model.itemsize_mm_d,model.itemsize_mm_h,material.description material,top.description top,mirrorglass.description mirrorglass,
            foam.description foam,interliner.description interliner,fabric.description fabric,furring.description furring,accessories.description accessories,
            salesorder.sonumber,salesorder.po_no,customer.name customer,customer.code customer_code,model.images,model.finishingcode fin_code_std,finishing.description finishing_std,
            salesorderdetail.finishingcode fin_sof_code,fin.description finishing_sof
            from joborderitem 
            join model on joborderitem.modelid=model.id
            join joborder on joborderitem.joborderid=joborder.id
            left join salesorder on joborderitem.salesorderid=salesorder.id
            left join salesorderdetail on joborderitem.salesorderdetailid=salesorderdetail.id
            left join customer on salesorder.orderby=customer.id
            left join material on joborderitem.materialcode=material.code
            left join top on joborderitem.topcode=top.code
            left join mirrorglass on joborderitem.mirrorglasscode=mirrorglass.code
            left join foam on joborderitem.foamcode=foam.code
            left join interliner on joborderitem.interlinercode=interliner.code
            left join fabric on joborderitem.fabriccode=fabric.code
            left join furring on joborderitem.furringcode=furring.code
            left join accessories on joborderitem.accessoriescode=accessories.code
            left join finishing on model.finishingcode=finishing.code
            left join finishing fin on salesorderdetail.finishingcode=fin.code
            where joborderitem.joborderid=$joborderid
               ";
        //echo $query;
        $this->load->model('model_joborderitem');
        $data['joborder_item'] = $this->db->query($query)->result();
        $this->load->model('model_company');
        $this->load->model('model_joborderoutsource');
        $data['company'] = $this->model_company->select();
        $this->load->view("joborder/print",$data);
    }
    
}
