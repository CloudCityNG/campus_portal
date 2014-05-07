<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class student_basic_info_pg_other_model extends CI_model {

    public $student_id;
    public $admission_id;
    public $form_number;
    public $course_id;
    public $course_special_id;
    public $preference_1;
    public $preference_2;
    public $preference_3;
    public $firstname;
    public $middlename;
    public $lastname;
    public $address;
    public $pincode;
    public $mobile_p;
    public $mobile_s;
    public $gender;
    public $email_p;
    public $email_s;
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
    private $table_name = 'student_basic_info_pg_other';

    function __construct() {
        parent::__construct();
    }

    function validationRules() {
        $validation_rules = array();
        return $validation_rules;
    }

    function convertObject($old) {
        $new = new student_basic_info_pg_other_model();
        $new->student_id = $old->student_id;
        $new->admission_id = $old->admission_id;
        $new->form_number = $old->form_number;
        $new->course_id = $old->course_id;
        $new->course_special_id = $old->course_special_id;
        $new->preference_1 = $old->preference_1;
        $new->preference_2 = $old->preference_2;
        $new->preference_3 = $old->preference_3;
        $new->firstname = $old->firstname;
        $new->middlename = $old->middlename;
        $new->lastname = $old->lastname;
        $new->address = $old->address;
        $new->pincode = $old->pincode;
        $new->mobile_p = $old->mobile_p;
        $new->mobile_s = $old->mobile_s;
        $new->gender = $old->gender;
        $new->email_p = $old->email_p;
        $new->email_s = $old->email_s;
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

        if ($this->course_id != '')
            $arr['course_id'] = $this->course_id;

        if ($this->course_special_id != '')
            $arr['course_special_id'] = $this->course_special_id;
        
        if ($this->preference_1 != '')
            $arr['preference_1'] = $this->preference_1;
        
        if ($this->preference_2 != '')
            $arr['preference_2'] = $this->preference_2;
        
        if ($this->preference_3 != '')
            $arr['preference_3'] = $this->preference_3;

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

        if ($this->mobile_p != '')
            $arr['mobile_p'] = $this->mobile_p;

        if ($this->mobile_s != '')
            $arr['mobile_s'] = $this->mobile_s;

        if ($this->gender != '')
            $arr['gender'] = $this->gender;

        if ($this->email_p != '')
            $arr['email_p'] = $this->email_p;

        if ($this->email_s != '')
            $arr['email_s'] = $this->email_s;

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
    
    function generateFormNumber($course_id, $year, $month, $day) {
        $this->load->model('courses_model');
        $short_code = $this->courses_model->getCourseShortCode($course_id);

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

}

?>