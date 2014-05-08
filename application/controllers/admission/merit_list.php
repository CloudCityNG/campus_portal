<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class merit_list extends CI_Controller {

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
        $this->load->model('admission_details_model');
        $this->load->model('courses_model');
    }

    public function index() {
        $this->admin_layout->setField('page_title', 'Merit List');
        $data['admission_details'] = $this->admission_details_model->getDistinctYear('PG');
        $data['course_details'] = $this->courses_model->getWhere(array('entrance_exam' => 'Y', 'status' => 'A'));
        $this->admin_layout->view('admission/merit_list/list', $data);
    }

    function getJsonList($year, $course_id) {
        $session = $this->session->userdata('admin_session');
        $this->load->library('datatable');
        $course_details = $this->courses_model->getWhere(array('course_id' => $course_id));

        if ($course_details[0]->degree == 'UG') {
            $query = 'SELECT s.student_id, form_number, s.degree, CONCAT(firstname, " ", lastname) AS student_name, marks,(select pcb_percentage from student_edu_master where s.student_id=student_edu_master.student_id AND course ="H.S.C") AS PCB, (select pcbe_percentage from student_edu_master where s.student_id=student_edu_master.student_id AND course ="H.S.C")AS PCBE, (select total_percentage from student_edu_master where s.student_id=student_edu_master.student_id AND course ="H.S.C") AS HSC, (select total_percentage from student_edu_master where s.student_id=student_edu_master.student_id AND course ="S.S.C") AS SSC FROM student_basic_info s, entrance_exam_marks em, admission_details ad WHERE s.admission_id=ad.admission_id AND s.student_id=em.student_id AND (marks != "0.00" OR marks != null) AND ad.admission_year=' . $year . ' AND course_id=' . $course_id . ' ORDER BY marks DESC, PCB DESC, PCBE DESC, HSC DESC, SSC DESC';
            $this->datatable->datatable_process_merit_list($query);

            $i = 1;
            foreach ($this->datatable->rResult->result_array() as $aRow) {
                $temp_arr = array();

                if ($aRow['PCB'] > 49.99) {
                    $temp_arr[] = $i;
                    $temp_arr[] = ucwords($aRow['student_name']);
                    $temp_arr[] = $aRow['form_number'];
                    $temp_arr[] = getHallTicket($aRow['student_id'], $aRow['degree']);
                    $temp_arr[] = sprintf(round($aRow['marks'], 2) == intval($aRow['marks']) ? "%d" : "%.2f", $aRow['marks']);
                    $this->datatable->output['aaData'][] = $temp_arr;
                    $i++;
                }
            }
        } else {
            $query = 'SELECT s.student_id, form_number, s.degree, CONCAT(firstname, " ", lastname) AS student_name, marks FROM student_basic_info s, entrance_exam_marks em, admission_details ad WHERE s.admission_id=ad.admission_id AND s.student_id=em.student_id AND (marks != "0.00" OR marks != null) AND ad.admission_year=' . $year . ' AND course_id=' . $course_id . ' ORDER BY marks DESC';
            $this->datatable->datatable_process_merit_list($query);

            $i = 1;
            foreach ($this->datatable->rResult->result_array() as $aRow) {
                $temp_arr = array();
                    $temp_arr[] = $i;
                    $temp_arr[] = ucwords($aRow['student_name']);
                    $temp_arr[] = $aRow['form_number'];
                    $temp_arr[] = getHallTicket($aRow['student_id'], $aRow['degree']);
                    $temp_arr[] = sprintf(round($aRow['marks'], 2) == intval($aRow['marks']) ? "%d" : "%.2f", $aRow['marks']);
                    $this->datatable->output['aaData'][] = $temp_arr;
                    $i++;
            }
        }

        echo json_encode($this->datatable->output);
        exit();
    }

    function print_merit_list($year, $course_id) {
        $course_details = $this->courses_model->getWhere(array('course_id' => $course_id));
        $data['table_data'] = $this->entrance_exam_marks_model->getMeritList($year, $course_id, $course_details[0]->degree);
        $data['year'] = $year;
        $data['course'] = $course_details[0]->name;
        $data['degree'] = $course_details[0]->degree;
        $this->load->view('admission/merit_list/print_list', $data);
    }

}
