<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of stockout
 *
 * @author user
 */
class stockout extends CI_Controller {

    //put your code here

    var $option_view;

    public function __construct() {
        parent::__construct();
        $this->load->model('model_stockout');
        $this->load->model('model_menuaccess');
        $this->option_view = $this->model_menuaccess->get_option_view($this->session->userdata('id'), 'stockout');
    }

    function index() {
        $this->load->view('stockout/view');
    }

    function get() {
        $query = "
            with t as (
                select 
                stockout.id,
                stockout.number,
                stockout.date,
                stockout.outby,
                stockout.materialwithdrawid,
                stockout.receivedate,
                stockout.joborderid,
                stockout.nota_no,
                stockout.subsectionid,
                subsection.name subsection,
                (case when materialwithdraw.number is null then stockout.nota_no else materialwithdraw.number end) mw_number,
                (case when materialwithdraw.number is null then stockout.requestby else materialwithdraw.requestedby end) requestby,
                materialwithdraw.date request_date,
                materialwithdraw.requestedby materialwithdraw_requestby,
                employee.name employee_outby,
                stockout.remark
                from stockout 
                left join materialwithdraw on stockout.materialwithdrawid=materialwithdraw.id
                left join employee on stockout.outby=employee.id 
                left join subsection on stockout.subsectionid=subsection.id
                where true
            ) select t.*,t.requestby request_by, employee.name employee_requestby from t 
            left join employee on t.requestby = employee.id where true
        ";

        $number = $this->input->post('number');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $mw_or_nota = $this->input->post('mw_or_nota');
        if ($number != "") {
            $query .= " and t.number ilike '%" . $number . "%' ";
        }if ($datefrom != "" && $dateto != "") {
            $query .= " and t.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and t.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and t.date = '" . $dateto . "'";
        }
        if ($mw_or_nota != "") {
            $query .= " and t.mw_number ilike '%$mw_or_nota%'";
        }

        if ($this->session->userdata('id') != 'admin') {
            if ($this->session->userdata('department') == 9) {
                if ($this->session->userdata('optiongroup') != -1) {
                    if ($this->session->userdata('optiongroup') != "") {
                        $query .= " and t.outby='" . $this->session->userdata('id') . "'";
                    } else {
                        $query.= " and t.id=0";
                    }
                }
            } else {
                if ($this->option_view == 0) {
                    $query.= " and t.id=0";
                }
            }
        }

//        $query .= " order by t.id desc ";
        //echo $query;
        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        echo $this->model_stockout->get($query);
    }

    function add() {
        $this->load->view('stockout/add');
    }

    function add2() {
        //$data['materialwithdrawid'] = $this->model_stockout->create_direct();
        $this->load->view('stockout/add2');
    }

    function add_item2($joborderid) {
        $data['joborderid'] = $joborderid;
        $this->load->view('stockout/detail/add2', $data);
    }

    function detail_edit() {
        $this->load->view('stockout/detail/edit');
    }

