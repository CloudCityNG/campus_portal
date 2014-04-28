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
                switch ($result[0]->dept_id) {
                    case 1:
                        $this->__redirect('admission', $result, ADMISSION_URL);
                    case 2:
                        $this->__redirect('exam_section', $result, EXAM_SECTION_URL);
                    case 3:
                        $this->__redirect('hostel_section', $result, HOSTEL_URL);
                    case 4:
                        $this->__redirect('student_section', $result, STUDENT_SECTION_URL);
                    default:
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

    function __redirect($type, $result, $url) {
        $result[0]->type = $type;
        $result[0]->logged_in = TRUE;
        $newdata = array('admin_session' => $result[0]);
        $this->session->set_userdata($newdata);
        redirect($url, 'refresh');
    }

    function logout() {
        $this->session->unset_userdata('admin_session');
        redirect(base_url() . 'login', 'refresh');
    }

}
