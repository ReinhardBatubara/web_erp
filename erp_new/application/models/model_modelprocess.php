<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_modelprocess
 *
 * @author user
 */
class model_modelprocess extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get($query) {
        $rows = $this->input->post('rows');
        $page = $this->input->post('page');
        $result = array();

        if (!empty($rows) && !empty($page)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
        }
        $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
        return json_encode($result);
    }

    function get_for_combo($query) {
        return json_encode($this->db->query($query)->result());
    }

    function insert($data) {
        return $this->db->insert('modelprocess', $data);
    }

    function delete($where) {
        return $this->db->delete('modelprocess', $where);
    }

    function update($data, $where) {
        return $this->db->update('modelprocess', $data, $where);
    }

    //Stock Out

    function insert_stock_out($data) {
        return $this->db->insert('modelprocessstockout', $data);
    }

    function update_stock_out($data, $where) {
        return $this->db->update('modelprocessstockout', $data, $where);
    }

    function delete_stock_out($where) {
        return $this->db->delete('modelprocessstockout', $where);
    }

}
