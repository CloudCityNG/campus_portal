<?php

function getMarks($edu_master_id, $subject, $field) {
    $ci = get_instance();
    $ci->load->model('student_edu_details_model');
    $edu_detail_info = $ci->student_edu_details_model->getWhere(array('edu_master_id' => $edu_master_id, 'subject' => $subject));

    if (!empty($edu_detail_info)) {
        return $edu_detail_info[0]->$field;
    }
}
