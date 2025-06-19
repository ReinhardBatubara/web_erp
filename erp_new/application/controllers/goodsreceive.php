<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of goodsreceipt
 *
 * @author hp
 */
class goodsreceive extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_goodsreceive');
        $this->load->model('model_stock_in');
    }

    function index() {
        $this->load->view('goodsreceive/view');
    }

    function get() {

        $query = "
            select 
            gr.*,
            v.name vendor,
            e.name received,
            emp.name checked
            from 
            goodsreceive gr 
            join vendor v on gr.vendorid=v.id 
            left join employee e on gr.received_by=e.id 
            left join employee emp on gr.checked_by=emp.id
            where true 
        ";

        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $number = $this->input->post('number');
        $vendorid = $this->input->post('vendorid');
        $no_sj = $this->input->post('no_sj');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and gr.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and gr.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and gr.date = '" . $dateto . "'";
        }if ($number != "") {
            $query .= " and gr.number ilike '%" . $number . "%'";
        }if ($no_sj != "") {
            $query .= " and gr.no_sj ilike '%" . $no_sj . "%'";
        }if (!empty($vendorid)) {
            $query .= " and gr.vendorid = " . $vendorid;
        }

        if ($this->session->userdata('department') == 9) {
            if ($this->session->userdata('optiongroup') != "" && $this->session->userdata('optiongroup') != -1) {
                $query .= " and gr.received_by='" . $this->session->userdata('id') . "'";
            }
        }
        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (gr.number ilike '%$q%' or po.number ilike '%$q%')";
        }

//        $query .= " order by gr.id desc";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";

