<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of report
 *
 * @author user
 */
class report extends CI_Controller {

  //put your code here
  public function __construct() {
    parent::__construct();
    $this->load->model('model_report');
  }

  function index() {
    $this->load->view('report/view');
  }

  function pemasukan_bahan_baku() {
    $this->load->view('report/pemasukan_bahan_baku_view');
  }

  function pemasukan_bahan_baku_get() {

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    if (empty($datefrom) && empty($dateto)) {
      $datefrom = date('Y-m-01');
      $dateto = date('Y-m-t');
    }
    else {
      if (!empty($datefrom) && empty($dateto)) {
        $dateto = $datefrom;
      }
      if (empty($datefrom) && !empty($dateto)) {
        $datefrom = $dateto;
      }
    }


    $query = "
            with t_data as (
            select t.itemid,t.unitcode,sum(qty) qty 
            from get_all_stock_in() t 
            join item on t.itemid=item.id
            where t.date between '$datefrom' and '$dateto'
            and item.category = 2
            group by t.itemid,t.unitcode 
            ) select t_data.*,item.code item_code,item.description item_description
            from t_data join item on t_data.itemid=item.id 
            where true 
        ";

    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";
    echo $this->model_report->get($query);
  }

  function pemasukan_bahan_baku_print($type) {
    $this->load->library('component');
    $this->load->model('model_company');

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    if (empty($datefrom) && empty($dateto)) {
      $datefrom = date('Y-m-01');
      $dateto = date('Y-m-t');
    }
    else {
      if (!empty($datefrom) && empty($dateto)) {
        $dateto = $datefrom;
      }
      if (empty($datefrom) && !empty($dateto)) {
        $datefrom = $dateto;
      }
    }


    $query = "
            with t_data as (
            select t.itemid,t.unitcode,sum(qty) qty 
            from get_all_stock_in() t 
            join item on t.itemid=item.id
            where t.date between '$datefrom' and '$dateto'
            and item.category = 2
            group by t.itemid,t.unitcode 
            ) select t_data.*,item.code item_code,item.description item_description
            from t_data join item on t_data.itemid=item.id 
            where true  
        ";

    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";

    $data['company'] = $this->model_company->select();
    $data['datefrom'] = $datefrom;
    $data['dateto'] = $dateto;
    $data['type'] = $type;
    $data['report'] = $this->db->query($query)->result();
    $this->load->view('report/pemasukan_bahan_baku_print', $data);
  }

  function pemakaian_bahan_baku() {
    $this->load->view('report/pemakaian_bahan_baku_view');
  }

  function pemakaian_bahan_baku_get() {

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    if (empty($datefrom) && empty($dateto)) {
      $datefrom = date('Y-m-01');
      $dateto = date('Y-m-t');
    }
    else {
      if (!empty($datefrom) && empty($dateto)) {
        $dateto = $datefrom;
      }
      if (empty($datefrom) && !empty($dateto)) {
        $datefrom = $dateto;
      }
    }


    $query = "
            with t_data as (
            select t.itemid,t.unitcode,sum(qty) qty 
            from get_stock_out_material_import() t 
            join item on t.itemid=item.id
            where t.date between '$datefrom' and '$dateto'
            group by t.itemid,t.unitcode 
            ) select t_data.*,item.code item_code,item.description item_description
            from t_data join item on t_data.itemid=item.id 
            where true 
        ";
    //echo $query;
    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";
    echo $this->model_report->get($query);
  }

  function pemakaian_bahan_baku_print($type) {
    $this->load->library('component');
    $this->load->model('model_company');

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    if (empty($datefrom) && empty($dateto)) {
      $datefrom = date('Y-m-01');
      $dateto = date('Y-m-t');
    }
    else {
      if (!empty($datefrom) && empty($dateto)) {
        $dateto = $datefrom;
      }
      if (empty($datefrom) && !empty($dateto)) {
        $datefrom = $dateto;
      }
    }


    $query = "
            with t_data as (
            select t.itemid,t.unitcode,sum(qty) qty 
            from get_stock_out_material_import() t 
            join item on t.itemid=item.id
            where t.date between '$datefrom' and '$dateto'
            group by t.itemid,t.unitcode 
            ) select t_data.*,item.code item_code,item.description item_description
            from t_data join item on t_data.itemid=item.id 
            where true 
        ";

    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";
    $data['company'] = $this->model_company->select();
    $data['datefrom'] = $datefrom;
    $data['dateto'] = $dateto;
    $data['type'] = $type;
    $data['report'] = $this->db->query($query)->result();
    $this->load->view('report/pemakaian_bahan_baku_print', $data);
  }

//-------------------------------
  function pemakaian_proses_sub_kontrak() {
    $this->load->view('report/pemakaian_proses_sub_kontrak_view');
  }

