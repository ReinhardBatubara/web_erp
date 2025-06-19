<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchaserequestcomment
 *
 * @author hp
 */
class purchaserequestcomment extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_purchaserequestcomment');
    }

    function index() {
        
    }

    function get_comment($purchaserequestid) {
        $data['commentlist'] = $this->model_purchaserequestcomment->get_comment($purchaserequestid);
        $this->load->view('purchaserequest/comment/commentlist', $data);
    }

    function post() {
        $purchaserequestid = $this->input->post('purchaserequestid');
        $content = $this->input->post('content');
        $data = array(
            'purchaserequestid' => $purchaserequestid,
            'content' => $content,
            'employeeid' => $this->session->userdata('id')
        );
        if ($this->model_purchaserequestcomment->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_purchaserequestcomment->delete(array('id' => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
