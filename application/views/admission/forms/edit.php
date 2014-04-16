<script>
    $(function() {
        $('#edit_form a[href="#<?php echo @$tab; ?>"]').tab('show')


<?php $date = date('m/d/Y', strtotime(get_current_date_time()->get_date_for_db())); ?>
        $("#dob").datepicker({dateFormat: 'dd-mm-yy', maxDate:<?php echo $date; ?>, changeMonth: true, changeYear: true, yearRange: "1900:<?php echo date('Y'); ?>"});

        $("#ssc_from_date").datepicker({dateFormat: 'dd-mm-yy', maxDate:<?php echo $date; ?>, changeMonth: true, changeYear: true, yearRange: "1900:<?php echo date('Y'); ?>"});

        $("#ssc_to_date").datepicker({dateFormat: 'dd-mm-yy', maxDate:<?php echo $date; ?>, changeMonth: true, changeYear: true, yearRange: "1900:<?php echo date('Y'); ?>"});

        $("#hsc_from_date").datepicker({dateFormat: 'dd-mm-yy', maxDate:<?php echo $date; ?>, changeMonth: true, changeYear: true, yearRange: "1900:<?php echo date('Y'); ?>"});

        $("#hsc_to_date").datepicker({dateFormat: 'dd-mm-yy', maxDate:<?php echo $date; ?>, changeMonth: true, changeYear: true, yearRange: "1900:<?php echo date('Y'); ?>"});

        $("#expire_date").datepicker({dateFormat: 'dd-mm-yy', minDate:<?php echo $date; ?>, changeMonth: true, changeYear: true, yearRange: "<?php echo date('Y') . ':' . (date('Y') + 30); ?>"});



        $('#result_wating').click(function() {
            if ($("#result_wating").is(':checked')) {
                $("#hsc_from_date").attr('disabled', true);
                $("#hsc_to_date").attr('disabled', true);
                $("#hsc_percentage").attr('disabled', true);
                $("#hsc_rank").attr('disabled', true);
                $("#edu_details").hide();
            }
            else {
                $("#hsc_from_date").attr('disabled', false);
                $("#hsc_to_date").attr('disabled', false);
                $("#hsc_percentage").attr('disabled', false);
                $("#hsc_rank").attr('disabled', false);
                $("#edu_details").show();
            }
        });

    });

    function countCheckBoxes(id, name, value) {
        var checkbox = document.getElementsByName(name);
        var checkboxCount = 0;
        for (var i = 0, length = checkbox.length; i < length; i++) {
            if (checkbox[i].checked) {
                checkboxCount++;
            }
        }

        if (checkboxCount > value) {
            $("#" + id).attr('checked', false);
            $('#info').modal('show');
        }
    }
</script>
<style>
    .nav-tabs > li, .nav-pills > li {
        float:none;
        display:inline-block;
        *display:inline; /* ie7 fix */
        zoom:1; /* hasLayout ie7 trigger */
    }

    .nav-tabs, .nav-pills {
        text-align:center;
    }
</style>

<h2 class="text-center">New Admission</h2>

<ul id="edit_form" class="nav nav-tabs">
    <li class=""><a href="#basic_info" data-toggle="tab">Basic Information</a></li>
    <li class=""><a href="#edu_info" data-toggle="tab">Education Information</a></li>
    <li class=""><a href="#languages" data-toggle="tab">Languages Know</a></li>
    <li class=""><a href="#foreign_detials" data-toggle="tab">Foreign Details</a></li>
    <li class=""><a href="#require_doc" data-toggle="tab">Require Documents</a></li>
</ul>

