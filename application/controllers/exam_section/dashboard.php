<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_layout->setLayout('template/layout_exam_section');

        $session = $this->session->userdata('admin_session');
        if (empty($session) && $session->type != 'exam_section') {
            $this->session->set_flashdata('error', 'Login First');
            redirect(base_url() . 'login', 'refresh');
        }
    }

    public function index() {
        $this->admin_layout->setField('page_title', 'Exam Section');
        $this->admin_layout->view('exam_section/dashobard');
    }

}
