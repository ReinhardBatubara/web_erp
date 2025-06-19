<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of customer
 *
 * @author hp
 */
class customer extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_customer');
    }

    function index() {
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "customer"));
        $this->load->view('customer/view', $data);
    }

    function get() {
        $query = "select customer.* from customer where true ";

        $code = $this->input->post('code');
        if (!empty($code)) {
            $query .= " and customer.code ilike '%$code%'";
        }

        $name = $this->input->post('name');
        if (!empty($name)) {
            $query .= " and customer.name ilike '%$name%'";
        }

        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= " and (customer.code ilike '%$q%' or customer.name ilike '%$q%')";
        }
        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        if (!empty($sort) && !empty($order)) {
            $query .= " order by $sort $order ";
        }
        echo $this->model_customer->get($query);
    }

    function save() {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $contact = $this->input->post('contact');
        $phone = $this->input->post('phone');
        $fax = $this->input->post('fax');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $zipcode = $this->input->post('zipcode');
        $country = $this->input->post('country');
        $service = $this->input->post('service');
        $data = array(
            "code" => $code,
            "name" => $name,
            "contact" => $contact,
            "phone" => $phone,
            "fax" => $fax,
            "email" => $email,
            "address1" => $address,
            "city" => $city,
            "state" => $state,
            "zipcode" => $zipcode,
            "country" => $country,
            "service" => $service);

        if ($this->model_customer->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $contact = $this->input->post('contact');
        $phone = $this->input->post('phone');
        $fax = $this->input->post('fax');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $zipcode = $this->input->post('zipcode');
        $country = $this->input->post('country');
        $service = $this->input->post('service');
        $data = array(
            "code" => $code,
            "name" => $name,
            "contact" => $contact,
            "phone" => $phone,
            "fax" => $fax,
            "email" => $email,
            "address1" => $address,
            "city" => $city,
            "state" => $state,
            "zipcode" => $zipcode,
            "country" => $country,
            "service" => $service);

        if ($this->model_customer->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_customer->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_address($id) {
        echo $this->model_customer->get_address($id);
    }

}
