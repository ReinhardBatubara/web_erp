<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bankaccount
 *
 * @author user
 */
class bankaccount extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_bankaccount');
    }

    function index() {
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "bankaccount"));
        $this->load->view('bankaccount/view', $data);
    }

    function get() {

        $account_number = $this->input->post('account_number');
        $account_name = $this->input->post('account_name');
        $bank = $this->input->post('bank');
        $bank_address = $this->input->post('bank_address');
        $swift_code = $this->input->post('swift_code');
        $currency = $this->input->post('currency');
        $q = $this->input->post('q');
        

        $query = "select * from bankaccount where true ";

        if (!empty($account_number)) {
            $query .= " and account_number ilike '%$account_number%' ";
        }if (!empty($account_name)) {
            $query .= " and account_name ilike '%$account_name%' ";
        }if (!empty($bank)) {
            $query .= " and bank ilike '%$bank%' ";
        }if (!empty($bank_address)) {
            $query .= " and bank_address ilike '%$bank_address%' ";
        }if (!empty($swift_code)) {
            $query .= " and swift_code ilike '%$swift_code%' ";
        }if (!empty($currency)) {
            $query .= " and currency ilike '%$currency%' ";
        }
        
        if(!empty($q)){
            $query .= " and (account_number ilike '%$q%' or 
                             account_name ilike '%$q%' or
                             bank ilike '%$bank%' or 
                             bank_address ilike '%$q%' or 
                             swift_code ilike '%$q%' or 
                             currency ilike '%$q%') ";
        }
        
        $query .= " order by id desc ";
        echo $this->model_bankaccount->get($query);
    }

    function save() {

        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $description = $this->input->post('description');

        $data = array(
            "code" => $code,
            "name" => $name,
            "description" => $description
        );

        if ($this->model_bankaccount->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $description = $this->input->post('description');

        $data = array(
            "code" => $code,
            "name" => $name,
            "description" => $description
        );

        if ($this->model_bankaccount->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_bankaccount->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}

?>
