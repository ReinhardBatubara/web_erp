<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_solidwood
 *
 * @author hp
 */
class model_solidwood extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get($query) {
        //$offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $row = array();
        //$query .= " limit $rows offset $offset";
        //echo $query;
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row_data = array(
                'id' => $data->id,
                'modelid' => $data->modelid,
                'parentid' => $data->parentid,
                'code' => $data->code,
                'itemid' => $data->itemid,
                'unitcode' => $data->unitcode,
                'materialdescription' => $data->materialdescription,
                'description' => $data->description,
                'finishedsize_l' => $data->finishedsize_l,
                'finishedsize_w' => $data->finishedsize_w,
                'finishedsize_t' => $data->finishedsize_t,
                'qty' => $data->qty,
                'rawsize_l' => $data->rawsize_l,
                'rawsize_w' => $data->rawsize_w,
                'rawsize_t' => $data->rawsize_t,
                'vol_finished' => $data->vol_finished,
                'vol_raw' => $data->vol_raw,
                'remark' => $data->remark
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
        return $this->db->insert('solidwood', $data);
    }

    function update($data, $where) {
        return $this->db->update('solidwood', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('solidwood', $where);
    }

    function select_by_model_id($modelid) {
        $query = "select * from solidwood_get_by_modelid($modelid) ";
        return $this->db->query($query)->result();
    }

}
