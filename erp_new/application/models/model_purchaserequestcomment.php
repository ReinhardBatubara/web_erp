<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_purchaserequestcomment
 *
 * @author hp
 */
class model_purchaserequestcomment extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function get_comment($purchaserequestid) {
        $query = "select 
                purchaserequestcomment.*,
                employee.name employee
                from purchaserequestcomment 
                join employee on purchaserequestcomment.employeeid=employee.id
                where purchaserequestid=$purchaserequestid";
        return $this->db->query($query)->result();
    }

    function insert($data) {
        return $this->db->insert('purchaserequestcomment', $data);
    }

    function delete($where) {
        return $this->db->delete('purchaserequestcomment', $where);
    }

}