//        echo $query;
        echo $this->model_goodsreceive->get($query);
    }

    function input() {
        $this->load->view('goodsreceive/input');
    }

    function insert() {
        $do_date = $this->input->post('do_date');
        $data = array(
            "date" => $this->input->post('date'),
            "vendorid" => $this->input->post('vendorid'),
            "no_sj" => $this->input->post('no_sj'),
            "do_date" => (empty($do_date) ? null : $do_date),
            "remark" => $this->input->post('remark')
        );

        if ($this->model_goodsreceive->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function add() {

        $this->load->view('goodsreceive/add');
    }

    function save() {

        $this->load->model('model_goodsreceivedetail');

        $purchaseorderdetailid = $this->input->post('purchaseorderdetail_id');
        $qty = $this->input->post('qty_receive');
        $warehouseid = $this->input->post('warehouseid');

        $id = $this->model_goodsreceive->get_next_id();

        $goodsreceive = array(
            "id" => $id,
            "date" => $this->input->post('date'),
            "no_sj" => $this->input->post('no_sj'),
            "purchaseorderid" => $this->input->post('purchaseorderid'),
            "received_by" => $this->session->userdata('id'),
            "checked_by" => $this->input->post('checked_by'),
            "remark" => $this->input->post('remark')
        );

        $goodsreceive_detail = array();
        for ($i = 0; $i < count($purchaseorderdetailid); $i++) {
            $goodsreceive_detail[] = array(
                "goodsreceiveid" => $id,
                "purchaseorderdetailid" => $purchaseorderdetailid[$i],
                "qty" => $qty[$i],
                "warehouseid" => $warehouseid[$i]
            );
        }
        $error_msg = '';
        $this->db->trans_start(TRUE);
        if (!$this->model_goodsreceive->insert($goodsreceive)) {
            $error_msg .= $this->db->_error_message();
        }
        if (!$this->model_goodsreceivedetail->insert_batch($goodsreceive_detail)) {
            $error_msg .= $this->db->_error_message();
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(array('msg' => $error_msg));
        } else {
            echo json_encode(array('success' => true));
        }
    }

    function update() {

        $data = array(
            "date" => $this->input->post('date'),
            "no_sj" => $this->input->post('no_sj'),
            "checked_by" => $this->input->post('checked_by'),
            "remark" => $this->input->post('remark')
        );

        if ($this->model_goodsreceive->update($data, array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        if ($this->model_goodsreceive->delete(array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function search_form() {
        $this->load->view('goodsreceive/search_form');
    }

    function prints() {
        $goodsreceiveid = $this->input->post('goodsreceiveid');
        $data['goodsreceive'] = $this->model_goodsreceive->select_by_id($goodsreceiveid);
        $this->load->model('model_goodsreceivedetail');
        $data['goodsreceivedetail'] = $this->model_goodsreceivedetail->select_by_goodsreceiveid($goodsreceiveid);
        $this->load->view('goodsreceive/prints', $data);
    }

    function print_detail() {
        $query = "select 
                grd.*,
                gr.number gr_number,
                gr.date gr_date, 
                po.number po_number, 
                po.date po_date, 
                v.name vendor, 
                e.name received, 
                (select name from employee where id=gr.checked_by) checked,
                item.code itemcode,
                item.description itemdescription,
                purchaserequestdetail.unitcode
                from goodsreceivedetail grd
                join goodsreceive gr on grd.goodsreceiveid=gr.id
                join purchaseorderdetail on grd.purchaseorderdetailid=purchaseorderdetail.id
                join purchaserequestdetail on purchaseorderdetail.purchaserequestdetailid=purchaserequestdetail.id 
                join item on purchaserequestdetail.itemid=item.id 
                join purchaseorder po on gr.purchaseorderid=po.id 
                join purchaserequest pr on po.purchaserequestid=pr.id 
                join vendor v on po.vendorid=v.id 
                left join employee e on gr.received_by=e.id where true ";

        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $number = $this->input->post('number');
        $vendorid = $this->input->post('vendorid');
        $no_sj = $this->input->post('no_sj');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and gr.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and gr.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and gr.date = '" . $dateto . "'";
        }if ($number != "") {
            $query .= " and gr.number ilike '%" . $number . "%'";
        }if ($no_sj != "") {
            $query .= " and gr.no_sj ilike '%" . $no_sj . "%'";
        }if ($vendorid != "") {
            $query .= " and pr.vendorid = " . $vendorid;
        }

        if ($this->session->userdata('department') == 9) {
            if ($this->session->userdata('optiongroup') != "" && $this->session->userdata('optiongroup') != -1) {
                $query .= " and gr.received_by='" . $this->session->userdata('id') . "'";
            }
        }
        $query .= " order by gr.id desc";
        //echo $query;
        $data['goodsreceive'] = $this->db->query($query)->result();
        $this->load->view('goodsreceive/print_detail', $data);
    }

    // STOCK IN
    function stock_in() {
        $this->load->view('stock_in/view');
    }

    function stock_in_get() {
        $query = "
            select 
            stock_in.*,
            vendor.name vendor,
            employee.name employee_receive
            from stock_in 
            left join vendor on stock_in.vendorid=vendor.id 
            left join employee on stock_in.receiveby=employee.id
            where true
        ";

        $bpnp = $this->input->post('bpnp');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $vendorid = $this->input->post('vendorid');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and stock_in.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and stock_in.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and stock_in.date = '" . $dateto . "'";
        }if (!empty($bpnp)) {
            $query .= " and stock_in.bpnp ilike '%" . $bpnp . "%'";
        }if (!empty($vendorid)) {
            $query .= " and stock_in.vendorid=$vendorid";
        }

        // $query .= " order by stock_in.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
//    echo $query;
        echo $this->model_stock_in->get($query);
    }

    function stock_in_add() {
        $this->load->view('stock_in/add');
    }

    function stock_in_detail_add() {
        $this->load->view('stock_in/detail/add');
    }

    function stock_in_save($id) {

        $data = array(
            "bpnp" => $this->input->post('bpnp'),
            "date" => $this->input->post('date'),
            "vendorid" => $this->input->post('vendorid'),
            "remark" => $this->input->post('remark'),
            "receiveby" => $this->session->userdata('id')
        );

        if ($id == 0) {
            if ($this->model_stock_in->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_stock_in->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function stock_in_delete() {
        $id = $this->input->post('id');
        if ($this->model_stock_in->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    //Detail Stock In

    function stock_in_detail_get() {
        $stock_in_id = $this->input->post('stock_in_id');
        if (empty($stock_in_id)) {
            $stock_in_id = 0;
        }
        $query = "select 
            stock_in_detail.*,
            item.code itemcode,
            item.description itemdescription  
            from stock_in_detail join item
            on stock_in_detail.itemid=item.id where stock_in_detail.stock_in_id=$stock_in_id";

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and item.code ilike '%$itemcode%' ";
        }
        $itemdescription = $this->input->post('itemdescription');
        if (!empty($itemdescription)) {
            $query .= " and item.description ilike '%$itemdescription%' ";
        }
        //$query .= " order by stock_in_detail.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        //echo $query;
        echo $this->model_stock_in->detail_get($query);
    }

    function stock_in_detail_save($stock_in_id, $id) {
        $data = array(
            "itemid" => $this->input->post('itemid'),
            "unitcode" => $this->input->post('unitcode'),
            "qty" => $this->input->post('qty')
        );

        if ($id == 0) {
            $data['stock_in_id'] = $stock_in_id;
            if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') {
                $data['warehouseid'] = $this->input->post('warehouseid');
            } else {
                $data['warehouseid'] = $this->session->userdata('optiongroup');
            }

            if ($this->model_stock_in->detail_insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_stock_in->detail_update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function stock_in_detail_delete() {
        $id = $this->input->post('id');
        if ($this->model_stock_in->detail_delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function summary() {
        $this->load->view('goodsreceive/summary');
    }

    function summary_get() {
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');


        $query = "
          with t as ( 
            with t_item as (
                select 
                stock_in_detail.itemid,
                stock_in_detail.unitcode,
                sum(stock_in_detail.qty) qty
                from stock_in_detail 
                join stock_in on stock_in_detail.stock_in_id=stock_in.id 
                where stock_in.date between '$datefrom' and '$dateto'
                group by stock_in_detail.itemid,stock_in_detail.unitcode
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
//    $query .= " order by t.itemdescription asc ";
        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        //echo $query;
        echo $this->model_goodsreceive->get($query);
    }

    function stock_in_detail() {
        $this->load->view('goodsreceive/stock_in_detail');
    }

    function get_all_detail() {
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        $query = "
            with t as (
                select 
                stock_in.bpnp stock_in_number,
                stock_in.date,
                stock_in.vendorid,
                vendor.name vendor_name,
                stock_in_detail.*,
                item.code item_code,
                item.description item_description,
                warehouse.name store_to,
                stock_in.transactionid,
                stock_in.remark
                from stock_in_detail
                join item on stock_in_detail.itemid=item.id
                join warehouse on stock_in_detail.warehouseid=warehouse.id
                join stock_in on stock_in_detail.stock_in_id=stock_in.id
                join vendor on stock_in.vendorid = vendor.id 
                where stock_in.date between '$datefrom' and '$dateto' 
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
        echo $this->model_goodsreceive->get($query);
    }

    function print_all_detail() {
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        $query = "
            with t as (
                select 
                stock_in.bpnp stock_in_number,
                stock_in.date,
                stock_in.vendorid,
                vendor.name vendor_name,
                stock_in_detail.*,
                item.code item_code,
                item.description item_description,
                warehouse.name store_to,
                stock_in.transactionid,
                stock_in.remark
                from stock_in_detail
                join item on stock_in_detail.itemid=item.id
                join warehouse on stock_in_detail.warehouseid=warehouse.id
                join stock_in on stock_in_detail.stock_in_id=stock_in.id
                join vendor on stock_in.vendorid = vendor.id 
                where stock_in.date between '$datefrom' and '$dateto' 
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
        $data['item'] = $this->db->query($query)->result();
        $data['datefrom'] = $datefrom;
        $data['dateto'] = $dateto;
        $this->load->model('model_company');
        $data['company'] = $this->model_company->select();
        $this->load->view('goodsreceive/print_all_detail', $data);
    }

    function excel_all_detail() {
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        $query = "
            with t as (
                select 
                stock_in.bpnp stock_in_number,
                stock_in.date,
                stock_in.vendorid,
                vendor.name vendor_name,
                stock_in_detail.*,
                item.code item_code,
                item.description item_description,
                warehouse.name store_to,
                stock_in.transactionid,
                stock_in.remark
                from stock_in_detail
                join item on stock_in_detail.itemid=item.id
                join warehouse on stock_in_detail.warehouseid=warehouse.id
                join stock_in on stock_in_detail.stock_in_id=stock_in.id
                join vendor on stock_in.vendorid = vendor.id 
                where stock_in.date between '$datefrom' and '$dateto' 
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
        $item = $this->db->query($query)->result();
        $this->load->model('model_company');
        $company = $this->model_company->select();

        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Stock In Detail');

        $this->excel->getActiveSheet()->setCellValue('A2', $company->name);
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A2:J2');
        $this->excel->getActiveSheet()->getRowDimension(2)->setRowHeight(18);

        $this->excel->getActiveSheet()->setCellValue('A3', $company->address);
        $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setWrapText(true);
        $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->mergeCells('A3:J3');
        $this->excel->getActiveSheet()->getRowDimension(3)->setRowHeight(36);

        $this->excel->getActiveSheet()->setCellValue('A4', 'Stock In Detail');
        $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A4:J4');
        $this->excel->getActiveSheet()->getRowDimension(4)->setRowHeight(30);

        $this->excel->getActiveSheet()->setCellValue('A5', "From: " . date('d M Y', strtotime($datefrom)) . " To: " . date('d M Y', strtotime($dateto)));
        $this->excel->getActiveSheet()->getStyle('A5')->getFont()->setSize(10);
        $this->excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->mergeCells('A5:J5');
        $this->excel->getActiveSheet()->getRowDimension(4)->setRowHeight(20);

        $this->excel->getActiveSheet()->getRowDimension(7)->setRowHeight(22);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
        $this->excel->getActiveSheet()->setCellValue('A7', 'No');
        $this->excel->getActiveSheet()->getStyle('A7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
        $this->excel->getActiveSheet()->setCellValue('B7', 'GR / BPNP');
        $this->excel->getActiveSheet()->getStyle('B7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('B7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
        $this->excel->getActiveSheet()->setCellValue('C7', 'Date');
        $this->excel->getActiveSheet()->getStyle('C7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('C7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('C7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
        $this->excel->getActiveSheet()->setCellValue('D7', 'Item Code');
        $this->excel->getActiveSheet()->getStyle('D7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('D7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('D7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $this->excel->getActiveSheet()->setCellValue('E7', 'Item Description');
        $this->excel->getActiveSheet()->getStyle('E7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('E7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(6);
        $this->excel->getActiveSheet()->setCellValue('F7', 'Unit');
        $this->excel->getActiveSheet()->getStyle('F7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('F7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('F7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(9);
        $this->excel->getActiveSheet()->setCellValue('G7', 'Qty');
        $this->excel->getActiveSheet()->getStyle('G7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('G7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('G7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(9);
        $this->excel->getActiveSheet()->setCellValue('H7', 'Store To');
        $this->excel->getActiveSheet()->getStyle('H7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('H7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('H7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(9);
        $this->excel->getActiveSheet()->setCellValue('I7', 'Supplier');
        $this->excel->getActiveSheet()->getStyle('I7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('I7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('I7')->getFont()->setBold(true);

        $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(24);
        $this->excel->getActiveSheet()->setCellValue('J7', 'Remark');
        $this->excel->getActiveSheet()->getStyle('J7')->getFont()->setSize(8);
        $this->excel->getActiveSheet()->getStyle('J7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('J7')->getFont()->setBold(true);
        $row = 7;

        if (!empty($item)) {
            $row++;
            $no = 1;
            foreach ($item as $result) {
                $this->excel->getActiveSheet()->getRowDimension($row)->setRowHeight(11);
                $this->excel->getActiveSheet()->setCellValue('A' . $row, $no++);
                $this->excel->getActiveSheet()->getStyle('A' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('B' . $row, $result->stock_in_number);
                $this->excel->getActiveSheet()->getStyle('B' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('B' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('C' . $row, date('d M Y', strtotime($result->date)));
                $this->excel->getActiveSheet()->getStyle('C' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('C' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('D' . $row, $result->item_code);
                $this->excel->getActiveSheet()->getStyle('D' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('D' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('E' . $row, $result->item_description);
                $this->excel->getActiveSheet()->getStyle('E' . $row)->getFont()->setSize(8);

                $this->excel->getActiveSheet()->setCellValue('F' . $row, $result->unitcode);
                $this->excel->getActiveSheet()->getStyle('F' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('F' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('G' . $row, $result->qty);
                $this->excel->getActiveSheet()->getStyle('G' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('G' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('H' . $row, $result->store_to);
                $this->excel->getActiveSheet()->getStyle('H' . $row)->getFont()->setSize(8);
                $this->excel->getActiveSheet()->getStyle('H' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $this->excel->getActiveSheet()->setCellValue('I' . $row, $result->vendor_name);
                $this->excel->getActiveSheet()->getStyle('I' . $row)->getFont()->setSize(8);

                $this->excel->getActiveSheet()->setCellValue('J' . $row, $result->remark);
                $this->excel->getActiveSheet()->getStyle('J' . $row)->getFont()->setSize(8);


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

        $this->excel->getActiveSheet()->getStyle('A7:J' . $row)->applyFromArray($styleArray);
        $filename = 'file.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    function stock_in_print() {
        $id = $this->input->post('id');
        $data['stock_in'] = $this->model_stock_in->select_by_id($id);
        $data['stock_in_detail'] = $this->model_stock_in->select_detail_by_stock_in_id($id);
        $this->load->view('stock_in/print', $data);
    }

    function detail_input($goodsreceiveid, $vedorid) {
        $data['goodsreceiveid'] = $goodsreceiveid;
        $data['vendorid'] = $vedorid;
        $this->load->view('goodsreceive/detail/input', $data);
    }

    function detail_edit() {
        $this->load->view('goodsreceive/detail/edit');
    }

    function detail_delete() {
        $id = $this->input->post("id");
        if ($this->db->delete("goodsreceivedetail", array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function report() {
        $this->load->view('goodsreceive/report');
    }
    
    function report_generate(){
        $query = "
        select mr.number mr_no,grd.*,gr.number gr_no,gr.date,gr.no_sj,gr.do_date,t.itemid,t.itemcode,t.itemdescription,t.unitcode,po.number po_no,po.vendorid,
            v.name vendor_name,whs.name warehouse_name,gr.received_by,emp.name name_receive,mr.departmentid,d.code department_code,ig.name item_group,
            emp_r.name name_requested
            from goodsreceivedetail grd
            join purchaseorderdetail pod on grd.purchaseorderdetailid=pod.id
            join purchaserequestdetail prd on pod.purchaserequestdetailid=prd.id
            join purchaseorder po on pod.purchaseorderid=po.id
            join goodsreceive gr on grd.goodsreceiveid=gr.id
            join vendor v on po.vendorid=v.id
            left join materialrequisitiondetail mrd on prd.materialrequisitiondetailid=mrd.id
            left join materialrequisition mr on mrd.materialrequisitionid=mr.id
            join (select * from purchaserequestdetail_get()) t on t.id=pod.id 
            left join warehouse whs on grd.warehouseid=whs.id
            left join employee emp on gr.received_by=emp.id
            left join department d on mr.departmentid=d.id
            left join item i on t.itemid=i.id
            left join itemgroup ig on i.groupid=ig.id
            left join employee emp_r on mr.requestedby=emp_r.id
        where true 
        ";
        
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        if(!empty($start_date) && !empty($end_date)){
            $query .= " and gr.date between '$start_date' and '$end_date' ";
        }
        $vendorid = $this->input->post('vendorid');
        if(!empty($vendorid)){
            $query .= " and v.id=$vendorid";
        }
        $gr_no = $this->input->post('gr_no');
        if(!empty($gr_no)){
            $query .= " and gr.number ilike '%$gr_no%'";
        }
        $po_no = $this->input->post('po_no');
        if(!empty($po_no)){
            $query .= " and po.number ilike '%$po_no%'";
        }
        $mr_no = $this->input->post('mr_no');
        if(!empty($mr_no)){
            $query .= " and mr.number ilike '%$po_no%'";
        }
        $departmentid = $this->input->post('departmentid');
        if(!empty($departmentid)){
            $query .= " and d.id=$po_no";
        }
        $groupid = $this->input->post('groupid');
        if(!empty($groupid)){
            $query .= " and ig.id=$groupid";
        }
        $item_description = $this->input->post('item_description');
        if(!empty($item_description)){
            $query .= " and (t.itemcode ilike '%$item_description%' or t.itemdescription ilike '%$item_description%')";
        }
        
        $query .= " order by grd.id asc ";
        $this->load->model('model_company');
        $this->load->model('model_joborderoutsource');
        $data['company'] = $this->model_company->select();
        $data['data'] = $this->db->query($query)->result();
        $this->load->view('goodsreceive/print_report',$data);
    }

}