  function pemakaian_proses_sub_kontrak_get() {
    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    if (empty($datefrom) && empty($dateto)) {
      $datefrom = date('Y-m-01');
      $dateto = date('Y-m-t');
    }
    else {
      if (!empty($datefrom) && empty($dateto)) {
        $dateto = $datefrom;
      }
      if (empty($datefrom) && !empty($dateto)) {
        $datefrom = $dateto;
      }
    }


    $query = "
            with t as 
            (
                select 
                sto_to_detail.itemid,
                sto_to_detail.unitcode,
                sum(sto_to_detail.qty) qty
                from sto_to_detail 
                join sto_to on sto_to_detail.sto_to_id=sto_to.id
                where sto_to.date between '$datefrom' and '$dateto'
                group by sto_to_detail.itemid,sto_to_detail.unitcode
            ) select t.*,item.code item_code,item.description item_description 
            from t join item on t.itemid=item.id 
            
        ";
    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";
    //echo $query;
    echo $this->model_report->get($query);
  }

  function pemakaian_proses_sub_kontrak_print($type) {
    $this->load->library('component');
    $this->load->model('model_company');

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    if (empty($datefrom) && empty($dateto)) {
      $datefrom = date('Y-m-01');
      $dateto = date('Y-m-t');
    }
    else {
      if (!empty($datefrom) && empty($dateto)) {
        $dateto = $datefrom;
      }
      if (empty($datefrom) && !empty($dateto)) {
        $datefrom = $dateto;
      }
    }


    $query = "
            with t as 
            (
                select 
                sto_to_detail.itemid,
                sto_to_detail.unitcode,
                sum(sto_to_detail.qty) qty
                from sto_to_detail 
                join sto_to on sto_to_detail.sto_to_id=sto_to.id
                where sto_to.date between '$datefrom' and '$dateto'
                group by sto_to_detail.itemid,sto_to_detail.unitcode
            ) select t.*,item.code item_code,item.description item_description 
            from t join item on t.itemid=item.id 
        ";
    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";

    $data['company'] = $this->model_company->select();
    $data['datefrom'] = $datefrom;
    $data['dateto'] = $dateto;
    $data['type'] = $type;
    $data['report'] = $this->db->query($query)->result();
    $this->load->view('report/pemakaian_proses_sub_kontrak_print', $data);
  }

//-------------------------------------

  function penyelesaian_scrap() {
    $this->load->view('report/penyelesaian_scrap_view');
  }

  function penyelesaian_scrap_get() {

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    if (empty($datefrom) && empty($dateto)) {
      $datefrom = date('Y-m-01');
      $dateto = date('Y-m-t');
    }
    else {
      if (!empty($datefrom) && empty($dateto)) {
        $dateto = $datefrom;
      }
      if (empty($datefrom) && !empty($dateto)) {
        $datefrom = $dateto;
      }
    }


    $query = "
            with t as (
            select 
            materialtrash.itemid,
            materialtrash.unitcode,
            sum(materialtrash.qty) qty
            from materialtrash 
            join item on materialtrash.itemid=item.id
            where materialtrash.date between '$datefrom' and '$dateto' 
            and item.category=2
            group by materialtrash.itemid,materialtrash.unitcode
            ) select t.*,item.code item_code,item.description item_description 
            from t join item on t.itemid=item.id 
        ";
    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";
    //echo $query;
    echo $this->model_report->get($query);
  }

  function penyelesaian_scrap_print($type) {
    $this->load->library('component');
    $this->load->model('model_company');

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    if (empty($datefrom) && empty($dateto)) {
      $datefrom = date('Y-m-01');
      $dateto = date('Y-m-t');
    }
    else {
      if (!empty($datefrom) && empty($dateto)) {
        $dateto = $datefrom;
      }
      if (empty($datefrom) && !empty($dateto)) {
        $datefrom = $dateto;
      }
    }


    $query = "
            with t as (
            select 
            materialtrash.itemid,
            materialtrash.unitcode,
            sum(materialtrash.qty) qty
            from materialtrash 
            join item on materialtrash.itemid=item.id
            where materialtrash.date between '$datefrom' and '$dateto' 
            and item.category=2
            group by materialtrash.itemid,materialtrash.unitcode
            ) select t.*,item.code item_code,item.description item_description 
            from t join item on t.itemid=item.id 
        ";

    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";
    $data['company'] = $this->model_company->select();
    $data['datefrom'] = $datefrom;
    $data['dateto'] = $dateto;
    $data['type'] = $type;
    $data['report'] = $this->db->query($query)->result();
    $this->load->view('report/penyelesaian_scrap_print', $data);
  }

