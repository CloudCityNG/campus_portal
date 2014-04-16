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
    }

    public function index() {
        $this->admin_layout->setField('page_title', 'Entrance Exam');
        $this->admin_layout->view('admission/eet/list');
    }

    function getJsonList() {
        $this->load->library('datatable');
        $this->datatable->aColumns = array('form_number, hall_ticket, CONCAT(firstname, " ", lastname) AS student_name, marks, mark_id');
        $this->datatable->eColumns = array('student_basic_info.student_id');
        $this->datatable->sIndexColumn = "student_basic_info.student_id";
        $this->datatable->sTable = " student_basic_info";
        $this->datatable->myWhere = 'LEFT JOIN entrance_exam_marks  ON student_basic_info.student_id = entrance_exam_marks.student_id Where student_basic_info.status=2 order by student_basic_info.student_id desc';
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();

            $temp_arr[] = ucwords($aRow['student_name']);
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
