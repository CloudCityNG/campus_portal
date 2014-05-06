<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class profile extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_layout->setLayout('template/layout_student_section');

        $session = $this->session->userdata('admin_session');
        if (empty($session) || $session->type != 'student_section') {
            $this->session->set_flashdata('error', 'Login First');
            redirect(base_url() . 'login', 'refresh');
        }

        $this->load->model('admin_user_model');
    }

    public function index() {
        $session = $this->session->userdata('admin_session');
        $data['profile'] = $this->admin_user_model->getWhere(array('admin_id' => $session->admin_id));
        $this->admin_layout->view('student_section/profile/edit_profile', $data);
    }

    function checkusername() {
        $session = $this->session->userdata('admin_session');
        $get = $this->admin_user_model->getWhere(array('username' => urldecode($_GET['username'])));
        if ($get !== FALSE && count($get) == 1 && $get[0]->admin_id != $session->admin_id) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    function checkemail() {
        $session = $this->session->userdata('admin_session');
        $get = $this->admin_user_model->getWhere(array('email_address' => urldecode($_GET['email_address'])));
        if ($get !== FALSE && count($get) == 1 && $get[0]->admin_id != $session->admin_id) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    function checkOldPassword() {
        $session = $this->session->userdata('admin_session');
        $get = $this->admin_user_model->getWhere(array('admin_id' => $session->admin_id, 'password' => md5($_GET['old_password'])));

        if ($get !== FALSE && count($get) == 1) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function updateProfile() {
        $obj = new admin_user_model();

        $obj->username = $this->input->post('username');
        $obj->full_name = $this->input->post('full_name');
        $obj->email_address = $this->input->post('email_address');
        $session = $this->session->userdata('admin_session');
        $obj->admin_id = $session->admin_id;
        $check = $obj->updateData();

        $result = $obj->getWhere(array('admin_id' => $session->admin_id));
        $result[0]->type = 'student_section';
        $result[0]->logged_in = TRUE;
        $newdata = array('admin_session' => $result[0]);
        $this->session->set_userdata($newdata);

        if ($check == true) {
            $this->session->set_flashdata('success', 'Update the your profile Successfully');
        } else {
            $this->session->set_flashdata('error', 'Error while Editing your profile');
        }

        redirect(STUDENT_SECTION_URL . 'profile', 'refresh');
    }

    function updatePassword() {
        $obj = new admin_user_model();

        $obj->password = md5($this->input->post('password'));
        $session = $this->session->userdata('admin_session');
        $obj->admin_id = $session->admin_id;
        $check = $obj->updateData();

        if ($check == true) {
            $this->session->set_flashdata('success', 'Password Change Successfuly');
        } else {
            $this->session->set_flashdata('error', 'Error while changing Password');
        }

        redirect(STUDENT_SECTION_URL, 'refresh');
    }

    function changePassword() {
        $this->admin_layout->view('student_section/profile/change_password');
    }

}
