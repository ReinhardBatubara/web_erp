<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vendor
 *
 * @author hp
 */
class vendor extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_vendor');
    }

    function index() {
        $this->load->model('model_currency');
        $data['currency'] = $this->model_currency->selectAllResult();
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "vendor"));
        $this->load->view('vendor/view', $data);
    }

    function get() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $query = "select vendor.* from vendor where true ";

        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $address1 = $this->input->post('address1');

        if (!empty($code)) {
            $query .= " and vendor.code ilike '%$code%' ";
        }if (!empty($name)) {
            $query .= " and vendor.name ilike '%$name%' ";
        }if (!empty($address1)) {
            $query .= " and vendor.address1 ilike '%$address1%' ";
        }
        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        //echo $query;
        echo $this->model_vendor->get($page, $rows, $query);
    }

    function get_remote_data() {
        $name = $this->input->post('q');
        $query = "select id,name from vendor where true ";
        if ($name != "") {
            $query .= " and name ilike '%$name%'";
        }
        //echo $query;
        echo $this->model_vendor->get_remote_data($query);
    }

    function save() {
        $joindate = $this->input->post('joindate');
        $enddate = $this->input->post('enddate');

        $data = array(
            "code" => $this->input->post('code'),
            "name" => $this->input->post('name'),
            "contact" => $this->input->post('contact'),
            "phone" => $this->input->post('phone'),
            "fax" => $this->input->post('fax'),
            "email" => $this->input->post('email'),
            "address1" => $this->input->post('address1'),
            "city" => $this->input->post('city'),
            "state" => $this->input->post('state'),
            "zipcode" => $this->input->post('zipcode'),
            "country" => $this->input->post('country'),
            "taxable" => $this->input->post('taxable'),
            "payment_terms" => $this->input->post('payment_terms'),
            "service" => $this->input->post('service'),
            "joindate" => ($joindate == '' ? null : $joindate),
            "enddate" => ($enddate == '' ? null : $enddate),
            "currency" => $this->input->post("currency")
        );

        if ($this->model_vendor->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $joindate = $this->input->post('joindate');
        $enddate = $this->input->post('enddate');

        $data = array(
            "code" => $this->input->post('code'),
            "name" => $this->input->post('name'),
            "contact" => $this->input->post('contact'),
            "phone" => $this->input->post('phone'),
            "fax" => $this->input->post('fax'),
            "email" => $this->input->post('email'),
            "address1" => $this->input->post('address1'),
            "city" => $this->input->post('city'),
            "state" => $this->input->post('state'),
            "zipcode" => $this->input->post('zipcode'),
            "country" => $this->input->post('country'),
            "taxable" => $this->input->post('taxable'),
            "payment_terms" => $this->input->post('payment_terms'),
            "service" => $this->input->post('service'),
            "joindate" => ($joindate == '' ? null : $joindate),
            "enddate" => ($enddate == '' ? null : $enddate),
            "currency" => $this->input->post("currency")
        );

        if ($this->model_vendor->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_vendor->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
