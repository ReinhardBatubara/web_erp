<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of currency
 *
 * @author hp
 */
class currency extends CI_Controller {

    //put your curr here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_currency');
    }

    function index() {
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "currency"));
        $this->load->view('currency/view', $data);
    }

    function get() {        

        $curr = $this->input->post('curr');
        $desc = $this->input->post('desc');

        $query = "select * from currency where true ";

        if (!empty($curr)) {
            $query .= " and curr ilike '%$curr%' ";
        }if (!empty($desc)) {
            $query .= " and desc ilike '%$desc%' ";
        }
        
        $query .= " order by curr asc ";
        //echo $query;
        echo $this->model_currency->get($query);
    }

    function save() {
        $curr = $this->input->post('curr');
        $desc = $this->input->post('desc');

        $data = array(
            "curr" => $curr,
            "desc" => $desc,
            "user_inserted"=>$this->session->userdata('name')
        );
       // var_dump($data);
        if ($this->model_currency->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($curr) {
        $newcurr = $this->input->post('curr');
        $desc = $this->input->post('desc');

        $data = array(
            "curr" => $newcurr,
            "desc" => $desc,
            "user_updated"=>$this->session->userdata('name')
        );

        if ($this->model_currency->update($data, array("curr" => $curr))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $curr = $this->input->post('curr');
        if ($this->model_currency->delete(array("curr" => $curr))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
