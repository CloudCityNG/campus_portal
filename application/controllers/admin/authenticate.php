<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class authenticate extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_layout->setLayout('admin/template/layout_login');
        $this->admin_layout->setField('page_title', 'Admin Login');

        $this->load->model('admin_user_model');
        $this->load->model('department_model');
    }

    public function index() {
        $data['department_details'] = $this->department_model->getAll();
        $this->admin_layout->view('admin/authenticate/login', $data);
    }

    function validateUser() {
        $result = $this->admin_user_model->check_login();
        if (is_array($result)) {
            if ($result[0]->status == 'A') {
                $newdata = array('admin_session' => $result[0], 'logged_in' => TRUE, 'type' => 'Admin');
                $this->session->set_userdata($newdata);
                if ($result[0]->dept_id == 1) {
                    redirect(ADMIN_URL . 'admission', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Department Does not Exit');
                    redirect(ADMIN_URL . 'login', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Account is not Active. Contact It Deptarment (Ext. 456)');
                redirect(ADMIN_URL . 'login', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid Username or Password');
            redirect(ADMIN_URL . 'login', 'refresh');
        }
    }

    function logout() {
        $this->session->unset_userdata('admin_session');
        redirect(ADMIN_URL . 'login', 'refresh');
    }

}
