<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_modelfinishingseen
 *
 * @author hp
 */
class model_modelfinishingseen extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_by_model_id($modelid) {
        
       $query = "
            select 
            modelfinishingseen.*,
            finishingtype.name finishing_type_name 
            from modelfinishingseen 
            left join finishingtype on modelfinishingseen.finishingtypeid=finishingtype.id
            where modelfinishingseen.modelid=$modelid order by id desc
        ";
        return $this->db->query($query)->result();
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

    function insert($data) {
        return $this->db->insert('modelfinishingseen', $data);
    }

    function update($data, $where) {
        return $this->db->update('modelfinishingseen', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('modelfinishingseen', $where);
    }

}
