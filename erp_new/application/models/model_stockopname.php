<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_stockopname
 *
 * @author operational
 */
class model_stockopname extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get($type = "") {

        $query = "
            select son.*,wh.name warehouse_name 
            from stockopname son
            join warehouse wh on son.warehouseid=wh.id 
            where true
            ";
        $stockopnameid = $this->input->post("stockopnameid");
        if (!empty($stockopnameid)) {
            $query .= " and son.id=$stockopnameid";
        }

        $stockopname_no = $this->input->post("stockopname_no");
        if (!empty($stockopname_no)) {
            $query .= " and son.stockopname_no ilike '%$stockopname_no%'";
        }
        $datefrom = $this->input->post("datefrom");
        $dateto = $this->input->post("dateto");
        if (!empty($datefrom) && !empty($dateto)) {
            $query .= " and son.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if (!empty($datefrom) && empty($dateto)) {
            $query .= " and son.date = '" . $datefrom . "'";
        }if (empty($datefrom) && !empty($dateto)) {
            $query .= " and son.date = '" . $dateto . "'";
        }

        $posting_datefrom = $this->input->post("posting_datefrom");
        $posting_dateto = $this->input->post("posting_dateto");
        if (!empty($posting_datefrom) && !empty($posting_dateto)) {
            $query .= " and son.posting_time between '" . $datefrom . "' and '" . $posting_dateto . "'";
        }if (!empty($posting_datefrom) && empty($posting_dateto)) {
            $query .= " and son.posting_time = '" . $posting_datefrom . "'";
        }if (empty($posting_datefrom) && !empty($posting_dateto)) {
            $query .= " and son.posting_time = '" . $posting_dateto . "'";
        }

        $warehouseid = $this->input->post("warehouseid");
        if (!empty($warehouseid)) {
            $query .= " and son.warehouseid=$warehouseid";
        }

        $query .= " order by son.id desc ";

//        echo $query;
        $data = null;
        if ($type == "result") {
            $num_rows = $this->db->query($query)->num_rows();
            if ($num_rows > 1) {
                $data = $this->db->query($query)->result();
            } else {
                $data = $this->db->query($query)->row();
            }
        } else {
            $page = $this->input->post('page');
            $rows = $this->input->post('rows');
            $result = array();
            if (!empty($page) && !empty($rows)) {
                $offset = ($page - 1) * $rows;
                $result['total'] = $this->db->query($query)->num_rows();
                $query .= " limit $rows offset $offset";
                $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
                $data = json_encode($result);
            } else {
                $data = json_encode($this->db->query($query)->result());
            }
        }
        return $data;
    }

    function selectAllResult() {
        return $this->db->get('stockopname')->result();
    }

    function insert($data) {
        return $this->db->insert('stockopname', $data);
    }

    function update($data, $where) {
        return $this->db->update('stockopname', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('stockopname', $where);
    }

    function posting($id) {
        return $this->db->query("select stockopname_posting($id)");
    }

    function detail_get($type = "") {

        $stockopnameid = $this->input->post("stockopnameid");
        if (empty($stockopnameid)) {
            $stockopnameid = 0;
        }

        $query = "
            select sond.*,son.warehouseid,i.code item_code,i.description item_description,ig.code item_group_code
            from stockopnamedetail sond
            join item i on sond.itemid=i.id
            join itemgroup ig on i.groupid=ig.id
            join stockopname son on sond.stockopnameid=son.id
            where sond.stockopnameid=$stockopnameid
            ";
        
        $q = $this->input->post("q");
        if(!empty($q)){
            $query .= " and (i.code ilike '%$q%' or i.description ilike '%$q%' or ig.code ilike '%$q%')";
        }
        
        $query .= " order by sond.id desc ";

        //echo $query;

        $data = null;
        if ($type == "result") {
                $data = $this->db->query($query)->result();
        } else {
            $page = $this->input->post('page');
            $rows = $this->input->post('rows');
            $result = array();
            if (!empty($page) && !empty($rows)) {
                $offset = ($page - 1) * $rows;
                $result['total'] = $this->db->query($query)->num_rows();
                $query .= " limit $rows offset $offset";
                $result = array_merge($result, array('rows' => $this->db->query($query)->result()));
                $data = json_encode($result);
            } else {
                $data = json_encode($this->db->query($query)->result());
            }
        }
        return $data;
    }

    function detail_insert($data) {
        return $this->db->insert('stockopnamedetail', $data);
    }

    function detail_update($data, $where) {
        return $this->db->update('stockopnamedetail', $data, $where);
    }

    function detail_delete($where) {
        return $this->db->delete('stockopnamedetail', $where);
    }

}
