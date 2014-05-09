<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admission_confirm extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_layout->setLayout('template/layout_student_section');

        $session = $this->session->userdata('admin_session');
        if (empty($session) && $session->type != 'student_section') {
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
        $this->admin_layout->setField('page_title', 'Admission Confirmed');
        $this->admin_layout->view('student_section/admission_confirm/index');
    }

    function getStudentList() {
        $res = $this->student_basic_info_model->getStudentDetails($_GET['term'], 4);
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

        if ($data['basic_info'][0]->status == 4) {
            $data['student_id'] = $student_id;
            $data['course_details'] = $this->courses_model->getWhere(array('degree' => 'UG', 'status' => 'A'));
            $data['candidate_status_info'] = $this->acsm->getWhere(array('status' => 'A'), NULL, NULL, 'ASC');
            $data['merit_info'] = $this->eemm->getWhere(array('student_id' => $student_id));
            $data['edu_master_info'] = $this->student_edu_master_model->getWhere(array('student_id' => $student_id));
            $data['image_details'] = $this->studnet_images_model->getWhere(array('student_id' => $student_id));

            echo $this->load->view('student_section/admission_confirm/student_history', $data, true);
        } else {
            $this->session->set_flashdata('error', 'Student Status is not Set to Admission Order');
            redirect(STUDENT_SECTION_URL . 'confirm', 'refresh');
        }
    }

    function updateStudentDetails($student_id) {
        $obj = new student_basic_info_model();
        $basic_info = $obj->getWhere(array('student_id' => $student_id));
        if ($basic_info[0]->status == 4) {
            $obj->status = $this->input->post('admission_status_id');
            $obj->student_id = $student_id;

            $session = $this->session->userdata('admin_session');
            $obj->modify_id = $session->admin_id;
            $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();

            $obj->updateData();

            $this->session->set_flashdata('success', 'Admission is Confirmed');
            redirect(STUDENT_SECTION_URL . 'confirm', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Student Status is not Set to Admission Confirm');
            redirect(STUDENT_SECTION_URL . 'confirm', 'refresh');
        }
    }

}
