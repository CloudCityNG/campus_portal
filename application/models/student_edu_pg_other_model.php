<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class student_edu_pg_other_model extends CI_model {

    public $pg_other_edu_id;
    public $student_id;
    public $course;
    public $year;
    public $uni_institute;
    public $board;
    public $total_percentage;
    public $rank;
    public $create_id;
    public $create_date_time;
    public $modify_id;
    public $modify_date_time;
    private $table_name = 'student_edu_pg_other';

    function __construct() {
        parent::__construct();
    }

    function validationRules() {
        $validation_rules = array();
        return $validation_rules;
    }

    function convertObject($old) {
        $new = new student_edu_pg_other_model();
        $new->pg_other_edu_id = $old->pg_other_edu_id;
        $new->student_id = $old->student_id;
        $new->course = $old->course;
        $new->year = $old->year;
        $new->uni_institute = $old->uni_institute;
        $new->board = $old->board;
        $new->total_percentage = $old->total_percentage;
        $new->rank = $old->rank;
        $new->create_id = $old->create_id;
        $new->create_date_time = $old->create_date_time;
        $new->modify_id = $old->modify_id;
        $new->modify_date_time = $old->modify_date_time;
        return $new;
    }

    function toArray() {
        $arr = array();
        if ($this->pg_other_edu_id != '')
            $arr['pg_other_edu_id'] = $this->pg_other_edu_id;

        if ($this->student_id != '')
            $arr['student_id'] = $this->student_id;

        if ($this->course != '')
            $arr['course'] = $this->course;

        if ($this->year != '')
            $arr['year'] = $this->year;

        if ($this->uni_institute != '')
            $arr['uni_institute'] = $this->uni_institute;

        if ($this->board != '')
            $arr['board'] = $this->board;

        if ($this->total_percentage != '')
            $arr['total_percentage'] = $this->total_percentage;

        if ($this->rank != '')
            $arr['rank'] = $this->rank;

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
            $orderby = 'pg_other_edu_id';
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
            $orderby = 'pg_other_edu_id';
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
        unset($array['pg_other_edu_id']);
        $this->db->where('pg_other_edu_id', $this->pg_other_edu_id);
        $this->db->update($this->table_name, $array);
        return TRUE;
    }

    function deleteData() {
        $this->db->where('pg_other_edu_id', $this->pg_other_edu_id);
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