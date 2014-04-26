<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class eet extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_layout->setLayout('template/layout_admission');


        $session = $this->session->userdata('admin_session');
        if (empty($session) || $session->type != 'admission') {
            $this->session->set_flashdata('error', 'Login First');
            redirect(base_url() . 'login', 'refresh');
        }

        $this->load->model('entrance_exam_marks_model');
        $this->load->model('student_basic_info_model');
        $this->load->model('admission_candidate_status_model');
        $this->load->model('admission_details_model');
        $this->load->model('courses_model');
    }

    public function index() {
        $this->admin_layout->setField('page_title', 'Entrance Exam');

        $data['admission_details'] = $this->admission_details_model->getDistinctYear('PG');
        $data['course_details'] = $this->courses_model->getWhere(array('degree' => 'UG', 'status' => 'A'));
        $data['candidate_status_info'] = $this->admission_candidate_status_model->getWhere(array('status' => 'A'));

        $this->admin_layout->view('admission/eet/list', $data);
    }

    function getJsonList($year, $course, $status) {
        $this->load->library('datatable');

        $condition = '';
        if ($status != 0) {
            $condition .= ' AND student_basic_info.status= ' . $status;
        }

        if ($course != 0) {
            $condition .= ' AND student_basic_info.course_id=' . $course;
        } else {
            $condition .= ' AND student_basic_info.status != 1';
        }

        $this->datatable->aColumns = array('form_number', 'hall_ticket', 'firstname', 'lastname', 'marks', 'mark_id');
        $this->datatable->eColumns = array('student_basic_info.student_id');
        $this->datatable->sIndexColumn = "student_basic_info.student_id";
        $this->datatable->sTable = " courses, admission_candidate_status, admission_details, student_basic_info";
        $this->datatable->myWhere = 'LEFT JOIN entrance_exam_marks  ON student_basic_info.student_id = entrance_exam_marks.student_id Where student_basic_info.course_id = courses.course_id AND student_basic_info.status = admission_candidate_status.admission_status_id AND student_basic_info.admission_id=admission_details.admission_id AND admission_details.admission_year=' . $year . $condition . ' ORDER BY student_basic_info.student_id DESC';
        
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();

            $temp_arr[] = ucwords($aRow['firstname']) . ' ' . ucwords($aRow['lastname']);
            $temp_arr[] = $aRow['form_number'];
            $temp_arr[] = $aRow['hall_ticket'];
            $temp_arr[] = $aRow['marks'];
            $temp_arr[] = '<a data-target="#update_student_marks" data-toggle="modal" href="' . ADMISSION_URL . 'eet/edit_marks/' . $aRow['student_id'] . '" class="icon-edit"></a>';

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    function editMarks($student_id) {
        $data['basic_info'] = $this->student_basic_info_model->getWhere(array('student_id' => $student_id));
        $data['details'] = $this->entrance_exam_marks_model->getWhere(array('student_id' => $student_id));
        $this->load->view('admission/eet/update_marks', $data);
    }

    function UpdateMarks($student_id) {
        $session = $this->session->userdata('admin_session');
        $obj = new entrance_exam_marks_model();

        $detail = $obj->getWhere(array('student_id' => $student_id));

        $obj->student_id = $student_id;
        $obj->marks = $this->input->post('marks');

        $obj_student = new student_basic_info_model();
        $basic_info = $obj_student->getWhere(array('student_id' => $student_id));

        if ($basic_info[0]->status == 2) {
            $obj_student->status = 3;
            $obj_student->student_id = $student_id;
            $obj->modify_id = $session->admin_id;
            $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();
            $obj_student->updateData();
        }

        if (empty($detail)) {
            $obj->create_id = $session->admin_id;
            $obj->create_date_time = get_current_date_time()->get_date_time_for_db();
            $obj->modify_id = $session->admin_id;
            $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();
            $obj->insertData();
        } else {
            $obj->modify_id = $session->admin_id;
            $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();
            $obj->mark_id = $detail[0]->mark_id;
            $obj->updateData();
        }

        redirect(ADMISSION_URL . 'eet', 'refresh');
    }

}
