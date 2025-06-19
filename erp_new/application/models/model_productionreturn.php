<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_productionreturn
 *
 * @author user
 */
class model_productionreturn extends CI_Model {

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
            select productionreturn.*,employee.name name_return_by,e.name name_receive_by
            from productionreturn
            join employee on productionreturn.returnby=employee.id
            left join employee e on productionreturn.returnby=e.id where productionreturn.id=$id 
        ";
        return $this->db->query($query)->row();
    }

    function select_all_result() {
        return $this->db->get('productionreturn')->result();
    }

    function insert($data) {
        return $this->db->insert('productionreturn', $data);
    }

    function update($data, $where) {
        return $this->db->update('productionreturn', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('productionreturn', $where);
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

    function detail_select_by_production_return_id($productionreturnid) {
        $query = "
            select productionreturndetail.*,item.code itemcode,item.description itemdescription  
            from productionreturndetail 
            join item on productionreturndetail.itemid=item.id where productionreturndetail.productionreturnid=$productionreturnid 
        ";
        return $this->db->query($query)->result();
    }

    function detail_select_all_result() {
        return $this->db->get('productionreturndetail')->result();
    }

    function detail_insert($data) {
        return $this->db->insert('productionreturndetail', $data);
    }

    function detail_update($data, $where) {
        return $this->db->update('productionreturndetail', $data, $where);
    }

    function detail_delete($where) {
        return $this->db->delete('productionreturndetail', $where);
    }

}

?>
