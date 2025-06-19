<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_quotation
 *
 * @author hp
 */
class model_quotation extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
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
//            echo $query;
//            exit;
            $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

    function select_all() {
        return $this->db->get('quotation')->result();
    }

    function select_by_id($id) {
        $query = "select * from quotation where id=$id";
//        echo $query;
        return $this->db->query($query)->row();
    }

    function select_detail_by_quotation_id($quotationid) {
        $query = "
            select t.*,t.modelcode item_code,t.modelname item_name 
            from quotation_get_detail_by_quotation_id($quotationid) t
        ";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function insert($data) {
        return $this->db->insert('quotation', $data);
    }

    function update($data, $where) {
        return $this->db->update('quotation', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('quotation', $where);
    }

    function detail_insert($data) {
        return $this->db->insert('quotationdetail', $data);
    }

    function detail_update($data, $where) {
        return $this->db->update('quotationdetail', $data, $where);
    }

    function detail_delete($where) {
        return $this->db->delete('quotationdetail', $where);
    }

}

?>
