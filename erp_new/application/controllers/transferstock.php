<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of transferstock
 *
 * @author user
 */
class transferstock extends CI_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_transferstock');
    }

    function index() {
        $this->load->view('transferstock/view');
    }

    function get() {
        $query = "select 
        transferstock.*,
        to_char(transferstock.date,'DD-MM-YYYY') date_f,
        warehouse.code warehouse_from,
        (select code from warehouse where id=transferstock.towarehouseid) warehouse_to,
        (employee.name || '(' || transferstock.deliveredby || ')') delivered_by,
        (select employee.name from employee where id=transferstock.receivedby) received_by
        from transferstock 
        join warehouse on transferstock.fromwarehouseid=warehouse.id
        left join employee on transferstock.deliveredby=employee.id where true ";

        $number = $this->input->post('number');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and transferstock.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and transferstock.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and transferstock.date = '" . $dateto . "'";
        }if (!empty($number)) {
            $query .= " and transferstock.number ilike '%" . $number . "%'";
        }

        //$query .= " order by transferstock.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        echo $this->model_transferstock->get($query);
    }

    function save($id) {

        if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') {
            $fromwarehouseid = $this->input->post('fromwarehouseid');
        } else {
            $fromwarehouseid = $this->session->userdata('optiongroup');
        }

        $data = array(
            "date" => $this->input->post('date'),
            "towarehouseid" => $this->input->post('towarehouseid'),
            "deliveredby" => $this->session->userdata('id'),
            "receivedby" => $this->input->post('receivedby'),
            "remark" => $this->input->post('remark')
        );

        if ($id == 0) {
            $data["fromwarehouseid"] = $fromwarehouseid;
            if ($this->model_transferstock->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_transferstock->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_transferstock->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

//Detail

    function detail_add($fromwarehouseid, $towarehouseid) {
        $data["fromwarehouseid"] = $fromwarehouseid;
        $data["towarehouseid"] = $towarehouseid;
        $this->load->view('transferstock/detail/add', $data);
    }

    function detail_get() {
        $transferstockid = $this->input->post('transferstockid');
        if (empty($transferstockid)) {
            $transferstockid = 0;
        }
        $query = "
            select 
            transferstockdetail.*,
            transferstock.fromwarehouseid,
            transferstock.towarehouseid,
            item.code itemcode,
            item.description itemdescription  
            from transferstockdetail 
            join transferstock on transferstockdetail.transferstockid=transferstock.id
            join item on transferstockdetail.itemid=item.id
            where transferstockdetail.transferstockid=$transferstockid        
        ";

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and item.code ilike '%$itemcode%' ";
        }
        $itemdescription = $this->input->post('itemdescription');
        if (!empty($itemdescription)) {
            $query .= " and item.description ilike '%$itemdescription%' ";
        }
        //$query .= " order by transferstockdetail.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
//echo $query;
        echo $this->model_transferstock->detail_get($query);
    }

    function detail_save($transferstockid, $id) {
        $data = array(
            "itemid" => $this->input->post('itemid'),
            "unitcode" => $this->input->post('unitcode'),
            "qty" => $this->input->post('qty'),
            "remark" => $this->input->post('remark')
        );

        if ($id == 0) {
            $data['transferstockid'] = $transferstockid;
            if ($this->model_transferstock->detail_insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_transferstock->detail_update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function detail_delete() {
        $id = $this->input->post('id');
        if ($this->model_transferstock->detail_delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function prints() {
        $data['transferstock'] = $this->model_transferstock->select_by_id($this->input->post('id'));
        $data['transferstock_item'] = $this->model_transferstock->select_item_by_transfer_id($this->input->post('id'));
        $this->load->view('transferstock/print', $data);
    }

}

?>
