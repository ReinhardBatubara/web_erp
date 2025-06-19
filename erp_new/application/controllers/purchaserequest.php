<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchaserequest
 *
 * @author hp
 */
class purchaserequest extends CI_Controller {

    //put your code here

    var $option_view;

    public function __construct() {
        parent::__construct();
        $this->load->model('model_purchaserequest');
        $this->load->model('model_menuaccess');
        $this->option_view = $this->model_menuaccess->get_option_view($this->session->userdata('id'), 'purchaserequest');
    }

    function index() {
        $this->load->model('model_department');
        $this->load->model('model_currency');
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "purchaserequest"));
        $data['department'] = $this->model_department->selectAllResult();
        $data['currency'] = $this->model_currency->selectAllResult();
        $this->load->view('purchaserequest/view', $data);
    }

    function get() {
        $query = "
            with t as (
                with t_temp as (
                    select 
                    purchaserequest.*,
                    department.name department,
                    department.code departmentcode,
                    (select count(*) from purchaserequestattachment where purchaserequestid=purchaserequest.id) countattachment,
                    (select count(*) from purchaserequestcomment where purchaserequestid=purchaserequest.id) countcomment,
                    (select count(*) from purchaserequestapproval where purchaserequestid=purchaserequest.id) countapproval,
                    (select count(*) from purchaserequestapproval where purchaserequestid=purchaserequest.id and employeeid='" . $this->session->userdata('id') . "') current_count_approval,
                    (select purchaserequestapproval_iscomplete(purchaserequest.id)) complete_approve,
                    (select purchaserequestapproval_complete(purchaserequest.id)) approvalcomplete,
                    (select count(*) from purchaseorder where purchaserequestid=purchaserequest.id) counterpurchaseorder,
                    (select count(*) from purchaserequestdetail where purchaserequestid=purchaserequest.id) countitem,
                    (purchaserequest_get_list_mr_number(purchaserequest.id)) mr_number_list,
                    (select purchaserequest_get_total_amount_summary(purchaserequest.id)) total_amount, 
                    purchaserequestapproval.id purchaserequestapprovalid,
                    purchaserequestapproval.employeeid purchaserequestapprovalemployeeid,
                    employee.name employeerequest,
                    vendor.name vendor
                    from purchaserequest 
                    left join department on purchaserequest.departmentid=department.id 
                    left join employee on purchaserequest.employeeidrequest = employee.id
                    left join vendor on purchaserequest.vendorid=vendor.id
                    left join purchaserequestapproval on purchaserequest.id=purchaserequestapproval.purchaserequestid and purchaserequestapproval.outstanding=true 
                ) select t_temp.*,(case when t_temp.countapproval= 0 then 'Preparing' else
                            case when t_temp.complete_approve = false then 'Approval Process' else
                            case when t_temp.counterpurchaseorder = 0 then 'Ready to Create PO' else 'Already Have PO' end end end  
                                ) as status from t_temp 
        )select t.* from t where true
        ";

        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $number = $this->input->post('number');
        $departmentid = $this->input->post('departmentid');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and t.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and t.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and t.date = '" . $dateto . "'";
        }if ($number != "") {
            $query .= " and t.number ilike '%" . $number . "%'";
        }if ($departmentid != "") {
            $query .= " and t.departmentid = " . $departmentid;
        }
        $status = $this->input->post('status');

        if ($status != "") {
            $query .= " and status='$status' ";
        }

        if ($this->session->userdata('id') != 'admin') {
            if ($this->session->userdata('department') == 7) {
                if ($this->option_view == 0) { //Jika Departement adalah Purchasing dang tidak dapat mengakses semua data
                    $query .= " and (t.create_by='" . $this->session->userdata('id') . "' or t.current_count_approval > 0)";
                }
            } else {
                if ($this->option_view == 0) { //Jika Departement bukan purchasing dan tidak tapat mengakses semua data,
                    //Yang Dapat diakses hanyalah data yang hanya dapat di approve
                    $query .= " and t.current_count_approval > 0";
                }
            }
        }

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');

        $query .= " order by t.$sort $order ";
        
