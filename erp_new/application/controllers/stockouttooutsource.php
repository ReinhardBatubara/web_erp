<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of stockouttooutsource
 *
 * @author user
 */
class stockouttooutsource extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_sto_to');
    }

    function index() {
        $this->load->view('stockouttooutsource/view');
    }

    function get() {
        $query = "select 
                sto_to.*,
                to_char(sto_to.date,'DD-MM-YYY') date_f,
                vendor.name vendor
                from sto_to join vendor 
                on sto_to.vendorid=vendor.id where true ";

        $number = $this->input->post('number');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        $vendorid = $this->input->post('vendorid');

        if ($datefrom != "" && $dateto != "") {
            $query .= " and sto_to.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and sto_to.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and sto_to.date = '" . $dateto . "'";
        }if (!empty($number)) {
            $query .= " and sto_to.number ilike '%" . $number . "%'";
        }if (!empty($vendorid)) {
            $query .= " and sto_to.vendorid ilike '%" . $number . "%'";
        }

        // $query .= " order by sto_to.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        echo $this->model_sto_to->get($query);
    }

    function add() {
        $this->load->view('stockouttooutsource/add');
    }

    function save($id) {
        $data = array(
            "date" => $this->input->post('date'),
            "vendorid" => $this->input->post('vendorid'),
            "remark" => $this->input->post('remark')
        );

        if ($id == 0) {
            if ($this->model_sto_to->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_sto_to->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_sto_to->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    //Detail


    function detail_get() {
        $sto_so_id = $this->input->post('sto_so_id');
        if (empty($sto_so_id)) {
            $sto_so_id = 0;
        }
        $query = "select 
            sto_to_detail.*,
            item.code itemcode,
            item.description itemdescription  
            from sto_to_detail join item
            on sto_to_detail.itemid=item.id where sto_to_detail.sto_to_id=$sto_so_id";

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and item.code ilike '%$itemcode%' ";
        }
        $itemdescription = $this->input->post('itemdescription');
        if (!empty($itemdescription)) {
            $query .= " and item.description ilike '%$itemdescription%' ";
        }
        //$query .= " order by sto_to_detail.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";

        //echo $query;
        echo $this->model_sto_to->detail_get($query);
    }

    function add_item() {
        $this->load->view('stockouttooutsource/detail/add');
    }

    function detail_save($sto_to_id, $id) {
        $data = array(
            "itemid" => $this->input->post('itemid'),
            "unitcode" => $this->input->post('unitcode'),
            "qty" => $this->input->post('qty')
        );

        if ($id == 0) {
            $data['sto_to_id'] = $sto_to_id;
            if (($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') == -1) || $this->session->userdata('id') == 'admin') {
                $data['warehouseid'] = $this->input->post('warehouseid');
            } else {
                $data['warehouseid'] = $this->session->userdata('optiongroup');
            }

            if ($this->model_sto_to->detail_insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_sto_to->detail_update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function detail_delete() {
        $id = $this->input->post('id');
        if ($this->model_sto_to->detail_delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}

?>
