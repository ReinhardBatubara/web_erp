<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchaserequestattachment
 *
 * @author hp
 */
class purchaserequestattachment extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_purchaserequestattachment');
    }

    function get($purchaserequestid) {
        $data['attachment'] = $this->model_purchaserequestattachment->get($purchaserequestid);
        $this->load->view('purchaserequest/attachment/list', $data);
    }

    function upload() {
        $purchaserequestid = $this->input->post('purchaserequestid');
        $title = $this->input->post('title');
        //echo $purchaserequestid . "#" . $attachment_title;
        $config['upload_path'] = './attachment/';
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $file_element_name = 'attachment_file';
        $status = false;
        $msg = "";
        if ($this->upload->do_upload($file_element_name)) {
            $data = $this->upload->data();
            $data_attachment = array(
                "purchaserequestid" => $purchaserequestid,
                "title" => $title,
                "filename" => $data['file_name']
            );
            if ($this->model_purchaserequestattachment->insert($data_attachment)) {
                $status = true;
            } else {
                unlink($data['full_path']);
                $msg = $this->db->_error_message();
            }
        } else {
            $msg = $this->upload->display_errors();
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
        @unlink($_FILES[$file_element_name]);
    }

    function delete() {
        $id = $this->input->post('id');
        $filename = $this->input->post('filename');
        $this->load->helper("file");
        $file_path = "attachment/" . $filename;
        //echo $file_path;
        if (unlink($file_path)) {
            if ($this->model_purchaserequestattachment->delete(array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            echo json_encode(array('msg' => 'Error Delete File'));
        }
    }

}
