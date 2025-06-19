<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_carvingpricelist
 *
 * @author user
 */
class model_carvingpricelist extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get($query) {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $row = array();
        $query .= " limit $rows offset $offset";
        $criteria = $this->db->query($query)->result();

        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'modelid' => $data->modelid,
                'price' => $data->price,
                'code' => $data->code,
                'originalcode' => $data->originalcode,
                'name' => $data->name,
                'itemsize_mm_w' => $data->itemsize_mm_w,
                'itemsize_mm_h' => $data->itemsize_mm_h,
                'itemsize_mm_d' => $data->itemsize_mm_d,
                'name_approved_by' => $data->name_approved_by,
                'date_approve' => $data->date_approve,
                'remark' => $data->remark,
                'image_location' => "<center><img src='files/model/" . $data->imagename . "' style='max-width:50px;max-height:50px;padding:2px;border:none;'></center>"
            );
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function selectAllResult() {
        return $this->db->get('carvingpricelist')->result();
    }

    function insert($data) {
        return $this->db->insert('carvingpricelist', $data);
    }

    function update($data, $where) {
        return $this->db->update('carvingpricelist', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('carvingpricelist', $where);
    }

}

?>
