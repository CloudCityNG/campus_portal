<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

Class admission_candidate_status_model extends CI_model {

public $admission_status_id;
public $name;
public $status;
public $create_id;
public $create_date_time;
public $modify_id;
public $modify_date_time;
private $table_name='admission_candidate_status';


function __construct() {
	parent::__construct();
}

function validationRules() {
	$validation_rules = array();
return $validation_rules;
}

function convertObject($old) { 
	$new = new admission_candidate_status_model();
	$new->admission_status_id = $old->admission_status_id;
	$new->name = $old->name;
	$new->status = $old->status;
	$new->create_id = $old->create_id;
	$new->create_date_time = $old->create_date_time;
	$new->modify_id = $old->modify_id;
	$new->modify_date_time = $old->modify_date_time;
	return $new;
}

function toArray() { 
	$arr = array();
	if($this->admission_status_id != '')
	 $arr['admission_status_id'] = $this->admission_status_id;

	if($this->name != '')
	 $arr['name'] = $this->name;

	if($this->status != '')
	 $arr['status'] = $this->status;

	if($this->create_id != '')
	 $arr['create_id'] = $this->create_id;

	if($this->create_date_time != '')
	 $arr['create_date_time'] = $this->create_date_time;

	if($this->modify_id != '')
	 $arr['modify_id'] = $this->modify_id;

	if($this->modify_date_time != '')
	 $arr['modify_date_time'] = $this->modify_date_time;

	return $arr;
}

function getWhere($where, $limit = null, $orderby = null, $ordertype = null) {
	$objects = array();
	$this->db->select(' * ');
	$this->db->from($this->table_name);
	$this->db->where($where);
	if (is_null($orderby)) {
	    $orderby = 'admission_status_id';
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
	    $orderby = 'admission_status_id';
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
	if($check > 0) {
		return $this->db->insert_id();
	} else {
		return FALSE;
	}
}

function updateData() {
	$array = $this->toArray();
	unset($array['admission_status_id']);
	$this->db->where('admission_status_id', $this->admission_status_id);
	$this->db->update($this->table_name, $array);
		return TRUE;
}

function deleteData() {
	$this->db->where('admission_status_id', $this->admission_status_id);
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