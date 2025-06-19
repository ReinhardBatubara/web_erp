<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_stockoutdetail
 *
 * @author user
 */
class model_stockoutdetail extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    function select_result_query($query) {
        return $this->db->query($query)->result();
    }

    function select_by_stockoutid($stockoutid) {
        $query = "
            with t as (
                select 
                stockoutdetail.id,
                stockoutdetail.stockoutid,
                stockoutdetail.materialwithdrawdetailid,
                stockoutdetail.qty,
                stockoutdetail.warehouseid,
                stockoutdetail.mrpid,
                stockoutdetail.remark,
                (case when stockoutdetail.itemid != 0 then stockoutdetail.itemid else materialwithdrawdetail.itemid end) itemid,
                (case when stockoutdetail.itemid != 0 then stockoutdetail.unitcode else materialwithdrawdetail.unitcode end) unitcode
                from
                stockoutdetail
                left join materialwithdrawdetail on stockoutdetail.materialwithdrawdetailid=materialwithdrawdetail.id
                left join item on materialwithdrawdetail.itemid=item.id where true 
            ) select t.*,item.code itemcode,item.description itemdescription from t 
            left join item on t.itemid=item.id where t.stockoutid=$stockoutid
        ";
        //echo $query;
        return $this->db->query($query)->result();
    }

    function get($query) {
        $result = array();
        $result['total'] = $this->db->query($query)->num_rows();
        $row = array();
        $criteria = $this->db->query($query)->result();
//        foreach ($criteria as $data) {
//            $row[] = array(
//                'id' => $data->id,
//                'itemid' => $data->itemid,
//                'itemcode' => $data->itemcode,
//                'itemdescription' => $data->itemdescription,
//                'unitcode' => $data->unitcode,
//                'qty' => $data->qty
//            );
//        }
        $result = array_merge($result, array('rows' => $criteria));
        return json_encode($result);
    }

    function insert($data) {
        return $this->db->insert("stockoutdetail", $data);
    }

    function update($data, $where) {
        return $this->db->update("stockoutdetail", $data, $where);
    }

    function insert_batch($data) {
        return $this->db->insert_batch("stockoutdetail", $data);
    }

    function delete($where) {
        return $this->db->delete('stockoutdetail', $where);
    }

}
