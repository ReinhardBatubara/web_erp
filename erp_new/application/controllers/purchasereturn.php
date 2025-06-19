<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchasereturn
 *
 * @author user
 */
class purchasereturn extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_purchasereturn');
    }

    function index() {
        $this->load->view('purchasereturn/view');
    }

    function get() {
        $query = "select 
        purchasereturn.*,
        vendor.name vendor_name,
        vendor.code vendor_code
        from purchasereturn
        join vendor on purchasereturn.vendorid=vendor.id
        where true ";

        $number = $this->input->post('number');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and purchasereturn.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and purchasereturn.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and purchasereturn.date = '" . $dateto . "'";
        }if (!empty($number)) {
            $query .= " and purchasereturn.number ilike '%" . $number . "%'";
        }
        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        echo $this->model_purchasereturn->get($query);
    }

    function input() {
        $this->load->view('purchasereturn/input');
    }

    function save($id) {
        $data = array(
            "date" => $this->input->post('date'),
            "vendorid" => $this->input->post('vendorid'),
            "remark" => $this->input->post('remark')
        );

        if ($id == 0) {
            if ($this->model_purchasereturn->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_purchasereturn->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_purchasereturn->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    //Detail

    function detail_view() {
        $this->load->view('purchasereturn/detail/view');
    }

    function detail_get() {
        $purchasereturnid = $this->input->post('purchasereturnid');
        if (empty($purchasereturnid)) {
            $purchasereturnid = 0;
        }
        $query = "
            select 
            purchasereturndetail.*, 
            item.code itemcode,
            item.description itemdescription,
            purchasereturndetail.unitcode,
            warehouse.name warehouse_name
            from purchasereturndetail
            join item on purchasereturndetail.itemid=item.id
            join warehouse on purchasereturndetail.warehouseid=warehouse.id 
            where purchasereturndetail.purchasereturnid=$purchasereturnid
        ";

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and item.code ilike '%$itemcode%' ";
        }
        $itemdescription = $this->input->post('itemdescription');
        if (!empty($itemdescription)) {
            $query .= " and item.description ilike '%$itemdescription%' ";
        }
        //$query .= " order by purchasereturndetail.id desc ";
        //echo $query;

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        //echo $query;
        echo $this->model_purchasereturn->detail_get($query);
    }

    function detail_add($goodsreceiveid) {
        $data['goodsreceiveid'] = $goodsreceiveid;
        $this->load->view('purchasereturn/detail/add', $data);
    }

    function detail_save($purchasereturnid, $id) {

        $warehouseid = $this->input->post('warehouseid');
        if (empty($warehouseid)) {
            $warehouseid = $this->session->userdata('optiongroup');
        }

        $data = array(
            "itemid" => $this->input->post('itemid'),
            "unitcode" => $this->input->post('unitcode'),
            "qty" => $this->input->post('qty'),
            "warehouseid" => $warehouseid,
            "type" => $this->input->post('type'),
            "remark" => $this->input->post('remark')
        );

        if ($id == 0) {
            $data['purchasereturnid'] = $purchasereturnid;
            if ($this->model_purchasereturn->detail_insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_purchasereturn->detail_update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function detail_delete() {
        $id = $this->input->post('id');
        if ($this->model_purchasereturn->detail_delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function prints($id) {
        $data['prt'] = $this->model_purchasereturn->select_by_id($id);
        $data['item'] = $this->model_purchasereturn->detail_select_by_purchase_return_id($id);
        $this->load->view('purchasereturn/print', $data);
    }

}

?>
