<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_mirror
 *
 * @author hp
 */
class model_mirror extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_by_model_id($modelid) {
        $query = "select 
                mirror.*,
                item.code itemcode,
                item.description itemdescription 
                from mirror left join item on mirror.itemid=item.id 
                where modelid=$modelid order by mirror.id asc";
        return $this->db->query($query)->result();
    }

    function get($page, $rows, $query) {
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
                'code' => $data->code,
                'itemid' => $data->itemid,
                'materialdescription' => $data->materialdescription,
                'description' => $data->description,
                'size_l' => $data->size_l,
                'size_w' => $data->size_w,
                'size_t' => $data->size_t,
                'qty' => $data->qty,
                'total_qty' => $data->total_qty,
                'unitcode' => $data->unitcode,
                'remark' => $data->remark,
                'volume' => $data->volume
            );
            $row[] = $row_data;
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function insert($data) {
        return $this->db->insert('mirror', $data);
    }

    function update($data, $where) {
        return $this->db->update('mirror', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('mirror', $where);
    }

}
