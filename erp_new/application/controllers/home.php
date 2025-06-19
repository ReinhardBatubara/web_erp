<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->userdata('id')) {
            $this->load->model('model_groups');
            $this->load->model('model_user');
            $data['menu_group'] = $this->model_user->selectMenuGroup($this->session->userdata('id'));
            $data['accessmenu'] = $this->model_user->selectAccessMenuByUserid($this->session->userdata('id'));
            $data['itemgroup'] = $this->model_groups->selectAllResult();
            $this->load->view('home2', $data);
        } else {
            $this->load->view('login');
        }
    }

    function login() {
        $this->load->model('model_user');
        $username = trim($this->input->post('username'));
        $password = md5(trim($this->input->post('password')));
        $user = $this->model_user->login($username, $password);

        if (!empty($user)) {
            $this->session->set_userdata('id', $user->id);
            $this->session->set_userdata('name', $user->name);
            $this->session->set_userdata('department', $user->departmentid);
            $this->session->set_userdata('optiongroup', $user->optiongroup);
            redirect('../');
        } else {
            $msg = "User and Password Faild!";
            $this->session->set_userdata('msg', $msg);
            redirect('../');
        }
    }

    function logout() {
        $this->session->unset_userdata('id');
        redirect('../');
    }

    function check_session() {
        if ($this->session->userdata('id')) {
            echo "0";
        } else {
            echo "1";
        }
    }

    function information() {
        $this->load->view('users/information');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */