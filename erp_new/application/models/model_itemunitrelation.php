<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_itemunitrelation
 *
 * @author hp
 */
class model_itemunitrelation extends CI_Model {

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
                'itemid' => $data->itemid,
                'unitfrom' => $data->unitfrom,
                'unitto' => $data->unitto,
                'value' => $data->value
            );
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function insert($data) {
        return $this->db->insert('itemunitrelation', $data);
    }

    function not_exist($itemid, $unitcode) {
        $query = "select 
                count(*) ct from 
                itemunitrelation 
                where itemid=$itemid and (unitfrom='$unitcode' or unitto ='$unitcode')";
        $dt = $this->db->query($query)->row();
        return ($dt->ct == 0);
    }

    function is_valid($itemid, $unitfrom, $unitto) {
        $query = "select 
                count(*) ct from 
                itemunitrelation 
                where itemid=$itemid and
                ((unitfrom='$unitfrom' and unitto='$unitto') or (unitfrom='$unitto' and unitto='$unitfrom'))";
        $dt = $this->db->query($query)->row();
        return ($dt->ct == 0);
    }

    function delete($where) {
        return $this->db->delete('itemunitrelation', $where);
    }

}
