<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_stock_in
 *
 * @author user
 */
class model_stock_in extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function select_by_id($id) {
        $query = "
            select 
            stock_in.*,
            vendor.name vendor,
            employee.name employee_receive
            from stock_in 
            left join vendor on stock_in.vendorid=vendor.id 
            left join employee on stock_in.receiveby=employee.id
            where stock_in.id=$id
        ";
        return $this->db->query($query)->row();
    }

    function select_detail_by_stock_in_id($stock_in_id) {
        $query = "select 
            stock_in_detail.*,
            item.code itemcode,
            item.description itemdescription  
            from stock_in_detail join item
            on stock_in_detail.itemid=item.id where stock_in_detail.stock_in_id=$stock_in_id
            order by stock_in_detail.id desc ";

        return $this->db->query($query)->result();
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

    function selectAllResult() {
        return $this->db->get('stock_in')->result();
    }

    function insert($data) {
        return $this->db->insert('stock_in', $data);
    }

    function update($data, $where) {
        return $this->db->update('stock_in', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('stock_in', $where);
    }

    function detail_get($query) {
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

    function detail_select_all_result() {
        return $this->db->get('stock_in_detail')->result();
    }

    function detail_insert($data) {
        return $this->db->insert('stock_in_detail', $data);
    }

    function detail_update($data, $where) {
        return $this->db->update('stock_in_detail', $data, $where);
    }

    function detail_delete($where) {
        return $this->db->delete('stock_in_detail', $where);
    }

}

?>
