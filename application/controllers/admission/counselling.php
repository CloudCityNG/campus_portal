<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class counselling extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_layout->setLayout('template/layout_admission');


        $session = $this->session->userdata('admin_session');
        if (empty($session) || $session->type != 'admission') {
            $this->session->set_flashdata('error', 'Login First');
            redirect(base_url() . 'login', 'refresh');
        }

        $this->load->model('entrance_exam_marks_model', 'eemm');
        $this->load->model('courses_model');
        $this->load->model('student_basic_info_model');
        $this->load->model('student_edu_master_model');
        $this->load->model('studnet_images_model');
        $this->load->model('admission_details_model');
        $this->load->model('admission_candidate_status_model', 'acsm');
    }

    public function index() {
        $this->admin_layout->setField('page_title', 'Student Counselling');
        $data['basic_info'] = $this->student_basic_info_model->getWhere(array('student_id' => $this->input->post('student_id')));
        $this->admin_layout->view('admission/counselling/index', $data);
    }

    function getStudentList() {
        $res = $this->student_basic_info_model->getStudentDetails($_GET['term'], 3);
        $customers = array();
        foreach ($res as $r) {
            $temp = array();
            $temp['value'] = $r->student_id;
            $temp['label'] = $r->firstname . ' ' . $r->lastname . ' (' . $r->form_number . ')';
            $customers[] = $temp;
        }
        echo json_encode($customers);
    }

    function getStudentHistory($student_id) {
        $this->admin_layout->setField('page_title', 'Student History');
        $data['basic_info'] = $this->student_basic_info_model->getWhere(array('student_id' => $student_id));

        if ($data['basic_info'][0]->status == 3) {
            $data['student_id'] = $student_id;
            $data['course_details'] = $this->courses_model->getWhere(array('degree' => 'UG', 'status' => 'A'));
            $data['candidate_status_info'] = $this->acsm->getWhere(array('status' => 'A'));
            $data['merit_info'] = $this->eemm->getWhere(array('student_id' => $student_id));
            $data['edu_master_info'] = $this->student_edu_master_model->getWhere(array('student_id' => $student_id));
            $data['image_details'] = $this->studnet_images_model->getWhere(array('student_id' => $student_id));

            $this->admin_layout->view('admission/counselling/student_history', $data);
        } else {
            $this->session->set_flashdata('error', 'Student Status is not Set to Counselling');
            redirect(ADMISSION_URL . 'counselling', 'refresh');
        }
    }

    function updateStudentDetails($student_id) {
        $obj = new student_basic_info_model();
        $basic_info = $obj->getWhere(array('student_id' => $student_id));
        if ($basic_info[0]->status == 3) {
            if ($this->input->post('course_id') != $basic_info[0]->course_id) {
                $course = $this->courses_model->getWhere(array('course_id' => $this->input->post('course_id')));
                $obj->form_number = substr($basic_info[0]->form_number, 0, 4) . $course[0]->short_code . substr($basic_info[0]->form_number, 6);
                $obj->course_id = $this->input->post('course_id');
            }

            $obj->status = $this->input->post('admission_status_id');
            $session = $this->session->userdata('admin_session');
            $obj->modify_id = $session->admin_id;
            $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();
            $obj->student_id = $student_id;
            $obj->updateData();

            $this->session->set_flashdata('success', 'Admission Order is Issue');
            redirect(ADMISSION_URL . 'counselling', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Student Status is not Set to Counselling');
            redirect(ADMISSION_URL . 'counselling', 'refresh');
        }
    }

}
