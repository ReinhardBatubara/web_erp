<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_modeladditionalmaterial
 *
 * @author user
 */
class model_modeladditionalmaterial extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function select_by_model_id($modelid) {
        $query = "select 
                modeladditionalmaterial.*,
                item.code itemcode,
                item.description itemdescription 
                from modeladditionalmaterial left join item on modeladditionalmaterial.itemid=item.id 
                where modeladditionalmaterial.modelid=$modelid order by modeladditionalmaterial.id asc";
        return $this->db->query($query)->result();
    }

    function get($query) {
        $rows = $this->input->post('rows');
        $page = $this->input->post('page');

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
                'qty' => $data->qty,
                'unitcode' => $data->unitcode
            );
            $row[] = $row_data;
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function insert($data) {
        return $this->db->insert('modeladditionalmaterial', $data);
    }

    function update($data, $where) {
        return $this->db->update('modeladditionalmaterial', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('modeladditionalmaterial', $where);
    }

}
