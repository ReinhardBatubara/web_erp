<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_purchaserequestattachment
 *
 * @author hp
 */
class model_purchaserequestattachment extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function insert($data) {
        return $this->db->insert('purchaserequestattachment', $data);
    }

    function get($purchaserequestid) {
        $this->db->where("purchaserequestid", $purchaserequestid);
        $this->db->order_by("id", "desc");
        return $this->db->get_where('purchaserequestattachment')->result();
    }

    function delete($where) {
        return $this->db->delete('purchaserequestattachment', $where);
    }

}
