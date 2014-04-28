<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class student extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_layout->setLayout('template/layout_hostel');

        $session = $this->session->userdata('admin_session');
        if (empty($session) && $session->type != 'hostel_section') {
            $this->session->set_flashdata('error', 'Login First');
            redirect(base_url() . 'login', 'refresh');
        }

        $this->load->model('courses_model');
        $this->load->model('student_basic_info_model');
        $this->load->model('studnet_images_model');
        $this->load->model('admission_details_model');
        $this->load->model('admission_candidate_status_model');
    }

    public function index() {
        $this->admin_layout->setField('page_title', 'Student List');

        $data['admission_details'] = $this->admission_details_model->getDistinctYear('PG');
        $data['course_details'] = $this->courses_model->getWhere(array('degree' => 'UG', 'status' => 'A'));
        $data['candidate_status_info'] = $this->admission_candidate_status_model->getWhere(array('status' => 'A'));

        $this->admin_layout->view('hostel/student/list', $data);
    }

    public function getListJson($year, $course) {
        $session = $this->session->userdata('admin_session');
        $this->load->library('datatable');

        $condition = '';
        if ($course != 0) {
            $condition .= ' AND student_basic_info.course_id=' . $course;
        }

        $this->datatable->aColumns = array('form_number', 'firstname', 'courses.name AS course_name', 'lastname', 'mobile_s');
        $this->datatable->eColumns = array('student_basic_info.student_id', 'gender', 'student_image',);
        $this->datatable->sIndexColumn = "student_basic_info.student_id";
        $this->datatable->sTable = " courses, admission_candidate_status, admission_details, student_basic_info";
        $this->datatable->myWhere = 'LEFT JOIN studnet_images ON studnet_images.student_id = student_basic_info.student_id WHERE student_basic_info.course_id = courses.course_id AND student_basic_info.status = admission_candidate_status.admission_status_id AND student_basic_info.admission_id=admission_details.admission_id AND hostel=\'Y\' AND admission_details.admission_year=' . $year . $condition;
        $this->datatable->sOrder = 'ORDER BY student_basic_info.student_id DESC';

        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();

            $url = 'assets/students/' . $aRow['student_id'] . '/' . $aRow['student_image'];
            if (!file_exists($url)) {
                if ($aRow['gender'] == 'M') {
                    $url = 'assets/images/no-male.png';
                } else {
                    $url = 'assets/images/no-female.png';
                }
            }
            $temp_arr[] = '<img src="' . base_url() . $url . '" class="img-responsive img-circle img-center" width="100"/>';


            $temp_arr[] = $aRow['form_number'];
            $temp_arr[] = ucwords($aRow['firstname']) . ' ' . ucwords($aRow['lastname']);
            $temp_arr[] = $aRow['course_name'];
            $temp_arr[] = $aRow['mobile_s'];
            $temp_arr[] = '';
            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

}