  //------------------------








  function pemasukan_hasil_produksi() {
    $this->load->view('report/pemasukan_hasil_produksi_view');
  }

  function pemasukan_hasil_produksi_get() {
    
  }

  function pemasukan_hasil_produksi_print($type) {
    $this->load->library('component');
    $this->load->model('model_company');

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    $data['company'] = $this->model_company->select();
    $data['datefrom'] = $datefrom;
    $data['dateto'] = $dateto;
    $this->load->view('report/pemasukan_hasil_produksi_print', $data);
  }

//-------------------------

  function pengeluaran_hasil_produksi() {
    $this->load->view('report/pengeluaran_hasil_produksi_view');
  }

  function pengeluaran_hasil_produksi_get() {
    
  }

  function pengeluaran_hasil_produksi_print($type) {
    $this->load->library('component');
    $this->load->model('model_company');

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    $data['company'] = $this->model_company->select();
    $data['datefrom'] = $datefrom;
    $data['dateto'] = $dateto;
    $this->load->view('report/pengeluaran_hasil_produksi_print', $data);
  }

  //-----------------------

  function mutasi_hasil_produksi() {
    $this->load->view('report/mutasi_hasil_produksi_view');
  }

  function mutasi_hasil_produksi_get() {
    
  }

  function mutasi_hasil_produksi_print($type) {
    $this->load->library('component');
    $this->load->model('model_company');

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    $data['company'] = $this->model_company->select();
    $data['datefrom'] = $datefrom;
    $data['dateto'] = $dateto;
    $this->load->view('report/mutasi_hasil_produksi_print', $data);
  }

  //------------    

  function mutasi_bahan_baku() {
    $this->load->view('report/mutasi_bahan_baku_view');
  }

  function mutasi_bahan_baku_get() {
    
  }

  function mutasi_bahan_baku_print($type) {
    $this->load->library('component');
    $this->load->model('model_company');

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    $data['company'] = $this->model_company->select();
    $data['datefrom'] = $datefrom;
    $data['dateto'] = $dateto;
    $this->load->view('report/mutasi_bahan_baku_print', $data);
  }

  function sales_order_rpt() {
    $this->load->library('component');
    $this->load->model('model_company');

    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    $data['company'] = $this->model_company->select();
    $data['datefrom'] = $datefrom;
    $data['dateto'] = $dateto;
    $this->load->view('report/sales_order_rpt', $data);
  }

  function sales_order_rpt_get() {
    $this->load->model('model_salesorder');
    $query = "
                select 
                salesorderdetail.id,
                salesorder.date,
                salesorder.sonumber,
                salesorder.orderby customerid,
                customer.name customer,
                salesorderdetail.qty,
                salesorderdetail.unitprice price,
                bankaccount.currency,
                model.code itemcode,
                model.name itemdescription 
                from 
                salesorderdetail
                join model on salesorderdetail.modelid=model.id
                join salesorder on salesorderdetail.salesorderid=salesorder.id
                join customer on salesorder.orderby=customer.id
                left join bankaccount on salesorder.bankaccountid=bankaccount.id
                where true
            ";
    $datefrom = $this->input->post('datefrom');
    $dateto = $this->input->post('dateto');

    if ($datefrom != "" && $dateto != "") {
      $query .= " and salesorder.date between '" . $datefrom . "' and '" . $dateto . "'";
    }if ($datefrom != "" && $dateto == "") {
      $query .= " and salesorder.date = '" . $datefrom . "'";
    }if ($datefrom == "" && $dateto != "") {
      $query .= " and salesorder.date = '" . $dateto . "'";
    }

    $sonumber = $this->input->post('sonumber');

    if (!empty($sonumber)) {
      $query .= " and salesorder.sonumber ilike '%$sonumber%'";
    }
    $item = $this->input->post('item');
    if (!empty($item)) {
      $query .= " and (model.code ilike '%$item%' or model.name ilike '%$item%')";
    }
    $customerid = $this->input->post('customerid');
    if (!empty($customerid)) {
      $query .= " and salesorder.orderby=$customerid ";
    }

    //$query .= " order by salesorderdetail.id desc ";
    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    $query .= " order by $sort $order ";

    //echo $query;
    echo $this->model_salesorder->get($query);
  }

}

?>
