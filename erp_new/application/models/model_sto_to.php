<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_sto_to
 *
 * @author user
 */
class model_sto_to extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get($query) {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

    function selectAllResult() {
        return $this->db->get('sto_to')->result();
    }

    function insert($data) {
        return $this->db->insert('sto_to', $data);
    }

    function update($data, $where) {
        return $this->db->update('sto_to', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('sto_to', $where);
    }

    function detail_get($query) {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

    function detail_select_all_result() {
        return $this->db->get('sto_to_detail')->result();
    }

    function detail_insert($data) {
        return $this->db->insert('sto_to_detail', $data);
    }

    function detail_update($data, $where) {
        return $this->db->update('sto_to_detail', $data, $where);
    }

    function detail_delete($where) {
        return $this->db->delete('sto_to_detail', $where);
    }

}

?>
