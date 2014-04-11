<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class forms extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_layout->setLayout('template/layout_admission');


        $session = $this->session->userdata('admin_session');
        if (empty($session) && $session->type != 'admission') {
            $this->session->set_flashdata('error', 'Login First');
            redirect(base_url() . 'login', 'refresh');
        }

        //$this->output->enable_profiler(TRUE);

        $this->load->model('courses_model');
        $this->load->model('exam_centers_model');
    }

    public function index() {
        $this->admin_layout->setField('page_title', 'Admission Section');

        $session = $this->session->userdata('admin_session');
        if (empty($session) && $session->type != 'admin') {
            $this->session->flashdata('error', 'Please Login First');
            redirect(base_url() . 'login', 'refresh');
        } else {
            $this->admin_layout->view('admission/forms/list');
        }
    }

    public function getListJson() {
        $session = $this->session->userdata('admin_session');
        $this->load->library('datatable');
        $this->datatable->aColumns = array('form_number, hall_ticket, CONCAT(firstname, " ", middlename, " ", lastname) AS student_name, courses.name AS course_name, admission_candidate_status.name AS status_name');
        $this->datatable->eColumns = array('student_id');
        $this->datatable->sIndexColumn = "student_id";
        $this->datatable->sTable = " student_basic_info, courses, admission_candidate_status";
        $this->datatable->myWhere = 'WHERE student_basic_info.course_id = courses.course_id AND student_basic_info.status = admission_candidate_status.admission_status_id';
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();

            $temp_arr[] = $aRow['form_number'];
            $temp_arr[] = $aRow['hall_ticket'];
            $temp_arr[] = $aRow['student_name'];
            $temp_arr[] = $aRow['course_name'];
            $temp_arr[] = $aRow['status_name'];

            if ($session->role == 3) {
                $temp_arr[] = '<a href="#"  class="icon-edit" id="' . $aRow['student_id'] . '"></a> &nbsp; <a href="javascript:;" onclick="deleteRow(this)" class="deletepage icon-trash" id="' . $aRow['student_id'] . '"></a>';
            }

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    function addUGNewForm() {
        $this->admin_layout->setField('page_title', 'UG New Admission');
        
        $data['course_details'] = $this->courses_model->getWhere(array('degree' => 'UG', 'status' => 'A'));
        $data['center_details'] = $this->exam_centers_model->getWhere(array('status' => 'A'));
        $this->admin_layout->view('admission/forms/add', $data);
    }

    function saveUGNewForm() {
        var_dump($_POST);
    }

}
