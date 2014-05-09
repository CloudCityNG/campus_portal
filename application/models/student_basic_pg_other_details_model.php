<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class student_basic_pg_other_details_model extends CI_model {

    public $student_detail_id;
    public $student_id;
    public $preference_1;
    public $preference_2;
    public $preference_3;
    public $course_special_id;
    public $create_id;
    public $create_date_time;
    public $modify_id;
    public $modify_date_time;
    private $table_name = 'student_basic_pg_other_details';

    function __construct() {
        parent::__construct();
    }

    function validationRules() {
        $validation_rules = array();
        return $validation_rules;
    }

    function convertObject($old) {
        $new = new student_basic_info_pg_other_model();
        $new->student_detail_id = $old->student_detail_id;
        $new->student_id = $old->student_id;
        $new->preference_1 = $old->preference_1;
        $new->preference_2 = $old->preference_2;
        $new->preference_3 = $old->preference_3;
        $new->course_special_id = $old->course_special_id;
        $new->create_id = $old->create_id;
        $new->create_date_time = $old->create_date_time;
        $new->modify_id = $old->modify_id;
        $new->modify_date_time = $old->modify_date_time;
        return $new;
    }

    function toArray() {
        $arr = array();
        if ($this->student_detail_id != '')
            $arr['student_detail_id'] = $this->student_detail_id;

        if ($this->student_id != '')
            $arr['student_id'] = $this->student_id;

        if ($this->preference_1 != '')
            $arr['preference_1'] = $this->preference_1;

        if ($this->preference_2 != '')
            $arr['preference_2'] = $this->preference_2;

        if ($this->preference_3 != '')
            $arr['preference_3'] = $this->preference_3;

        if ($this->course_special_id != '')
            $arr['course_special_id'] = $this->course_special_id;

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
            $orderby = 'student_detail_id';
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
            $orderby = 'student_detail_id';
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
        unset($array['student_detail_id']);
        unset($array['student_id']);
        if ($this->student_id != '') {
            $this->db->where('student_id', $this->student_id);
        } else {
            $this->db->where('student_detail_id', $this->student_detail_id);
        }
        $this->db->update($this->table_name, $array);
        return TRUE;
    }

    function deleteData() {
        $this->db->where('student_detail_id', $this->student_detail_id);
        $this->db->delete($this->table_name);
        $check = $this->db->affected_rows();
        if ($check > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>