//        echo $query;
        
        echo $this->model_purchaserequest->get($query);
    }

    function add() {
        $this->load->view('purchaserequest/add');
    }

    function save() {
        $date = $this->input->post('date');
//        $employeeidrequest = $this->input->post('employeeidrequest');
        $vendorid = $this->input->post('vendorid');
        $currency = $this->input->post('currency');
//        $departmentid = $this->input->post('departmentid');
        $remark = $this->input->post('remark');
        $tax = $this->input->post('tax');
        $data = array(
            'date' => $date,
//            'employeeidrequest' => $employeeidrequest,
//            'departmentid' => $departmentid,
            'vendorid' => $vendorid,
            'currency' => $currency,
            'tax' => $tax,
            'remark' => $remark,
            'create_by' => $this->session->userdata('id')
        );
        if ($this->model_purchaserequest->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $date = $this->input->post('date');
        $departmentid = $this->input->post('departmentid');
        $remark = $this->input->post('remark');
        $employeeidrequest = $this->input->post('employeeidrequest');
        $data = array(
            'date' => $date,
            'departmentid' => $departmentid,
            'employeeidrequest' => $employeeidrequest,
            'remark' => $remark
        );
        if ($this->model_purchaserequest->update($data, array('id' => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit_price($id) {
        $data['purchaserequest'] = $this->model_purchaserequest->select_result_by_id($id);
        $this->load->view('purchaserequest/edit_price_form-input', $data);
    }

    function update_price($id) {

        $data = array(
            'total' => (double) $this->input->post('total'),
            'discount' => (double) $this->input->post('discount'),
            'tax' => (double) $this->input->post('tax'),
            'amount' => (double) $this->input->post('amount')
        );

        if ($this->model_purchaserequest->update($data, array('id' => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_default_aprroval() {
        echo $this->model_purchaserequest->get_default_aprroval();
    }

    function save_default_aprroval() {
        $checked = $this->input->post('checked');
        $acknowledge = $this->input->post('acknowledge');
        $approved = $this->input->post('approved');
        $data = array(
            'checked' => $checked,
            'acknowledge' => $acknowledge,
            'approved' => $approved
        );
        if ($this->model_purchaserequest->save_default_aprroval($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_purchaserequest->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function load_search_form() {
        $this->load->model('model_department');
        $data['department'] = $this->model_department->selectAllResult();
        $this->load->view('purchaserequest/load_search_form', $data);
    }

    function save_batch_from_mr_item() {
        $this->load->model('model_purchaserequestdetail');
        $pr = $this->input->post('pr');
        $new_pr = array();
        for ($i = 0; $i < count($pr); $i++) {
            $new_pr[$pr[$i]['name']] = $pr[$i]['value'];
        }

        $data = array(
            'date' => $new_pr['date'],
//            'employeeidrequest' => $new_pr['employeeidrequest'],
//            'departmentid' => $new_pr['departmentid'],
            'remark' => $new_pr['remark'],
            'create_by' => $this->session->userdata('id')
        );

        $mritemid = $this->input->post('mritemid');
        $itemid = $this->input->post('itemid');
        $unitcode = $this->input->post('unitcode');
        $qty = $this->input->post('qty');

        $msg_error = '';
        $this->db->trans_start();
        $purchaserequestid = 0;
        if (!$this->model_purchaserequest->insert($data)) {
            $msg_error = $this->db->_error_message();
        } else {
            $purchaserequestid = $this->model_purchaserequest->get_last_id();
        }

        $data_pr_item = array();
        for ($i = 0; $i < count($mritemid); $i++) {
            $data_pr_item[] = array(
                'materialrequisitiondetailid' => $mritemid[$i],
                'itemid' => $itemid[$i],
                'unitcode' => $unitcode[$i],
                'qty' => $qty[$i],
                'purchaserequestid' => $purchaserequestid
            );
        }

        if (!$this->model_purchaserequestdetail->insert_batch($data_pr_item)) {
            $msg_error = $this->db->_error_message();
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === TRUE) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $msg_error));
        }
    }

    function po_plan() {
        $this->load->view('purchaserequest/po_plan');
    }

    function get_po_plan() {

        $purchaserequestid = $this->input->post("purchaserequestid");

        if (empty($purchaserequestid)) {
            $purchaserequestid = 0;
        }

        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        $query = "
            select 
            puchaseorder_plan.*,
            (puchaseorder_plan.sub_total - puchaseorder_plan.discount) sub_total_discount,
            vendor.code vendor_code,
            vendor.name vendor_name
            from puchaseorder_plan
            join vendor on puchaseorder_plan.vendorid=vendor.id
            where puchaseorder_plan.purchaserequestid=$purchaserequestid
            order by puchaseorder_plan.id asc
        ";
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

    function po_plan_edit() {
        $this->load->model('model_currency');
        $data['currency'] = $this->model_currency->selectAllResult();
        $this->load->view('purchaserequest/po_plan_edit_form', $data);
    }

    function po_plan_update($id) {
//        $ppn_check = $this->input->post('ppn_check');
        $expected_delivery_date = $this->input->post("expected_delivery_date");
        $data = array(
//            "discount_percent" => (double) $this->input->post('discount_percent'),
//            "discount" => (double) $this->input->post('discount'),
//            "tax_percent" => (empty($ppn_check) ? 0 : 10),
//            "tax" => (double) $this->input->post('tax'),
            "expected_delivery_date" => (empty($expected_delivery_date) ? null : $expected_delivery_date),
            "payment_terms" => $this->input->post("payment_terms"),
            "description" => $this->input->post("description"),
        );

        if ($this->db->update('puchaseorder_plan', $data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function view_approval($purchaserequestid) {
        $this->load->model('model_purchaserequestapproval');
        $data["approval"] = $this->model_purchaserequestapproval->select_all_by_purchaserequest_id($purchaserequestid);
        $this->load->view('purchaserequest/approval/view_approval', $data);
    }

}
