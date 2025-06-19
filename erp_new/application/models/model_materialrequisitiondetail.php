<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_materialrequisitiondetail
 *
 * @author hp
 */
class model_materialrequisitiondetail extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get($query) {
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();

        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $query .= " limit $rows offset $offset";
        }
        //echo $query;
        $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
        return json_encode($result);
    }

    function insert($data) {
        return $this->db->insert("materialrequisitiondetail", $data);
    }

    function insert_batch($data) {
        return $this->db->insert_batch("materialrequisitiondetail", $data);
    }

    function update($data, $where) {
        return $this->db->update("materialrequisitiondetail", $data, $where);
    }

    function update_batch($data, $ndex) {
        return $this->db->update_batch("materialrequisitiondetail", $data, $ndex);
    }

    function delete($where) {
        return $this->db->delete("materialrequisitiondetail", $where);
    }

}
