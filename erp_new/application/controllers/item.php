<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of item
 *
 * @author hp
 */
class item extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->model('model_item');
    }

    function index() {
        $this->load->model('model_groups');
        $this->load->model('model_unit');
        $this->load->model('model_warehouse');
        $this->load->model('model_currency');
        $this->load->model('model_user');
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "item"));
        $data['groups'] = $this->model_groups->selectAllResult();
        $data['unit'] = $this->model_unit->selectAllResult();
        $data['warehouse'] = $this->model_warehouse->selectAllResult();
        $data['currency'] = $this->model_currency->selectAllResult();
        $this->load->view('item/view', $data);
    }

    function get() {
        $code = $this->input->post('partnumber');
        $description = $this->input->post('description');
        $groupsid = $this->input->post('groupsid');
        $category = $this->input->post('category');
        $warehouseid = $this->input->post('warehouseid');
        if ($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') != -1) {
            $query = "
                with t as (
                        with t_item as (
                        select distinct(itemid),(select item_get_smallest_unit(itemid)) unitcode,warehouseid from itemwarehousestock where warehouseid=" . $this->session->userdata('optiongroup') . "
                ) select item.*,
                        t_item.unitcode,
                        (select item_is_stock(item.id)) isstock,
                        groups.name groups,
                        (case when item.category = 1 then 'Local' when item.category = 2 then 'Import' when item.category = 3 then 'Mix' end) category_f,
                        t_item.warehouseid,
                        (select item_get_stock_by_warehouse_unitcode(item.id,t_item.unitcode,t_item.warehouseid)) stock
                        from t_item join item on t_item.itemid=item.id 
                        join groups on item.groupsid=groups.id 
                ) select t.* from t where true
            ";
        } else {
            $query = "with t as(
                        select 
                        item.*,
                        (select item_get_smallest_unit(item.id)) unitcode,
                        groups.name groups,
                        (case when item.category = 1 then 'Local' when item.category = 2 then 'Import' when item.category = 3 then 'Mix' end) category_f
                        from item 
                        join groups on item.groupsid=groups.id 
                        ) select t.*,(select item_get_stock_by_unit(t.id,t.unitcode)) stock from t ";

            if (!empty($warehouseid)) {
                $query .= " join (select distinct itemid from itemwarehousestock where warehouseid=$warehouseid) t_join on t.id=t_join.itemid where true ";
            } else {
                $query .= " where true ";
            }
        }

        if (!empty($code)) {
            $query .= " and (t.code ilike '%$code%' or t.description ilike '%$code%')";
        }if (!empty($groupsid)) {
            $query .= " and t.groupsid=$groupsid";
        }if (!empty($category)) {
            $query .= " and (t.category = $category or t.category=3)";
        }

        $q = $this->input->post("q");
        if (!empty($q)) {
            $query .= " and (t.code ilike '%$code%' or t.description ilike '%$description%') ";
        }
        $query .= " order by t.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        echo $query;
        echo $this->model_item->get($query);
    }

    function getfordialog() {
        $page = $this->input->post('page');
        $rows = $this->input->post('rows');

        $code = $this->input->post('partnumber');
        $description = $this->input->post('description');
        $groupsid = $this->input->post('groupsid');

        $query = "select 
                  item.*,
                  (case when item.category = 1 then 'Local' when item.category = 2 then 'Import' when item.category = 3 then 'Mix' end) category_f,
                  groups.name groups,
                  (select item_get_base_unit(item.id)) unitcode
                  from item  
                  left join groups on item.groupsid=groups.id where true 
                  and item.active=true";

        if (!empty($code)) {
            $query .= " and item.code ilike '%$code%' ";
        }if (!empty($description)) {
            $query .= " and item.description ilike '%$description%'";
        }if (!empty($groupsid)) {
            $query .= " and item.groupsid=$groupsid ";
        }
        $query .= " order by code asc ";
        echo $this->model_item->getfordialog($page, $rows, $query);
    }

    function get_in_warehouse($warehouse1, $warehouse2) {
        $query = "
            with t_item as (
                select 
                itemwarehousestock.itemid
                from itemwarehousestock 
                join (
                    select itemwarehousestock.itemid from 
                    itemwarehousestock where itemwarehousestock.warehouseid=$warehouse2
                ) as t_2 on itemwarehousestock.itemid=t_2.itemid
            where itemwarehousestock.warehouseid=$warehouse1 group by itemwarehousestock.itemid
            ) select t_item.itemid id,item.code,item.description 
            from t_item join item on t_item.itemid=item.id where true
        ";

        $q = $this->input->post('q');

        if (!empty($q)) {
            $query .= " and (item.code ilike '%$q%' or item.description ilike '%$q%') ";
        }

        $query .= " order by item.description asc";
        //echo $query;
        echo $this->model_item->get_for_combo($query);
    }

    function add() {
        $this->load->model('model_groups');
        $this->load->model('model_unit');
        $this->load->model('model_warehouse');
        $this->load->model('model_currency');
        $this->load->model('model_user');
        $data['groups'] = $this->model_groups->selectAllResult();
        $data['unit'] = $this->model_unit->selectAllResult();
        $data['warehouse'] = $this->model_warehouse->selectAllResult();
        $data['currency'] = $this->model_currency->selectAllResult();
        $this->load->view('item/add2', $data);
    }

    function get_for_combo() {
//        sleep(3);
        if ($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') != -1) {
            $query = "
                    with t as(
                            with t_sub as (
                                    select 
                                    distinct(itemid) id from itemwarehousestock
                                    where itemwarehousestock.warehouseid=" . $this->session->userdata('optiongroup') . "
                                    union
                                    select item.id
                                    from item where id not in (
                                            select distinct(itemid) from itemwarehousestock
                                        ) 
                            ) select t_sub.id,item.groupsid,groups.name groups,item.code,item.description,
                                item.images,item.reorderpoint,item.moq,item.lt,item.qccheck,item.yield,item.category,
                            (select item_is_stock(t_sub.id)) isstock,
                            (select item_get_base_unit(t_sub.id)) unitcode,
                            (case when item.category = 1 then 'Local' when item.category = 2 then 'Import' end) category_f from t_sub 
                            join item on t_sub.id=item.id
                            join groups on item.groupsid=groups.id where item.active=true
                        ) select t.*,(select item_get_stock_by_warehouse_unitcode(t.id,t.unitcode," . $this->session->userdata('optiongroup') . ")) stock from t where true
                    ";
        } else {
            $query = "
                with t as(
                    select 
                    item.*,
                    groups.name groups
                    from item 
                    join groups on item.groupsid=groups.id
                    where item.active=true 
                ) select t.*,(select item_get_base_unit(t.id)) unitcode from t where true";
        }

        $q = $this->input->post("q");
        if (!empty($q)) {
            $query .= " and (t.code ilike '%$q%' or t.description ilike '%$q%') ";
        }
        $query .= " order by t.id desc";

//        echo $query;
//        exit;
        echo $this->model_item->get_for_combo($query);
    }

    function save() {

        $this->load->model('model_itemunitprice');

        $code = $this->input->post('partnumber');
        $description = $this->input->post('description');
        $groupsid = $this->input->post('groupsid');
        $yield = $this->input->post('yield');
        $reorderpoint = $this->input->post('reorderpoint');
        $moq = $this->input->post('moq');
        $lt = $this->input->post('lt');
        $qccheck = $this->input->post('qccheck');

        $itemid = $this->model_item->getNextId();
        $file_name = "";
        if (empty($_FILES['fileupload']['name'])) {
            $file_name = "no-image.jpg";
        } else {
            $ext = pathinfo($_FILES['fileupload']['name'], PATHINFO_EXTENSION);
            $file_name = "image$itemid.$ext";
        }

        $config['upload_path'] = './files/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024 * 8;
        $config['file_name'] = $file_name;
        $this->load->library('upload', $config);


        $data = array(
            'id' => $itemid,
            'groupsid' => $groupsid,
            'partnumber' => $code,
            'description' => $description,
            'reorderpoint' => (double) $reorderpoint,
            'yield' => (double) $yield,
            'moq' => (double) $moq,
            'lt' => (double) $lt,
            'qccheck' => $qccheck,
            'images' => $file_name
        );

        $unitcode = $this->input->post('unitcode');
        $originalprice = $this->input->post('originalprice');
        $currency = $this->input->post('currency');
        $costingprice = $this->input->post('costingprice');

        $data_item_unit_price = array(
            "itemid" => $itemid,
            "unitcode" => $unitcode,
            "originalprice" => (double) $originalprice,
            "sellprice" => (double) $costingprice,
            "currency" => $currency,
            "rate" => 1
        );

        if ($this->model_item->insert($data)) {
            if ($this->model_itemunitprice->insert($data_item_unit_price)) {
                if ($file_name != "no-image.jpg") {
                    if ($this->upload->do_upload('fileupload')) {
                        echo json_encode(array('success' => true));
                    } else {
                        echo json_encode(array('warning' => true));
                    }
                } else {
                    echo json_encode(array('success' => true));
                }
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function update($id) {
        $code = $this->input->post('partnumber');
        $description = $this->input->post('description');
        $groupsid = $this->input->post('groupsid');
        $yield = $this->input->post('yield');
        $reorderpoint = $this->input->post('reorderpoint');
        $moq = $this->input->post('moq');
        $lt = $this->input->post('lt');
        $qccheck = $this->input->post('qccheck');
        $category = $this->input->post('category');
        $data = array(
            'groupsid' => $groupsid,
            'partnumber' => $code,
            'description' => $description,
            'reorderpoint' => (double) $reorderpoint,
            'yield' => (double) $yield,
            'moq' => (double) $moq,
            'lt' => (double) $lt,
            'qccheck' => $qccheck,
            'category' => $category
        );

        if ($this->model_item->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function disable() {
        $id = $this->input->post('id');
        if ($this->model_item->update(array("active" => 'false'), array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function enable() {
        $id = $this->input->post('id');
        if ($this->model_item->update(array("active" => 'true'), array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function updateimage($id, $filename) {
        $config['upload_path'] = './files/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024 * 8;

        if ($filename != "no-image.jpg") {
            @unlink("./files/" . $filename);
        }
        $ext = pathinfo($_FILES['fileupload']['name'], PATHINFO_EXTENSION);
        $config['file_name'] = "image$id.$ext";
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('fileupload')) {
            if ($this->model_item->update(array("images" => "image$id.$ext"), array("id" => $id))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            echo json_encode(array('msg' => $this->upload->display_errors('', '')));
        }
    }

    function delete() {
        $id = $this->input->post('id');
        if ($this->model_item->delete(array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_warehouse($itemid = 0, $unitcode = "") {

        if ($itemid != 0 && $unitcode != "") {
            $extend_query = " and itemwarehousestock.itemid=$itemid
                              and itemwarehousestock.unitcode='$unitcode'";
        } else if ($itemid != 0 && $unitcode == "") {
            $extend_query = " and itemwarehousestock.itemid=$itemid ";
        } else {
            $extend_query = " and itemwarehousestock.itemid=0 ";
        }

        $query = "select 
            distinct itemwarehousestock.warehouseid,
            warehouse.name warehousename
            from itemwarehousestock 
            join warehouse on itemwarehousestock.warehouseid=warehouse.id 
            where true " . $extend_query;

        if ($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') != -1) {
            $query .= " and itemwarehousestock.warehouseid = " . $this->session->userdata('optiongroup');
        }

        $query .= " order by itemwarehousestock.warehouseid asc";
//        echo $query;exit;
        echo $this->model_item->get_warehouse_combo($query);
    }

    function load_search_form() {
        $this->load->model('model_groups');
        $data['groups'] = $this->model_groups->selectAllResult();
        $this->load->view('item/search_form', $data);
    }

    function get_more_information($itemid, $image) {
        $data['action'] = explode('|', $this->model_user->getAction($this->session->userdata('id'), "item"));
        $data['image'] = $image;
        $this->load->view('item/information', $data);
    }

    function change_admin() {
        $this->load->view('item/change_admin');
    }

    function do_change_admin() {
        $this->load->model('model_user');
        $id = $this->input->post('userid');
        $data = array("optiongroup" => $this->input->post('warehouseid'));
        if ($this->model_user->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function get_stock_by_unit_code($itemid, $unitcode) {
        $dt = $this->db->query("select item_get_stock_by_unitcode($itemid, '$unitcode') ct")->row();
        echo $dt->ct;
    }

    function export_to_excel() {
        $code = $this->input->post('partnumber');
        $description = $this->input->post('description');
        $groupsid = $this->input->post('groupsid');
        $category = $this->input->post('category');
        $warehouseid = $this->input->post('warehouseid');
        if ($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') != -1) {
            $query = "
                with t as (
                        with t_item as (
                        select distinct(itemid),(select item_get_base_unit(itemid)) unitcode,warehouseid from itemwarehousestock where warehouseid=" . $this->session->userdata('optiongroup') . "
                ) select item.*,
                        t_item.unitcode,
                        (select item_is_stock(item.id)) isstock,
                        groups.name groups,
                        (case when item.category = 1 then 'Local' when item.category = 2 then 'Import' when item.category = 3 then 'Mix' end) category_f,
                        t_item.warehouseid,
                        (select item_get_stock_by_warehouse_unitcode(item.id,t_item.unitcode,t_item.warehouseid)) stock
                        from t_item join item on t_item.itemid=item.id 
                        join groups on item.groupsid=groups.id 
                ) select t.* from t where true
            ";
        } else {
            $query = "with t as(
                        select 
                        item.*,
                        (select item_get_base_unit(item.id)) unitcode,
                        groups.name groups,
                        (case when item.category = 1 then 'Local' when item.category = 2 then 'Import' when item.category = 3 then 'Mix' end) category_f
                        from item 
                        join groups on item.groupsid=groups.id 
                        ) select t.*,(select item_get_stock_by_unitcode(t.id,t.unitcode)) stock from t ";

            if (!empty($warehouseid)) {
                $query .= " join (select distinct itemid from itemwarehousestock where warehouseid=$warehouseid) t_join on t.id=t_join.itemid where true ";
            } else {
                $query .= " where true ";
            }
        }

        if (!empty($code)) {
            $query .= " and (t.code ilike '%$code%' or t.description ilike '%$code%')";
        }if (!empty($groupsid)) {
            $query .= " and t.groupsid=$groupsid";
        }if (!empty($category)) {
            $query .= " and (t.category = $category or t.category=3)";
        }

        $q = $this->input->post("q");
        if (!empty($q)) {
            $query .= " and (t.code ilike '%$code%' or t.description ilike '%$description%') ";
        }
        $query .= " order by t.id desc ";
        //echo $query;
        $this->load->library('excel');
        $data['item'] = $this->db->query($query)->result();
        $this->load->view('item/export_to_excel', $data);
    }

    function order_recommendation() {
        $this->load->view('item/order_recommendation');
    }

    function print_order_recommendation() {

        $code = $this->input->post('partnumber');
        $description = $this->input->post('description');
        $groupsid = $this->input->post('groupsid');
        $category = $this->input->post('category');
        $warehouseid = $this->input->post('warehouseid');
        if ($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') != -1) {
            $query = "
                with t as (
                        with t_item as (
                        select distinct(itemid),(select item_get_base_unit(itemid)) unitcode,warehouseid from itemwarehousestock where warehouseid=" . $this->session->userdata('optiongroup') . "
                ) select item.*,
                        t_item.unitcode,
                        item_is_stock(item.id) isstock,
                        groups.name groups,
                        (case when item.category = 1 then 'Local' when item.category = 2 then 'Import' when item.category = 3 then 'Mix' end) category_f,
                        t_item.warehouseid,
                        (select item_get_stock_by_warehouse_unitcode(item.id,t_item.unitcode,t_item.warehouseid)) stock
                        from t_item join item on t_item.itemid=item.id 
                        join groups on item.groupsid=groups.id 
                ) select t.* from t where t.reorderpoint >= t.stock 
            ";
        } else {
            $query = "with t as(
                        select 
                        item.*,
                        item_get_base_unit(item.id) unitcode,
                        item_get_stock_by_unitcode(item.id,item_get_base_unit(item.id)) stock,
                        groups.name groups,
                        (case when item.category = 1 then 'Local' when item.category = 2 then 'Import' when item.category = 3 then 'Mix' end) category_f
                        from item 
                        join groups on item.groupsid=groups.id
                     ) select t.* from t ";

            if (!empty($warehouseid)) {
                $query .= " join (select distinct itemid from itemwarehousestock where warehouseid=$warehouseid) t_join on t.id=t_join.itemid where true ";
            } else {
                $query .= " where t.reorderpoint >= t.stock ";
            }
        }

        if (!empty($code)) {
            $query .= " and (t.code ilike '%$code%' or t.description ilike '%$code%')";
        }if (!empty($groupsid)) {
            $query .= " and t.groupsid=$groupsid";
        }if (!empty($category)) {
            $query .= " and (t.category = $category or t.category=3)";
        }

        $q = $this->input->post("q");
        if (!empty($q)) {
            $query .= " and (t.code ilike '%$code%' or t.description ilike '%$description%') ";
        }

        $stock_status = $this->input->post('stock_status');
        if (!empty($stock_status)) {
            if ($stock_status == 1) {
                $query .= " and t.stock <= 0 ";
            }
            if ($stock_status == 2) {
                $query .= " and t.stock > 0 ";
            }
        }

        $query .= " order by t.id asc ";
        //echo $query;exit;
        $this->load->model('model_company');
        $data['company'] = $this->model_company->select();
        $data["item"] = $this->db->query($query)->result();
        $this->load->view('item/print_order_recommendation', $data);
    }

    function get_order_recommendation() {
        $code = $this->input->post('partnumber');
        $description = $this->input->post('description');
        $groupsid = $this->input->post('groupsid');
        $category = $this->input->post('category');
        $warehouseid = $this->input->post('warehouseid');
        if ($this->session->userdata('department') == 9 && $this->session->userdata('optiongroup') != -1) {
            $query = "
                with t as (
                        with t_item as (
                        select distinct(itemid),(select item_get_base_unit(itemid)) unitcode,warehouseid from itemwarehousestock where warehouseid=" . $this->session->userdata('optiongroup') . "
                ) select item.*,
                        t_item.unitcode,
                        item_is_stock(item.id) isstock,
                        groups.name groups,
                        (case when item.category = 1 then 'Local' when item.category = 2 then 'Import' when item.category = 3 then 'Mix' end) category_f,
                        t_item.warehouseid,
                        (select item_get_stock_by_warehouse_unitcode(item.id,t_item.unitcode,t_item.warehouseid)) stock
                        from t_item join item on t_item.itemid=item.id 
                        join groups on item.groupsid=groups.id 
                ) select t.* from t where t.reorderpoint >= t.stock 
            ";
        } else {
            $query = "with t as(
                        select 
                        item.*,
                        item_get_base_unit(item.id) unitcode,
                        item_get_stock_by_unitcode(item.id,item_get_base_unit(item.id)) stock,
                        groups.name groups,
                        (case when item.category = 1 then 'Local' when item.category = 2 then 'Import' when item.category = 3 then 'Mix' end) category_f
                        from item 
                        join groups on item.groupsid=groups.id
                     ) select t.* from t ";

            if (!empty($warehouseid)) {
                $query .= " join (select distinct itemid from itemwarehousestock where warehouseid=$warehouseid) t_join on t.id=t_join.itemid where true ";
            } else {
                $query .= " where t.reorderpoint >= t.stock ";
            }
        }

        if (!empty($code)) {
            $query .= " and (t.code ilike '%$code%' or t.description ilike '%$code%')";
        }if (!empty($groupsid)) {
            $query .= " and t.groupsid=$groupsid";
        }if (!empty($category)) {
            $query .= " and (t.category = $category or t.category=3)";
        }

        $q = $this->input->post("q");
        if (!empty($q)) {
            $query .= " and (t.code ilike '%$code%' or t.description ilike '%$description%') ";
        }

        $stock_status = $this->input->post('stock_status');
        if (!empty($stock_status)) {
            if ($stock_status == 1) {
                $query .= " and t.stock <= 0 ";
            }
            if ($stock_status == 2) {
                $query .= " and t.stock > 0 ";
            }
        }
        //$query .= " order by t.id desc ";

        $sort = $this->input->post('sort');
        $order = $this->input->post('order');
        $query .= " order by $sort $order ";
        //echo $query;
        echo $this->model_item->get($query);
    }

    function on_purchase() {
        $this->load->view("item/on_purchase");
    }

    function get_onpurchase() {
        $query = "with pod as (
                select
                purchaseorderdetail.*,
                purchaseorder.number po_number,
                purchaseorder.date po_date,
                (department.code || ': ' || department.name)  department,
                purchaserequest.number pr_number,
                purchaserequestdetail.vendorid, 
                purchaserequestdetail.itemid,
                item.code itemcode,
                item.description itemdescription,
                purchaserequestdetail.unitcode,
                purchaserequestdetail.qty request_qty,
                purchaserequestdetail.price,
                (purchaseorderdetail.qty * purchaserequestdetail.price) subtotal,
                purchaserequestdetail.currency,
                purchaserequestdetail.discount,
                purchaserequestdetail.ppn,
                purchaserequestdetail.amount,
                purchaserequestdetail.total,
                vendor.id vendor_id,
                vendor.name vendor,
                purchaserequestdetail.materialrequisitiondetailid,
                materialrequisition.number mr_number,
                (purchaseorderdetail_get_receiving_status(purchaseorderdetail.id)) receive_status
                from purchaseorderdetail 
                join purchaserequestdetail on 
                purchaseorderdetail.purchaserequestdetailid=purchaserequestdetail.id 
                join item on purchaserequestdetail.itemid=item.id 
                join vendor on purchaserequestdetail.vendorid=vendor.id
                join purchaseorder on purchaseorderdetail.purchaseorderid=purchaseorder.id
                join purchaserequest on purchaserequestdetail.purchaserequestid=purchaserequest.id
                left join department on purchaserequest.departmentid=department.id
                left join materialrequisitiondetail on purchaserequestdetail.materialrequisitiondetailid=materialrequisitiondetail.id
                left join materialrequisition on materialrequisitiondetail.materialrequisitionid=materialrequisition.id
                where true and purchaseorder.status in (0,1)
        ) select pod.* from pod where true ";

        $itemcode = $this->input->post('itemcode');
        if (!empty($itemcode)) {
            $query .= " and (pod.itemcode ilike '%" . $itemcode . "%' or pod.itemdescription ilike '%" . $itemcode . "%')";
        }

        $po_no = $this->input->post('po_no');
        if (!empty($po_no)) {
            $query .= " and pod.po_number ilike '%" . $po_no . "%'";
        }
        $pr_no = $this->input->post('pr_no');
        if (!empty($pr_no)) {
            $query .= " and pod.pr_number ilike '%" . $pr_no . "%'";
        }
        $vendorid = $this->input->post('vendorid');
        if (!empty($vendorid)) {
            $query .= " and pod.vendor_id=$vendorid";
        }

        $query .= " and pod.qty_ots > 0";
        
        $this->load->model('model_purchaseorderdetail');
        echo $this->model_purchaseorderdetail->get($query);
    }

    function stock_card() {
        $this->load->view('item/stock_card');
    }

    function print_stock_card($flag = "") {
        $data['flag'] = $flag;
        $itemid = $this->input->post('itemid');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $this->load->view('item/print_stock_card', $data);
    }

}
