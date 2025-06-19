<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_joborderoutsource
 *
 * @author user
 */
class model_joborderoutsource extends CI_Model {

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
        //echo $query;
        return $data;
    }

    function insert($data) {
        return $this->db->insert('joborderoutsource', $data);
    }

    function update($data, $where) {
        return $this->db->update('joborderoutsource', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('joborderoutsource', $where);
    }

    function select_vendor_by_joborder_item_id($jo_item_id) {
        $query = "
            select jo_otsc.*,v.name vendor_name  
            from joborderoutsource jo_otsc
            join vendor v on jo_otsc.vendorid=v.id
            where jo_otsc.joborderitemid=$jo_item_id 
        ";
        return $this->db->query($query)->result();
    }

}

?>
