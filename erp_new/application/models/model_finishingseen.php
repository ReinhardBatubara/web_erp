<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_finishingseen
 *
 * @author hp
 */
class model_finishingseen extends CI_Model {

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
                'comment' => $data->comment,
                'area' => $data->area,
                'size_l' => $data->size_l,
                'size_w' => $data->size_w,
                'qty' => $data->qty,
                'volume' => number_format($data->volume, 4, '.', ''),
                'unitcode'=>$data->unitcode
            );
            $row[] = $row_data;
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function insert($data) {
        return $this->db->insert('finishingseen', $data);
    }

    function update($data, $where) {
        return $this->db->update('finishingseen', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('finishingseen', $where);
    }

}
