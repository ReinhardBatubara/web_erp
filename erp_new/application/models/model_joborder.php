<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_joborder
 *
 * @author user
 */
class model_joborder extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_by_id($id) {
        return $this->db->get_where('joborder', array('id' => $id))->row();
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

    function insert($data) {
        return $this->db->insert('joborder', $data);
    }

    function update($data, $where) {
        return $this->db->update('joborder', $data, $where);
    }

    function generate_barcode($id) {
        return $this->db->query("select job_order_generate_barcode($id)");
    }

    function select_serial_item_query($query) {
        return $this->db->query($query)->result();
    }

    function delete($where) {
        return $this->db->delete('joborder', $where);
    }

    function generate_mrp($id) {
        return $this->db->query("select joborder_generate_mrp($id)");
    }

    function update_batch($data, $index) {
        return $this->db->update_batch('mrp', $data, $index);
    }

    function material_to_outsource_insert($data) {
        return $this->db->insert('joborderitemtooutsource', $data);
    }

    function material_to_outsource_update($data, $where) {
        return $this->db->update('joborderitemtooutsource', $data, $where);
    }

    function material_to_outsource_delete($where) {
        return $this->db->delete('joborderitemtooutsource', $where);
    }

    function update_joborderitembarcode($data, $where) {
        return $this->db->update('joborderitembarcode', $data, $where);
    }

    function joborderitemprocess_is_complete_reference($jobordeid) {
        $query = "select joborderitemprocess_is_complete_reference($jobordeid) as ct";
        $dt = $this->db->query($query)->row();
        return $dt->ct;
    }

    function bar128($text) {      // Part 1, make list of widths
        $char128asc = ' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
        $char128wid = array(
            '212222', '222122', '222221', '121223', '121322', '131222', '122213', '122312', '132212', '221213', // 0-9 
            '221312', '231212', '112232', '122132', '122231', '113222', '123122', '123221', '223211', '221132', // 10-19 
            '221231', '213212', '223112', '312131', '311222', '321122', '321221', '312212', '322112', '322211', // 20-29 			
            '212123', '212321', '232121', '111323', '131123', '131321', '112313', '132113', '132311', '211313', // 30-39 
            '231113', '231311', '112133', '112331', '132131', '113123', '113321', '133121', '313121', '211331', // 40-49 
            '231131', '213113', '213311', '213131', '311123', '311321', '331121', '312113', '312311', '332111', // 50-59 
            '314111', '221411', '431111', '111224', '111422', '121124', '121421', '141122', '141221', '112214', // 60-69 
            '112412', '122114', '122411', '142112', '142211', '241211', '221114', '413111', '241112', '134111', // 70-79 
            '111242', '121142', '121241', '114212', '124112', '124211', '411212', '421112', '421211', '212141', // 80-89 
            '214121', '412121', '111143', '111341', '131141', '114113', '114311', '411113', '411311', '113141', // 90-99
            '114131', '311141', '411131', '211412', '211214', '211232', '23311120');
        $w = $char128wid[$sum = 104];       // START symbol
        $onChar = 1;
        for ($x = 0; $x < strlen($text); $x++) {        // GO THRU TEXT GET LETTERS
            if (!( ($pos = strpos($char128asc, $text[$x])) === false )) { // SKIP NOT FOUND CHARS
                $w.= $char128wid[$pos];
                $sum += $onChar++ * $pos;
            }
        }
        $w.= $char128wid[$sum % 103] . $char128wid[106];    //Check Code, then END
        //Part 2, Write rows
        $html = "<table cellpadding=0 cellspacing=0><tr>";
        for ($x = 0; $x < strlen($w); $x+=2) {         // code 128 widths: black border, then white space
            $html .= "<td><div class=\"b128\" style=\"border-left-width:{$w[$x]};width:{$w[$x + 1]}\"></div>";
        }
        return "$html </td></tr></table>";
    }

}
