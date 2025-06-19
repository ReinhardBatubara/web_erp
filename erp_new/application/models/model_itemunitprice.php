<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_itemunitprice
 *
 * @author hp
 */
class model_itemunitprice extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get($query) {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $query .= " limit $rows offset $offset";
        $criteria = $this->db->query($query)->result();
        $result = array_merge($result, array('rows' => $criteria));
        return json_encode($result);
    }

    function get_remote_unit($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->unitcode,
                'text' => $data->unitcode
            );
        }
        return json_encode($row);
    }

    function insert($data) {
        return $this->db->insert('itemunitprice', $data);
    }

    function delete($where) {
        return $this->db->delete('itemunitprice', $where);
    }

}
