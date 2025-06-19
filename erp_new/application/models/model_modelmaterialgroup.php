<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_modelmaterialgroup
 *
 * @author user
 */
class model_modelmaterialgroup extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get_material_group_for_combo($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'name' => $data->name
            );
        }
        return json_encode($row);
    }

}
