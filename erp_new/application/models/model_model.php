<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_model
 *
 * @author hp
 */
class model_model extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function select_by_id($modelid) {
        $query = "
                select 
                model.*,
                model.id modelid,
                modelcategory.description modelcategory,
                finishing.description finishing,
                material.description material,
                top.description top,
                mirrorglass.description mirrorglass,
                foam.description foam,
                interliner.description interliner,
                fabric.description fabric,
                furring.description furring,
                accessories.description accessories,
                costing.final_selling_price,
                employee.name employee_created
                from model
                join modelcategory on model.modelcategorycode=modelcategory.code
                left join finishing on model.finishingcode=finishing.code
                left join material on model.materialcode=material.code
                left join top on model.topcode=top.code
                left join mirrorglass on model.mirrorglasscode=mirrorglass.code
                left join foam on model.foamcode=foam.code
                left join interliner on model.interlinercode=interliner.code
                left join fabric on model.fabriccode=fabric.code
                left join furring on model.furringcode=furring.code
                left join accessories on model.accessoriescode=accessories.code 
                left join costing on model.id=costing.modelid
                left join employee on model.create_by=employee.id
                where model.id=$modelid
        ";

        //echo $query;
        return $this->db->query($query)->row();
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

    function get_ready($query) {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');
        $offset = ($page - 1) * $rows;
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $query .= " limit $rows offset $offset";
        $criteria = $this->db->query($query)->result();
        $result = array_merge($result, array('rows' => $criteria));
        return json_encode($result);
    }

    function get_for_combo($query) {
        $row = array();
        $criteria = $this->db->query($query)->result();
        foreach ($criteria as $data) {
            $row[] = array(
                'id' => $data->id,
                'modelid' => $data->id,
                'originalcode' => $data->originalcode,
                'name' => $data->name,
                'mastercode' => $data->mastercode,
                'code' => $data->code,
                'modelcategorycode' => $data->modelcategorycode,
                'modelcategory' => $data->modelcategory,
                'itemsize_mm_w' => $data->itemsize_mm_w,
                'itemsize_mm_d' => $data->itemsize_mm_d,
                'itemsize_mm_h' => $data->itemsize_mm_h,
                'packagingsize_mm_w' => $data->packagingsize_mm_w,
                'packagingsize_mm_d' => $data->packagingsize_mm_d,
                'packagingsize_mm_h' => $data->packagingsize_mm_h,
            );
        }
        return json_encode($row);
    }

    function insert($data) {
        return $this->db->insert('model', $data);
    }

    function update($data, $where) {
        return $this->db->update('model', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('model', $where);
    }

    function generate_bom($id) {
        return $this->db->query("select model_generate_material_summary($id)");
    }

    function do_copy($modelid, $code, $mastercode, $originalcode, $name) {
        $create_by = $this->session->userdata('id');
        $query = "select model_do_copy($modelid, '$code', '$mastercode', '$originalcode', '$name','$create_by')";
        //echo $query;
        return $this->db->query($query);
    }

    function get_next_id_summary_material() {
        return $this->db->query("select nextval('modelmaterialsummary_id_seq') ct")->row()->ct;
    }

}
