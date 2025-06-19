<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_hardware
 *
 * @author hp
 */
class model_hardware extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function select_by_model_id($modelid) {
        $query = "select 
                hardware.*,
                item.code itemcode,
                item.description itemdescription 
                from hardware left join item on hardware.itemid=item.id 
                where modelid=$modelid order by hardware.id asc";
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
                'volume' => number_format($data->volume, 4, '.', ''),
                'remark' => $data->remark,
                'unitcode' => $data->unitcode,
                'total_qty' => $data->total_qty
            );
            $row[] = $row_data;
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function insert($data) {
        return $this->db->insert('hardware', $data);
    }

    function update($data, $where) {
        return $this->db->update('hardware', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('hardware', $where);
    }

}
