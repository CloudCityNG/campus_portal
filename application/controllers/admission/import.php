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
            $this->session->set_flashdata('success', $count . ' records are imported');
            redirect(ADMISSION_URL . 'import', 'refresh');
        } else if ($this->input->post('degree') == 'PG') {
            $count = $this->importPGData($array);
            $this->session->set_flashdata('success', $count . ' records are imported');
            redirect(ADMISSION_URL . 'import', 'refresh');
        } else if ($this->input->post('degree') == 'PG_OTHER') {
            $count = $this->importPGOtherData($array);
            $this->session->set_flashdata('success', $count . ' records are imported');
            redirect(ADMISSION_URL . 'import', 'refresh');
        } else {
            $this->session->flashdata('error', 'Select any From');
            redirect(ADMISSION_URL . 'import', 'refresh');
        }
    }

    function processInput($input) {
        if (is_null($input) || $input == '') {
            return $input;
        } else if (is_int($input) || is_integer($input) || is_float($input)) {
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
                $obj->form_number = $obj->generateFormNumber($this->processInput($data[3]), date('y', strtotime('01-01-' . getYearByAdmissionID($this->processInput($data[2])))), get_current_date_time()->month, get_current_date_time()->day);
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
                $obj->parent_2 = $this->processInput($data[20]);
                if ($data[14] != 0) {
                    $obj->dob = date_format(date_create_from_format('d-m-y', $this->processInput($data[14])), 'Y-m-d');
                } else {
                    $obj->dob = '0000-00-00';
                }
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
                    $obj_master->total_percentage = $this->processInput(str_replace('%', '', $data[30]));
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
                    $obj_master->total_percentage = $this->processInput(str_replace('%', '', $data[35]));
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

    function importPGOtherData($all_data) {
        $student_id = 0;
        $count = 0;
        foreach ($all_data as $data) {
            if (empty($data[0]) && empty($data[28])) {
                continue;
            } else if (!empty($data[0])) {
                $obj = new student_basic_info_model();
                $obj->admission_id = $this->processInput($data[2]);
                $obj->form_number = $obj->generateFormNumber($this->processInput($data[3]), date('y', strtotime('01-01-' . getYearByAdmissionID($this->processInput($data[2])))), get_current_date_time()->month, get_current_date_time()->day);
                $obj->course_id = $this->processInput($data[3]);
                $obj->degree = 'PG_OTHER';
                $obj->firstname = $this->processInput($data[9]);
                $obj->middlename = $this->processInput($data[10]);
                $obj->lastname = $this->processInput($data[8]);
                $obj->address = $this->processInput($data[11]);
                $obj->pincode = $this->processInput($data[12]);
                $obj->mobile_p = $this->processInput($data[13]);
                $obj->mobile_s = $this->processInput($data[14]);
                if ($this->processInput($data[15]) != 0) {
                    $obj->dob = date_format(date_create_from_format('d-m-y', $this->processInput($this->processInput($data[15]))), 'Y-m-d');
                } else {
                    $obj->dob = '0000-00-00';
                }
                $obj->gender = ucwords($this->processInput($data[17]));
                $obj->email_p = NULL;
                $obj->email_s = $this->processInput($data[16]);
                $obj->parent_1 = $this->processInput($data[19]);
                $obj->parent_1_occupation = $this->processInput($data[20]);
                $obj->parent_2 = $this->processInput($data[21]);
                $obj->marital_status = $this->processInput($data[18]);
                $obj->nationality = $this->processInput($data[22]);
                $obj->religion = $this->processInput($data[23]);
                $obj->community = $this->processInput($data[24]);
                $obj->category = $this->processInput($data[25]);
                $obj->hostel = $this->processInput($data[26]);
                $obj->transoprt = $this->processInput($data[27]);
                $obj->status = 5;

                $session = $this->session->userdata('admin_session');
                $obj->create_id = $session->admin_id;
                $obj->create_date_time = get_current_date_time()->get_date_time_for_db();
                $obj->modify_id = $session->admin_id;
                $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();

                $student_id = $obj->insertData();

                $obj_details = new student_basic_pg_other_details_model();
                $obj_details->student_id = $student_id;
                $obj_details->course_special_id = $this->processInput($data[4]);
                $obj_details->preference_1 = $this->processInput($data[4]);
                $obj_details->preference_2 = $this->processInput($data[5]);
                $obj_details->preference_3 = $this->processInput($data[6]);
                $obj_details->create_id = $session->admin_id;
                $obj_details->create_date_time = get_current_date_time()->get_date_time_for_db();
                $obj_details->modify_id = $session->admin_id;
                $obj_details->modify_date_time = get_current_date_time()->get_date_time_for_db();
                $obj_details->insertData();

                $obj_edu = new student_edu_pg_other_model();
                $obj_edu->student_id = $student_id;
                $obj_edu->course = $this->processInput($data[28]);
                $obj_edu->year = 0;
                $obj_edu->uni_institute = $this->processInput($data[29]);
                $obj_edu->board = $this->processInput($data[30]);
                $obj_edu->total_percentage = $this->processInput($data[31]);
                $obj_edu->rank = $this->processInput($data[32]);
                $obj_edu->create_id = $session->admin_id;
                $obj_edu->create_date_time = get_current_date_time()->get_date_time_for_db();
                $obj_edu->modify_id = $session->admin_id;
                $obj_edu->modify_date_time = get_current_date_time()->get_date_time_for_db();
                $obj_edu->insertData();

                $count++;
            } else if (!empty($data[28])) {
                $obj_edu = new student_edu_pg_other_model();
                $obj_edu->student_id = $student_id;
                $obj_edu->course = $this->processInput($data[28]);
                $obj_edu->year = 0;
                $obj_edu->uni_institute = $this->processInput($data[29]);
                $obj_edu->board = $this->processInput($data[30]);
                $obj_edu->total_percentage = $this->processInput($data[31]);
                $obj_edu->rank = $this->processInput($data[32]);
                $obj_edu->create_id = $session->admin_id;
                $obj_edu->create_date_time = get_current_date_time()->get_date_time_for_db();
                $obj_edu->modify_id = $session->admin_id;
                $obj_edu->modify_date_time = get_current_date_time()->get_date_time_for_db();
                $obj_edu->insertData();
            } else {
                continue;
            }
        }

        return $count;
    }

    function importPGData($all_data) {
        $count = 0;
        $temp_cnt = 1;
        $student_id = 0;
        foreach ($all_data as $data) {
            if ($temp_cnt == 1 && !empty($data[0])) {
                $count++;
                $obj = new student_basic_info_model();
                $obj->admission_id = $this->processInput($data[2]);
                $obj->form_number = $obj->generateFormNumber($this->processInput($data[4]), date('y', strtotime('01-01-' . getYearByAdmissionID($this->processInput($data[2])))), get_current_date_time()->month, get_current_date_time()->day);
                $obj->course_id = $this->processInput($data[4]);
                $obj->degree = 'PG';
                $obj->lastname = $this->processInput($data[12]);
                $obj->firstname = $this->processInput($data[13]);
                $obj->middlename = $this->processInput($data[14]);
                $obj->address = $this->processInput($data[15]);
                $obj->pincode = $this->processInput($data[16]);
                $obj->mobile_p = $this->processInput($data[17]);
                $obj->mobile_s = $this->processInput($data[18]);
                if ($data[19] != 0) {
                    $obj->dob = date_format(date_create_from_format('d-m-y', $this->processInput($data[19])), 'Y-m-d');
                } else {
                    $obj->dob = '0000-00-00';
                }
                $obj->email_s = $this->processInput($data[20]);
                $obj->gender = $this->processInput($data[21]);
                $obj->email_p = null;
                $obj->marital_status = $this->processInput($data[22]);
                $obj->parent_1 = $this->processInput($data[23]);
                $obj->parent_1_occupation = $this->processInput($data[24]);
                $obj->parent_2 = $this->processInput($data[25]);
                $obj->nationality = $this->processInput($data[26]);
                $obj->religion = $this->processInput($data[27]);
                $obj->community = $this->processInput($data[28]);
                $obj->category = $this->processInput($data[29]);
                $obj->hostel = 'N';
                $obj->transoprt = 'N';
                $obj->status = 5;

                $session = $this->session->userdata('admin_session');
                $obj->create_id = $session->admin_id;
                $obj->create_date_time = get_current_date_time()->get_date_time_for_db();
                $obj->modify_id = $session->admin_id;
                $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();

                $student_id = $obj->insertData();

                $obj_details = new student_basic_pg_details_model();
                $obj_details->student_id = $student_id;
                $obj_details->hallticket = $obj_details->generateHallTicketNumber($data[5], get_current_date_time()->year);
                $obj_details->course_special_id = $this->processInput($data[8]);
                $obj_details->center_pref_1 = $this->processInput($data[5]);
                $obj_details->center_pref_2 = $this->processInput($data[6]);
                $obj_details->center_pref_3 = $this->processInput($data[7]);
                $obj_details->preference_1 = $this->processInput($data[8]);
                $obj_details->preference_2 = $this->processInput($data[9]);
                $obj_details->preference_3 = $this->processInput($data[10]);
                $obj_details->rotational_intership = $this->processInput($data[36]);
                if ($data[36] == 'Y') {
                    if ($data[37] != 0 && $data[37] != '') {
                        $obj->intership_date = date_format(date_create_from_format('d-m-y', $this->processInput($data[37])), 'Y-m-d');
                    } else {
                        $obj->intership_date = '0000-00-00';
                    }
                } else {
                    if ($data[38] != 0 && $data[38] != '') {
                        $obj->intership_date = date_format(date_create_from_format('d-m-y', $this->processInput($data[38])), 'Y-m-d');
                    } else {
                        $obj->intership_date = '0000-00-00';
                    }
                }

                $obj_details->register_mci_dci = $this->processInput($data[33]);
                $obj_details->reg_no = $this->processInput($data[34]);
                if ($data[35] != 0 && $data[35] != '') {
                    $obj_details->reg_date = date_format(date_create_from_format('d-m-y', $this->processInput($data[35])), 'Y-m-d');
                } else {
                    $obj->reg_date = '0000-00-00';
                }
                $obj_details->past_college = $this->processInput($data[30]);
                $obj_details->past_university = $this->processInput($data[31]);
                $obj_details->college_mci_dci = $this->processInput($data[32]);
                $obj_details->create_id = $session->admin_id;
                $obj_details->create_date_time = get_current_date_time()->get_date_time_for_db();
                $obj_details->modify_id = $session->admin_id;
                $obj_details->modify_date_time = get_current_date_time()->get_date_time_for_db();
                $obj_details->insertData();

                $obj_edu_detail = new student_edu_pg_model();
                $ex = explode('_', $data[40]);
                $obj_edu_detail->student_id = $student_id;
                $obj_edu_detail->exam = $this->processInput($data[39]);
                $obj_edu_detail->month = @$ex[0];
                $obj_edu_detail->year = @$ex[1];
                $obj_edu_detail->percentage = $this->processInput($data[41]);
                $obj_edu_detail->attempt = $this->processInput($data[42]);
                $obj_edu_detail->create_id = $session->admin_id;
                $obj_edu_detail->create_date_time = get_current_date_time()->get_date_time_for_db();
                $obj_edu_detail->modify_id = $session->admin_id;
                $obj_edu_detail->modify_date_time = get_current_date_time()->get_date_time_for_db();
                $obj_edu_detail->insertData();
                $temp_cnt++;
            } else if ($temp_cnt != 1 && !empty($data[39])) {
                $obj_edu_detail_1 = new student_edu_pg_model();
                $ex = explode('_', $data[40]);
                $obj_edu_detail_1->student_id = $student_id;
                $obj_edu_detail_1->exam = $this->processInput($data[39]);
                $obj_edu_detail_1->month = @$ex[0];
                $obj_edu_detail_1->year = @$ex[1];
                $obj_edu_detail_1->percentage = $this->processInput($data[41]);
                $obj_edu_detail_1->attempt = $this->processInput($data[42]);
                $obj_edu_detail_1->create_id = $session->admin_id;
                $obj_edu_detail_1->create_date_time = get_current_date_time()->get_date_time_for_db();
                $obj_edu_detail_1->modify_id = $session->admin_id;
                $obj_edu_detail_1->modify_date_time = get_current_date_time()->get_date_time_for_db();
                $obj_edu_detail_1->insertData();
                $temp_cnt++;
                if ($temp_cnt == 5) {
                    $temp_cnt = 1;
                }
            }
        }

        return $count;
    }

}
