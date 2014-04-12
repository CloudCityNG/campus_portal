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
        $this->load->model('student_basic_info_model');
        $this->load->model('student_edu_master_model');
        $this->load->model('student_edu_details_model');
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
        $obj = new student_basic_info_model();

        $center_p1 = $this->input->post('p1');
        $center_p2 = $this->input->post('p2');
        $center_p3 = $this->input->post('p3');

        $obj->form_number = $obj->generateFormNumber($this->input->post('cid'));
        $obj->hall_ticket = $obj->generateHallTicketNumber($center_p1[0]);
        $obj->course_id = $this->input->post('cid');
        $obj->center_pref_1 = $center_p1[0];
        $obj->center_pref_2 = $center_p2[0];
        $obj->center_pref_3 = $center_p3[0];
        $obj->firstname = $this->input->post('firstname');
        $obj->middlename = ($this->input->post('middlename') == '') ? NULL : $this->input->post('middlename     ');
        $obj->lastname = $this->input->post('lastname');
        $obj->address = $this->input->post('address');
        $obj->pincode = $this->input->post('pincode');
        $obj->phone_no = ($this->input->post('phone_no') == '') ? NULL : $this->input->post('phone_no');
        $obj->mobile_no = $this->input->post('mobile_no');
        $obj->gender = $this->input->post('gender');
        $obj->email = $this->input->post('email');
        $obj->parent_1 = $this->input->post('parent_1');
        $obj->parent_1_occupation = $this->input->post('parent_1_occupation');
        $obj->parent_2 = $this->input->post('parent_2');
        $obj->dob = date('Y-m-d', strtotime($this->input->post('dob')));
        $obj->marital_status = $this->input->post('marital_status');
        $obj->nationality = $this->input->post('nationality');
        $obj->religion = $this->input->post('religion');
        $obj->community = ($this->input->post('community') == '') ? NULL : $this->input->post('community');
        $obj->category = ($this->input->post('category') == '') ? NULL : $this->input->post('category');
        $obj->hostel = $this->input->post('hostel');
        $obj->transoprt = $this->input->post('transoprt');
        $obj->status = 'A';
        $obj->create_id = $obj->form_number;
        $obj->create_date_time = get_current_date_time()->get_date_time_for_db();
        $obj->modify_id = $obj->form_number;
        $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();

        $student_id = $obj->insertData();
        if (!empty($student_id)) {
            $this->session->set_flashdata('success', 'Data Inserted Successfully');
            redirect(ADMISSION_URL . 'forms/edit_ug/' . $student_id . '/edu_info', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Error in inserting the Data');
            redirect(ADMISSION_URL . 'forms/add_ug', 'refresh');
        }
    }

    function editUGForm($student_id, $tab) {
        $this->admin_layout->setField('page_title', 'UG Admission');

        $data['tab'] = $tab;
        $data['student_id'] = $student_id;
        $data['course_details'] = $this->courses_model->getWhere(array('degree' => 'UG', 'status' => 'A'));
        $data['center_details'] = $this->exam_centers_model->getWhere(array('status' => 'A'));

        $data['basic_info'] = $this->student_basic_info_model->getWhere(array('student_id' => $student_id));
        $data['edu_master_info'] = $this->student_edu_master_model->getWhere(array('student_id' => $student_id));
        if (!empty($data['edu_master_info'])) {
            $data['edu_detail_info'] = $this->student_edu_details_model->getWhere(array('edu_master_id' => $data['edu_master_info'][0]->edu_master_id));
        }

        $this->admin_layout->view('admission/forms/edit', $data);
    }

    function updateUGForm($student_id, $tab) {
        var_dump($_POST);
    }

}
