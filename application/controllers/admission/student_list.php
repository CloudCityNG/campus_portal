<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class student_list extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_layout->setLayout('template/layout_admission');

        $session = $this->session->userdata('admin_session');
        if (empty($session) || $session->type != 'admission') {
            $this->session->set_flashdata('error', 'Login First');
            redirect(base_url() . 'login', 'refresh');
        }

        $this->load->model('courses_model');
        $this->load->model('student_basic_info_model');
        $this->load->model('admission_details_model');
        $this->load->model('admission_candidate_status_model', 'acsm');
    }

    public function index() {
        $this->admin_layout->setField('page_title', 'Student List');
        $data['admission_details'] = $this->admission_details_model->getDistinctYear();
        $data['course_details'] = $this->courses_model->getWhere(array('status' => 'A'));
        $data['candidate_status_info'] = $this->acsm->getWhere(array('status' => 'A'));
        $this->admin_layout->view('admission/student_list/list', $data);
    }

    function getPGCourseSpecialization($course_id) {
        $this->load->model('course_specialization_model');
        $records = $this->course_specialization_model->getWhere(array('course_id' => $course_id));
        var_dump($records);
        if (!empty($records)) {
            echo '<option value="0">None</option>';
            foreach ($records as $value) {
                echo '<option value="' . $value->course_special_id . '">' . $value->name . '</option>';
            }
        } else {
            echo '<option value="0">None</option>';
        }
    }

    function getList($year, $course, $course_specialization, $status, $degree) {
        $this->load->library('datatable');
        $condition = '';
        if ($status != 0) {
            $condition .= ' AND s.status= ' . $status;
        }

        if ($degree == 'PG_OTHER' || $degree == 'Certificate') {
            if ($course_specialization != 0) {
                $condition .= ' AND cs.course_special_id= ' . $course_specialization;
            }
            $table = " student_basic_info s, admission_details ad, admission_candidate_status, student_basic_pg_other_details spod, course_specialization cs";

            $where = 'WHERE s.status =admission_candidate_status.admission_status_id AND s.admission_id=ad.admission_id AND s.student_id=spod.student_id AND spod.course_special_id = cs.course_special_id AND ad.admission_year=' . $year . ' AND s.course_id=' . $course . ' ' . $condition;
        } else if ($degree == 'PG' || $degree == 'SS' || $degree == 'Diploma') {
            if ($course_specialization != 0) {
                $condition .= ' AND cs.course_special_id= ' . $course_specialization;
            }
            $table = " student_basic_info s, admission_details ad, admission_candidate_status, student_basic_pg_details spd, course_specialization cs";

            $where = 'WHERE s.status =admission_candidate_status.admission_status_id AND s.admission_id=ad.admission_id AND s.student_id=spd.student_id AND spd.course_special_id = cs.course_special_id AND ad.admission_year=' . $year . ' AND s.course_id=' . $course . ' ' . $condition;
        } else {
            $table = " student_basic_info s, admission_details ad, admission_candidate_status";
            $where = 'WHERE s.status =admission_candidate_status.admission_status_id AND s.admission_id=ad.admission_id AND ad.admission_year=' . $year . ' AND s.course_id=' . $course . ' ' . $condition;
        }

        $this->datatable->aColumns = array('form_number', 'firstname', 'lastname', 'mobile_s', 'email_s', 'mobile_p', 'email_p', 'admission_candidate_status.name AS status');
        $this->datatable->eColumns = array('s.student_id');
        $this->datatable->sIndexColumn = "s.student_id";
        $this->datatable->sTable = $table;
        $this->datatable->myWhere = $where;
        $this->datatable->sOrder = ' ORDER BY student_id ASC';
        $this->datatable->datatable_process();
        return $this->datatable->rResult->result_array();
    }

    function getJsonList($year, $course, $course_specialization, $status, $degree) {
        $data = $this->getList($year, $course, $course_specialization, $status, $degree);
        $i = 1;
        foreach ($data as $aRow) {
            $temp_arr = array();
            $temp_arr[] = $i;
            $temp_arr[] = $aRow['form_number'];
            $temp_arr[] = ucwords($aRow['firstname']) . ' ' . ucwords($aRow['lastname']);
            $temp_arr[] = $aRow['mobile_s'];
            $temp_arr[] = $aRow['email_s'];
            $temp_arr[] = $aRow['mobile_p'];
            $temp_arr[] = $aRow['email_p'];
            $temp_arr[] = $aRow['status'];
            $this->datatable->output['aaData'][] = $temp_arr;
            $i++;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    function print_student_list($year, $course, $course_specialization, $status, $degree) {
        if (is_numeric($year) && is_numeric($course) && is_numeric($status)) {
            $data['table_data'] = $this->student_basic_info_model->getStudentList($year, $course, $course_specialization, $status, $degree);
            $data['year'] = $year;
            $data['course_details'] = $this->courses_model->getWhere(array('course_id' => $course, 'degree' => 'UG', 'status' => 'A'));
            $this->load->view('admission/student_list/print_list', $data);
        } else {
            $this->session->set_flashdata('error', 'Do not Change the URL.');
            redirect(ADMISSION_URL . 'list', 'refresh');
        }
    }

}
