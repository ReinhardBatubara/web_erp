<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_shipvia
 *
 * @author hp
 */
class model_shipvia extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function selectAllResult() {
        return $this->db->get('shipvia')->result();
    }

}
