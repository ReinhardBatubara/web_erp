<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_goodsreceive
 *
 * @author hp
 */
class model_goodsreceive extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_by_id($id) {

        $query = "
            select 
            gr.*,
            v.name vendor,
            e.name received,
            emp.name checked
            from 
            goodsreceive gr 
            join vendor v on gr.vendorid=v.id 
            left join employee e on gr.received_by=e.id 
            left join employee emp on gr.checked_by=emp.id 
            where gr.id=" . $id;
        //echo $query;
        return $this->db->query($query)->row();
    }

    function get($query) {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $result = array();
        $data = "";
        if (!empty($page) && !empty($rows)) {
            $offset = ($page - 1) * $rows;
            $result['total'] = $this->db->query($query)->num_rows();
            $query .= " limit $rows offset $offset";
            $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

    function get_next_id() {
        $query = "select nextval('goodsreceive_id_seq') id";
        return $this->db->query($query)->row()->id;
    }

    function insert($data) {
        return $this->db->insert('goodsreceive', $data);
    }

    function update($data, $where) {
        return $this->db->update('goodsreceive', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('goodsreceive', $where);
    }

}
