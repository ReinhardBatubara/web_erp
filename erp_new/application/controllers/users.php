<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author hp
 */
class users extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('model_user');
    }

    function index() {
        $this->load->model('model_user');
        $data['users'] = $this->model_user->selectAllResult();
        $this->load->view('users/view', $data);
    }

//     function get() {

//         $query = "
//             select 
//             users.*,
//             employee.name employeename,
//             employee.departmentid,
//             department.name department
//             from users left join employee 
//             on users.id=employee.id 
//             left join department on 
//             employee.departmentid=department.id 
//             where true 
//         ";
//         $id_name = $this->input->post('id_name');
//         if (!empty($id_name)) {
//             $query .= " and (users.id ilike '%$id_name%' or employee.name ilike '%$id_name%')";
//         }

// //        $query .= " order by users.id_field desc ";
//         $sort = $this->input->post('sort');
//         $order = $this->input->post('order');
//         $query .= " order by $sort $order ";

//         echo $this->model_user->get($query);
//     }

    function get() {
    $bindings = [];
    $query = "
        select 
        users.*,
        employee.name as employeename,
        employee.departmentid,
        department.name as department
        from users 
        left join employee on users.id=employee.id 
        left join department on employee.departmentid=department.id 
        where true 
    ";

    $id_name = $this->input->post('id_name');
    if (!empty($id_name)) {
        // Gunakan placeholder '?' untuk keamanan
        $query .= " and (users.id ilike ? or employee.name ilike ?)";
        // Tambahkan value ke array bindings
        array_push($bindings, "%$id_name%", "%$id_name%");
    }

    // Amankan parameter sort & order
    $sort = $this->input->post('sort');
    $order = $this->input->post('order');
    
    // Whitelist kolom yang boleh di-sort untuk mencegah injection
    $allowed_sort_columns = ['id', 'employeename', 'department'];
    if ($sort && in_array($sort, $allowed_sort_columns)) {
        // Pastikan order adalah 'asc' atau 'desc'
        $order = (strtolower($order) == 'desc') ? 'desc' : 'asc';
        $query .= " order by $sort $order ";
    } else {
        // Default sort
        $query .= " order by users.id desc ";
    }

    // Kirim query dan bindings ke model
    echo $this->model_user->get($query, $bindings);
}

    // function save() {
    //     $id = $this->input->post('id_name');
    //     $password = md5($this->input->post('password'));
    //     $optiongroup = $this->input->post('optiongroup');

    //     if (empty($optiongroup) || $optiongroup == 'NULL') {
    //         $optiongroup = null;
    //     }

    //     $data = array(
    //         "id" => $id,
    //         "password" => $password,
    //         "optiongroup" => $optiongroup
    //     );
    //     if ($this->model_user->insert($data)) {
    //         echo json_encode(array('success' => true));
    //     } else {
    //         echo json_encode(array('msg' => $this->db->_error_message()));
    //     }
    // }

    function save() {
    // BUG FIX: Mengambil 'id' bukan 'id_name' untuk menyimpan user baru.
    $id = $this->input->post('id'); 
    $password = md5($this->input->post('password'));
    $optiongroup = $this->input->post('optiongroup');

    if (empty($optiongroup) || $optiongroup == 'NULL') {
        $optiongroup = null;
    }

    // Menambah kolom 'enabled' secara default saat user baru dibuat
    $data = array(
        "id" => $id,
        "password" => $password,
        "optiongroup" => $optiongroup,
        "enabled" => 'true' // User baru sebaiknya langsung aktif
    );
    
    if ($this->model_user->insert($data)) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('msg' => $this->db->error()['message'])); // Gunakan db->error() untuk CI3
    }
}

    function change_password_by_admin() {
        $this->load->view('users/change_password');
    }

    function do_change_password_by_admin() {
        $id = $this->input->post('id');
        $newpassword = md5(trim($this->input->post('newpassword')));
        $data = array(
            "password" => $newpassword
        );
        if ($this->model_user->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function disable() {
        $id = $this->input->post('id');
        $data = array(
            "enabled" => 'false'
        );
        if ($this->model_user->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function enable() {
        $id = $this->input->post('id');
        $data = array(
            "enabled" => 'true'
        );
        if ($this->model_user->update($data, array("id" => $id))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function delete() {

        if ($this->model_user->delete(array("id" => $this->input->post('id')))) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('msg' => $this->db->_error_message()));
        }
    }

    function edit_privilege($id, $departmentid) {
        $this->load->model('model_menuaccess');
        $this->load->model('model_menu');
        $data['menu'] = $this->model_menu->selectAll();
        $data['id'] = $id;
        $data['departmentid'] = $departmentid;
        $user_list_menu = $this->model_menuaccess->select_all_menu_by_user($id);
        $arr_user_list_menu = array();
        foreach ($user_list_menu as $result) {
            $arr_user_list_menu[] = $result->scriptmenu;
        }
        $data['user_list_menu'] = $arr_user_list_menu;
        $this->load->view('users/edit_privilege', $data);
    }

    function action_set_menu() {
        $this->load->model('model_menuaccess');
        $type = $this->input->post('type');
        $userid = $this->input->post('userid');
        $scriptview = $this->input->post('scriptview');
        if ($type == 1) {
            //echo "1";
            if ($this->model_menuaccess->set($userid, $scriptview)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            //echo "2";
            if ($this->model_menuaccess->remove($userid, $scriptview)) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function action_set() {
        $this->load->model('model_menuaccess');
        $type = $this->input->post('type');
        $userid = $this->input->post('userid');
        $scriptview = $this->input->post('scriptview');
        $action = $this->input->post('action');

        $user_action = $this->model_menuaccess->get_user_action($userid, $scriptview);

        if ($type == 1) {
            $user_action .= "|" . $action;
            $data = array(
                "actions" => $user_action
            );
            if ($this->model_menuaccess->update($data, array("userid" => $userid, "scriptmenu" => $scriptview))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        } else {
            $array_user_action = explode('|', $user_action);
            $new_array_user_action = array_diff($array_user_action, array($action));
            $new_action = implode('|', $new_array_user_action);
            echo $new_action;
            $data = array(
                "actions" => $new_action
            );
            if ($this->model_menuaccess->update($data, array("userid" => $userid, "scriptmenu" => $scriptview))) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('msg' => $this->db->_error_message()));
            }
        }
    }

    function privilege_option_view() {
        $this->load->model('model_menuaccess');
        $userid = $this->input->post('userid');
        $scriptview = $this->input->post('scriptview');
        $value = $this->input->post('value');

        $data = array(
            "optionview" => $value
        );
        $this->model_menuaccess->update($data, array("userid" => $userid, "scriptmenu" => $scriptview));
    }

    function get_admin_warehouse() {
        $query = "
            select 
            users.id,
            employee.name
            from users
            join employee on users.id=employee.id 
            where employee.departmentid=9 and users.enabled=true 
            and users.optiongroup != -1
            ";
        echo $this->model_user->get($query);
    }

}
