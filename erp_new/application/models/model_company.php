<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_company
 *
 * @author hp
 */
class model_company extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    function select(){
        return $this->db->get('company')->row();
    }
    
    function get_address(){
        $dt = $this->db->get('company')->row();
        return $dt->address;
    }
}
