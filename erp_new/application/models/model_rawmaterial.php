<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_rawmaterial
 *
 * @author user
 */
class model_rawmaterial extends CI_Model {

    //put your code here
    function get($query) {
        $row = array();
        $json = "";
        $criteria = $this->db->query($query)->result();
        $total_qty = 0;
        $total_m2 = 0;
        $total_kg = 0;
        foreach ($criteria as $data) {
            $row[] = $data;
            $total_qty += $data->qty;
            $total_m2 += $data->m2;
            $total_kg += $data->kg;
        }
        $footer = array(
            array(
                'panjang' => 'TOTAL',
                'qty' => $total_qty,
                'm2' => $total_m2,
                'kg' => $total_kg
            )
        );
        $json = json_encode(array_merge(array('rows' => $row, 'footer' => $footer)));
        return $json;
    }

    function select_by_costingid_rawcategoryid_rawtypeid($costingid, $rawcategoryid, $rawtypeid) {
        $query = "
            select * from rawmaterial where 
            costingid=$costingid and 
            rawcategoryid=$rawcategoryid and 
            rawtypeid=$rawtypeid order by id asc
        ";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function selectAllResult() {
        return $this->db->get('rawmaterial')->result();
    }

    function insert($data) {
        return $this->db->insert('rawmaterial', $data);
    }

    function update($data, $where) {
        return $this->db->update('rawmaterial', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('rawmaterial', $where);
    }

    function get_total_luas($costingid, $categoryid) {
        $query = "select COALESCE(sum(m2),0) m2 from rawmaterial where costingid=$costingid and rawcategoryid=$categoryid";
        $dt = $this->db->query($query)->row();
        return $dt->m2;
    }

    function get_total_kg($costingid, $categoryid) {
        $query = "select COALESCE(sum(kg),0) kg from rawmaterial where costingid=$costingid and rawcategoryid=$categoryid";
        $dt = $this->db->query($query)->row();
        return $dt->kg;
    }

}

?>
