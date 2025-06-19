<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of carvingsubmission
 *
 * @author user
 */
class carvingsubmission extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_carvingsubmissionperiod');
        $this->load->model('model_carvingsubmissioncarver');
        $this->load->model('model_carvingsubmissionlistitem');
    }

    function index() {
        $this->load->view('carvingsubmission/index');
    }

    function period() {
        $this->load->view('carvingsubmission/period');
    }

    function period_save($id = 0) {

        $data = array(
            "startdate" => $this->input->post('startdate'),
            "stopdate" => $this->input->post('stopdate'),
            "week" => $this->input->post('week'),
            "remark" => $this->input->post('remark')
        );

        if ($id == 0) {
            if ($this->model_carvingsubmissionperiod->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_carvingsubmissionperiod->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function period_get() {
        $query = " 
            select * from carvingsubmissionperiod
        ";

        echo $this->model_carvingsubmissionperiod->get($query);
    }

    function period_delete() {
        if ($this->model_carvingsubmissionperiod->delete(array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function carver() {
        $this->load->view('carvingsubmission/carver');
    }

    function carver_save($carvingsubmissionperiodid, $id) {
        $data = array(
            "carvingsubmissionperiodid" => $carvingsubmissionperiodid,
            "carverid" => $this->input->post('carverid')
        );

        if ($this->model_carvingsubmissioncarver->insert($data)) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function carver_delete() {
        if ($this->model_carvingsubmissioncarver->delete(array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function carver_get() {

        $carvingsubmissionperiod_id = $this->input->post('carvingsubmissionperiod_id');

        if (empty($carvingsubmissionperiod_id)) {
            $carvingsubmissionperiod_id = 0;
        }

        $query = "
            select 
            carvingsubmissioncarver.*,
            carver.name 
            from carvingsubmissioncarver
            join carver on carvingsubmissioncarver.carverid=carver.id
            where carvingsubmissioncarver.carvingsubmissionperiodid=$carvingsubmissionperiod_id
            order by carver.name asc
        ";
        //echo $query;
        echo $this->model_carvingsubmissioncarver->get($query);
    }

    function list_item() {
        $this->load->view('carvingsubmission/list_item');
    }

    function list_item_save($carvingsubmissionperiodid, $carverid, $id) {

        $data = array(
            "trackingid" => $this->input->post('trackingid'),
            "serial" => $this->input->post('serial'),
            "price" => $this->input->post('price'),
            "remark" => $this->input->post('remark'),
            "status" => $this->input->post('status')
        );

        if ($id == 0) {
            $data["carvingsubmissionperiodid"] = $carvingsubmissionperiodid;
            $data["carvingsubmissioncarverid"] = $carverid;
            if ($this->model_carvingsubmissionlistitem->insert($data)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            if ($this->model_carvingsubmissionlistitem->update($data, array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function list_item_delete() {
        if ($this->model_carvingsubmissionlistitem->delete(array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function list_item_get() {

        $carvingsubmissionperiodid = $this->input->post('carvingsubmissionperiodid');
        if (empty($carvingsubmissionperiodid)) {
            $carvingsubmissionperiodid = 0;
        }

        $carvingsubmissioncarverid = $this->input->post('carvingsubmissioncarverid');
        if (empty($carvingsubmissioncarverid)) {
            $carvingsubmissioncarverid = 0;
        }

        $query = "
            select 
            carvingsubmissionlistitem.*,
            joborderitembarcode.modelid,
            model.originalcode,
            model.code,
            model.name,
            model.itemsize_mm_w,
            model.itemsize_mm_h,
            model.itemsize_mm_d,
            model.images imagename
            from carvingsubmissionlistitem
            join joborderitembarcode on carvingsubmissionlistitem.serial=joborderitembarcode.serial
            join model on joborderitembarcode.modelid=model.id 
            where 
            carvingsubmissionlistitem.carvingsubmissionperiodid=$carvingsubmissionperiodid and
            carvingsubmissionlistitem.carvingsubmissioncarverid=$carvingsubmissioncarverid
        ";
        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= "
              and (carvingsubmissionlistitem.serial ilike '%$q%' or
                   model.originalcode ilike '%$q%' or
                   model.code ilike '%$q%' or
                   model.name ilike '%$q%'
                  )
            ";
        }

        $query .= " order by carvingsubmissionlistitem.id desc ";
        echo $this->model_carvingsubmissionlistitem->get($query);
    }

    function get_available() {
        $query = "
            with t as (
                select 
                tracking.id,
                tracking.serial,
                joborderitembarcode.modelid,
                model.originalcode,
                model.code,
                model.name,
                model.itemsize_mm_w,
                model.itemsize_mm_h,
                model.itemsize_mm_d,
                model.images imagename,
                carvingpricelist.price,
                carvingpricelist.remark
                from tracking 
                join joborderitembarcode on tracking.serial=joborderitembarcode.serial
                join model on joborderitembarcode.modelid=model.id
                left join carvingpricelist on model.id=carvingpricelist.modelid
                where tracking.tracking_process_id=3
                and tracking.serial != '0' 
                and tracking.id not in (select trackingid from carvingsubmissionlistitem where status='Complete')
            ) select t.* from t where true  
        ";

        $q = $this->input->post('q');
        if (!empty($q)) {
            $query .= "
              and (t.serial ilike '%$q%' or
                   t.originalcode ilike '%$q%' or
                   t.code ilike '%$q%' or
                   t.name ilike '%$q%'
                  )
            ";
        }
        
        //echo $query;
        echo $this->model_carvingsubmissionlistitem->get($query);
    }

    function period_excel() {
        $this->load->library('excel');
        $id = $this->input->post('id');
        $query = "
            select 
            carvingsubmissionlistitem.*,
            joborderitembarcode.modelid,
            model.originalcode,
            model.code,
            model.name,
            model.images,
            model.itemsize_mm_w,
            model.itemsize_mm_h,
            model.itemsize_mm_d,
            model.images imagename,
            carver.name carver_name
            from carvingsubmissionlistitem
            join joborderitembarcode on carvingsubmissionlistitem.serial=joborderitembarcode.serial
            join carvingsubmissioncarver on carvingsubmissionlistitem.carvingsubmissioncarverid=carvingsubmissioncarver.id
            join carver on carvingsubmissioncarver.carverid=carver.id
            join model on joborderitembarcode.modelid=model.id  
            where carvingsubmissionlistitem.carvingsubmissionperiodid=$id";
        $data['item'] = $this->db->query($query)->result();
        $this->load->view('carvingsubmission/period_excel', $data);
    }

}
