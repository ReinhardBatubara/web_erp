<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pricecomparison
 *
 * @author hp
 */
class pricecomparison extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_pricecomparison');
    }

    function index() {
        $this->load->view('pricecomparison/view');
    }

    function get() {
        $purchaserequestdetailid = $this->input->post('purchaserequestdetailid');
        $query = "select 
            pricecomparison.*,
            vendor.name vendor
            from pricecomparison
            join vendor on pricecomparison.vendorid=vendor.id";

        if (empty($purchaserequestdetailid)) {
            $purchaserequestdetailid = 0;
        }
        $query .= " and pricecomparison.purchaserequestdetailid = $purchaserequestdetailid ";
        echo $this->model_pricecomparison->get($query);
    }

    function get_vendor_list_pritem($purchaserequestdetailid) {
        $query = "select 
        pricecomparison.*,
        vendor.name vendor
        from 
        pricecomparison 
        join vendor on pricecomparison.vendorid=vendor.id
        where pricecomparison.purchaserequestdetailid=$purchaserequestdetailid";
        echo $this->model_pricecomparison->get($query);
    }

    function save($id, $qty) {
        $vendorid = $this->input->post('vendorid');
        $currency = $this->input->post('currency');
        $price = (double) $this->input->post('price');
        $discount = (double) $this->input->post('discount');
        $ppn = (double) $this->input->post('ppn');
        $total_price = ($qty * $price);
        $amount = ($total_price + $ppn) - $discount;
        $expired_date = $this->input->post('expired_date');
        $expired_date = (!empty($expired_date)) ? $expired_date : null;

        $data = array(
            'purchaserequestdetailid' => $id,
            'vendorid' => $vendorid,
            'currency' => $currency,
            'price' => $price,
            'total' => $total_price,
            'ppn' => $ppn,
            'amount' => $amount,
            'expired_date' => $expired_date
        );
        if ($this->model_pricecomparison->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id, $qty) {
        $vendorid = $this->input->post('vendorid');
        $currency = $this->input->post('currency');
        $price = (double) $this->input->post('price');
        $discount = (double) $this->input->post('discount');
        $ppn = (double) $this->input->post('ppn');
        $total_price = ($qty * $price);
        $amount = ($total_price + $ppn) - $discount;
        $expired_date = $this->input->post('expired_date');
        $expired_date = (!empty($expired_date)) ? $expired_date : null;
        $data = array(
            'vendorid' => $vendorid,
            'currency' => $currency,
            'price' => $price,
            'total' => $total_price,
            'ppn' => $ppn,
            'amount' => $amount,
            'expired_date' => $expired_date
        );
        if ($this->model_pricecomparison->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_pricecomparison->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function setselected() {
        $id = $this->input->post('id');
        $purchaserequestdetailid = $this->input->post('purchaserequestdetailid');
        $vendorid = $this->input->post('vendorid');
        $price = $this->input->post('price');
        $discount = $this->input->post('discount');
        $currency = $this->input->post('currency');
        $ppn = $this->input->post('ppn');
        $amount = $this->input->post('amount');

        $data = array(
            "pricecomparisonid" => $id,
            "vendorid" => $vendorid,
            "currency" => $currency,
            "price" => $price,
            "discount" => $discount,
            "ppn" => $ppn,
            "amount" => $amount
        );
//        print_r($data);
        $this->load->model('model_purchaserequestdetail');
        if ($this->model_purchaserequestdetail->update($data, array("id" => $purchaserequestdetailid))) {
            $this->model_pricecomparison->update(array("used" => 0), array("purchaserequestdetailid" => $purchaserequestdetailid));
            if ($this->model_pricecomparison->update(array("used" => 1), array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function preview($purchaserequestid, $type) {
        $this->load->model('model_purchaserequestdetail');
        $data['purchaserequestdetail'] = $this->model_purchaserequestdetail->select_result_by_purchase_request_id($purchaserequestid);
        if ($type == 'print') {
            echo "<link rel='stylesheet' type='text/css' href='http://localhost/allegra/css/style.css'>";
        }
        $this->load->view('pricecomparison/preview', $data);
    }

    function load_input() {
        $this->load->model('model_currency');
        $data['currency'] = $this->model_currency->selectAllResult();
        $this->load->view('pricecomparison/add', $data);
    }

}
