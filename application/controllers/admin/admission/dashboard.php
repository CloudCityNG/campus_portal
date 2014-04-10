<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_layout->setLayout('admin/template/layout_admission');
        
        
        $session = $this->session->userdata('admin_session');
        if (empty($session)) {
            $this->session->set_flashdata('error', 'Login First');
            redirect(ADMIN_URL . 'login', 'refresh');
        }
    }

    public function index() {
        $this->admin_layout->setField('page_title', 'Admission Section');
        
        $session = $this->session->userdata('admin_session');
        if (empty($session) && $session->type != 'admin') {
            $this->session->flashdata('error', 'Please Login First');
            redirect(ADMIN_URL . 'login', 'refresh');
        } else {
            $this->admin_layout->view('admin/admission/dashobard');
        }
    }

}
