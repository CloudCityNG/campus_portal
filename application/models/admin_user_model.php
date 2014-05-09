<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class admin_user_model extends CI_model {

    public $admin_id;
    public $username;
    public $password;
    public $full_name;
    public $email_address;
    public $dept_id;
    public $course_id;
    public $role;
    public $status;
    public $create_id;
    public $create_date_time;
    public $modify_id;
    public $modify_date_time;
    private $table_name = 'admin_user';

    function __construct() {
        parent::__construct();
    }

    function validationRules() {
        $validation_rules = array();
        return $validation_rules;
    }

    function convertObject($old) {
        $new = new admin_user_model();
        $new->admin_id = $old->admin_id;
        $new->username = $old->username;
        $new->password = $old->password;
        $new->full_name = $old->full_name;
        $new->email_address = $old->email_address;
        $new->dept_id = $old->dept_id;
        $new->course_id = $old->course_id;
        $new->role = $old->role;
        $new->status = $old->status;
        $new->create_id = $old->create_id;
        $new->create_date_time = $old->create_date_time;
        $new->modify_id = $old->modify_id;
        $new->modify_date_time = $old->modify_date_time;
        return $new;
    }

    function toArray() {
        $arr = array();
        if ($this->admin_id != '')
            $arr['admin_id'] = $this->admin_id;

        if ($this->username != '')
            $arr['username'] = $this->username;

        if ($this->password != '')
            $arr['password'] = $this->password;

        if ($this->full_name != '')
            $arr['full_name'] = $this->full_name;

        if ($this->email_address != '')
            $arr['email_address'] = $this->email_address;

        if ($this->dept_id != '')
            $arr['dept_id'] = $this->dept_id;
        
        if ($this->course_id != '')
            $arr['course_id'] = $this->course_id;

        if ($this->role != '')
            $arr['role'] = $this->role;

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
            $orderby = 'admin_id';
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
            $orderby = 'admin_id';
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
        unset($array['admin_id']);
        $this->db->where('admin_id', $this->admin_id);
        $this->db->update($this->table_name, $array);
        return TRUE;
    }

    function deleteData() {
        $this->db->where('admin_id', $this->admin_id);
        $this->db->delete($this->table_name);
        $check = $this->db->affected_rows();
        if ($check > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_login() {
        $this->db->where('dept_id', $this->input->post('dept_id'));
        $this->db->where('username', $this->input->post('email_address'));
        $this->db->where('password', md5($this->input->post('password')));
        $query = $this->db->get($this->table_name);
        $query->result();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            return $result;
        } else {
            return false;
        }
    }

    public function check_mail($randid, $email_address) {
        $check = $this->getWhere(array('email_address' => $email_address));
        if (count($check) == 1) {
            if ($check[0]->status == 'A') {
                $this->password = $randid;
                $this->userid = $check[0]->userid;
                $this->updateData();
                return $email_address;
            } else {
                return 1;
            }
        } else {
            return 2;
        }
    }

}

?>