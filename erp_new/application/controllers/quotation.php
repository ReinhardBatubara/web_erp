<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of quotation
 *
 * @author hp
 */
class quotation extends CI_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_quotation');
    }

    function index() {
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "quotation"));
        $this->load->view('quotation/view', $data);
    }
    
    function input(){
        $this->load->view('quotation/add');
    }

    function get() {

        $query = "select quotation.* from quotation where true ";

        $number = $this->input->post('number');
        if (!empty($number)) {
            $query .= " and quotation.number ilike '%$number%'";
        }
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        if ($datefrom != "" && $dateto != "") {
            $query .= " and quotation.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and quotation.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and quotation.date = '" . $dateto . "'";
        }

        // $query .= " order by quotation.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');

        $query .= " order by $sort $order ";

        //echo $query;
        echo $this->model_quotation->get($query);
    }

    function save($id) {
        $data = array(
            "date" => $this->input->post('date'),
            "to" => $this->input->post('to'),
            "customerid" => (int) $this->input->post('customerid'),
            "company" => $this->input->post('company'),
            "project" => $this->input->post('project'),
            "ref" => $this->input->post('ref'),
            "note" => $this->input->post('note'),
            "currency" => $this->input->post('currency')
        );

        if ($id == 0) {
            if ($this->model_quotation->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_quotation->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_quotation->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function detail_get() {
        $quotationid = $this->input->post('quotationid');
        if (empty($quotationid)) {
            $quotationid = 0;
        }
        $query = "
            select t.*,t.modelcode item_code,t.modelname item_name 
            from quotation_get_detail_by_quotation_id($quotationid) t
        ";
        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and t.modelcode ilike '%$itemcode%' ";
        }
        $itemdescription = $this->input->post('itemdescription');
        if (!empty($itemdescription)) {
            $query .= " and t.modelname ilike '%$itemdescription%' ";
        }
        $query .= " order by t.id desc ";

        echo $this->model_quotation->get($query);
    }

    function detail_add() {
        $this->load->view('quotation/detail/add');
    }

    function detail_add_others() {
        $this->load->view('quotation/detail/add_others');
    }

    function detail_save($quotationid, $id) {
        $data = array(
            "modelid" => $this->input->post('modelid'),
            "price" => $this->input->post('price'),
            "finishingcode" => $this->input->post('finishingcode'),
            "remark" => $this->input->post('remark')
        );

        if ($id == 0) {
            $data['quotationid'] = $quotationid;
            if ($this->model_quotation->detail_insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_quotation->detail_update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function detail_save_others($quotationid, $id, $images = "") {

        $config['upload_path'] = './files';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        $data = array(
            "modelid" => 0,
            "item_code" => $this->input->post('item_code'),
            "price" => $this->input->post('price'),
            "finishingcode" => $this->input->post('finishingcode'),
            "remark" => $this->input->post('remark'),
            "item_size_w" => $this->input->post('item_size_w'),
            "item_size_d" => $this->input->post('item_size_d'),
            "item_size_h" => $this->input->post('item_size_h'),
            "item_name" => $this->input->post('item_name')
        );
        $upload_msg = "";
        if ($id == 0) {
            $data['quotationid'] = $quotationid;
            if ($this->upload->do_upload('fileupload')) {
                $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];
            } else {
                $image = "no-image.jpg";
                $upload_msg = $this->upload->display_errors('', '');
            }
            $data['images'] = $image;
            if ($this->model_quotation->detail_insert($data)) {
                echo json_encode(array('success' => true, 'msg_upload' => $upload_msg));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if (!empty($_FILES['fileupload'])) {
                if ($this->upload->do_upload('fileupload')) {
                    $upload_data = $this->upload->data();
                    if ($images != "no-image.jpg" && $images != "") {
                        @unlink("./files/model/" . $images);
                    }
                    $data['images'] = $upload_data['file_name'];
                } else {
                    $upload_msg = $this->upload->display_errors('', '');
                }
            }

            if ($this->model_quotation->detail_update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function detail_delete() {
        $id = $this->input->post('id');
        if ($this->model_quotation->detail_delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function prints($id_get = null) {
        $id = $id_get;
        $id_post = $this->input->post('id');
        $type = $this->input->post('type');
        if (empty($id_get)) {
            $id = $id_post;
        }
        $this->load->library('component');
        $this->load->model('model_company');
        $data['company'] = $this->model_company->select();
        $data['quotation'] = $this->model_quotation->select_by_id($id);
        $data['quotationdetail'] = $this->model_quotation->select_detail_by_quotation_id($id);
        if ($type == 'excel') {
            $this->load->library('excel');
            $this->load->view('quotation/print_excel', $data);
        } else {
            $this->load->view('quotation/print', $data);
        }
    }

}

?>
