<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class student_edu_details_model extends CI_model {

    public $edu_detail_id;
    public $edu_master_id;
    public $subject;
    public $theory_min_mark;
    public $theory_max_mark;
    public $pratical_min_mark;
    public $pratical_max_mark;
    public $total_min_mark;
    public $total_max_mark;
    public $create_id;
    public $create_date_time;
    public $modify_id;
    public $modify_date_time;
    private $table_name = 'student_edu_details';

    function __construct() {
        parent::__construct();
    }

    function validationRules() {
        $validation_rules = array();
        return $validation_rules;
    }

    function convertObject($old) {
        $new = new student_edu_details_model();
        $new->edu_detail_id = $old->edu_detail_id;
        $new->edu_master_id = $old->edu_master_id;
        $new->subject = $old->subject;
        $new->theory_min_mark = $old->theory_min_mark;
        $new->theory_max_mark = $old->theory_max_mark;
        $new->pratical_min_mark = $old->pratical_min_mark;
        $new->pratical_max_mark = $old->pratical_max_mark;
        $new->total_min_mark = $old->total_min_mark;
        $new->total_max_mark = $old->total_max_mark;
        $new->create_id = $old->create_id;
        $new->create_date_time = $old->create_date_time;
        $new->modify_id = $old->modify_id;
        $new->modify_date_time = $old->modify_date_time;
        return $new;
    }

    function toArray() {
        $arr = array();
        if ($this->edu_detail_id != '')
            $arr['edu_detail_id'] = $this->edu_detail_id;

        if ($this->edu_master_id != '')
            $arr['edu_master_id'] = $this->edu_master_id;

        if ($this->subject != '')
            $arr['subject'] = $this->subject;

        if ($this->theory_min_mark != '')
            $arr['theory_min_mark'] = $this->theory_min_mark;

        if ($this->theory_max_mark != '')
            $arr['theory_max_mark'] = $this->theory_max_mark;

        if ($this->pratical_min_mark != '')
            $arr['pratical_min_mark'] = $this->pratical_min_mark;

        if ($this->pratical_max_mark != '')
            $arr['pratical_max_mark'] = $this->pratical_max_mark;

        if ($this->total_min_mark != '')
            $arr['total_min_mark'] = $this->total_min_mark;

        if ($this->total_max_mark != '')
            $arr['total_max_mark'] = $this->total_max_mark;

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
            $orderby = 'edu_detail_id';
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
            $orderby = 'edu_detail_id';
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
        unset($array['edu_detail_id']);
        $this->db->where('edu_detail_id', $this->edu_detail_id);
        $this->db->update($this->table_name, $array);
        return TRUE;
    }

    function deleteData() {
        $this->db->where('edu_detail_id', $this->edu_detail_id);
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