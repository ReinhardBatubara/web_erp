<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class model_materialtrash extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get($query) {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();

        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
        }

        $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
        return json_encode($result);
    }

    function insert($data) {
        return $this->db->insert('materialtrash', $data);
    }

    function update($data, $where) {
        return $this->db->update('materialtrash', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('materialtrash', $where);
    }

}

?>
