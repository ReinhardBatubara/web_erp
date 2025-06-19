<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tracking
 *
 * @author user
 */
class tracking extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_tracking');
    }

    function index() {
        $this->load->model('model_customer');
        $data['customer'] = $this->model_customer->selectAllResult();
        $data['process'] = $this->model_tracking->select_all_process();
        $this->load->view('tracking/view', $data);
    }

    function get() {
        $query = "select 
            t.*,joborderitembarcode.stock_in_processid,model.originalcode,customer.code customer_code,(select tracking_get_remark(t.id)) remark, finishing.description finishing 
            from tracking_get() t
            join joborderitembarcode on t.serial=joborderitembarcode.serial
            join model on t.modelid=model.id
            left join finishing on model.finishingcode=finishing.code
            left join customer on t.customerid=customer.id where true";

        $serials = $this->input->post('serials');
        $serial = $this->input->post('serial');
        if (!empty($serials) || !empty($serial)) {
            if (!empty($serials)) {
                $query .= " and t.serial in (" . $serials . ")";
            }if (!empty($serial)) {
                $query .= " and t.serial ilike '%$serial%'";
            }
        } else {
            $query .= " and t.pack_out is null ";
        }

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and t.modelcode ilike '%$itemcode%'";
        }
        $itemname = $this->input->post('itemname');
        if (!empty($itemname)) {
            $query .= " and t.modelname ilike '%$itemname%'";
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
        $order_type = $this->input->post('order_type');
        if (!empty($order_type)) {
            $query .= " and t.order_type='$order_type'";
        }

        $processid = $this->input->post('processid');
        if (!empty($processid)) {
            $query .= " and t.positionid=$processid ";
            if ($processid == 7) {
                $query .= " and t.pack_out is null ";
            }
        }

        if (empty($serial) && empty($itemcode) && empty($itemname) && empty($jo_no) &&
                empty($so_no) && empty($po_no) && empty($customerid) && empty($order_type) &&
                empty($processid)) {
            $query .= " and joborderitembarcode.stock_in_processid = 0 ";
        }

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
//        echo $query;
        echo $this->model_tracking->get($query);
    }

    function get_tracking_process_for_combo() {
        $name = $this->input->post('q');
        $query = "select 
                tracking_process.*
                from tracking_process where true ";
        if ($name != "") {
            $query .= " and tracking_process.name ilike '%$name%'";
        }

        $query .= " order by tracking_process.id asc ";
        echo $this->model_tracking->get_tracking_process_for_combo($query);
    }

    function do_import_process() {
        $process_id = $this->input->post('process_id');
        $date = $this->input->post('date');

        $this->load->helper("file");
        if (file_exists('./tempfile/process.csv')) {
            unlink('./tempfile/process.csv');
        }
        if (file_exists('./tempfile/process.txt')) {
            unlink('./tempfile/process.txt');
        }
        $file_element_name = 'inputfile';
        $config['upload_path'] = './tempfile/';
        $config['allowed_types'] = 'csv|txt';
        $config['max_size'] = 1024 * 8;
        $config['file_name'] = 'process';
        $this->load->library('upload', $config);

        $status = "";
        $msg = "";

        $serial_upload = array();
        $row = array();
        if ($this->upload->do_upload($file_element_name)) {
            $file_uploaded = $this->upload->data();
            if ($file_uploaded['file_ext'] == ".csv") {
                $filePath = './tempfile/process.csv';
                if (($file = fopen($filePath, "r")) !== FALSE) {
                    while (($line = fgetcsv($file)) !== FALSE) {
                        //print_r($line)
                        if ($line != "") {
                            if ($this->model_tracking->is_valid($process_id, $line[0])) {
                                //echo 'sa';
                                $row[] = array(
                                    "tracking_process_id" => $process_id,
                                    "serial" => $line[0],
                                    "date" => $date
                                );
                            }
                            array_push($serial_upload, $line[0]);
                        } else {
                            $status = "error";
                            $msg = "File contain error format";
                            break;
                        }
                    }
                }
            } else {
                $filePath = './tempfile/process.txt';

                $file_handle = fopen($filePath, "r");
                while (!feof($file_handle)) {
                    $data_line = fgets($file_handle);
                    $data_line = trim($data_line);
                    if ($this->model_tracking->is_valid($process_id, $data_line)) {
                        if ($process_id == 8) {
                            $row[] = array(
                                "tracking_process_id" => 7,
                                "serial" => $data_line,
                                "dateout" => $date
                            );
                        } else {
                            $row[] = array(
                                "tracking_process_id" => $process_id,
                                "serial" => $data_line,
                                "date" => $date
                            );
                        }
                    }
                    array_push($serial_upload, $data_line);
                }
                fclose($file_handle);
            }
        } else {
            $status = 'error';
            $msg = $this->upload->display_errors('', '');
        }
//        print_r($row);
        if ($status == "") {
            $this->load->model('model_tracking');
            if (count($row) > 0) {
                $this->db->trans_start();
                if ($this->model_tracking->insert_batch($row)) {
                    $status = "success";
                    $msg = "Import data successfull";
                } else {
                    $status = "error";
                    $msg = $this->db->_error_message();
                }
                $this->db->trans_complete();
            } else {
                $status = "warning";
                $msg = "No Data to Import or some serial duplicate for selected process";
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg, 'serial' => $serial_upload));
    }

    function history($serial) {
        $data['serial'] = $serial;
        $this->load->view('tracking/history', $data);
    }

    function history_get($serial) {
        $query = "with t as (select 
            tracking.*,
            tracking_process.name,
            (select tracking_get_last_date_process_by_id(tracking.id,tracking.serial)) last_date
            from 
            tracking 
            join tracking_process on tracking.tracking_process_id=tracking_process.id 
            where serial = '$serial' order by tracking.id asc
            ) select t.*,(t.last_date - t.date) duration from t where t.last_date is not null order by t.id desc";
        echo $this->model_tracking->history_get($query);
    }

    function edit_date($serial, $processid, $status) {
        $data['serial'] = $serial;
        $data['processid'] = $processid;
        $data['status'] = $status;
        $this->load->view('tracking/edit_date', $data);
    }

    function update_date() {
        $serial = explode("-", $this->input->post('serial'));
        $processid = $this->input->post('processid');
        $status = $this->input->post('status');
        $date = $this->input->post('date');
        $err_msg = "";
        $this->db->trans_start();
        for ($i = 0; $i < count($serial); $i++) {
            if (!$this->model_tracking->update_date($serial[$i], $processid, $status, $date)) {
                $err_msg .= $this->db->_error_message();
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() == TRUE) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function do_make_stock_item() {
        $serial = implode(",", $this->input->post('serial'));
        $position = implode(",", $this->input->post('position'));

        $this->load->model('model_joborderitem');
        if ($this->model_joborderitem->do_make_stock_item($serial, $position)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function back_item() {
        $this->load->view('tracking/back');
    }

    function do_back_item() {

        $serial = implode(",", $this->input->post('serial'));
        $processid = $this->input->post('processid');
        $date = $this->input->post('date');
        $this->load->model('model_joborderitem');

        if ($this->model_joborderitem->do_back_item($serial, $processid, $date)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function view_remark($joborderitembarcodeid) {
        $data["joborderitembarcodeid"] = $joborderitembarcodeid;
        $this->load->view('tracking/view_remark', $data);
    }

    function remark_get($joborderitembarcodeid) {
        $query = "select * from tracking_remark where joborderitembarcodeid=$joborderitembarcodeid order by id desc ";
        echo $this->model_tracking->get($query);
    }

    function add_remark() {
        $this->load->view('tracking/add_remark');
    }

    function save_remark($id) {
        $joborderitembarcodeid = $this->input->post('joborderitembarcodeid');
        $notes = $this->input->post('notes');

        $data = array(
            "notes" => $notes
        );

        if ($id == 0) {
            $data["joborderitembarcodeid"] = $joborderitembarcodeid;
            if ($this->db->insert('tracking_remark', $data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->db->update('tracking_remark', $data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete_remark() {
        $id = $this->input->post("id");
        if ($this->db->delete('tracking_remark', array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function view_detail($serial) {
        $query = "
          select 
            joborderitembarcode.id joborderitembarcodeid,
            joborderitembarcode.joborderitemid,
            joborderitembarcode.serial,
            joborderitembarcode.joborderitembarcode_reference_id,
            joborderitembarcode.joborderoutsourceid,
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
            customer.name customer_name
            from joborderitembarcode 
            join model on joborderitembarcode.modelid=model.id
            join joborder on joborderitembarcode.joborderid=joborder.id
            join joborderitem on joborderitembarcode.joborderitemid=joborderitem.id
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
            where joborderitembarcode.serial='$serial'  
        ";

        $data['item'] = $this->db->query($query)->row();
        $this->load->view('tracking/view_detail', $data);
    }

    function print_target() {
        $position = $this->input->post('position');
        echo $position."<br/>";
        $query = "
            with t as(
            select 
            *
            from tracking_get()
            )select t.*,model.originalcode,customer.code customer_code,
            joborder.expected_delivery_date,
            joborder.project_name,
            finishing.description finishing,
            model.finishingcode model_finishingcode,model.images,joborder.week,            
            model.packagingsize_mm_w,
            model.packagingsize_mm_d,
            model.packagingsize_mm_h,
            joborderitem.finishingcode joborderitem_finishingcode,
            (select tracking_get_remark(t.id)) remark 
            from t join model on t.modelid=model.id
            left join customer on t.customerid=customer.id
            left join joborderitem on t.joborderitemid=joborderitem.id
            left join finishing on joborderitem.finishingcode=finishing.code
            left join joborder on t.joborderid=joborder.id 
            where t.positionid=$position
        ";
        $data['item'] = $this->db->query($query)->result();
        if ($position == 1) {

            $query = "
                with t as(
                select 
                *
                from tracking_get()
                )select t.rm_in,t.rm_aging,model.id,model.code item_code,
                model.originalcode original_code,model.name item_name,
                customer.code customer_code,
                joborder.expected_delivery_date,
                joborder.project_name,
                finishing.description finishing,
                model.finishingcode model_finishingcode,model.images,           
                model.packagingsize_mm_w,
                model.packagingsize_mm_d,
                model.packagingsize_mm_h,
                joborderitem.finishingcode joborderitem_finishingcode,
                count(*) qty,
                t.po_no
                from t join model on t.modelid=model.id
                left join customer on t.customerid=customer.id
                left join joborderitem on t.joborderitemid=joborderitem.id
                left join finishing on joborderitem.finishingcode=finishing.code
                left join joborder on t.joborderid=joborder.id 
                where t.positionid=1 and t.rm_out is null
                group by model.id,joborder.expected_delivery_date,
                joborder.project_name,finishing.description,joborderitem.finishingcode,customer.code,t.rm_in,t.rm_aging,t.po_no
                order by joborder.expected_delivery_date asc 
            ";
            $data['item'] = $this->db->query($query)->result();
            $this->load->view('tracking/print_target_roughmill', $data);
        } else if ($position == 2) {
            $query = "
                with t as(
            select 
            *
            from tracking_get()
            )select t.mc_in,t.mc_aging,model.id,model.code item_code,
            model.originalcode original_code,model.name item_name,
            customer.code customer_code,
            joborder.expected_delivery_date,
            joborder.project_name,
            joborder.week,
            finishing.description finishing,
            model.finishingcode model_finishingcode,model.images,           
            model.packagingsize_mm_w,
            model.packagingsize_mm_d,
            model.packagingsize_mm_h,
            joborderitem.finishingcode joborderitem_finishingcode,
            count(*) qty,
            t.po_no
            from t join model on t.modelid=model.id
            left join customer on t.customerid=customer.id
            left join joborderitem on t.joborderitemid=joborderitem.id
            left join finishing on joborderitem.finishingcode=finishing.code
            left join joborder on t.joborderid=joborder.id 
            where t.positionid=2 and t.mc_out is null
            group by model.id,joborder.expected_delivery_date,
            joborder.project_name,joborder.week,finishing.description,joborderitem.finishingcode,customer.code,t.mc_in,t.mc_aging,t.po_no
            order by joborder.expected_delivery_date asc 
            ";
            $data['item'] = $this->db->query($query)->result();
            $this->load->view('tracking/print_target_construction', $data);
        } else if ($position == 3) {
            $query = "
              with t as(
                select 
                *
                from tracking_get()
                )select t.cv_in,t.cv_aging,model.id,model.code item_code,
                model.originalcode original_code,model.name item_name,
                customer.code customer_code,
                joborder.expected_delivery_date,
                joborder.project_name,
                joborder.week,
                finishing.description finishing,
                model.finishingcode model_finishingcode,model.images,           
                model.packagingsize_mm_w,
                model.packagingsize_mm_d,
                model.packagingsize_mm_h,
                joborderitem.finishingcode joborderitem_finishingcode,
                count(*) qty,
                t.po_no
                from t join model on t.modelid=model.id
                left join customer on t.customerid=customer.id
                left join joborderitem on t.joborderitemid=joborderitem.id
                left join finishing on joborderitem.finishingcode=finishing.code
                left join joborder on t.joborderid=joborder.id 
                where t.positionid=3 and t.cv_out is null
                group by model.id,joborder.expected_delivery_date,
                joborder.project_name,joborder.week,finishing.description,joborderitem.finishingcode,customer.code,t.cv_in,t.cv_aging,t.po_no
                order by joborder.expected_delivery_date asc  
            ";
            $data['item'] = $this->db->query($query)->result();
            $this->load->view('tracking/print_target_carving', $data);
        } else if ($position == 4) {
            $query = "
              with t as(
                select 
                *
                from tracking_get()
                )select t.sn_in,t.sn_aging,model.id,model.code item_code,
                model.originalcode original_code,model.name item_name,
                customer.code customer_code,
                joborder.expected_delivery_date,
                joborder.project_name,
                joborder.week,
                finishing.description finishing,
                model.finishingcode model_finishingcode,model.images,           
                model.packagingsize_mm_w,
                model.packagingsize_mm_d,
                model.packagingsize_mm_h,
                joborderitem.finishingcode joborderitem_finishingcode,
                count(*) qty,
                t.po_no
                from t join model on t.modelid=model.id
                left join customer on t.customerid=customer.id
                left join joborderitem on t.joborderitemid=joborderitem.id
                left join finishing on joborderitem.finishingcode=finishing.code
                left join joborder on t.joborderid=joborder.id 
                where t.positionid=4 and t.sn_out is null
                group by model.id,joborder.expected_delivery_date,
                joborder.project_name,joborder.week,finishing.description,joborderitem.finishingcode,customer.code,t.sn_in,t.sn_aging,t.po_no
                order by joborder.expected_delivery_date asc  
            ";
            $data['item'] = $this->db->query($query)->result();
            $this->load->view('tracking/print_target_sanding', $data);
        } else if ($position == 5) {
            $query = "
                with t as(
                select 
                *
                from tracking_get()
                )select t.fn_in,t.fn_aging,model.id,model.code item_code,
                model.originalcode original_code,model.name item_name,
                customer.code customer_code,
                joborder.expected_delivery_date,
                joborder.project_name,
                finishing.description finishing,
                model.finishingcode model_finishingcode,model.images,           
                model.packagingsize_mm_w,
                model.packagingsize_mm_d,
                model.packagingsize_mm_h,
                joborderitem.finishingcode joborderitem_finishingcode,
                count(*) qty,
                t.po_no
                from t join model on t.modelid=model.id
                left join customer on t.customerid=customer.id
                left join joborderitem on t.joborderitemid=joborderitem.id
                left join finishing on joborderitem.finishingcode=finishing.code
                left join joborder on t.joborderid=joborder.id 
                where t.positionid=5 and t.pack_out is null
                group by model.id,joborder.expected_delivery_date,
                joborder.project_name,finishing.description,joborderitem.finishingcode,customer.code,t.fn_in,t.fn_aging,t.po_no
                order by joborder.expected_delivery_date asc
            ";
            $data['item'] = $this->db->query($query)->result();
            $this->load->view('tracking/print_target_finishing', $data);
        } else if ($position == 6) {

            $query = "
                with t as(
                        select 
                        *
                        from tracking_get()
                )select t.up_in,t.up_aging,model.id,model.code item_code,
                model.originalcode original_code,model.name item_name,
                customer.code customer_code,
                joborder.expected_delivery_date,
                joborder.project_name,
                finishing.description finishing,
                model.finishingcode model_finishingcode,
                model.images,           
                model.packagingsize_mm_w,
                model.packagingsize_mm_d,
                model.packagingsize_mm_h,
                material.description material,
                fabric.description fabric,
                top.description top,
                foam.description foam,
                interliner.description interliner,
                mirrorglass.description mirrorglass,
                accessories.description accessories,
                furring.description furing,
                joborderitem.finishingcode joborderitem_finishingcode,
                count(*) qty,
                t.po_no
                from t join model on t.modelid=model.id
                left join customer on t.customerid=customer.id
                left join joborderitem on t.joborderitemid=joborderitem.id
                left join finishing on joborderitem.finishingcode=finishing.code
                left join joborder on t.joborderid=joborder.id 
                left join material on joborderitem.materialcode=material.code
                left join fabric  on joborderitem.fabriccode=fabric.code
                left join top  on joborderitem.topcode=top.code
                left join mirrorglass on joborderitem.mirrorglasscode=mirrorglass.code
                left join foam on joborderitem.foamcode=foam.code
                left join interliner on joborderitem.interlinercode=interliner.code
                left join accessories on joborderitem.accessoriescode=accessories.code
                left join furring on joborderitem.furringcode=furring.code
                where t.positionid=6 and t.up_out is null
                group by model.id,joborder.expected_delivery_date,
                joborder.project_name,finishing.description,joborderitem.finishingcode,
                fabric.description,top.description,mirrorglass.description,foam.description,
                interliner.description,customer.code,t.up_in,t.up_aging,t.po_no,
                material.description,accessories.description,furring.description
                order by joborder.expected_delivery_date asc
            ";
//            echo $query;
            $data['item'] = $this->db->query($query)->result();
            $this->load->view('tracking/print_target_upholstry', $data);
        } else if ($position == 7) {
            $query = "
              with t as(
                select 
                *
                from tracking_get()
                )select t.pack_in,t.pack_aging,model.id,model.code item_code,
                model.originalcode original_code,model.name item_name,
                customer.code customer_code,
                joborder.expected_delivery_date,
                joborder.project_name,
                finishing.description finishing,
                model.finishingcode model_finishingcode,model.images,           
                model.packagingsize_mm_w,
                model.packagingsize_mm_d,
                model.packagingsize_mm_h,
                joborderitem.finishingcode joborderitem_finishingcode,
                count(*) qty,
                t.po_no
                from t join model on t.modelid=model.id
                left join customer on t.customerid=customer.id
                left join joborderitem on t.joborderitemid=joborderitem.id
                left join finishing on joborderitem.finishingcode=finishing.code
                left join joborder on t.joborderid=joborder.id 
                where t.positionid=7 and t.pack_out is null
                group by model.id,joborder.expected_delivery_date,
                joborder.project_name,finishing.description,joborderitem.finishingcode,customer.code,t.pack_in,t.pack_aging,t.po_no
                order by joborder.expected_delivery_date asc  
            ";

//            echo $query;
            $data['item'] = $this->db->query($query)->result();
            $this->load->view('tracking/print_target_packing', $data);
        }
    }

    function finished_production_order() {
        $this->load->model('model_customer');
        $data['customer'] = $this->model_customer->selectAllResult();
        $this->load->view('tracking/finished_production_order', $data);
    }

    function finished_production_order_get() {
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
                trck.ship_date
                from tracking_get() trck
                join joborderitembarcode on trck.serial=joborderitembarcode.serial
                where trck.salesorderid is not null and trck.pack_out is not null
            )select t.*,model.originalcode,customer.code customer_code
            from t join model on t.modelid=model.id
            join customer on t.customerid=customer.id 
            where true
        ";

        $serial = $this->input->post('serial');
        if (!empty($serial)) {
            $query .= " and t.serial ilike '%$serial%'";
        }

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and t.modelcode ilike '%$itemcode%'";
        }
        $itemname = $this->input->post('itemname');
        if (!empty($itemname)) {
            $query .= " and t.modelname ilike '%$itemname%'";
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

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        //echo $query;exit;
        echo $this->model_tracking->get($query);
    }

    function import_shipment() {
        $this->load->view('tracking/import_shipment');
    }

    function get_critical_order() {
        $query = "
        select 
            trck.id,trck.joborderitemid,trck.joborderid,trck.modelid,trck.serial,trck.jo_no,
            trck.salesorderid,trck.so_no,trck.po_no,trck.customerid,
            trck.modelcode,trck.modelname,trck.size_w,trck.size_d,trck.size_h,trck.packing_size_w,
            trck.packing_size_d,trck.packing_size_h,trck.pack_out,trck.ship_date,salesorder.shipdate expected_ship_date,
            model.originalcode,customer.code customer_code,(salesorder.shipdate - now()::date) remaining_time            
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
        echo $this->model_tracking->get($query);
    }

    function get_critical_job_order() {
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
        echo $this->model_tracking->get($query);
    }

    function do_import_shipment() {

        $date = $this->input->post('date');

        $this->load->helper("file");
        if (file_exists('./tempfile/process.csv')) {
            unlink('./tempfile/process.csv');
        }
        if (file_exists('./tempfile/process.txt')) {
            unlink('./tempfile/process.txt');
        }

        $file_element_name = 'inputfile';
        $config['upload_path'] = './tempfile/';
        $config['allowed_types'] = 'txt|csv';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['file_name'] = 'process';
        $this->load->library('upload', $config);

        $status = "";
        $msg = "";

        $row = array();

        if ($this->upload->do_upload($file_element_name)) {
            $file_uploaded = $this->upload->data();
            if ($file_uploaded['file_ext'] == ".csv") {
                $filePath = './tempfile/process.csv';
                if (($file = fopen($filePath, "r")) !== FALSE) {
                    while (($line = fgetcsv($file)) !== FALSE) {
                        //print_r($line)
                        if ($line != "") {
//                            if ($this->model_productiontracking->is_valid_to_upload($production_process_id, $line[0])) {
                            //echo 'sa';
                            $row[] = array(
                                "serial" => $line[0],
                                "ship_date" => $date
                            );
//                            }
                        } else {
                            $status = "error";
                            $msg = "File contain error format";
                            break;
                        }
                    }
                }
            } else {
                $filePath = './tempfile/process.txt';
                $file_handle = fopen($filePath, "r");
                while (!feof($file_handle)) {
                    $data_line = trim(fgets($file_handle));
//                    if ($this->model_productiontracking->is_valid_to_upload($production_process_id, $data_line)) {
                    $row[] = array(
                        "serial" => $data_line,
                        "ship_date" => $date
                    );
//                    }
                }
            }
            fclose($file_handle);
        } else {
            $status = 'error';
            $msg = $this->upload->display_errors('', '');
        }

        $this->load->model('model_joborderitem');
        if ($status == "") {
            if (count($row) > 0) {
                $this->db->trans_start();
                if ($this->model_joborderitem->item_barcode_update_batch($row, 'serial')) {
                    $status = "success";
                    $msg = "Import data successfull";
                } else {
                    $status = "error";
                    $msg = $this->db->_error_message();
                }
                $this->db->trans_complete();
            } else {
                $status = "warning";
                $msg = 'No Data to Import or some serial duplicate for selected Production Status';
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

}
