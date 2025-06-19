<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_modeldataillayout
 *
 * @author user
 */
class model_modeldataillayout extends CI_Model {

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
        $row = array();
        $query .= " limit $rows offset $offset";
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row_data = array(
                'id' => $data->id,
                'modelid' => $data->modelid,
                'title' => $data->title,
                'imagename' => $data->imagename,
            );
            $row[] = $row_data;
        }

        $j_result = array_merge($result, array('rows' => $row));
        return json_encode($j_result);
    }

    function insert($data) {
        return $this->db->insert("modeldataillayout", $data);
    }

    function update($data, $where) {
        return $this->db->update("modeldataillayout", $data, $where);
    }

    function delete($where) {
        return $this->db->delete("modeldataillayout", $where);
    }

}
