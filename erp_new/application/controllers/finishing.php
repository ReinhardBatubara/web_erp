<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of finishing
 *
 * @author hp
 */
class finishing extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_finishing');
    }

    function index() {
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "finishing"));
        $this->load->view('finishing/view', $data);
    }

    function get() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');

        $code = $this->input->post('code');
        $description = $this->input->post('description');

        $query = "select * from finishing where true ";

        if (!empty($code)) {
            $query .= " and code ilike '%$code%' ";
        }if (!empty($description)) {
            $query .= " and description ilike '%$description%' ";
        }

        if (!empty($sort)) {
            $arr_sort = explode(',', $sort);
            $arr_order = explode(',', $order);
            if (count($arr_sort) == 1) {
                $order_specification = " $arr_sort[0] $arr_order[0] ";
            } else {
                $order_specification = " $arr_sort[0] $arr_order[0] ";
                for ($i = 1; $i < count($arr_sort); $i++) {
                    $order_specification .= ", $arr_sort[$i] $arr_order[$i] ";
                }
            }
        } else {
            $order_specification = " code asc ";
        }

        $query .= " order by $order_specification ";

        echo $this->model_finishing->get($page, $rows, $query);
    }

    function get_remote_data() {
        $q = $this->input->post('q');
        $query = "select * from finishing where true ";
        if (!empty($q)) {
            $query .= " and code ilike '%$q%' or description ilike '%$q%'";
        }
        echo $this->model_finishing->get_remote_data($query);
    }

    function save() {
        $code = $this->input->post('code');
        $description = $this->input->post('description');

        $data = array(
            "code" => $code,
            "description" => $description
        );

        if ($this->model_finishing->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($code) {
        $newcode = $this->input->post('code');
        $description = $this->input->post('description');

        $data = array(
            "code" => $newcode,
            "description" => $description
        );

        if ($this->model_finishing->update($data, array("code" => $code))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {
        $code = $this->input->post('code');
        if ($this->model_finishing->delete(array("code" => $code))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

}
