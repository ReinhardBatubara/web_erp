<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_costingmaterial
 *
 * @author user
 */
class model_costingmaterial extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function insert($data) {
        return $this->db->insert('costingmaterial', $data);
    }

    function update_batch($data, $index) {
        return $this->db->update_batch('costingmaterial', $data, $index);
    }

    function detail_save_load_price($id) {
        $query = "select costingmaterial_update_sell_price($id)";
        //echo $query;      
        return $this->db->query($query);
    }

    function update($data, $where) {
        return $this->db->update('costingmaterial', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('costingmaterial', $where);
    }

}
