<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class forms extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->admin_layout->setLayout('template/layout_admission');

        $session = $this->session->userdata('admin_session');
        if (empty($session) || $session->type != 'admission') {
            $this->session->set_flashdata('error', 'Login First');
            redirect(base_url() . 'login', 'refresh');
        }

        //$this->output->enable_profiler(TRUE);

        $this->load->model('courses_model');
        $this->load->model('exam_centers_model');
        $this->load->model('student_basic_info_model');
        $this->load->model('student_edu_master_model');
        $this->load->model('student_edu_details_model');
        $this->load->model('student_language_model');
        $this->load->model('student_foregin_details_model');
        $this->load->model('studnet_images_model');
        $this->load->model('admission_details_model');
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
        $this->datatable->aColumns = array('form_number, hall_ticket, CONCAT(firstname, " ", lastname) AS student_name, courses.name AS course_name, student_basic_info.status, admission_candidate_status.name AS status_name');
        $this->datatable->eColumns = array('student_id');
        $this->datatable->sIndexColumn = "student_id";
        $this->datatable->sTable = " student_basic_info, courses, admission_candidate_status";
        $this->datatable->myWhere = 'WHERE student_basic_info.course_id = courses.course_id AND student_basic_info.status = admission_candidate_status.admission_status_id order by student_id desc';
        $this->datatable->datatable_process();

        foreach ($this->datatable->rResult->result_array() as $aRow) {
            $temp_arr = array();

            $temp_arr[] = $aRow['form_number'];
            $temp_arr[] = $aRow['hall_ticket'];
            $temp_arr[] = ucwords($aRow['student_name']) . $aRow['status'];
            $temp_arr[] = $aRow['course_name'];
            $temp_arr[] = '<a data-target="#update_student_status" data-toggle="modal" href="' . ADMISSION_URL . 'forms/edit_ug_status/' . $aRow['student_id'] . '"/aids_certificate" class="link">' . $aRow['status_name'] . '</a>';

            if ($aRow['status'] != 1) {
                $temp_arr[] = '<a  href="' . ADMISSION_URL . 'forms/hall_ticket/' . $aRow['student_id'] . '" class="link" target="_blank">HallTicket</a>';
            } else {
                $temp_arr[] = '';
            }
            if ($session->role == 3) {
                $temp_arr[] = '<a href="' . ADMISSION_URL . 'forms/edit_ug/' . $aRow['student_id'] . '/basic_info"  class="icon-edit" id="' . $aRow['student_id'] . '"></a> &nbsp; <a href="javascript:;" onclick="deleteRow(this)" class="deletepage icon-trash" id="' . $aRow['student_id'] . '"></a>';
            }

            $this->datatable->output['aaData'][] = $temp_arr;
        }
        echo json_encode($this->datatable->output);
        exit();
    }

    function viewHallTicket($student_id) {
        $detail = $this->student_basic_info_model->getWhere(array('student_id' => $student_id));

        if (empty($detail)) {
            $this->session->set_flashdata('error', 'Invalid Student ID');
            redirect(ADMISSION_URL . 'forms', 'refresh');
        } else {
            if ($detail[0]->status == 1) {
                $this->session->set_flashdata('error', 'Hall Ticket Not Generated as Payment Not Done');
                redirect(ADMISSION_URL . 'forms', 'refresh');
            } else {
                $data['detail'] = $detail[0];
                $data['image_details'] = $this->studnet_images_model->getWhere(array('student_id' => $student_id));
                $data['center_details'] = $this->exam_centers_model->getWhere(array('status' => 'A', 'center_id' => $detail[0]->center_pref_1));
                $data['admission_details'] = $this->admission_details_model->getWhere(array('degree' => 'PG', 'admission_year' => get_current_date_time()->year));
                $this->load->view('admission/forms/hall_ticket_view', $data);
            }
        }
    }

    function hallicketPDF($student_id) {
        $detail = $this->student_basic_info_model->getWhere(array('student_id' => $student_id));

        if (empty($detail)) {
            $this->session->set_flashdata('error', 'Invalid Student ID');
            redirect(ADMISSION_URL . 'forms', 'refresh');
        } else {
            if ($detail[0]->status == 1) {
                $this->session->set_flashdata('error', 'Payment Not Done');
                redirect(ADMISSION_URL . 'forms', 'refresh');
            } else {
                $data['detail'] = $detail[0];
                $data['image_details'] = $this->studnet_images_model->getWhere(array('student_id' => $student_id));
                $data['center_details'] = $this->exam_centers_model->getWhere(array('status' => 'A', 'center_id' => $detail[0]->center_pref_1));
                $data['admission_details'] = $this->admission_details_model->getWhere(array('degree' => 'PG', 'admission_year' => get_current_date_time()->year));
                $html = $this->load->view('admission/forms/hall_ticket_view', $data, TRUE);

                $this->load->helper('dompdf');
                $this->load->helper('file');
                pdf_create($html, $detail[0]->hall_ticket, true);
            }
        }
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

        $admission_details = $this->admission_details_model->getWhere(array('degree' => 'PG', 'admission_year' => get_current_date_time()->year));
        $obj->admission_id = $admission_details[0]->admission_id;
        $obj->form_number = $obj->generateFormNumber($this->input->post('cid'), date('y', strtotime(get_current_date_time()->year)), get_current_date_time()->month, get_current_date_time()->day);
        $obj->hall_ticket = $obj->generateHallTicketNumber($center_p1[0], get_current_date_time()->year);
        $obj->course_id = $this->input->post('cid');
        $obj->center_pref_1 = $center_p1[0];
        $obj->center_pref_2 = $center_p2[0];
        $obj->center_pref_3 = $center_p3[0];
        $obj->firstname = $this->input->post('firstname');
        $obj->middlename = ($this->input->post('middlename') == '') ? NULL : $this->input->post('middlename     ');
        $obj->lastname = $this->input->post('lastname');
        $obj->address = $this->input->post('address');
        $obj->pincode = $this->input->post('pincode');
        $obj->mobile_s = $this->input->post('mobile_s');
        $obj->mobile_p = $this->input->post('mobile_p');
        $obj->gender = $this->input->post('gender');
        $obj->email_p = $this->input->post('email_p');
        $obj->email_s = $this->input->post('email_s');
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
        $obj->status = 1;
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
        $data['languages_details'] = $this->student_language_model->getWhere(array('student_id' => $student_id));
        $data['image_details'] = $this->studnet_images_model->getWhere(array('student_id' => $student_id));

        $this->admin_layout->view('admission/forms/edit', $data);
    }

    function updateUGBasicForm($student_id) {
        $obj = new student_basic_info_model();

        $obj->student_id = $student_id;
        $obj->firstname = $this->input->post('firstname');
        $obj->middlename = ($this->input->post('middlename') == '') ? NULL : $this->input->post('middlename     ');
        $obj->lastname = $this->input->post('lastname');
        $obj->address = $this->input->post('address');
        $obj->pincode = $this->input->post('pincode');
        $obj->mobile_s = $this->input->post('mobile_s');
        $obj->mobile_p = $this->input->post('mobile_p');
        $obj->gender = $this->input->post('gender');
        $obj->email_p = $this->input->post('email_p');
        $obj->email_s = $this->input->post('email_s');
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

        $check = $obj->updateData();
        if ($check) {
            $this->session->set_flashdata('success', 'Data Updated Successfully');
        } else {
            $this->session->set_flashdata('error', 'Error in Updating the Data');
        }

        redirect(ADMISSION_URL . 'forms/edit_ug/' . $student_id . '/edu_info', 'refresh');
    }

    function updateUGEduForm($student_id) {
        $obj_master = new student_edu_master_model();

        $ssc = $obj_master->getWhere(array('student_id' => $student_id, 'course' => 'S.S.C'));

        $obj_master->student_id = $student_id;
        $obj_master->course = $this->input->post('ssc_course');
        $obj_master->year = $this->input->post('ssc_year');
        $obj_master->uni_institute = $this->input->post('ssc_uni_institute');
        $obj_master->board = $this->input->post('ssc_board');
        $obj_master->pcb_percentage = '0.00';
        $obj_master->pcbe_percentage = '0.00';
        $obj_master->total_percentage = $this->input->post('ssc_total_percentage');
        $obj_master->rank = $this->input->post('ssc_rank');
        $obj_master->result_wating = 'N';

        if (empty($ssc)) {
            $obj_master->create_id = $student_id;
            $obj_master->create_date_time = get_current_date_time()->get_date_time_for_db();
            $obj_master->modify_id = $student_id;
            $obj_master->modify_date_time = get_current_date_time()->get_date_time_for_db();
            $obj_master->insertData();
        } else {
            $obj_master->modify_id = $student_id;
            $obj_master->modify_date_time = get_current_date_time()->get_date_time_for_db();
            $obj_master->edu_master_id = $ssc[0]->edu_master_id;
            $obj_master->updateData();
        }

        $hsc = $obj_master->getWhere(array('student_id' => $student_id, 'course' => 'H.S.C'));

        $obj_master->student_id = $student_id;
        $obj_master->course = $this->input->post('hsc_course');
        $obj_master->year = $this->input->post('hsc_year');
        $obj_master->uni_institute = $this->input->post('hsc_uni_institute');
        $obj_master->board = $this->input->post('hsc_board');
        $obj_master->pcb_percentage = $this->input->post('pcb_percentage');
        $obj_master->pcbe_percentage = $this->input->post('pcbe_percentage');
        $obj_master->total_percentage = $this->input->post('hsc_total_percentage');
        $obj_master->rank = $this->input->post('hsc_rank');
        if ($this->input->post('result_wating') != FALSE) {
            $obj_master->result_wating = 'Y';
        } else {
            $obj_master->result_wating = 'N';
        }

        if (empty($hsc)) {
            $obj_master->create_id = $student_id;
            $obj_master->create_date_time = get_current_date_time()->get_date_time_for_db();
            $obj_master->modify_id = $student_id;
            $obj_master->modify_date_time = get_current_date_time()->get_date_time_for_db();
            $edu_master_id = $obj_master->insertData();
        } else {
            $obj_master->modify_id = $student_id;
            $obj_master->modify_date_time = get_current_date_time()->get_date_time_for_db();
            $obj_master->edu_master_id = $hsc[0]->edu_master_id;
            $obj_master->updateData();
            $edu_master_id = $hsc[0]->edu_master_id;
        }

        if ($obj_master->result_wating == 'N') {

            $subject = $this->input->post('subject');
            $max_theory_marks = $this->input->post('max_theory_marks');
            $min_theroy_marks = $this->input->post('min_theroy_marks');
            $max_pratical_marks = $this->input->post('max_pratical_marks');
            $min_pratical_marks = $this->input->post('min_pratical_marks');

            for ($i = 0; $i < count($subject); $i++) {
                $obj_details = new student_edu_details_model();
                $edu_detail_id = $obj_details->getWhere(array('edu_master_id' => $edu_master_id, 'subject' => $subject[$i]));
                $obj_details->edu_master_id = $edu_master_id;
                $obj_details->subject = $subject[$i];
                $obj_details->theory_max_mark = $max_theory_marks[$i];
                $obj_details->theory_min_mark = $min_theroy_marks[$i];
                $obj_details->pratical_max_mark = $max_pratical_marks[$i];
                $obj_details->pratical_min_mark = $min_pratical_marks[$i];
                $obj_details->total_min_mark = $min_theroy_marks[$i] + $min_pratical_marks[$i];
                $obj_details->total_max_mark = $max_theory_marks[$i] + $max_pratical_marks[$i];

                if (empty($edu_detail_id)) {
                    $obj_details->create_id = $student_id;
                    $obj_details->create_date_time = get_current_date_time()->get_date_time_for_db();
                    $obj_details->modify_id = $student_id;
                    $obj_details->modify_date_time = get_current_date_time()->get_date_time_for_db();
                    $obj_details->insertData();
                } else {
                    $obj_details->modify_id = $student_id;
                    $obj_details->modify_date_time = get_current_date_time()->get_date_time_for_db();
                    $obj_details->edu_detail_id = $edu_detail_id[0]->edu_detail_id;
                    $obj_details->updateData();
                }
            }
        }

        redirect(ADMISSION_URL . 'forms/edit_ug/' . $student_id . '/languages', 'refresh');
    }

    function updateUGLanguagesForm($student_id) {
        $languages = $this->input->post('langauge_name');
        $i = 0;
        foreach ($languages as $language) {
            $obj = new student_language_model();
            $detail = $obj->getWhere(array('name' => strtolower($language), 'student_id' => $student_id));

            if (!empty($language)) {
                $obj->name = strtolower($language);
                $obj->student_id = $student_id;
                if ($this->input->post('speaking' . $i) != FALSE) {
                    $obj->speaking = 'Y';
                } else {
                    $obj->speaking = 'N';
                }

                if ($this->input->post('reading' . $i) != FALSE) {
                    $obj->reading = 'Y';
                } else {
                    $obj->reading = 'N';
                }

                if ($this->input->post('writing' . $i) != FALSE) {
                    $obj->writing = 'Y';
                } else {
                    $obj->writing = 'N';
                }

                if (empty($detail)) {
                    $obj->create_id = $student_id;
                    $obj->create_date_time = get_current_date_time()->get_date_time_for_db();
                    $obj->modify_id = $student_id;
                    $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();
                    $obj->insertData();
                } else {
                    $obj->modify_id = $student_id;
                    $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();
                    $obj->language_id = $detail[0]->language_id;
                    $obj->updateData();
                }

                $i++;
            }
        }
        redirect(ADMISSION_URL . 'forms/edit_ug/' . $student_id . '/foreign_detials', 'refresh');
    }

    function updateUGForeignForm($student_id) {
        $obj = new student_foregin_details_model();

        $detail = $obj->getWhere(array('student_id' => $student_id));

        $obj->student_id = $student_id;
        $obj->detail_pp = $this->input->post('detail_pp');
        $obj->passport_no = $this->input->post('passport_no');
        $obj->country = $this->input->post('country');
        $obj->issue = $this->input->post('issue');
        $obj->expire_date = date('Y-m-d', strtotime($this->input->post('expire_date')));
        $obj->visa_type = $this->input->post('visa_type');
        $obj->aids_dearance = $this->input->post('aids_dearance');

        if (empty($detail)) {
            $obj->create_id = $student_id;
            $obj->create_date_time = get_current_date_time()->get_date_time_for_db();
            $obj->modify_id = $student_id;
            $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();
            $obj->insertData();
        } else {
            $obj->modify_id = $student_id;
            $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();
            $obj->foregin_detail_id = $detail[0]->foregin_detail_id;
            $obj->updateData();
        }

        redirect(ADMISSION_URL . 'forms/edit_ug/' . $student_id . '/require_doc', 'refresh');
    }

    function updateUGImagesForm($student_id) {
        $obj = new studnet_images_model();

        $details = $obj->getWhere(array('student_id' => $student_id));

        $obj->student_id = $student_id;

        if (!empty($_FILES['student_image']['name'])) {
            $upload_status = $this->do_upload('student_image', 'student_image', $student_id);
            if (isset($upload_status['upload_data'])) {
                if ($upload_status['upload_data']['file_name'] != '') {
                    if (!empty($details)) {
                        $old_location = $details[0]->student_image;
                        if ($old_location != null && $old_location != 'no_image.png') {
                            $full_path_of_old = './assets/students/' . $student_id . '/' . $old_location;
                            $path_to_be_removed = substr($full_path_of_old, 2);
                            if (file_exists($path_to_be_removed)) {
                                unlink($path_to_be_removed);
                            }
                        }
                    }
                    $obj->student_image = $upload_status['upload_data']['file_name'];
                }
            }
        }

        if (!empty($_FILES['sign']['name'])) {
            $upload_status = $this->do_upload('sign', 'sign', $student_id);
            if (isset($upload_status['upload_data'])) {
                if ($upload_status['upload_data']['file_name'] != '') {
                    if (!empty($details)) {
                        $old_location = $details[0]->sign;
                        if ($old_location != null && $old_location != 'no_image.png') {
                            $full_path_of_old = './assets/students/' . $student_id . '/' . $old_location;
                            $path_to_be_removed = substr($full_path_of_old, 2);
                            if (file_exists($path_to_be_removed)) {
                                unlink($path_to_be_removed);
                            }
                        }
                    }
                    $obj->sign = $upload_status['upload_data']['file_name'];
                }
            }
        }

        if (!empty($_FILES['ssc_marksheet']['name'])) {
            $upload_status = $this->do_upload('ssc_marksheet', 'sign', $student_id);
            if (isset($upload_status['upload_data'])) {
                if ($upload_status['upload_data']['file_name'] != '') {
                    if (!empty($details)) {
                        $old_location = $details[0]->ssc_marksheet;
                        if ($old_location != null && $old_location != 'no_image.png') {
                            $full_path_of_old = './assets/students/' . $student_id . '/' . $old_location;
                            $path_to_be_removed = substr($full_path_of_old, 2);
                            if (file_exists($path_to_be_removed)) {
                                unlink($path_to_be_removed);
                            }
                        }
                    }
                    $obj->ssc_marksheet = $upload_status['upload_data']['file_name'];
                }
            }
        }

        if (!empty($_FILES['hsc_marksheet']['name'])) {
            $upload_status = $this->do_upload('hsc_marksheet', 'sign', $student_id);
            if (isset($upload_status['upload_data'])) {
                if ($upload_status['upload_data']['file_name'] != '') {
                    if (!empty($details)) {
                        $old_location = $details[0]->hsc_marksheet;
                        if ($old_location != null && $old_location != 'no_image.png') {
                            $full_path_of_old = './assets/students/' . $student_id . '/' . $old_location;
                            $path_to_be_removed = substr($full_path_of_old, 2);
                            if (file_exists($path_to_be_removed)) {
                                unlink($path_to_be_removed);
                            }
                        }
                    }
                    $obj->hsc_marksheet = $upload_status['upload_data']['file_name'];
                }
            }
        }

        if (!empty($_FILES['migration_certificate']['name'])) {
            $upload_status = $this->do_upload('migration_certificate', 'sign', $student_id);
            if (isset($upload_status['upload_data'])) {
                if ($upload_status['upload_data']['file_name'] != '') {
                    if (!empty($details)) {
                        $old_location = $details[0]->migration_certificate;
                        if ($old_location != null && $old_location != 'no_image.png') {
                            $full_path_of_old = './assets/students/' . $student_id . '/' . $old_location;
                            $path_to_be_removed = substr($full_path_of_old, 2);
                            if (file_exists($path_to_be_removed)) {
                                unlink($path_to_be_removed);
                            }
                        }
                    }
                    $obj->migration_certificate = $upload_status['upload_data']['file_name'];
                }
            }
        }

        if (!empty($_FILES['leaving_certificate']['name'])) {
            $upload_status = $this->do_upload('leaving_certificate', 'sign', $student_id);
            if (isset($upload_status['upload_data'])) {
                if ($upload_status['upload_data']['file_name'] != '') {
                    if (!empty($details)) {
                        $old_location = $details[0]->leaving_certificate;
                        if ($old_location != null && $old_location != 'no_image.png') {
                            $full_path_of_old = './assets/students/' . $student_id . '/' . $old_location;
                            $path_to_be_removed = substr($full_path_of_old, 2);
                            if (file_exists($path_to_be_removed)) {
                                unlink($path_to_be_removed);
                            }
                        }
                    }
                    $obj->leaving_certificate = $upload_status['upload_data']['file_name'];
                }
            }
        }

        if (!empty($_FILES['cast_certificate']['name'])) {
            $upload_status = $this->do_upload('cast_certificate', 'sign', $student_id);
            if (isset($upload_status['upload_data'])) {
                if ($upload_status['upload_data']['file_name'] != '') {
                    if (!empty($details)) {
                        $old_location = $details[0]->cast_certificate;
                        if ($old_location != null && $old_location != 'no_image.png') {
                            $full_path_of_old = './assets/students/' . $student_id . '/' . $old_location;
                            $path_to_be_removed = substr($full_path_of_old, 2);
                            if (file_exists($path_to_be_removed)) {
                                unlink($path_to_be_removed);
                            }
                        }
                    }
                    $obj->cast_certificate = $upload_status['upload_data']['file_name'];
                }
            }
        }

        if (!empty($_FILES['aids_certificate']['name'])) {
            $upload_status = $this->do_upload('aids_certificate', 'sign', $student_id);
            if (isset($upload_status['upload_data'])) {
                if ($upload_status['upload_data']['file_name'] != '') {
                    if (!empty($details)) {
                        $old_location = $details[0]->aids_certificate;
                        if ($old_location != null && $old_location != 'no_image.png') {
                            $full_path_of_old = './assets/students/' . $student_id . '/' . $old_location;
                            $path_to_be_removed = substr($full_path_of_old, 2);
                            if (file_exists($path_to_be_removed)) {
                                unlink($path_to_be_removed);
                            }
                        }
                    }
                    $obj->aids_certificate = $upload_status['upload_data']['file_name'];
                }
            }
        }

        if (empty($details)) {
            $obj->create_id = $student_id;
            $obj->create_date_time = get_current_date_time()->get_date_time_for_db();
            $obj->modify_id = $student_id;
            $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();
            $obj->insertData();
        } else {
            $obj->modify_id = $student_id;
            $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();
            $obj->image_id = $details[0]->image_id;
            $obj->updateData();
        }

        redirect(ADMISSION_URL . 'forms', 'refresh');
    }

    function do_upload($field, $field_type, $student_id) {
        $config['upload_path'] = './assets/students/' . $student_id;
        if (!is_dir($config['upload_path'])) { //create the folder if it's not already exists
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['overwrite'] = FALSE;
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($field)) {
            $data = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data($field));

            if ($field_type == 'student_image') {
                $image = $data['upload_data']['file_name'];
                $this->load->helper('image_manipulation/image_manipulation');
                include_lib_image_manipulation();
                $magicianObj = new imageLib('./assets/students/' . $student_id . '/' . $image);
                $magicianObj->resizeImage(250, 250, 'auto');
                $magicianObj->saveImage('./assets/students/' . $student_id . '/' . $image, 100);
            }

            if ($field_type == 'sign') {
                $image = $data['upload_data']['file_name'];
                $this->load->helper('image_manipulation/image_manipulation');
                include_lib_image_manipulation();
                $magicianObj = new imageLib('./assets/students/' . $student_id . '/' . $image);
                $magicianObj->resizeImage(175, 50, 'exact');
                $magicianObj->saveImage('./assets/students/' . $student_id . '/' . $image, 100);
            }
        }

        return $data;
    }

    function viewStudentImages($student_id, $image_type) {
        $get = $this->studnet_images_model->getWhere(array('student_id' => $student_id));
        $data['student_id'] = $student_id;
        $data['image_type'] = 'Images';
        $data['image'] = '<strong>No Image Upload</strong>';

        if (!empty($get[0]) && $image_type == 'student_image') {
            $data['image_type'] = 'Student Image';
            $full_path_of_old = './assets/students/' . $student_id . '/' . '/' . $get[0]->student_image;
            $path_to_be_removed = substr($full_path_of_old, 2);
            if (file_exists($path_to_be_removed)) {
                $data['image'] = '<img src="' . base_url() . 'assets/students/' . $student_id . '/' . $get[0]->student_image . '" class="img-responsive img-thumbnail"/>';
            }
        }

        if (!empty($get[0]) && $image_type == 'sign') {
            $data['image_type'] = 'Student Signature';
            $full_path_of_old = './assets/students/' . $student_id . '/' . '/' . $get[0]->sign;
            $path_to_be_removed = substr($full_path_of_old, 2);
            if (file_exists($path_to_be_removed)) {
                $data['image'] = '<img src="' . base_url() . 'assets/students/' . $student_id . '/' . $get[0]->sign . '" class="img-responsive img-thumbnail"/>';
            }
        }

        if (!empty($get[0]) && $image_type == 'ssc_marksheet') {
            $data['image_type'] = 'S.S.C. Marksheet';
            $full_path_of_old = './assets/students/' . $student_id . '/' . '/' . $get[0]->ssc_marksheet;
            $path_to_be_removed = substr($full_path_of_old, 2);
            if (file_exists($path_to_be_removed)) {
                $data['image'] = '<img src="' . base_url() . 'assets/students/' . $student_id . '/' . $get[0]->ssc_marksheet . '" class="img-responsive img-thumbnail"/>';
            }
        }

        if (!empty($get[0]) && $image_type == 'hsc_marksheet') {
            $data['image_type'] = 'H.S.C. Marksheet';
            $full_path_of_old = './assets/students/' . $student_id . '/' . '/' . $get[0]->hsc_marksheet;
            $path_to_be_removed = substr($full_path_of_old, 2);
            if (file_exists($path_to_be_removed)) {
                $data['image'] = '<img src="' . base_url() . 'assets/students/' . $student_id . '/' . $get[0]->hsc_marksheet . '" class="img-responsive img-thumbnail"/>';
            }
        }

        if (!empty($get[0]) && $image_type == 'migration_certificate') {
            $data['image_type'] = 'Migration Certificate';
            $full_path_of_old = './assets/students/' . $student_id . '/' . '/' . $get[0]->migration_certificate;
            $path_to_be_removed = substr($full_path_of_old, 2);
            if (file_exists($path_to_be_removed)) {
                $data['image'] = '<img src="' . base_url() . 'assets/students/' . $student_id . '/' . $get[0]->migration_certificate . '" class="img-responsive img-thumbnail"/>';
            }
        }

        if (!empty($get[0]) && $image_type == 'leaving_certificate') {
            $data['image_type'] = 'Leaving Certificate';
            $full_path_of_old = './assets/students/' . $student_id . '/' . '/' . $get[0]->leaving_certificate;
            $path_to_be_removed = substr($full_path_of_old, 2);
            if (file_exists($path_to_be_removed)) {
                $data['image'] = '<img src="' . base_url() . 'assets/students/' . $student_id . '/' . $get[0]->leaving_certificate . '" class="img-responsive img-thumbnail"/>';
            }
        }

        if (!empty($get[0]) && $image_type == 'cast_certificate') {
            $data['image_type'] = 'Cast Certificate';
            $full_path_of_old = './assets/students/' . $student_id . '/' . '/' . $get[0]->cast_certificate;
            $path_to_be_removed = substr($full_path_of_old, 2);
            if (file_exists($path_to_be_removed)) {
                $data['image'] = '<img src="' . base_url() . 'assets/students/' . $student_id . '/' . $get[0]->cast_certificate . '" class="img-responsive img-thumbnail"/>';
            }
        }

        if (!empty($get[0]) && $image_type == 'aids_certificate') {
            $data['image_type'] = 'AIDS Certificate';
            $full_path_of_old = './assets/students/' . $student_id . '/' . '/' . $get[0]->aids_certificate;
            $path_to_be_removed = substr($full_path_of_old, 2);
            if (file_exists($path_to_be_removed)) {
                $data['image'] = '<img src="' . base_url() . 'assets/students/' . $student_id . '/' . $get[0]->aids_certificate . '" class="img-responsive img-thumbnail"/>';
            }
        }

        echo $this->load->view('admission/forms/view_images', $data, TRUE);
    }

    function editUGStudentStatus($student_id) {
        $this->load->model('admission_candidate_status_model');
        $data['basic_info'] = $this->student_basic_info_model->getWhere(array('student_id' => $student_id));
        $data['candidate_status_info'] = $this->admission_candidate_status_model->getWhere(array('status' => 'A'));
        $this->load->view('admission/forms/update_status', $data);
    }

    function updateUGStudentStatus($student_id) {
        $session = $this->session->userdata('admin_session');
        $obj = new student_basic_info_model();
        $obj->status = $this->input->post('admission_status_id');
        $obj->student_id = $student_id;
        $obj->modify_id = $session->admin_id;
        $obj->modify_date_time = get_current_date_time()->get_date_time_for_db();
        $obj->updateData();

        redirect(ADMISSION_URL . 'forms', 'refresh');
    }

}
