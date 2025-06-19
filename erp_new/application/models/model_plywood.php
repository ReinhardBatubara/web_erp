<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_packaging
 *
 * @author hp
 */
class model_plywood extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get($query) {
        $result = array();
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row_data = array(
                'id' => $data->id,
                'modelid' => $data->modelid,
                'code' => $data->code,
                'itemid' => $data->itemid,
                'materialdescription' => $data->materialdescription,
                'description' => $data->description,
                'size_l' => $data->size_l,
                'size_w' => $data->size_w,
                'size_t' => $data->size_t,
                'qty' => $data->qty,
                'total_qty' => $data->total_qty,
                'volume' => $data->volume,
                'unitcode' => $data->unitcode,
                'remark' => $data->remark,
                'parentid' => $data->parentid
            );
            if ($data->parentid != 0) {
                $row_data["_parentId"] = $data->parentid;
            }
            $row[] = $row_data;
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function insert($data) {
        return $this->db->insert('plywood', $data);
    }

    function update($data, $where) {
        return $this->db->update('plywood', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('plywood', $where);
    }

    function select_by_model_id($modelid) {
        $query = "select * from plywood_get_by_modelid($modelid)";
        return $this->db->query($query)->result();
    }

}
