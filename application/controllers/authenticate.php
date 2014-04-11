<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class authenticate extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_layout->setLayout('template/layout_login');
        $this->admin_layout->setField('page_title', 'Admin Login');

        $this->load->model('admin_user_model');
        $this->load->model('department_model');
    }

    public function index() {
        $data['department_details'] = $this->department_model->getAll();
        $this->admin_layout->view('authenticate/login', $data);
    }

    function validateUser() {
        $result = $this->admin_user_model->check_login();
        if (is_array($result)) {
            if ($result[0]->status == 'A') {
                if ($result[0]->dept_id == 1) {
                    $result[0]->type = 'admission';
                    $result[0]->logged_in = TRUE;
                    $newdata = array('admin_session' => $result[0]);
                    $this->session->set_userdata($newdata);
                    redirect(ADMISSION_URL, 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Department Does not Exit');
                    redirect(base_url() . 'login', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Account is not Active. Contact It Deptarment (Ext. 456)');
                redirect(base_url() . 'login', 'refresh');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid Username or Password');
            redirect(base_url() . 'login', 'refresh');
        }
    }

    function logout() {
        $this->session->unset_userdata('admin_session');
        redirect(base_url() . 'login', 'refresh');
    }

}