<div id="myTabContent" class="tab-content">
    <div class="tab-pane in active" id="basic_info">
        <script>
            $(function() {
                $('#info_basic').validate();
            });
        </script>
        <h3 class="text-center">Basic Information</h3>
        <form action="<?php echo ADMISSION_URL . 'forms/update_ug_basic/' . $student_id; ?>" method="post" class="form-horizontal" id="info_basic">
            <div class="form-group">
                <div class="col-md-12 text-center">
                    Fields marked with  <span class="text-danger">*</span>  are mandatory.
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label class="col-md-12 text-center">
                        Select Course
                        <span class="text-danger">*</span>
                    </label>

                    <?php foreach ($course_details as $course) { ?>
                        <div class="radio">
                            <label for="radios-0">
                                <input type="radio" name="cid" value="<?php echo @$course->course_id; ?>" class="required" <?php
                                if (@$basic_info[0]->course_id == $course->course_id) {
                                    echo 'checked="checked"';
                                }
                                ?> disabled="disabled"/>
                                       <?php echo @$course->name; ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-6">
                    <label class="col-md-12 text-center">
                        Select Exam Center
                        <span class="text-danger">*</span>
                    </label>
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <th rowspan="2">Examination Center</th>
                            <th rowspan="2">Code</th>
                            <th colspan="4">Preference</th>
                        </tr>
                        <tr>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                        </tr>

                        <?php
                        $i = 1;
                        foreach ($center_details as $center) {
                            ?>
                            <tr>
                                <td><?php echo @$center->name; ?></td>
                                <td class="text-center"><?php echo @$center->code; ?></td>
                                <th>
                                    <label for="<?php echo $i; ?>" >
                                        <input disabled="disabled" type="checkbox" name="p1[]" id="<?php echo $i; ?>" class="required" value="<?php echo @$center->center_id; ?>" <?php
                                        if (@$basic_info[0]->center_pref_1 == @$center->center_id) {
                                            echo 'checked="checked"';
                                        }
                                        ?> onclick="countCheckBoxes(<?php
                                               echo $i;
                                               $i++;
                                               ?>, 'p1[]', '1')">
                                    </label>
                                </th>
                                <th>
                                    <label for="<?php echo $i; ?>" >
                                        <input disabled="disabled" type="checkbox" name="p2[]" id="<?php echo $i; ?>" class="required" value="<?php echo @$center->center_id; ?>"  <?php
                                        if (@$basic_info[0]->center_pref_2 == @$center->center_id) {
                                            echo 'checked="checked"';
                                        }
                                        ?> onclick="countCheckBoxes(<?php
                                               echo $i;
                                               $i++;
                                               ?>, 'p2[]', '1')">
                                    </label>
                                </th>
                                <th>
                                    <label for="<?php echo $i; ?>" >
                                        <input disabled="disabled" type="checkbox" name="p3[]" id="<?php echo $i; ?>" class="required" value="<?php echo @$center->center_id; ?>"  <?php
                                        if (@$basic_info[0]->center_pref_3 == @$center->center_id) {
                                            echo 'checked="checked"';
                                        }
                                        ?>  onclick="countCheckBoxes(<?php
                                               echo $i;
                                               $i++;
                                               ?>, 'p3[]', '1')">
                                    </label>
                                </th>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>

            <hr />

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Sur Name
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="lastname"  value="<?php echo @$basic_info[0]->lastname; ?>" class="form-control required" placeholder = "Surname" />
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    First Name
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="firstname"  value="<?php echo @$basic_info[0]->firstname; ?>" class="form-control required" placeholder = "First name" />
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Middle Name
                    <span class="text-danger">&nbsp;</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="middlename"  value="<?php echo @$basic_info[0]->middlename; ?>" class="form-control" placeholder = "Middle name" />
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Address
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <textarea class="form-control required" name="address"><?php echo @$basic_info[0]->address; ?></textarea>
                </div>
            </div>

            <div class = "form-group">
                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Pincode
                        <span class="text-danger">&nbsp;</span>
                    </label>
                    <div class = "col-md-8">
                        <input type="text" name="pincode" value="<?php echo @$basic_info[0]->pincode; ?>" class="form-control" placeholder = "Pincode" />
                    </div>
                </div>
            </div>

            <div class = "form-group">
                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Phone Number
                        <span class="text-danger">&nbsp;</span>
                    </label>
                    <div class = "col-md-8">
                        <input type="text" name="phone_no" value="<?php echo @$basic_info[0]->phone_no; ?>" class="form-control" placeholder = "Phone Number with STD code" />
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for="question" class="col-md-3 control-label">
                        Date of Birth
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="dob" id="dob" class="form-control required" placeholder = "Date of Birth" value="<?php echo date('d-m-Y', strtotime(@$basic_info[0]->dob)); ?>"/>
                    </div>
                </div>



            </div>

            <div class="form-group">
                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Mobile Number
                        <span class="text-danger">*</span>
                    </label>
                    <div class = "col-md-8">
                        <input type="text" name="mobile_no" value="<?php echo @$basic_info[0]->mobile_no; ?>" class="form-control required" placeholder = "Mobile Number" />
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for = "question" class = "col-md-3 control-label">
                        Email Address
                        <span class="text-danger">*</span>
                    </label>
                    <div class = "col-md-9">
                        <input type="email" name="email" value="<?php echo @$basic_info[0]->email; ?>" class="form-control required" placeholder = "Email Address" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class = "col-md-6">
                    <label for="question" class="col-md-4 control-label">
                        Gender
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-8">
                        <input type="radio" name="gender"  value="M" class="required" <?php
                        if (@$basic_info[0]->gender == 'M') {
                            echo 'checked="checked"';
                        }
                        ?>/> Male
                        <input type="radio" name="gender"  value="F" class="required" <?php
                        if (@$basic_info[0]->gender == 'F') {
                            echo 'checked="checked"';
                        }
                        ?>/> Female
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for = "question" class = "col-md-3 control-label">
                        Marital Status
                        <span class="text-danger">*</span>
                    </label>
                    <div class = "col-md-9">
                        <input type="radio" name="marital_status"  value="U" class="required" <?php
                        if (@$basic_info[0]->marital_status == 'U') {
                            echo 'checked="checked"';
                        }
                        ?>/> Single
                        <input type="radio" name="marital_status"  value="M" class="required" <?php
                        if (@$basic_info[0]->marital_status == 'M') {
                            echo 'checked="checked"';
                        }
                        ?>/> Married
                    </div>
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Father's Name
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="parent_1" value="<?php echo @$basic_info[0]->parent_1; ?>" class="form-control required" placeholder = "Father's / Husband's / Guardian's Name" />
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Occupation
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="parent_1_occupation" value="<?php echo @$basic_info[0]->parent_1_occupation; ?>"  class="form-control required" placeholder = "Occupation" />
                </div>
            </div>


            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Mother's Name
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="parent_2" value="<?php echo @$basic_info[0]->parent_2; ?>" class="form-control required" placeholder = " Mother's Name" />
                </div>
            </div>



            <div class="form-group">
                <div class = "col-md-6">
                    <label for="question" class="col-md-4 control-label">
                        Nationality
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-8">
                        <input type="text" name="nationality" value="<?php echo @$basic_info[0]->nationality; ?>" class="form-control required" placeholder = "Nationality" />
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for="question" class="col-md-4 control-label">
                        Religion
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-8">
                        <input type="text" name="religion" value="<?php echo @$basic_info[0]->religion; ?>" class="form-control required" placeholder = "Religion" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Community
                        <span class="text-danger">&nbsp;</span>
                    </label>
                    <div class="col-md-8">
                        <input type="text" name="community" value="<?php echo @$basic_info[0]->community; ?>" class="form-control" placeholder = "Community" />
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Category
                        <span class="text-danger">&nbsp;</span>
                    </label>
                    <div class="col-md-8">
                        <input type="radio" name="category" class="required" value="SC" <?php
                        if (@$basic_info[0]->category == 'SC') {
                            echo 'checked="checked"';
                        }
                        ?>/> SC &nbsp;
                        <input type="radio" name="category" class="required" value="ST" <?php
                        if (@$basic_info[0]->category == 'ST') {
                            echo 'checked="checked"';
                        }
                        ?>/> ST &nbsp;
                        <input type="radio" name="category" class="required" value="SEBC" <?php
                        if (@$basic_info[0]->category == 'SEBC') {
                            echo 'checked="checked"';
                        }
                        ?>/> SEBC <br />
                        <input type="radio" name="category" class="required" value="OBC" <?php
                        if (@$basic_info[0]->category == 'OBC') {
                            echo 'checked="checked"';
                        }
                        ?>/> OBC &nbsp;
                        <input type="radio" name="category" class="required" value="General" <?php
                        if (@$basic_info[0]->category == 'General') {
                            echo 'checked="checked"';
                        }
                        ?>/> General &nbsp;
                        <input type="radio" name="category" class="required" value="Other" <?php
                        if (@$basic_info[0]->category == 'Other') {
                            echo 'checked="checked"';
                        }
                        ?>/> Other 
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class = "col-md-6">
                    <label for="question" class="col-md-6 control-label">
                        Do you need Hostel Accommodation
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-6">
                        <input type="radio" name="hostel" class="required" value="Y" <?php
                        if (@$basic_info[0]->hostel == 'Y') {
                            echo 'checked="checked"';
                        }
                        ?>/> Yes &nbsp;
                        <input type="radio" name="hostel" class="required" value="N" <?php
                        if (@$basic_info[0]->hostel == 'N') {
                            echo 'checked="checked"';
                        }
                        ?>/> No &nbsp;
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for="question" class="col-md-6 control-label">
                        Do you need Transport Facility
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-6">
                        <input type="radio" name="transoprt" class="required" value="Y" <?php
                        if (@$basic_info[0]->transoprt == 'Y') {
                            echo 'checked="checked"';
                        }
                        ?>/> Yes &nbsp;
                        <input type="radio" name="transoprt" class="required" value="N" <?php
                        if (@$basic_info[0]->transoprt == 'N') {
                            echo 'checked="checked"';
                        }
                        ?>/> No &nbsp;
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Next &nbsp; <i class="glyphicon glyphicon-arrow-right"></i></button>
                    <a href="<?php echo ADMISSION_URL . 'forms'; ?>" class="btn btn-inverse">Cancel</a>
                </div>
            </div>

        </form>
    </div>

    <div class="tab-pane in active" id="edu_info">
        <script>
            $(function() {
                $('#info_edu').validate();
            });
        </script>
        <h3 class="text-center">Education Information</h3>
        <h5>Academic Record :</h5>
        <form action="<?php echo ADMISSION_URL . 'forms/update_ug_education/' . $student_id ?>" method="post" class="form-horizontal" id="info_edu">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Course</th>
                        <th>Result Waiting</th>
                        <th>Year</th>
                        <th>Institute</th>
                        <th>University / Board</th>
                        <th>From <br /> (dd-mm-yyyy)</th>
                        <th>To <br /> (dd-mm-yyyy)</th>
                        <th>Percentage / Grade</th>
                        <th>Rank</th>
                    </tr>

                    <tr>
                        <td>S.S.C <input type="hidden" name="ssc_course" value="S.S.C" /></td>
                        <td>&nbsp;</td>
                        <td><input type="text" name="ssc_year" value="<?php echo @$edu_master_info[1]->year; ?>" class="form-control required"/></td>
                        <td><input type="text" name="ssc_uni_institute" value="<?php echo @$edu_master_info[1]->uni_institute; ?>" class="form-control required"/></td>
                        <td><input type="text" name="ssc_board" value="<?php echo @$edu_master_info[1]->board; ?>" class="form-control required"/></td>
                        <td><input type="text" name="ssc_from_date" id="ssc_from_date" value="<?php echo (date('d-m-Y', strtotime(@$edu_master_info[1]->from_date)) == '01-01-1970') ? '' : date('d-m-Y', strtotime(@$edu_master_info[1]->from_date)); ?>" class="form-control required"/></td>
                        <td><input type="text" name="ssc_to_date" id="ssc_to_date" value="<?php echo (date('d-m-Y', strtotime(@$edu_master_info[1]->to_date)) == '01-01-1970') ? '' : date('d-m-Y', strtotime(@$edu_master_info[1]->to_date)); ?>" class="form-control required"/></td>
                        <td><input type="text" name="ssc_percentage" value="<?php echo @$edu_master_info[1]->percentage; ?>" class="form-control required"/></td>
                        <td><input type="text" name="ssc_rank" value="<?php echo @$edu_master_info[1]->rank; ?>" class="form-control required"/></td>
                    </tr>

                    <tr>
                        <td>H.S.C <input type="hidden" name="hsc_course" value="H.S.C" /></td>
                        <td class="text-center"><input type="checkbox" name="result_wating" id="result_wating" value="Y"/></td>
                        <td><input type="text" name="hsc_year" value="<?php echo @$edu_master_info[0]->year; ?>" class="form-control required"/></td>
                        <td><input type="text" name="hsc_uni_institute" value="<?php echo @$edu_master_info[0]->uni_institute; ?>" class="form-control required"/></td>
                        <td><input type="text" name="hsc_board" value="<?php echo @$edu_master_info[0]->board; ?>" class="form-control required"/></td>
                        <td><input type="text" name="hsc_from_date" id="hsc_from_date" value="<?php echo (date('d-m-Y', strtotime(@$edu_master_info[0]->from_date)) == '01-01-1970') ? '' : date('d-m-Y', strtotime(@$edu_master_info[0]->from_date)); ?>" class="form-control required"/></td>
                        <td><input type="text" name="hsc_to_date" id="hsc_to_date" value="<?php echo (date('d-m-Y', strtotime(@$edu_master_info[0]->to_date)) == '01-01-1970') ? '' : date('d-m-Y', strtotime(@$edu_master_info[0]->to_date)); ?>" class="form-control required"/></td>
                        <td><input type="text" name="hsc_percentage" id="hsc_percentage" value="<?php echo @$edu_master_info[0]->percentage; ?>" class="form-control required"/></td>
                        <td><input type="text" name="hsc_rank" id="hsc_rank" value="<?php echo @$edu_master_info[0]->rank; ?>" class="form-control required"/></td>
                    </tr>

                </table>
                <br />
                <h5>Details of 12 Examination :</h5>
                <table  id="edu_details" class="table table-bordered table-responsive">
                    <tr>
                        <th rowspan="2">Subject</th>
                        <th colspan="2">Theory</th>
                        <th colspan="2">Practical</th>
                    </tr>

                    <tr>
                        <th>Max Marks</th>
                        <th>Marks Scored</th>
                        <th>Max Marks</th>
                        <th>Marks Scored</th>
                    </tr>

                    <tr>
                        <td><input type="text" name="subject[]" value="Physics" class="form-control" readonly/></td>
                        <td><input type="text" name="max_theory_marks[0]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Physics', 'theory_max_mark'); ?>" class="hsc_marks form-control text-center required"/></td>
                        <td><input type="text" name="min_theroy_marks[0]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Physics', 'theory_min_mark'); ?>" class="hsc_marks form-control text-center required"/></td>
                        <td><input type="text" name="max_pratical_marks[0]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Physics', 'pratical_max_mark'); ?>" class="hsc_marks form-control text-center required"/></td>
                        <td><input type="text" name="min_pratical_marks[0]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Physics', 'pratical_min_mark'); ?>" class="hsc_marks form-control text-center required"/></td>
                    </tr>

                    <tr>
                        <td><input type="text" name="subject[]" value="Chemistry" class="form-control" readonly/></td>
                        <td><input type="text" name="max_theory_marks[1]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Physics', 'theory_max_mark'); ?>" class="hsc_marks form-control text-center required"/></td>
                        <td><input type="text" name="min_theroy_marks[1]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Physics', 'theory_min_mark'); ?>" class="hsc_marks form-control text-center required"/></td>
                        <td><input type="text" name="max_pratical_marks[1]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Physics', 'pratical_max_mark'); ?>" class="hsc_marks form-control text-center required"/></td>
                        <td><input type="text" name="min_pratical_marks[1]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Physics', 'pratical_min_mark'); ?>" class="hsc_marks form-control text-center required"/></td>
                    </tr>

                    <tr>
                        <td><input type="text" name="subject[]" value="Biology" class="form-control" readonly/></td>
                        <td><input type="text" name="max_theory_marks[2]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Biology', 'theory_max_mark'); ?>" class="hsc_marks form-control text-center required"/></td>
                        <td><input type="text" name="min_theroy_marks[2]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Biology', 'theory_min_mark'); ?>" class="hsc_marks form-control text-center required"/></td>
                        <td><input type="text" name="max_pratical_marks[2]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Biology', 'pratical_max_mark'); ?>" class="hsc_marks form-control text-center required"/></td>
                        <td><input type="text" name="min_pratical_marks[2]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Biology', 'pratical_min_mark'); ?>" class="hsc_marks form-control text-center required"/></td>
                    </tr>

                    <tr>
                        <td><input type="text" name="subject[]" value="Mathematics" class="form-control" readonly/></td>
                        <td><input type="text" name="max_theory_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Mathematics', 'theory_max_mark'); ?>" class="form-control text-center"/></td>
                        <td><input type="text" name="min_theroy_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Mathematics', 'theory_min_mark'); ?>" class="form-control text-center"/></td>
                        <td><input type="text" name="max_pratical_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Mathematics', 'pratical_max_mark'); ?>" class="form-control text-center"/></td>
                        <td><input type="text" name="min_pratical_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Mathematics', 'pratical_min_mark'); ?>" class="form-control text-center"/></td>
                    </tr>

                    <tr>
                        <td><input type="text" name="subject[]" value="English" class="form-control" readonly/></td>
                        <td><input type="text" name="max_theory_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'English', 'theory_max_mark'); ?>" class="form-control text-center"/></td>
                        <td><input type="text" name="min_theroy_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'English', 'theory_min_mark'); ?>" class="form-control text-center"/></td>
                        <td><input type="text" name="max_pratical_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'English', 'pratical_max_mark'); ?>" class="form-control text-center"/></td>
                        <td><input type="text" name="min_pratical_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'English', 'pratical_min_mark'); ?>" class="form-control text-center"/></td>
                    </tr>

                    <tr>
                        <td><input type="text" name="subject[]" value="Computer Science" class="form-control" readonly/></td>
                        <td><input type="text" name="max_theory_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Computer Science', 'theory_max_mark'); ?>" class="form-control text-center"/></td>
                        <td><input type="text" name="min_theroy_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Computer Science', 'theory_min_mark'); ?>" class="form-control text-center"/></td>
                        <td><input type="text" name="max_pratical_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Computer Science', 'pratical_max_mark'); ?>" class="form-control text-center"/></td>
                        <td><input type="text" name="min_pratical_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Computer Science', 'pratical_min_mark'); ?>" class="form-control text-center"/></td>
                    </tr>

                    <tr>
                        <td><input type="text" name="subject[]" value="Others" class="form-control" readonly/></td>
                        <td><input type="text" name="max_theory_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Others', 'theory_max_mark'); ?>" class="form-control text-center"/></td>
                        <td><input type="text" name="min_theroy_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Others', 'theory_min_mark'); ?>" class="form-control text-center"/></td>
                        <td><input type="text" name="max_pratical_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Others', 'pratical_max_mark'); ?>" class="form-control text-center"/></td>
                        <td><input type="text" name="min_pratical_marks[]" value="<?php echo getMarks(@$edu_master_info[0]->edu_master_id, 'Others', 'pratical_min_mark'); ?>" class="form-control text-center"/></td>
                    </tr>
                </table>

                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Next &nbsp; <i class="glyphicon glyphicon-arrow-right"></i></button>
                        <a href="<?php echo ADMISSION_URL . 'forms'; ?>" class="btn btn-inverse">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="tab-pane in active" id="languages">
        <script>
            $(function() {
                $('#info_lang').validate();
            });
        </script>
        <h3 class="text-center">Languages Information</h3>
        <form action="<?php echo ADMISSION_URL . 'forms/update_ug_language/' . $student_id ?>" method="post" class="form-horizontal" id="info_lang">
            <table class="table table-bordered table-responsive">
                <tr>
                    <th rowspan="2" style="vertical-align: middle; ">Language</th>
                    <th colspan="3">Speaking</th>
                    <th colspan="3">Reading</th>
                    <th colspan="3">Writing</th>
                </tr>
                <tr>
                    <th width="100">Excellent</th>
                    <th width="100">Good</th>
                    <th width="100">Fair</th>
                    <th width="100">Excellent</th>
                    <th width="100">Good</th>
                    <th width="100">Fair</th>
                    <th width="100">Excellent</th>
                    <th width="100">Good</th>
                    <th width="100">Fair</th>
                </tr>

                <tr>
                    <td><input value="<?php echo ucfirst(@$languages_details[2]->name); ?>" type="text" placeholder="Language Name" name="langauge_name[]" class="form-control required"/></td>

                    <th><input type="radio" name="speaking0" value="E" <?php
                        if (@$languages_details[2]->speaking == 'E') {
                            echo 'checked="checked"';
                        }
                        ?> class="required"/></td>
                    <th><input type="radio" name="speaking0" value="G" <?php
                        if (@$languages_details[2]->speaking == 'G') {
                            echo 'checked="checked"';
                        }
                        ?> class="required"/></td>
                    <th><input type="radio" name="speaking0" value="F" <?php
                        if (@$languages_details[2]->speaking == 'F') {
                            echo 'checked="checked"';
                        }
                        ?> class="required"/></td>

                    <th><input type="radio" name="reading0" value="E" <?php
                        if (@$languages_details[2]->reading == 'E') {
                            echo 'checked="checked"';
                        }
                        ?> class="required"/></td>
                    <th><input type="radio" name="reading0" value="G" <?php
                        if (@$languages_details[2]->reading == 'G') {
                            echo 'checked="checked"';
                        }
                        ?> class="required"/></td>
                    <th><input type="radio" name="reading0" value="F" <?php
                        if (@$languages_details[2]->reading == 'F') {
                            echo 'checked="checked"';
                        }
                        ?> class="required"/></td>

                    <th><input type="radio" name="writing0" value="E" <?php
                        if (@$languages_details[2]->writing == 'E') {
                            echo 'checked="checked"';
                        }
                        ?> class="required"/></td>
                    <th><input type="radio" name="writing0" value="G" <?php
                        if (@$languages_details[2]->writing == 'G') {
                            echo 'checked="checked"';
                        }
                        ?> class="required"/></td>
                    <th><input type="radio" name="writing0" value="F" <?php
                        if (@$languages_details[2]->writing == 'F') {
                            echo 'checked="checked"';
                        }
                        ?> class="required"/></td>
                </tr>

                <tr>
                    <td><input value="<?php echo ucfirst(@$languages_details[1]->name); ?>" type="text" placeholder="Language Name" name="langauge_name[]" class="form-control"/></td>

                    <th><input type="radio" name="speaking1" value="E" <?php
                        if (@$languages_details[1]->speaking == 'E') {
                            echo 'checked="checked"';
                        }
                        ?>/></td>
                    <th><input type="radio" name="speaking1" value="G" <?php
                        if (@$languages_details[1]->speaking == 'G') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>
                    <th><input type="radio" name="speaking1" value="F" <?php
                        if (@$languages_details[1]->speaking == 'F') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>

                    <th><input type="radio" name="reading1" value="E" <?php
                        if (@$languages_details[1]->reading == 'E') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>
                    <th><input type="radio" name="reading1" value="G" <?php
                        if (@$languages_details[1]->reading == 'G') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>
                    <th><input type="radio" name="reading1" value="F" <?php
                        if (@$languages_details[1]->reading == 'F') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>

                    <th><input type="radio" name="writing1" value="E" <?php
                        if (@$languages_details[1]->writing == 'E') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>
                    <th><input type="radio" name="writing1" value="G" <?php
                        if (@$languages_details[1]->writing == 'G') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>
                    <th><input type="radio" name="writing1" value="F" <?php
                        if (@$languages_details[1]->writing == 'F') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>
                </tr>

                <tr>
                    <td><input value="<?php echo ucfirst(@$languages_details[0]->name); ?>" type="text" placeholder="Language Name" name="langauge_name[]" class="form-control"/></td>

                    <th><input type="radio" name="speaking2" value="E" <?php
                        if (@$languages_details[0]->speaking == 'E') {
                            echo 'checked="checked"';
                        }
                        ?>/></td>
                    <th><input type="radio" name="speaking2" value="G" <?php
                        if (@$languages_details[0]->speaking == 'G') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>
                    <th><input type="radio" name="speaking2" value="F" <?php
                        if (@$languages_details[0]->speaking == 'F') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>

                    <th><input type="radio" name="reading2" value="E" <?php
                        if (@$languages_details[0]->reading == 'E') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>
                    <th><input type="radio" name="reading2" value="G" <?php
                        if (@$languages_details[0]->reading == 'G') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>
                    <th><input type="radio" name="reading2" value="F" <?php
                        if (@$languages_details[0]->reading == 'F') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>

                    <th><input type="radio" name="writing2" value="E" <?php
                        if (@$languages_details[0]->writing == 'E') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>
                    <th><input type="radio" name="writing2" value="G" <?php
                        if (@$languages_details[0]->writing == 'G') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>
                    <th><input type="radio" name="writing2" value="F" <?php
                        if (@$languages_details[0]->writing == 'F') {
                            echo 'checked="checked"';
                        }
                        ?>/></th>
                </tr>
            </table>
            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Next &nbsp; <i class="glyphicon glyphicon-arrow-right"></i></button>
                    <a href="<?php echo ADMISSION_URL . 'forms'; ?>" class="btn btn-inverse">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <div class="tab-pane in active" id="foreign_detials">
        <script>
            $(function() {
                $('#info_foreign').validate();
            });
        </script>
        <h3 class="text-center">Foreign Details Information</h3>
        <h5>For Foreign Students :</h5>
        <form action="<?php echo ADMISSION_URL . 'forms/update_ug_foreign/' . $student_id ?>" method="post" class="form-horizontal" id="info_foreign">
            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Details of Pass Port & VISA
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="detail_pp"  value="<?php echo @$foreign_info[0]->detail_pp; ?>" class="form-control required" placeholder = "Details of Pass Port & VISA" />
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Pass Port No.
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="passport_no"  value="<?php echo @$foreign_info[0]->passport_no; ?>" class="form-control required" placeholder = "Pass Port No." />
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Name of the Country
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="country"  value="<?php echo @$foreign_info[0]->country; ?>" class="form-control required" placeholder = "Name of Country" />
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Place of Issue
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="issue"  value="<?php echo @$foreign_info[0]->issue; ?>" class="form-control required" placeholder = "Place of Issue" />
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Expiry Date
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="expire_date"  value="<?php echo @$foreign_info[0]->issue; ?>" class="form-control required" placeholder = "dd-mm-yyyy" id="expire_date"/>
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Visa Type
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="radio" name="visa_type" class="required" value="S" <?php
                    if (@$foreign_info[0]->visa_type == 'S') {
                        echo 'checked="checked"';
                    }
                    ?>/> Student &nbsp;

                    <input type="radio" name="visa_type" class="required" value="T" <?php
                    if (@$foreign_info[0]->visa_type == 'T') {
                        echo 'checked="checked"';
                    }
                    ?>/> Tourist &nbsp;

                    <input type="radio" name="visa_type" class="required" value="O" <?php
                    if (@$foreign_info[0]->visa_type == 'O') {
                        echo 'checked="checked"';
                    }
                    ?>/> Other &nbsp;
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    AIDS dearance <br />certificate attached
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="radio" name="aids_dearance" class="required" value="Y" <?php
                    if (@$foreign_info[0]->aids_dearance == 'Y') {
                        echo 'checked="checked"';
                    }
                    ?>/> Yes &nbsp;

                    <input type="radio" name="aids_dearance" class="required" value="N" <?php
                    if (@$foreign_info[0]->aids_dearance == 'N') {
                        echo 'checked="checked"';
                    }
                    ?>/> No &nbsp;
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 text-center">
                    <a href="<?php echo ADMISSION_URL . 'forms/edit_ug/' . $student_id . '/require_doc'; ?>" class="btn btn-primary">Skip</a>

                    <button type="submit" class="btn btn-primary">Next &nbsp; <i class="glyphicon glyphicon-arrow-right"></i></button>
                    <a href="<?php echo ADMISSION_URL . 'forms'; ?>" class="btn btn-inverse">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <div class="tab-pane in active" id="require_doc">
        <script>
            $(function() {
                $('#info_images').validate({
                    rules: {
                        student_image: {
                            required: true,
                            extension: "jpg|jpeg|png"
                        },
                        sign: {
                            required: true,
                            extension: "jpg|jpeg|png"
                        },
                        ssc_marksheet: {
                            required: true,
                            extension: "jpg|jpeg|png"
                        },
                        hsc_marksheet: {
                            extension: "jpg|jpeg|png"
                        },
                        migration_certificate: {
                            extension: "jpg|jpeg|png"
                        },
                        leaving_certificate: {
                            extension: "jpg|jpeg|png"
                        },
                        cast_certificate: {
                            extension: "jpg|jpeg|png"
                        },
                        aids_certificate: {
                            extension: "jpg|jpeg|png"
                        }
                    },
                    messages: {
                        student_image: {extension: '* Select Ony JPG, JPEG, PNG files.'},
                        sign: {extension: '* Select Ony JPG, JPEG, PNG files.'},
                        ssc_marksheet: {extension: '* Select Ony JPG, JPEG, PNG files.'},
                        hsc_marksheet: {extension: '* Select Ony JPG, JPEG, PNG files.'},
                        leaving_certificate: {extension: '* Select Ony JPG, JPEG, PNG files.'},
                        cast_certificate: {extension: '* Select Ony JPG, JPEG, PNG files.'},
                        aids_certificate: {extension: '* Select Ony JPG, JPEG, PNG files.'}
                    },
                    errorPlacement: function(error, element) {
                        if (element.is('radio') || element.is('checkbox')) {
                            error.appendTo(element.parent());
                        } else if (element.is("textarea")) {
                            error.insertAfter(element.next());
                        } else {
                            error.insertAfter(element);
                        }
                    }
                });

                $('body').on('hidden.bs.modal', '.modal', function() {
                    $(this).removeData('bs.modal');
                });
            });
        </script>
        <h3 class="text-center">Upload Require Documents</h3>
        <form action="<?php echo ADMISSION_URL . 'forms/update_ug_images/' . $student_id ?>" method="post" class="form-horizontal" id="info_images" enctype="multipart/form-data">
            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Student Image
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-8">
                    <input type="file" name="student_image" id="student_image" class="form-control required" />
                </div>
                <div class = "col-md-2">
                    <?php if (@$image_details[0]->student_image != '') { ?>
                        <a data-target="#view_image" data-toggle="modal" href="<?php echo ADMISSION_URL . 'forms/view_image/' . $student_id . '/student_image'; ?>" class="btn btn-default">View Image</a>
                    <?php } else { ?>
                        <a href="#" class="btn btn-default disabled">No Image</a>
                    <?php } ?>
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Student Signature
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-8">
                    <input type="file" name="sign" class="form-control required"/>
                </div>
                <div class = "col-md-2">
                    <?php if (@$image_details[0]->sign != '') { ?>
                        <a data-target="#view_image" data-toggle="modal" href="<?php echo ADMISSION_URL . 'forms/view_image/' . $student_id . '/sign'; ?>" class="btn btn-default">View Image</a>
                    <?php } else { ?>
                        <a href="#" class="btn btn-default disabled">No Image</a>
                    <?php } ?>
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    S.S.C Marksheet
                    <span class="text-danger">&nbsp;</span>
                </label>
                <div class = "col-md-8">
                    <input type="file" name="ssc_marksheet" class="form-control required"/>
                </div>
                <div class = "col-md-2">
                    <?php if (@$image_details[0]->ssc_marksheet != '') { ?>
                        <a data-target="#view_image" data-toggle="modal" href="<?php echo ADMISSION_URL . 'forms/view_image/' . $student_id . '/ssc_marksheet'; ?>" class="btn btn-default">View Image</a>
                    <?php } else { ?>
                        <a href="#" class="btn btn-default disabled">No Image</a>
                    <?php } ?>
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    H.S.C Marksheet
                    <span class="text-danger">&nbsp;</span>
                </label>
                <div class = "col-md-8">
                    <input type="file" name="hsc_marksheet" class="form-control"/>
                </div>
                <div class = "col-md-2">
                    <?php if (@$image_details[0]->hsc_marksheet != '') { ?>
                        <a data-target="#view_image" data-toggle="modal" href="<?php echo ADMISSION_URL . 'forms/view_image/' . $student_id . '/hsc_marksheet'; ?>" class="btn btn-default">View Image</a>
                    <?php } else { ?>
                        <a href="#" class="btn btn-default disabled">No Image</a>
                    <?php } ?>
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Migration Certificate
                    <span class="text-danger">&nbsp;</span>
                </label>
                <div class = "col-md-8">
                    <input type="file" name="migration_certificate" class="form-control"/>
                </div>
                <div class = "col-md-2">
                    <?php if (@$image_details[0]->migration_certificate != '') { ?>
                        <a data-target="#view_image" data-toggle="modal" href="<?php echo ADMISSION_URL . 'forms/view_image/' . $student_id . '/migration_certificate'; ?>" class="btn btn-default">View Image</a>
                    <?php } else { ?>
                        <a href="#" class="btn btn-default disabled">No Image</a>
                    <?php } ?>
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Leaving Certificate
                    <span class="text-danger">&nbsp;</span>
                </label>
                <div class = "col-md-8">
                    <input type="file" name="leaving_certificate" class="form-control"/>
                </div>
                <div class = "col-md-2">
                    <?php if (@$image_details[0]->leaving_certificate != '') { ?>
                        <a data-target="#view_image" data-toggle="modal" href="<?php echo ADMISSION_URL . 'forms/view_image/' . $student_id . '/leaving_certificate'; ?>" class="btn btn-default">View Image</a>
                    <?php } else { ?>
                        <a href="#" class="btn btn-default disabled">No Image</a>
                    <?php } ?>
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Cast Certificate
                    <span class="text-danger">&nbsp;</span>
                </label>
                <div class = "col-md-8">
                    <input type="file" name="cast_certificate" class="form-control"/>
                </div>
                <div class = "col-md-2">
                    <?php if (@$image_details[0]->cast_certificate != '') { ?>
                        <a data-target="#view_image" data-toggle="modal" href="<?php echo ADMISSION_URL . 'forms/view_image/' . $student_id . '/cast_certificate'; ?>" class="btn btn-default">View Image</a>
                    <?php } else { ?>
                        <a href="#" class="btn btn-default disabled">No Image</a>
                    <?php } ?>
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    AIDS Certificate
                    <span class="text-danger">&nbsp;</span>
                </label>
                <div class = "col-md-8">
                    <input type="file" name="aids_certificate" class="form-control"/>
                </div>
                <div class = "col-md-2">
                    <?php if (@$image_details[0]->aids_certificate != '') { ?>
                        <a data-target="#view_image" data-toggle="modal" href="<?php echo ADMISSION_URL . 'forms/view_image/' . $student_id . '/aids_certificate'; ?>" class="btn btn-default">View Image</a>
                    <?php } else { ?>
                        <a href="#" class="btn btn-default disabled">No Image</a>
                    <?php } ?>
                </div>
            </div>



            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Finish</button>
                    <a href="<?php echo ADMISSION_URL . 'forms'; ?>" class="btn btn-inverse">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="info" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="col-md-12">
                <h3>Information</h3>
                <hr />
                <div class="form-horizontal">
                    <div class = "form-group">
                        <div class = "col-md-12">
                            Select Only 1 checkbox for single Preference !!
                        </div>
                    </div>
                    <div class = "form-group">
                        <div class = "col-md-12">
                            <a onclick="$('#info').modal('hide');" class="btn btn-inverse pull-right">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view_image" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        </div>
    </div>
</div>