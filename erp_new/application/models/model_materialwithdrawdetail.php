<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_materialwithdrawdetail
 *
 * @author hp
 */
class model_materialwithdrawdetail extends CI_Model {

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

    function get_option($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'itemid' => $data->itemid,
                'itemcode' => $data->itemcode,
                'itemdescription' => $data->itemdescription,
                'unitcode' => $data->unitcode,
                'qty' => $data->qty,
                'qty_ots' => $data->qty_ots,
                'warehouseid' => ''
            );
        }
        return json_encode($row);
    }

    function insert($data) {
        return $this->db->insert("materialwithdrawdetail", $data);
    }

    function insert_batch($data) {
        return $this->db->insert_batch("materialwithdrawdetail", $data);
    }

    function update($data, $where) {
        return $this->db->update("materialwithdrawdetail", $data, $where);
    }

    function delete($where) {
        return $this->db->delete("materialwithdrawdetail", $where);
    }

}
