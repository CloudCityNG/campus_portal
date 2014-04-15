<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class studnet_images_model extends CI_model {

    public $image_id;
    public $student_id;
    public $student_image;
    public $sign;
    public $ssc_marksheet;
    public $hsc_marksheet;
    public $migration_certificate;
    public $leaving_certificate;
    public $cast_certificate;
    public $aids_certificate;
    public $create_id;
    public $create_date_time;
    public $modify_id;
    public $modify_date_time;
    private $table_name = 'studnet_images';

    function __construct() {
        parent::__construct();
    }

    function validationRules() {
        $validation_rules = array();
        return $validation_rules;
    }

    function convertObject($old) {
        $new = new studnet_images_model();
        $new->image_id = $old->image_id;
        $new->student_id = $old->student_id;
        $new->student_image = $old->student_image;
        $new->sign = $old->sign;
        $new->ssc_marksheet = $old->ssc_marksheet;
        $new->hsc_marksheet = $old->hsc_marksheet;
        $new->migration_certificate = $old->migration_certificate;
        $new->leaving_certificate = $old->leaving_certificate;
        $new->cast_certificate = $old->cast_certificate;
        $new->aids_certificate = $old->aids_certificate;
        $new->create_id = $old->create_id;
        $new->create_date_time = $old->create_date_time;
        $new->modify_id = $old->modify_id;
        $new->modify_date_time = $old->modify_date_time;
        return $new;
    }

    function toArray() {
        $arr = array();
        if ($this->image_id != '')
            $arr['image_id'] = $this->image_id;

        if ($this->student_id != '')
            $arr['student_id'] = $this->student_id;

        if ($this->student_image != '')
            $arr['student_image'] = $this->student_image;

        if ($this->sign != '')
            $arr['sign'] = $this->sign;

        if ($this->ssc_marksheet != '')
            $arr['ssc_marksheet'] = $this->ssc_marksheet;

        if ($this->hsc_marksheet != '')
            $arr['hsc_marksheet'] = $this->hsc_marksheet;

        if ($this->migration_certificate != '')
            $arr['migration_certificate'] = $this->migration_certificate;

        if ($this->leaving_certificate != '')
            $arr['leaving_certificate'] = $this->leaving_certificate;

        if ($this->cast_certificate != '')
            $arr['cast_certificate'] = $this->cast_certificate;

        if ($this->aids_certificate != '')
            $arr['aids_certificate'] = $this->aids_certificate;

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
            $orderby = 'image_id';
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
            $orderby = 'image_id';
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
        unset($array['image_id']);
        $this->db->where('image_id', $this->image_id);
        $this->db->update($this->table_name, $array);
        return TRUE;
    }

    function deleteData() {
        $this->db->where('image_id', $this->image_id);
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