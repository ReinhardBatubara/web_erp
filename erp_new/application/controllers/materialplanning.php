<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of materialplanning
 *
 * @author user
 */
class materialplanning extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('materialplanning/view');
    }


}

?>
