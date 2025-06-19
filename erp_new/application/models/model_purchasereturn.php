<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_purchasereturn
 *
 * @author user
 */
class model_purchasereturn extends CI_Model {

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
            $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
            $data = json_encode($result);
        } else {
            $data = json_encode($this->db->query($query)->result());
        }
        return $data;
    }

    function select_by_id($id) {
        $query = "
            select 
        purchasereturn.*,
        vendor.name vendor_name,
        vendor.code vendor_code
        from purchasereturn
        join vendor on purchasereturn.vendorid=vendor.id
        where purchasereturn.id=$id 
        ";
        return $this->db->query($query)->row();
    }

    function detail_select_by_purchase_return_id($purchasereturnid) {
        $query = "
            select 
            purchasereturndetail.*, 
            item.code itemcode,
            item.description itemdescription,
            purchasereturndetail.unitcode,
            warehouse.name warehouse_name
            from purchasereturndetail
            join item on purchasereturndetail.itemid=item.id
            join warehouse on purchasereturndetail.warehouseid=warehouse.id 
            where purchasereturndetail.purchasereturnid=$purchasereturnid";
        return $this->db->query($query)->result();
    }

    function select_all_result() {
        return $this->db->get('purchasereturn')->result();
    }

    function insert($data) {
        return $this->db->insert('purchasereturn', $data);
    }

    function update($data, $where) {
        return $this->db->update('purchasereturn', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('purchasereturn', $where);
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
        return $this->db->get('purchasereturndetail')->result();
    }

    function detail_insert($data) {
        return $this->db->insert('purchasereturndetail', $data);
    }

    function detail_update($data, $where) {
        return $this->db->update('purchasereturndetail', $data, $where);
    }

    function detail_delete($where) {
        return $this->db->delete('purchasereturndetail', $where);
    }

}

?>
