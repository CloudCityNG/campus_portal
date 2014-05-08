<?php

function getMarks($edu_master_id, $subject, $field) {
    $ci = get_instance();
    $ci->load->model('student_edu_details_model');
    $edu_detail_info = $ci->student_edu_details_model->getWhere(array('edu_master_id' => $edu_master_id, 'subject' => $subject));

    if (!empty($edu_detail_info)) {
        return $edu_detail_info[0]->$field;
    }
}

function getCoursePreference($id) {
    $ci = get_instance();
    $ci->load->model('course_specialization_model');
    $detail = $ci->course_specialization_model->getWhere(array('course_special_id' => $id));

    if (!empty($detail)) {
        return $detail[0];
    }
}

function getHallTicket($student_id, $degree) {
    $ci = get_instance();
    $ci->load->model('student_basic_ug_details_model');
    $ci->load->model('student_basic_pg_details_model');

    if ($degree == 'UG') {
        $detail = $ci->student_basic_ug_details_model->getWhere(array('student_id' => $student_id));
    } else {
        $detail = $ci->student_basic_pg_details_model->getWhere(array('student_id' => $student_id));
    }


    if (!empty($detail)) {
        return $detail[0]->hallticket;
    }
}
