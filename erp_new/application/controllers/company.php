<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of company
 *
 * @author hp
 */
class company extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_company');
    }

    function select() {
        
    }

    function get_address() {
        echo $this->model_company->get_address();
    }

}
