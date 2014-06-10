<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class student_basic_ug_details_model extends CI_model {

    public $student_detail_id;
    public $student_id;
    public $hallticket;
    public $center_pref_1;
    public $center_pref_2;
    public $center_pref_3;
    public $create_id;
    public $create_date_time;
    public $modify_id;
    public $modify_date_time;
    private $table_name = 'student_basic_ug_details';

    function __construct() {
        parent::__construct();
    }

    function validationRules() {
        $validation_rules = array();
        return $validation_rules;
    }

    function convertObject($old) {
        $new = new student_basic_ug_details_model();
        $new->student_detail_id = $old->student_detail_id;
        $new->student_id = $old->student_id;
        $new->hallticket = $old->hallticket;
        $new->center_pref_1 = $old->center_pref_1;
        $new->center_pref_2 = $old->center_pref_2;
        $new->center_pref_3 = $old->center_pref_3;
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

        if ($this->hallticket != '')
            $arr['hallticket'] = $this->hallticket;

        if ($this->center_pref_1 != '')
            $arr['center_pref_1'] = $this->center_pref_1;

        if ($this->center_pref_2 != '')
            $arr['center_pref_2'] = $this->center_pref_2;

        if ($this->center_pref_3 != '')
            $arr['center_pref_3'] = $this->center_pref_3;

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
        $this->db->where('student_detail_id', $this->student_detail_id);
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

    function generateHallTicketNumber($center_peref_1, $year) {
        $res = $this->getWhere(array('center_pref_1' => $center_peref_1), 1, 'student_id', 'desc');

        if (!empty($res)) {
            $last_id = substr($res[0]->hallticket, 4);
        } else {
            $this->load->model('exam_centers_model');
            $exam = $this->exam_centers_model->getWhere(array('center_id' => $center_peref_1));
            $last_id = $exam[0]->code;
        }

        return $year . ($last_id + 1);
    }

}

?>