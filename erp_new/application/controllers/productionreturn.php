<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of productionreturn
 *
 * @author user
 */
class productionreturn extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_productionreturn');
    }

    function index() {
        $this->load->view('productionreturn/view');
    }

    function get() {
        $query = "select 
            productionreturn.*,
            to_char(productionreturn.date,'DD-MM-YYYY') date_f,
            employee.name return_by,
            (select name from employee where id=productionreturn.receiveby) receive_by
            from productionreturn
            join employee on productionreturn.returnby=employee.id where true ";

        $number = $this->input->post('number');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $returnby = $this->input->post('returnby');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and productionreturn.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and productionreturn.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and productionreturn.date = '" . $dateto . "'";
        }if (!empty($number)) {
            $query .= " and productionreturn.number ilike '%" . $number . "%'";
        }if (!empty($returnby)) {
            $query .= " and productionreturn.returnby ilike '%" . $returnby . "%'";
        }

        //$query .= " order by productionreturn.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";

        //echo $query;
        echo $this->model_productionreturn->get($query);
    }

    function save($id) {
        $data = array(
            "date" => $this->input->post('date'),
            "returnby" => $this->input->post('returnby'),
            "remark" => $this->input->post('remark')
        );

        if ($id == 0) {
            $data["receiveby"] = $this->session->userdata('id');
            if ($this->model_productionreturn->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_productionreturn->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_productionreturn->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    //Detail


    function detail_get() {
        $productionreturnid = $this->input->post('productionreturnid');
        if (empty($productionreturnid)) {
            $productionreturnid = 0;
        }
        $query = "
            select productionreturndetail.*,item.code itemcode,item.description itemdescription  
            from productionreturndetail 
            join item on productionreturndetail.itemid=item.id where productionreturndetail.productionreturnid=$productionreturnid 
        ";

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and item.code ilike '%$itemcode%' ";
        }
        $itemdescription = $this->input->post('itemdescription');
        if (!empty($itemdescription)) {
            $query .= " and item.description ilike '%$itemdescription%' ";
        }
        //$query .= " order by productionreturndetail.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        //echo $query;
        echo $this->model_productionreturn->detail_get($query);
    }

    function detail_save($productionreturnid, $id) {
        $data = array(
            "itemid" => $this->input->post('itemid'),
            "unitcode" => $this->input->post('unitcode'),
            "qty" => $this->input->post('qty'),
            "returntype" => $this->input->post('returntype')
        );

        if ($id == 0) {
            $data['productionreturnid'] = $productionreturnid;
            if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') {
                $data['warehouseid'] = $this->input->post('warehouseid');
            } else {
                $data['warehouseid'] = $this->session->userdata('optiongroup');
            }

            if ($this->model_productionreturn->detail_insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_productionreturn->detail_update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function detail_delete() {
        $id = $this->input->post('id');
        if ($this->model_productionreturn->detail_delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function prints($id) {
        $data['production_return'] = $this->model_productionreturn->select_by_id($id);
        $data['item'] = $this->model_productionreturn->detail_select_by_production_return_id($id);
        $this->load->view('productionreturn/print', $data);
    }

}

?>
