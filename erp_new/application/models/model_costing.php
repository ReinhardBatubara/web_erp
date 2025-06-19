<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_costing
 *
 * @author user
 */
class model_costing extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function select_row($query) {
        return $this->db->query($query)->row();
    }

    function select_query($query) {
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

    function product_price_list_get($query) {

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
                'usd_price' => $data->usd_price,
                'usd_optional_price' => $data->usd_optional_price,
                'idr_price' => $data->idr_price,
                'costingid' => $data->costingid,
                'date' => $data->date,
                'imagename' => $data->imagename,
                'code' => $data->code,
                'original_code' => $data->original_code,
                'name' => $data->name,
                'item_name' => $data->item_name,
                'itemsize_mm_w' => $data->itemsize_mm_w,
                'itemsize_mm_h' => $data->itemsize_mm_h,
                'itemsize_mm_d' => $data->itemsize_mm_d,
                'itemsize_inc_w' => $data->itemsize_inc_w,
                'itemsize_inc_d' => $data->itemsize_inc_d,
                'itemsize_inc_h' => $data->itemsize_inc_h,
                'packagingsize_mm_w' => $data->packagingsize_mm_w,
                'packagingsize_mm_d' => $data->packagingsize_mm_d,
                'packagingsize_mm_h' => $data->packagingsize_mm_h,
                'seat_width' => $data->seat_width,
                'seat_depth' => $data->seat_depth,
                'seat_height' => $data->seat_height,
                'arm_height' => $data->arm_height,
                'image_location' => "<center><img src='files/model/" . $data->imagename . "' style='max-width:40px;max-height:40px;padding:1px;border:none;'></center>"
            );
        }
        $result = array_merge($result, array('rows' => $row));
        return json_encode($result);
    }

    function get_last_id() {
        return $this->db->query("select id from costing order by id desc limit 1")->row()->id;
    }

    function get_material_total_cost($costingid) {
        $dt = $this->db->query("select costing_get_material_total_cost($costingid) ct")->row();
        return $dt->ct;
    }

    function get_material($query) {
        $result = array();
        $row = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $criteria = $this->db->query($query)->result();
        $total = 0;
        foreach ($criteria as $data) {
            $itemcode = $data->o_itemcode;
            if ($data->o_id < 0) {
                $itemcode = 'SUB TOTAL';
            }
            $row[] = array(
                'id' => $data->o_id,
                'costingmaterialgroupid' => $data->o_costingmaterialgroupid,
                'costing_group' => $data->o_costing_group,
                'itemid' => $data->o_itemid,
                'itemcode' => $itemcode,
                'itemname' => $data->o_itemname,
                'unitcode' => $data->o_unitcode,
                'qty' => $data->o_qty,
                'yield' => $data->o_yield,
                'gross_qty' => $data->o_gross_qty,
                'cost' => $data->o_cost,
                'total_cost' => $data->o_total_cost,
                'sequenceid' => $data->o_sequenceid,
                'remark' => $data->o_remark,
                'special_material' => $data->o_special_material,
                'model_material_summary_id' => $data->o_model_material_summary_id
            );
            if ($data->o_id < 0) {
                $total += $data->o_total_cost;
            }
        }

        $costingid = $this->input->post('costingid');
        if (empty($costingid)) {
            $costingid = 0;
        }
        $footer = array(
            array(
                'itemcode' => 'TOTAL',
                'total_cost' => $total,
            )
        );
        $j_result = array_merge($result, array('rows' => $row, 'footer' => $footer));
        return json_encode($j_result);
    }

    function insert($data) {
        return $this->db->insert('costing', $data);
    }

    function update($data, $where) {
        return $this->db->update('costing', $data, $where);
    }

    function delete($where) {
        return $this->db->delete('costing', $where);
    }

    function get_summary($costingid) {
        $query = "select * from costing where id=$costingid limit 1";
        $criteria = $this->db->query($query)->row();
        $row = array(
            array("name" => "Material Price", "value" => number_format($criteria->material_price), "id" => "material_price"),
            array("name" => "Carving", "value" => number_format($criteria->carving), "id" => "carving"),
            array("name" => "Labour Cost", "value" => number_format($criteria->labour_cost), "id" => "labour_cost"),
            array("name" => "Manufactur Cost", "value" => number_format($criteria->manufacture_cost), "id" => "manufacture_cost"),
            array("name" => "X Factor (" . $criteria->xfactor_percentage . "%)", "value" => number_format($criteria->xfactor), "id" => "xfactor"),
            array("name" => "Overhead (" . $criteria->overhead_percentage . "%)", "value" => number_format($criteria->overhead), "id" => "overhead"),
            array("name" => "Shipment Cost (".$criteria->shipment_cost_expense."%)", "value" => number_format($criteria->shipment_cost), "id" => "shipment_cost"),
            array("name" => "Total", "value" => number_format($criteria->total), "id" => "total"),
            array("name" => "Margin (" . $criteria->margin_percentage . "%)", "value" => number_format($criteria->margin), "id" => "margin"),
            array("name" => "TOTAL PRICE", "value" => number_format($criteria->total_price), "id" => "total_price"),
            array("name" => "USD", "value" => number_format($criteria->total_to_rate, 2), "id" => "total_to_rate"),
            array("name" => "SELLING PRICE (" . $criteria->selling_price_percentage . "%)", "value" => number_format($criteria->selling_price, 2), "id" => "selling_price"),
            array("name" => "FINAL/APPROVE PRICE", "value" => number_format($criteria->final_selling_price, 2), "id" => "final_selling_price")
        );
        return json_encode($row);
    }

    function calculate($costingid) {
        return $this->db->query("select costing_calculate($costingid)");
    }

    function do_set_to_model($costingid, $date, $modelid, $costingby) {
        return $this->db->query("select costing_do_set_to_model($costingid,'$date',$modelid,'$costingby')");
    }

    function do_detail_copy_from($categoryid, $from_costingid, $to_costingid, $modelid) {
        return $this->db->query("select costing_do_detail_copy_from($categoryid,$from_costingid,$to_costingid,$modelid)");
    }

}
