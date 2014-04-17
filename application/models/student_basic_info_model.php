<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class student_basic_info_model extends CI_model {

    public $student_id;
    public $admission_id;
    public $form_number;
    public $hall_ticket;
    public $course_id;
    public $center_pref_1;
    public $center_pref_2;
    public $center_pref_3;
    public $firstname;
    public $middlename;
    public $lastname;
    public $address;
    public $pincode;
    public $phone_no;
    public $mobile_no;
    public $gender;
    public $email;
    public $parent_1;
    public $parent_1_occupation;
    public $parent_2;
    public $dob;
    public $marital_status;
    public $nationality;
    public $religion;
    public $community;
    public $category;
    public $hostel;
    public $transoprt;
    public $status;
    public $create_id;
    public $create_date_time;
    public $modify_id;
    public $modify_date_time;
    private $table_name = 'student_basic_info';

    function __construct() {
        parent::__construct();
    }

    function validationRules() {
        $validation_rules = array();
        return $validation_rules;
    }

    function convertObject($old) {
        $new = new student_basic_info_model();
        $new->student_id = $old->student_id;
        $new->admission_id = $old->admission_id;
        $new->form_number = $old->form_number;
        $new->hall_ticket = $old->hall_ticket;
        $new->course_id = $old->course_id;
        $new->center_pref_1 = $old->center_pref_1;
        $new->center_pref_2 = $old->center_pref_2;
        $new->center_pref_3 = $old->center_pref_3;
        $new->firstname = $old->firstname;
        $new->middlename = $old->middlename;
        $new->lastname = $old->lastname;
        $new->address = $old->address;
        $new->pincode = $old->pincode;
        $new->phone_no = $old->phone_no;
        $new->mobile_no = $old->mobile_no;
        $new->gender = $old->gender;
        $new->email = $old->email;
        $new->parent_1 = $old->parent_1;
        $new->parent_1_occupation = $old->parent_1_occupation;
        $new->parent_2 = $old->parent_2;
        $new->dob = $old->dob;
        $new->marital_status = $old->marital_status;
        $new->nationality = $old->nationality;
        $new->religion = $old->religion;
        $new->community = $old->community;
        $new->category = $old->category;
        $new->hostel = $old->hostel;
        $new->transoprt = $old->transoprt;
        $new->status = $old->status;
        $new->create_id = $old->create_id;
        $new->create_date_time = $old->create_date_time;
        $new->modify_id = $old->modify_id;
        $new->modify_date_time = $old->modify_date_time;
        return $new;
    }

    function toArray() {
        $arr = array();
        if ($this->student_id != '')
            $arr['student_id'] = $this->student_id;
        
        if ($this->admission_id != '')
            $arr['admission_id'] = $this->admission_id;

        if ($this->form_number != '')
            $arr['form_number'] = $this->form_number;

        if ($this->hall_ticket != '')
            $arr['hall_ticket'] = $this->hall_ticket;

        if ($this->course_id != '')
            $arr['course_id'] = $this->course_id;

        if ($this->center_pref_1 != '')
            $arr['center_pref_1'] = $this->center_pref_1;

        if ($this->center_pref_2 != '')
            $arr['center_pref_2'] = $this->center_pref_2;

        if ($this->center_pref_3 != '')
            $arr['center_pref_3'] = $this->center_pref_3;

        if ($this->firstname != '')
            $arr['firstname'] = $this->firstname;

        if ($this->middlename != '')
            $arr['middlename'] = $this->middlename;

        if ($this->lastname != '')
            $arr['lastname'] = $this->lastname;

        if ($this->address != '')
            $arr['address'] = $this->address;

        if ($this->pincode != '')
            $arr['pincode'] = $this->pincode;

        if ($this->phone_no != '')
            $arr['phone_no'] = $this->phone_no;

        if ($this->mobile_no != '')
            $arr['mobile_no'] = $this->mobile_no;

        if ($this->gender != '')
            $arr['gender'] = $this->gender;

        if ($this->email != '')
            $arr['email'] = $this->email;

        if ($this->parent_1 != '')
            $arr['parent_1'] = $this->parent_1;

        if ($this->parent_1_occupation != '')
            $arr['parent_1_occupation'] = $this->parent_1_occupation;

        if ($this->parent_2 != '')
            $arr['parent_2'] = $this->parent_2;

        if ($this->dob != '')
            $arr['dob'] = $this->dob;

        if ($this->marital_status != '')
            $arr['marital_status'] = $this->marital_status;

        if ($this->nationality != '')
            $arr['nationality'] = $this->nationality;

        if ($this->religion != '')
            $arr['religion'] = $this->religion;

        if ($this->community != '')
            $arr['community'] = $this->community;

        if ($this->category != '')
            $arr['category'] = $this->category;

        if ($this->hostel != '')
            $arr['hostel'] = $this->hostel;

        if ($this->transoprt != '')
            $arr['transoprt'] = $this->transoprt;

        if ($this->status != '')
            $arr['status'] = $this->status;

        if ($this->create_id != '')
            $arr['create_id'] = $this->create_id;

        if ($this->create_date_time != '')
            $arr['create_date_time'] = $this->create_date_time;

        if ($this->modify_id != '')
            $arr['modify_id'] = $this->modify_id;

        if ($this->modify_date_time != '')
            $arr['modify_date_time'] = $this->modify_date_time;

        return $arr;
    }

    function getWhere($where, $limit = null, $orderby = null, $ordertype = null) {
        $objects = array();
        $this->db->select(' * ');
        $this->db->from($this->table_name);
        $this->db->where($where);
        if (is_null($orderby)) {
            $orderby = 'student_id';
        }
        if (is_null($ordertype)) {
            $ordertype = 'desc;';
        }
        $this->db->order_by($orderby, $ordertype);
        if ($limit != null) {
            $this->db->limit($limit);
        }
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    function getAll($limit = null, $orderby = null, $ordertype = null) {
        $objects = array();
        $this->db->select(' * ');
        $this->db->from($this->table_name);
        if (is_null($orderby)) {
            $orderby = 'student_id';
        }
        if (is_null($ordertype)) {
            $ordertype = 'desc';
        }
        $this->db->order_by($orderby, $ordertype);
        if ($limit != null) {
            $this->db->limit($limit);
        }
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    function insertData() {
        $array = $this->toArray();
        $this->db->insert($this->table_name, $array);
        $check = $this->db->affected_rows();
        if ($check > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    function updateData() {
        $array = $this->toArray();
        unset($array['student_id']);
        $this->db->where('student_id', $this->student_id);
        $this->db->update($this->table_name, $array);
        return TRUE;
    }

    function deleteData() {
        $this->db->where('student_id', $this->student_id);
        $this->db->delete($this->table_name);
        $check = $this->db->affected_rows();
        if ($check > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function generateFormNumber($course_id) {
        $this->load->model('courses_model');
        $year = date('y', strtotime(get_current_date_time()->year));
        $month = get_current_date_time()->month;
        $short_code = $this->courses_model->getCourseShortCode($course_id);
        $day = get_current_date_time()->day;

        $res = $this->getAll(1, 'student_id', 'desc');
        if (!empty($res)) {
            $last_id = substr($res[0]->form_number, 10);
        } else {
            $last_id = 0;
        }

        $new_number = str_pad(($last_id + 1), 5, '0', STR_PAD_LEFT);
        $id = $year . $month . $short_code . $day . 'SV' . $new_number;
        return $id;
    }

    function generateHallTicketNumber($center_peref_1) {
        $res = $this->getWhere(array('center_pref_1' => $center_peref_1), 1, 'student_id', 'desc');

        if (!empty($res)) {
            $last_id = substr($res[0]->hall_ticket, 4);
        } else {
            $this->load->model('exam_centers_model');
            $exam = $this->exam_centers_model->getWhere(array('center_id' => $center_peref_1));
            $last_id = $exam[0]->code;
        }

        return get_current_date_time()->year . ($last_id + 1);
    }

}

?>