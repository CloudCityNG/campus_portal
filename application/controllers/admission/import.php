<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class import extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_layout->setLayout('template/layout_admission');


        $session = $this->session->userdata('admin_session');
        if (empty($session) && $session->type != 'admission') {
            $this->session->set_flashdata('error', 'Login First');
            redirect(base_url() . 'login', 'refresh');
        }

        $this->load->model('student_basic_info_model');
        $this->load->model('student_basic_ug_details_model');
        $this->load->model('student_edu_master_model');
        $this->load->model('student_edu_details_model');
        $this->load->model('student_foregin_details_model');
        $this->load->model('student_basic_pg_other_details_model');
        $this->load->model('student_edu_pg_other_model');
        $this->load->model('student_basic_pg_details_model');
        $this->load->model('student_edu_pg_model');
        $this->load->model('admission_details_model');
    }

    function index() {
        $this->admin_layout->setField('page_title', 'Admission Section');

        $session = $this->session->userdata('admin_session');
        if (empty($session) && $session->type != 'admin') {
            $this->session->flashdata('error', 'Please Login First');
            redirect(base_url() . 'login', 'refresh');
        } else {
            $this->admin_layout->view('admission/import/index');
        }
    }

    function fetchDataFromExcel() {
        $pathToFile = $_FILES['excel_file']['tmp_name'];
        $this->load->helper('excel/php_to_excel');
        includeExcelClasses();
        $objPHPExcel = PHPExcel_IOFactory::load($pathToFile);
        $array = $objPHPExcel->getActiveSheet()->toArray();
        if ($this->input->post('degree') == 'UG') {
            $count = $this->importUGData($array);
            $this->session->flashdata('success', $count . ' records are imported');
            redirect(ADMISSION_URL . 'import', 'refresh');
        } else if ($this->input->post('degree') == 'PG') {
            
        } else if ($this->input->post('degree') == 'PG_OTHER') {
            
        } else {
            $this->session->flashdata('error', 'Select any From');
            redirect(ADMISSION_URL . 'import', 'refresh');
        }
    }

    function processInput($input) {
        if (is_int($input) || is_integer($input) || is_float($input)) {
            return trim($input);
        } else {
            return ucwords(trim($input));
        }
    }

    function importUGData($all_data) {
        $count = 0;
        foreach ($all_data as $data) {
            if (!empty($data[0])) {
                $obj = new student_basic_info_model();
                $obj->admission_id = $this->processInput($data[2]);
                $obj->degree = 'UG';
                $obj->form_number = $obj->generateFormNumber($this->processInput($data[3]), date('y', strtotime(get_current_date_time()->year)), get_current_date_time()->month, get_current_date_time()->day);
                $obj->course_id = $this->processInput($data[3]);
                $obj->firstname = $this->processInput($data[8]);
                $obj->middlename = $this->processInput($data[9]);
                $obj->lastname = $this->processInput($data[7]);
                $obj->address = $this->processInput($data[10]);
                $obj->pincode = $this->processInput($data[11]);
                $obj->mobile_s = $this->processInput($data[13]);
                $obj->mobile_p = $this->processInput($data[12]);
                $obj->gender = $this->processInput($data[16]);
                $obj->email_p = NULL;
                $obj->email_s = $this->processInput($data[15]);
                $obj->parent_1 = $this->processInput($data[18]);
                $obj->parent_1_occupation = $this->processInput($data[19]);
                $obj->parent_2 = $this->processInput($data[10]);
                $obj->dob = date('Y-m-d', strtotime($this->processInput($data[14])));
                $obj->marital_status = $this->processInput($data[17]);
                $obj->nationality = $this->processInput($data[21]);
                $obj->religion = $this->processInput($data[22]);
                $obj->community = $this->processInput($data[23]);
                if ($this->processInput($data[24]) == 'G') {
                    $obj->category = 'General';
                } else {
                    $obj->category = $this->processInput($data[24]);
                }
                $obj->hostel = $this->processInput($data[25]);
                $obj->transoprt = $this->processInput($data[26]);
                $obj->status = 5;

                $session = $this->session->userdata('admin_session');
                $obj->create_id = $session->admin_id;
                $obj->create_date_time = get_current_date_time()->get_date_time_for_db();
                $obj->modify_id = $session->admin_id;
                $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();

                $student_id = $obj->insertData();

                if (!empty($student_id)) {
                    $count++;
                    $obj_details = new student_basic_ug_details_model();
                    $obj_details->student_id = $student_id;
                    $obj_details->hallticket = $this->processInput($data[1]);
                    $obj_details->center_pref_1 = $this->processInput($data[4]);
                    $obj_details->center_pref_2 = $this->processInput($data[5]);
                    $obj_details->center_pref_3 = $this->processInput($data[6]);
                    $obj_details->create_id = $session->admin_id;
                    $obj_details->create_date_time = get_current_date_time()->get_date_time_for_db();
                    $obj_details->modify_id = $session->admin_id;
                    $obj_details->modify_date_time = get_current_date_time()->get_date_time_for_db();
                    $obj_details->insertData();


                    $obj_master = new student_edu_master_model();
                    $obj_master->student_id = $student_id;
                    $obj_master->course = 'S.S.C';
                    $obj_master->year = $this->processInput($data[27]);
                    $obj_master->uni_institute = $this->processInput($data[28]);
                    $obj_master->board = $this->processInput($data[29]);
                    $obj_master->pcb_percentage = '0.00';
                    $obj_master->pcbe_percentage = '0.00';
                    $obj_master->total_percentage = $this->processInput($data[30]);
                    $obj_master->rank = $this->processInput($data[31]);
                    $obj_master->result_wating = 'N';
                    $obj_master->create_id = $session->admin_id;
                    $obj_master->create_date_time = get_current_date_time()->get_date_time_for_db();
                    $obj_master->modify_id = $session->admin_id;
                    $obj_master->modify_date_time = get_current_date_time()->get_date_time_for_db();
                    $obj_master->insertData();

                    $obj_master->student_id = $student_id;
                    $obj_master->course = 'H.S.C';
                    $obj_master->year = $this->processInput($data[32]);
                    $obj_master->uni_institute = $this->processInput($data[33]);
                    $obj_master->board = $this->processInput($data[34]);
                    $pcb_max = $data[38] + $data[40] + $data[42] + $data[44] + $data[46] + $data[48];
                    $pcb_min = $data[37] + $data[39] + $data[41] + $data[43] + $data[45] + $data[47];
                    if ($pcb_max != 0 && $pcb_min != 0) {
                        $obj_master->pcb_percentage = (float) (($pcb_min) / ($pcb_max)) * (int) 100;
                    } else {
                        $obj_master->pcb_percentage = '0.00';
                    }
                    $obj_master->pcbe_percentage = '0.00';
                    $obj_master->total_percentage = $this->processInput($data[35]);
                    $obj_master->rank = $this->processInput($data[36]);
                    $obj_master->result_wating = 'N';
                    $obj_master->create_id = $session->admin_id;
                    $obj_master->create_date_time = get_current_date_time()->get_date_time_for_db();
                    $obj_master->modify_id = $session->admin_id;
                    $obj_master->modify_date_time = get_current_date_time()->get_date_time_for_db();
                    $edu_master_id = $obj_master->insertData();

                    if (!empty($edu_master_id)) {
                        $obj_edu = new student_edu_details_model();
                        $obj_edu->edu_master_id = $edu_master_id;
                        $obj_edu->subject = 'Physics';
                        $obj_edu->theory_max_mark = $this->processInput($data[37]);
                        $obj_edu->theory_min_mark = $this->processInput($data[38]);
                        $obj_edu->pratical_max_mark = $this->processInput($data[39]);
                        $obj_edu->pratical_min_mark = $this->processInput($data[40]);
                        $obj_edu->total_min_mark = $this->processInput($data[38]) + $this->processInput($data[40]);
                        $obj_edu->total_max_mark = $this->processInput($data[37]) + $this->processInput($data[39]);
                        $obj_edu->create_id = $session->admin_id;
                        $obj_edu->create_date_time = get_current_date_time()->get_date_time_for_db();
                        $obj_edu->modify_id = $session->admin_id;
                        $obj_edu->modify_date_time = get_current_date_time()->get_date_time_for_db();
                        $obj_edu->insertData();

                        $obj_edu->edu_master_id = $edu_master_id;
                        $obj_edu->subject = 'Chemistry';
                        $obj_edu->theory_max_mark = $this->processInput($data[41]);
                        $obj_edu->theory_min_mark = $this->processInput($data[42]);
                        $obj_edu->pratical_max_mark = $this->processInput($data[43]);
                        $obj_edu->pratical_min_mark = $this->processInput($data[44]);
                        $obj_edu->total_min_mark = $this->processInput($data[42]) + $this->processInput($data[44]);
                        $obj_edu->total_max_mark = $this->processInput($data[41]) + $this->processInput($data[43]);
                        $obj_edu->create_id = $session->admin_id;
                        $obj_edu->create_date_time = get_current_date_time()->get_date_time_for_db();
                        $obj_edu->modify_id = $session->admin_id;
                        $obj_edu->modify_date_time = get_current_date_time()->get_date_time_for_db();
                        $obj_edu->insertData();

                        $obj_edu->edu_master_id = $edu_master_id;
                        $obj_edu->subject = 'Biology';
                        $obj_edu->theory_max_mark = $this->processInput($data[45]);
                        $obj_edu->theory_min_mark = $this->processInput($data[46]);
                        $obj_edu->pratical_max_mark = $this->processInput($data[47]);
                        $obj_edu->pratical_min_mark = $this->processInput($data[48]);
                        $obj_edu->total_min_mark = $this->processInput($data[46]) + $this->processInput($data[48]);
                        $obj_edu->total_max_mark = $this->processInput($data[45]) + $this->processInput($data[47]);
                        $obj_edu->create_id = $session->admin_id;
                        $obj_edu->create_date_time = get_current_date_time()->get_date_time_for_db();
                        $obj_edu->modify_id = $session->admin_id;
                        $obj_edu->modify_date_time = get_current_date_time()->get_date_time_for_db();
                        $obj_edu->insertData();
                    }
                }
            }
        }

        return $count;
    }

    function importPGOtherData($data) {
        
    }

    function importPGData($data) {
        
    }

}
