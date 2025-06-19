<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_bankaccount
 *
 * @author hp
 */
class model_bankaccount extends CI_Model {

    //put your code here
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
        return $this->db->get('bankaccount')->result();
    }

    function insert($data) {
        return $this->db->insert('bankaccount', $data);
    }

    function update($data, $where) {
        return $this->db->update('bankaccount', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('bankaccount', $where);
    }

}

?>
