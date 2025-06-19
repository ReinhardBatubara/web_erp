<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_employee
 *
 * @author hp
 */
class model_employee extends CI_Model {

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

    function get_remote_data($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'name' => $data->name,
                'department' => $data->department,
                'departmentid' => $data->departmentid,
                'position' => $data->position
            );
        }
        return json_encode($row);
    }

    function insert($data) {
        return $this->db->insert('employee', $data);
    }

    function update($data, $where) {
        return $this->db->update('employee', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('employee', $where);
    }

}
