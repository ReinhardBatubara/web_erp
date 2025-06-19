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
class model_packaging extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_by_model_id($modelid) {
        $query = "select 
                packaging.*,
                item.code itemcode,
                item.description itemdescription 
                from packaging left join item on packaging.itemid=item.id 
                where packaging.modelid=$modelid order by packaging.id asc";
        return $this->db->query($query)->result();
    }

    function get($query) {
//        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $row = array();
//        $query .= " limit $rows offset $offset";
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
                'volume_m2' => number_format($data->volume_m2, 4, '.', ''),
                'volume_m3' => number_format($data->volume_m3, 4, '.', ''),
                'remark' => $data->remark,
                'unitcode' => $data->unitcode,
                'total_qty' => $data->total_qty,
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
        return $this->db->insert('packaging', $data);
    }

    function update($data, $where) {
        return $this->db->update('packaging', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('packaging', $where);
    }

}
