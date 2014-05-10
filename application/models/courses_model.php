<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class courses_model extends CI_model {

    public $course_id;
    public $name;
    public $degree;
    public $entrance_exam;
    public $seats;
    public $status;
    public $create_id;
    public $create_date_time;
    public $modify_id;
    public $modify_date_time;
    private $table_name = 'courses';

    function __construct() {
        parent::__construct();
    }

    function validationRules() {
        $validation_rules = array();
        return $validation_rules;
    }

    function convertObject($old) {
        $new = new courses_model();
        $new->course_id = $old->course_id;
        $new->name = $old->name;
        $new->degree = $old->degree;
        $new->entrance_exam = $old->entrance_exam;
        $new->seats = $old->seats;
        $new->status = $old->status;
        $new->create_id = $old->create_id;
        $new->create_date_time = $old->create_date_time;
        $new->modify_id = $old->modify_id;
        $new->modify_date_time = $old->modify_date_time;
        return $new;
    }

    function toArray() {
        $arr = array();
        if ($this->course_id != '')
            $arr['course_id'] = $this->course_id;

        if ($this->name != '')
            $arr['name'] = $this->name;

        if ($this->degree != '')
            $arr['degree'] = $this->degree;

        if ($this->entrance_exam != '')
            $arr['entrance_exam'] = $this->entrance_exam;

        if ($this->seats != '')
            $arr['seats'] = $this->seats;

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
            $orderby = 'course_id';
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
            $orderby = 'course_id';
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
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function updateData() {
        $array = $this->toArray();
        unset($array['course_id']);
        $this->db->where('course_id', $this->course_id);
        $this->db->update($this->table_name, $array);
        return TRUE;
    }

    function deleteData() {
        $this->db->where('course_id', $this->course_id);
        $this->db->delete($this->table_name);
        $check = $this->db->affected_rows();
        if ($check > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getCourseShortCode($id) {
        $this->db->select('short_code');
        $this->db->from($this->table_name);
        $this->db->where('course_id', $id);
        $res = $this->db->get();
        if ($res->num_rows > 0) {
            $result = $res->result();
            return $result[0]->short_code;
        } else {
            return false;
        }
    }

    function getPgCourse($course_array, $exam) {
        $this->db->select(' * ');
        $this->db->from($this->table_name);
        $this->db->where('entrance_exam', $exam);
        $this->db->where('status', 'A');
        $this->db->where_in('degree', $course_array);
        $res = $this->db->get();

        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

    function getCourseByStudentSection() {
        $this->db->select(' * ');
        $this->db->from($this->table_name);
        $session = $this->session->userdata('admin_session');
        if (isset($session->course_id) && $session->course_id != 0) {
            $this->db->where_in('course_id', explode(',', $session->course_id));
        }
        $res = $this->db->get();

        if ($res->num_rows > 0) {
            return $res->result();
        } else {
            return false;
        }
    }

}

?>