    function get_mrp_outstanding_withdraw_by_joborderid($joborderid) {
        $query = "
                select 
                mrp.id,
                mrp.joborderid,
                mrp.ots_withdraw,
                mrp.itemid,
                item.code item_code,
                item.description item_description, 
                mrp.unitcode unit_code
                from mrp 
                join item on mrp.itemid=item.id  
                where ots_withdraw > 0 and mrp.joborderid=$joborderid
        ";
        if ($this->session->userdata('department') == 9) {
            if ($this->session->userdata('optiongroup') != -1) {
                $query .= "and mrp.itemid in (select itemid from itemwarehousestock
                           where itemwarehousestock.warehouseid=" . $this->session->userdata('optiongroup') . ")";
            }
        }

        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (item.code ilike '%$q%' or item.description ilike '%$q%')";
        }
        //echo $query;
        echo $this->model_stockout->get($query);
    }

    function direct_save() {
        $date = $this->input->post('date');
        $joborderid = $this->input->post('joborderid');
        $request_by = $this->input->post('request_by');
        $remark = $this->input->post('remark');

        $error_msg = '';
        $this->db->trans_start(TRUE);
        if (!$this->model_stockout->direct_save($date, $joborderid, $request_by, $remark, $this->session->userdata('id'))) {
            $error_msg .= $this->db->_error_message();
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(array('msg' => $error_msg));
        } else {
            echo json_encode(array('success' => true));
        }
    }

    function save_item2($stokoutid, $materialwithdrawid) {
        $mrpid = $this->input->post('mrpid');
        $itemid = $this->input->post('itemid');
        $description = $this->input->post('description');
        $unitcode = $this->input->post('unitcode');
        $warehouseid = $this->input->post('warehouseid');
        $qty = $this->input->post('qty');

        $error_msg = '';
        $this->db->trans_start(TRUE);
        if (!$this->model_stockout->direct_save_item($stokoutid, $materialwithdrawid, $itemid, $description, $unitcode, $warehouseid, $qty, $mrpid)) {
            $error_msg .= $this->db->_error_message();
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(array('msg' => $error_msg));
        } else {
            echo json_encode(array('success' => true));
        }
    }

    function save() {

        $this->load->model('model_stockoutdetail');

        $id = $this->model_stockout->get_next_id();
        $date = $this->input->post('date');
        $materialwithdrawid = $this->input->post('mw_id');
        $remark = $this->input->post('remark');
        $materialwithdrawdetail_id = $this->input->post('materialwithdrawdetail_id');
        $warehouse_id = $this->input->post('warehouse_id');
        $qty_out = $this->input->post('qty_out');

        $data = array(
            "id" => $id,
            "date" => $date,
            "materialwithdrawid" => $materialwithdrawid,
            "remark" => $remark,
            "outby" => $this->session->userdata('id')
        );

        $data_detail = array();
        for ($i = 0; $i < count($materialwithdrawdetail_id); $i++) {
            $data_detail[] = array(
                "stockoutid" => $id,
                "materialwithdrawdetailid" => $materialwithdrawdetail_id[$i],
                "qty" => $qty_out[$i],
                "warehouseid" => $warehouse_id[$i]
            );
        }

        $error_msg = '';
        $this->db->trans_start(TRUE);
        if (!$this->model_stockout->insert($data)) {
            $error_msg .= $this->db->_error_message();
        }
        if (!$this->model_stockoutdetail->insert_batch($data_detail)) {
            $error_msg .= $this->db->_error_message();
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(array('msg' => $error_msg));
        } else {
            echo json_encode(array('success' => true));
        }
    }

    function update($id) {
        $data = array(
            "date" => $this->input->post('date'),
            "remark" => $this->input->post('remark')
        );

        if ($this->model_stockout->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        if ($this->model_stockout->delete(array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function waiting_to_receive() {
        $this->load->view('stockout/waiting_to_receive');
    }

    function get_wating_to_receive() {
        $materialwithdrawid = $this->input->post('materialwithdrawid');
        if (empty($materialwithdrawid)) {
            $materialwithdrawid = 0;
        }

        $query = "select 
                stockout.*,
                materialwithdraw.number mw_number,
                materialwithdraw.date request_date,
                materialwithdraw.requestedby,
                department.name department,
                (select name from employee where id=materialwithdraw.requestedby) employee_requestby,
                employee.name employee_outby
                from stockout 
                join materialwithdraw on stockout.materialwithdrawid=materialwithdraw.id
                join employee on stockout.outby=employee.id 
                join department on materialwithdraw.departmentid=department.id
                where materialwithdraw.requestedby='" . $this->session->userdata('id') . "' and "
                . " materialwithdraw.id=$materialwithdrawid order by stockout.receivedate desc, stockout.id desc";

        echo $this->model_stockout->get_with_no_paging($query);
    }

    function receive() {
        if ($this->model_stockout->receive($this->input->post('id'))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function prints() {
        $stockoutid = $this->input->post('stockoutid');
        $query = "
            with t as (
                select 
                stockout.id,
                stockout.number,
                stockout.date,
                stockout.outby,
                stockout.materialwithdrawid,
                stockout.receivedate,
                stockout.joborderid,
                stockout.nota_no,
                (case when materialwithdraw.number is null then stockout.nota_no else materialwithdraw.number end) mw_number,
                (case when materialwithdraw.number is null then stockout.requestby else materialwithdraw.requestedby end) requestby,
                materialwithdraw.date request_date,
                materialwithdraw.requestedby materialwithdraw_requestby,
                employee.name employee_outby,
                stockout.remark
                from stockout 
                left join materialwithdraw on stockout.materialwithdrawid=materialwithdraw.id
                left join employee on stockout.outby=employee.id 
                where true
            ) select t.*,t.requestby request_by, employee.name employee_requestby from t 
            left join employee on t.requestby = employee.id where t.id=$stockoutid 
        ";
        //echo $query;
        $data['stockout'] = $this->model_stockout->select_row_query($query);
        $this->load->model('model_stockoutdetail');
        $data['stockoutdetail'] = $this->model_stockoutdetail->select_by_stockoutid($stockoutid);
        $this->load->model('model_company');
        $data['company'] = $this->model_company->select();
        $this->load->view('stockout/print', $data);
    }

    function search_form() {
        $this->load->view('stockout/search_form');
    }

    function print_detail() {
        $this->load->view('stockout/print_detail', $data);
    }

    function request() {
        $this->load->view('stockout/request');
    }

    function add_from_nota() {
        $this->load->view('stockout/add_from_nota');
    }

    function save_from_nota() {
        $date = $this->input->post('date');
        $nota_no = $this->input->post('nota_no');
        $request_by = $this->input->post('request_by');
        $remark = $this->input->post('remark');
        $subsectionid = $this->input->post('subsectionid');

        $error_msg = '';
        $this->db->trans_start(TRUE);
        if (!$this->model_stockout->save_from_nota($date, $nota_no, $request_by, $remark, $this->session->userdata('id'), $subsectionid)) {
            $error_msg .= $this->db->_error_message();
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(array('msg' => $error_msg));
        } else {
            echo json_encode(array('success' => true));
        }
    }

    function update_from_nota($id) {
        $data = array(
            "date" => $this->input->post('date'),
            "nota_no" => $this->input->post('nota_no'),
            "requestby" => $this->input->post('request_by'),
            "remark" => $this->input->post('remark')
        );

        if ($this->model_stockout->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function add_item_from_nota() {
        $this->load->view('stockout/detail/add_from_nota');
    }

    function save_item_from_nota($stockoutid) {
        $itemid = $this->input->post('itemid');
        $unitcode = $this->input->post('unitcode');
        $warehouseid = $this->input->post('warehouseid');
        $qty = $this->input->post('qty');
        $remark = $this->input->post('remark');
        if ($this->model_stockout->save_item_from_nota($stockoutid, $itemid, $unitcode, $warehouseid, $qty, $remark)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function all_detail() {
        $this->load->view('stockout/report/all_detail');
    }

    function get_all_detail() {

        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        $query = "
            with t as (
                select
                stockout.id stockoutid,
                stockout.number stockout_number,
                stockout.date,
                stockout.materialwithdrawid,
                stockout.nota_no,
                stockout.requestby,
                employee.name employee_request_by,
                stockoutdetail.id,
                stockoutdetail.itemid,
                item.code item_code,
                item.description item_description,
                stockoutdetail.unitcode,
                stockoutdetail.qty,
                stockoutdetail.warehouseid,
                warehouse.name warehouse_name_out,
                stockoutdetail.remark stockoutdetail_remark,
                stockout.transactionid
                from stockoutdetail
                join stockout on stockoutdetail.stockoutid=stockout.id
                left join employee on stockout.requestby=employee.id 
                left join warehouse on stockoutdetail.warehouseid=warehouse.id
                left join item on stockoutdetail.itemid=item.id
                where stockout.date between '$datefrom' and '$dateto' 
         ) select t.* from t where true
        ";

        $item_code = $this->input->post('item_code');
        if (!empty($item_code)) {
            $query .= " and t.item_code ilike '%$item_code%' ";
        }

        $item_description = $this->input->post('item_description');
        if (!empty($item_description)) {
            $query .= " and t.item_description ilike '%$item_description%' ";
        }

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');

        $query .= " order by t.$sort $order ";

        //echo $query;

        echo $this->model_stockout->get($query);
    }

    function print_all_detail() {

        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        $query = "
            with t as (
                select
                stockout.id stockoutid,
                stockout.number stockout_number,
                stockout.date,
                stockout.materialwithdrawid,
                stockout.nota_no,
                stockout.requestby,
                employee.name employee_request_by,
                stockoutdetail.id,
                stockoutdetail.itemid,
                item.code item_code,
                item.description item_description,
                stockoutdetail.unitcode,
                stockoutdetail.qty,
                stockoutdetail.warehouseid,
                warehouse.name warehouse_name_out,
                stockoutdetail.remark stockoutdetail_remark,
                stockout.transactionid
                from stockoutdetail
                join stockout on stockoutdetail.stockoutid=stockout.id
                left join employee on stockout.requestby=employee.id 
                left join warehouse on stockoutdetail.warehouseid=warehouse.id
                left join item on stockoutdetail.itemid=item.id
                where stockout.date between '$datefrom' and '$dateto' 
         ) select t.* from t where true
        ";

        $item_code = $this->input->post('item_code');
        if (!empty($item_code)) {
            $query .= " and t.item_code ilike '%$item_code%' ";
        }

        $item_description = $this->input->post('item_description');
        if (!empty($item_description)) {
            $query .= " and t.item_description ilike '%$item_description%' ";
        }

        $query .= " order by t.date asc,t.transactionid asc";

        //echo $query;

        $data['item'] = $this->db->query($query)->result();
        $data['datefrom'] = $datefrom;
        $data['dateto'] = $dateto;
        $this->load->model('model_company');
        $data['company'] = $this->model_company->select();
        $this->load->view('stockout/report/print_all_detail', $data);
    }

    function excel_all_detail() {

        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        $query = "
            with t as (
                select
                stockout.id stockoutid,
                stockout.number stockout_number,
                stockout.date,
                stockout.materialwithdrawid,
                stockout.nota_no,
                stockout.requestby,
                employee.name employee_request_by,
                stockoutdetail.id,
                stockoutdetail.itemid,
                item.code item_code,
                item.description item_description,
                stockoutdetail.unitcode,
                stockoutdetail.qty,
                stockoutdetail.warehouseid,
                warehouse.name warehouse_name_out,
                stockoutdetail.remark stockoutdetail_remark,
                stockout.transactionid
                from stockoutdetail
                join stockout on stockoutdetail.stockoutid=stockout.id
                left join employee on stockout.requestby=employee.id 
                left join warehouse on stockoutdetail.warehouseid=warehouse.id
                left join item on stockoutdetail.itemid=item.id
                where stockout.date between '$datefrom' and '$dateto' 
         ) select t.* from t where true
        ";

        $item_code = $this->input->post('item_code');
        if (!empty($item_code)) {
            $query .= " and t.item_code ilike '%$item_code%' ";
        }

        $item_description = $this->input->post('item_description');
        if (!empty($item_description)) {
            $query .= " and t.item_description ilike '%$item_description%' ";
        }

        $query .= " order by t.date asc,t.transactionid asc";

        //echo $query;

        $item = $this->db->query($query)->result();
        $this->load->model('model_company');
        $company = $this->model_company->select();

        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Stock Out Detail');

        $this->excel->getActiveSheet()->setCellValue('A2', $company->name);
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A2:K2');
        $this->excel->getActiveSheet()->getRowDimension(2)->setRowHeight(18);

        $this->excel->getActiveSheet()->setCellValue('A3', $company->address);
        $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->mergeCells('A3:K3');
        $this->excel->getActiveSheet()->getRowDimension(3)->setRowHeight(36);

        $this->excel->getActiveSheet()->setCellValue('A4', 'Stock Out Detail');
        $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A4:K4');
        $this->excel->getActiveSheet()->getRowDimension(4)->setRowHeight(30);

        $this->excel->getActiveSheet()->setCellValue('A5', "From: " . date('d M Y', strtotime($datefrom)) . " To: " . date('d M Y', strtotime($dateto)));
        $this->excel->getActiveSheet()->getStyle('A5')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A5:K5');
        $this->excel->getActiveSheet()->getRowDimension(4)->setRowHeight(20);

        $this->excel->getActiveSheet()->getRowDimension(7)->setRowHeight(22);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
        $this->excel->getActiveSheet()->setCellValue('A7', 'No');
        $this->excel->getActiveSheet()->getStyle('A7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
        $this->excel->getActiveSheet()->setCellValue('B7', 'STO');
        $this->excel->getActiveSheet()->getStyle('B7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('B7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
        $this->excel->getActiveSheet()->setCellValue('C7', 'Date');
        $this->excel->getActiveSheet()->getStyle('C7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('C7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('C7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(9);
        $this->excel->getActiveSheet()->setCellValue('D7', 'MW / NOTA');
        $this->excel->getActiveSheet()->getStyle('D7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('D7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('D7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
        $this->excel->getActiveSheet()->setCellValue('E7', 'Item Code');
        $this->excel->getActiveSheet()->getStyle('E7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('E7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $this->excel->getActiveSheet()->setCellValue('F7', 'Item Description');
        $this->excel->getActiveSheet()->getStyle('F7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('F7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('F7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(6);
        $this->excel->getActiveSheet()->setCellValue('G7', 'Unit');
        $this->excel->getActiveSheet()->getStyle('G7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('G7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('G7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(9);
        $this->excel->getActiveSheet()->setCellValue('H7', 'Qty');
        $this->excel->getActiveSheet()->getStyle('H7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('H7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('H7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(9);
        $this->excel->getActiveSheet()->setCellValue('I7', 'Out From');
        $this->excel->getActiveSheet()->getStyle('I7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('I7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('I7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $this->excel->getActiveSheet()->setCellValue('J7', 'Request By');
        $this->excel->getActiveSheet()->getStyle('J7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('J7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('J7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(24);
        $this->excel->getActiveSheet()->setCellValue('K7', 'Require For');
        $this->excel->getActiveSheet()->getStyle('K7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('K7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('K7')->getFont()->setBold(true);

        $row = 7;

        if (!empty($item)) {
            $row++;
            $no = 1;
            foreach ($item as $result) {
                $this->excel->getActiveSheet()->getRowDimension($row)->setRowHeight(11);
                $this->excel->getActiveSheet()->setCellValue('A' . $row, $no++);
                $this->excel->getActiveSheet()->getStyle('A' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('B' . $row, $result->stockout_number);
                $this->excel->getActiveSheet()->getStyle('B' . $row)->getFont()->setSize(8);

                $this->excel->getActiveSheet()->setCellValue('C' . $row, date('d M Y', strtotime($result->date)));
                $this->excel->getActiveSheet()->getStyle('C' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('C' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('D' . $row, $result->nota_no);
                $this->excel->getActiveSheet()->getStyle('D' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('D' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('E' . $row, $result->item_code);
                $this->excel->getActiveSheet()->getStyle('E' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('E' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('F' . $row, $result->item_description);
                $this->excel->getActiveSheet()->getStyle('F' . $row)->getFont()->setSize(8);

                $this->excel->getActiveSheet()->setCellValue('G' . $row, $result->unitcode);
                $this->excel->getActiveSheet()->getStyle('G' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('G' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('H' . $row, $result->qty);
                $this->excel->getActiveSheet()->getStyle('H' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('H' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                $this->excel->getActiveSheet()->setCellValue('I' . $row, $result->warehouse_name_out);
                $this->excel->getActiveSheet()->getStyle('I' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('I' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('J' . $row, $result->employee_request_by);
                $this->excel->getActiveSheet()->getStyle('J' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('I' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

                $this->excel->getActiveSheet()->setCellValue('K' . $row, "$result->stockoutdetail_remark");
                $this->excel->getActiveSheet()->getStyle('K' . $row)->getFont()->setSize(8);

                $row++;
            }
        }

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $this->excel->getActiveSheet()->getStyle('A7:K' . $row)->applyFromArray($styleArray);
        $filename = 'file.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    function summary() {
        $this->load->view('stockout/report/summary');
    }

    function summary_get() {
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');


        $query = "
          with t as ( 
            with t_item as (
                select 
                stockoutdetail.itemid,
                stockoutdetail.unitcode,
                sum(stockoutdetail.qty) qty
                from stockoutdetail 
                join stockout on stockoutdetail.stockoutid=stockout.id 
                where stockout.date between '$datefrom' and '$dateto'
                group by stockoutdetail.itemid,stockoutdetail.unitcode
                ) select t_item.itemid,item.code itemcode,item.description itemdescription,item.groupid,t_item.unitcode,t_item.qty from t_item 
                join item on t_item.itemid=item.id
                
        ) select t.*,itemgroup.code groupcode from t join itemgroup on t.groupid=itemgroup.id where true
        ";

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and t.itemcode ilike '%$itemcode%' ";
        }
        $itemdescription = $this->input->post('itemdescription');
        if (!empty($itemdescription)) {
            $query .= " and t.itemdescription ilike '%$itemdescription%' ";
        }
        $groupid = $this->input->post('groupid');
        if (!empty($groupid)) {
            $query .= " and t.groupid=$groupid ";
        }
        //$query .= " order by t.itemdescription asc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        //echo $query;
        echo $this->model_stockout->get($query);
    }

}
