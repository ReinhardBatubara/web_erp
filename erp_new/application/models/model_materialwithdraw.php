<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_materialwithdraw
 *
 * @author hp
 */
class model_materialwithdraw extends CI_Model {

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
        $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
        return json_encode($result);
    }

    function get_available_warehouse($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'number' => $data->number,
                'date_modify' => date('d-m-Y', strtotime($data->date)),
                'departmentid' => $data->departmentid,
                'department' => $data->department,
                'employeerequest'=>$data->employeerequest
            );
        }
        return json_encode($row);
    }

    function insert($data) {
        return $this->db->insert('materialwithdraw', $data);
    }

    function update($data, $where) {
        return $this->db->update('materialwithdraw', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('materialwithdraw', $where);
    }

}
