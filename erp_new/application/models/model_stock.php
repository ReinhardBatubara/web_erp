<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_stock
 *
 * @author hp
 */
class model_stock extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get($page, $rows, $query) {
        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $row = array();
        $query .= " limit $rows offset $offset";
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'code' => $data->code,
                'name' => $data->name,
                'description' => $data->description
            );
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function get_by_item($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'warehouseid' => $data->warehouseid,
                'warehousename' => $data->warehousename,
                'unitcode' => $data->unitcode,
                'qty' => $data->stock
            );
        }
        return json_encode($row);
    }

    function selectAllResult() {
        return $this->db->get('stock')->result();
    }

    function insert($data) {
        return $this->db->insert('stock', $data);
    }

    function insert_batch($data) {
        return $this->db->insert_batch('stock', $data);
    }

    function update($data, $where) {
        return $this->db->update('stock', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('stock', $where);
    }

}

?>
