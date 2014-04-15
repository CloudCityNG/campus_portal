<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class student_foregin_details_model extends CI_model {

    public $foregin_detail_id;
    public $student_id;
    public $detail_pp;
    public $passport_no;
    public $country;
    public $issue;
    public $expire_date;
    public $visa_type;
    public $aids_dearance;
    public $create_id;
    public $create_date_time;
    public $modify_id;
    public $modify_date_time;
    private $table_name = 'student_foregin_details';

    function __construct() {
        parent::__construct();
    }

    function validationRules() {
        $validation_rules = array();
        return $validation_rules;
    }

    function convertObject($old) {
        $new = new student_foregin_details_model();
        $new->foregin_detail_id = $old->foregin_detail_id;
        $new->student_id = $old->student_id;
        $new->detail_pp = $old->detail_pp;
        $new->passport_no = $old->passport_no;
        $new->country = $old->country;
        $new->issue = $old->issue;
        $new->expire_date = $old->expire_date;
        $new->visa_type = $old->visa_type;
        $new->aids_dearance = $old->aids_dearance;
        $new->create_id = $old->create_id;
        $new->create_date_time = $old->create_date_time;
        $new->modify_id = $old->modify_id;
        $new->modify_date_time = $old->modify_date_time;
        return $new;
    }

    function toArray() {
        $arr = array();
        if ($this->foregin_detail_id != '')
            $arr['foregin_detail_id'] = $this->foregin_detail_id;

        if ($this->student_id != '')
            $arr['student_id'] = $this->student_id;

        if ($this->detail_pp != '')
            $arr['detail_pp'] = $this->detail_pp;

        if ($this->passport_no != '')
            $arr['passport_no'] = $this->passport_no;

        if ($this->country != '')
            $arr['country'] = $this->country;

        if ($this->issue != '')
            $arr['issue'] = $this->issue;

        if ($this->expire_date != '')
            $arr['expire_date'] = $this->expire_date;

        if ($this->visa_type != '')
            $arr['visa_type'] = $this->visa_type;

        if ($this->aids_dearance != '')
            $arr['aids_dearance'] = $this->aids_dearance;

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
            $orderby = 'foregin_detail_id';
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
            $orderby = 'foregin_detail_id';
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
        unset($array['foregin_detail_id']);
        $this->db->where('foregin_detail_id', $this->foregin_detail_id);
        $this->db->update($this->table_name, $array);
        return TRUE;
    }

    function deleteData() {
        $this->db->where('foregin_detail_id', $this->foregin_detail_id);
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