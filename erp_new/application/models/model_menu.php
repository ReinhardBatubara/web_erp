<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class model_menu extends CI_Model {

    //put your code here
    public function __construct() {
        $this->load->database();
        parent::__construct();
    }

    function selectAll() {
        $this->db->order_by('level', 'asc');
        return $this->db->get('menu')->result();
    }

}
