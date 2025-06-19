<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of materialrequisitionitem
 *
 * @author user
 */
class materialrequisitionitem extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_materialrequisitiondetail');
    }

    function index() {
        $this->load->view('materialrequisition/view_by_item');
    }

    function get() {

        $query = "
            with mr_item as (
                select 
                materialrequisitiondetail.id,
                materialrequisitiondetail.status,
                materialrequisition.number mr_no,
                materialrequisition.date,  
                materialrequisitiondetail.itemid,
                item.code itemcode,
                item.description itemdescription,
                materialrequisitiondetail.unitcode,
                materialrequisitiondetail.qty qty_request,
                materialrequisitiondetail.qty_ots
                from materialrequisitiondetail 
                join item on materialrequisitiondetail.itemid=item.id 
                join materialrequisition on 
                materialrequisitiondetail.materialrequisitionid=materialrequisition.id
            ) select mr_item.* from mr_item where true ";

        $itemcode = $this->input->post('itemcode');
        $itemdescription = $this->input->post('itemdescription');
        $mr_no = $this->input->post('mr_no');
        $status = $this->input->post('status');
        $datefrom = $this->input->post('datefrom');
        $dateto = $this->input->post('dateto');
        if (empty($status)) {
            $status = "2";
        }
        
//        if (!empty($itemcode)) {
//            $query .= " and (mr_item.itemcode ilike '%$itemcode%' or mr_item.itemdescription ilike '%$itemdescription%')";
//        }
        
        if (!empty($itemdescription)) {
            $query .= " and (mr_item.itemdescription ilike '%$itemdescription%' or mr_item.itemcode ilike '%$itemdescription%')";
        }if (!empty($mr_no)) {
            $query .= " and mr_item.mr_no ilike '%$mr_no%'";
        }if ($status != "-1") {
            if ($status == "2") {
                $query .= " and mr_item.qty_ots > 0 and mr_item.status='open'";
            } else {
                $query .= " and mr_item.qty_ots <= 0";
            }
        }if ($datefrom != "" && $dateto != "") {
            $query .= " and mr_item.date between '" . $datefrom . "' and '" . $dateto . "'";
        }if ($datefrom != "" && $dateto == "") {
            $query .= " and mr_item.date = '" . $datefrom . "'";
        }if ($datefrom == "" && $dateto != "") {
            $query .= " and mr_item.date = '" . $dateto . "'";
        }

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        //echo $status;
        $query .= " order by mr_item.$sort $order ";

//        echo $query;
        echo $this->model_materialrequisitiondetail->get($query);
    }

}

?>
