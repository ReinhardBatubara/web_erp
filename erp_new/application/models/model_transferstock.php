<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_transferstock
 *
 * @author user
 */
class model_transferstock extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function select_by_id($id) {
        $query = "select 
        transferstock.*,
        to_char(transferstock.date,'DD-MM-YYYY') date_f,
        warehouse.code warehouse_from,
        (select code from warehouse where id=transferstock.towarehouseid) warehouse_to,
        (employee.name || '(' || transferstock.deliveredby || ')') delivered_by,
        (select employee.name from employee where id=transferstock.receivedby) received_by
        from transferstock 
        join warehouse on transferstock.fromwarehouseid=warehouse.id
        left join employee on transferstock.deliveredby=employee.id where transferstock.id=$id ";
        return $this->db->query($query)->row();
    }

    function select_item_by_transfer_id($transferstockid) {
        $query = "
            select 
            transferstockdetail.*,
            transferstock.fromwarehouseid,
            transferstock.towarehouseid,
            item.code itemcode,
            item.description itemdescription  
            from transferstockdetail 
            join transferstock on transferstockdetail.transferstockid=transferstock.id
            join item on transferstockdetail.itemid=item.id
            where transferstockdetail.transferstockid=$transferstockid        
        ";
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

    function select_all_result() {
        return $this->db->get('transferstock')->result();
    }

    function insert($data) {
        return $this->db->insert('transferstock', $data);
    }

    function update($data, $where) {
        return $this->db->update('transferstock', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('transferstock', $where);
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
        return $this->db->get('transferstockdetail')->result();
    }

    function detail_insert($data) {
        return $this->db->insert('transferstockdetail', $data);
    }

    function detail_update($data, $where) {
        return $this->db->update('transferstockdetail', $data, $where);
    }

    function detail_delete($where) {
        return $this->db->delete('transferstockdetail', $where);
    }

}

?>
