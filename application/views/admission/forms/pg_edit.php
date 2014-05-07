<?php $date = date('m/d/Y', strtotime(get_current_date_time()->get_date_for_db())); ?>
<script>
    $(function() {
        $('#edit_form a[href="#<?php echo @$tab; ?>"]').tab('show');
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

<h2 class="text-center">New Admission</h2>

<ul id="edit_form" class="nav nav-tabs">
    <li class=""><a href="#basic_info" data-toggle="tab">Basic Information</a></li>
    <li class=""><a href="#edu_info" data-toggle="tab">Education Information</a></li>
    <li class=""><a href="#languages" data-toggle="tab">Languages Know</a></li>
    <li class=""><a href="#foreign_detials" data-toggle="tab">Passport Details</a></li>
    <li class=""><a href="#require_doc" data-toggle="tab">Require Documents</a></li>
</ul>

<div id="myTabContent" class="tab-content">
    <div class="tab-pane in active" id="basic_info">
        <script>
            $(function() {
                $('#info_basic').validate({
                    errorPlacement: function(error, element) {
                        if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                            $('.error_generate').html(error);
                        } else {
                            return false;
                        }
                    }
                });

                $("#dob").datepicker({dateFormat: 'dd-mm-yy', maxDate:<?php echo $date; ?>, changeMonth: true, changeYear: true, yearRange: "1900:<?php echo date('Y'); ?>"});
            });
        </script>
        <h3 class="text-center">Basic Information</h3>
        <form action="<?php echo ADMISSION_URL . 'forms/update_pg_other_basic/' . $student_id; ?>" method="post" class="form-horizontal" id="info_basic">
            <input type="hidden" name="form_number" value="<?php echo @$basic_info[0]->form_number; ?>" />
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
                    <span class="error_generate text-center"></span>
                    <table class="table table-bordered table-responsive">
                        <?php foreach ($course_details as $course) { ?>
                            <tr>
                                <td>
                                    <input type="radio" name="cid" value="<?php echo @$course->course_id; ?>" class="required" <?php
                                    if (@$basic_info[0]->course_id == $course->course_id) {
                                        echo 'checked="checked"';
                                    }
                                    ?> disabled="disabled"/>
                                           <?php echo @$course->name; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="col-md-6">
                    <label class="col-md-12 text-center">
                        Select Preference
                        <span class="text-danger">*</span>
                    </label>
                    <span class="error_generate text-center"></span>
                    <?php $p1 = getCoursePreference(@$basic_info[0]->preference_1); ?>
                    <select class="form-control" name="preference_1" id="preference_1" disabled="disabled">
                        <option value="<?php echo $p1->course_special_id; ?>"><?php echo $p1->name; ?></option>
                    </select>
                    <br />
                    <?php $p2 = getCoursePreference(@$basic_info[0]->preference_2); ?>
                    <select class="form-control" name="preference_2" id="preference_2" disabled="disabled">
                        <option value="<?php echo $p2->course_special_id; ?>"><?php echo $p2->name; ?></option>
                    </select>
                    <br />
                    <?php $p3 = getCoursePreference(@$basic_info[0]->preference_3); ?>
                    <select class="form-control" name="preference_3" id="preference_3" disabled="disabled">
                        <option value="<?php echo $p3->course_special_id; ?>"><?php echo $p3->name; ?></option>
                    </select>
                </div>
            </div>

            <hr />

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Surname
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
                        <input type="text" name="pincode" value="<?php echo @$basic_info[0]->pincode; ?>" class="form-control required" placeholder = "Pincode" />
                    </div>
                </div>
                <div class = "col-md-6">
                    <label for="question" class="col-md-4 control-label">
                        Date of Birth
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-8">
                        <input type="text" name="dob" id="dob" class="form-control required" placeholder = "Date of Birth" value="<?php echo date('d-m-Y', strtotime(@$basic_info[0]->dob)); ?>"/>
                    </div>
                </div>
            </div>

            <div class = "form-group">
                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Student Contact
                        <span class="text-danger">*</span>
                    </label>
                    <div class = "col-md-8">
                        <input type="text" name="mobile_s" value="<?php echo @$basic_info[0]->mobile_s; ?>" class="form-control required" placeholder = "Moblie No Student" />
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Parent Contact
                        <span class="text-danger">*</span>
                    </label>
                    <div class = "col-md-8">
                        <input type="text" name="mobile_p" value="<?php echo @$basic_info[0]->mobile_p; ?>" class="form-control required" placeholder = "Moblie No Parent" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Student Email Address
                        <span class="text-danger">*</span>
                    </label>
                    <div class = "col-md-8">
                        <input type="email" name="email_s" value="<?php echo @$basic_info[0]->email_s; ?>" class="form-control required" placeholder = "Email Address of Student" />
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Parent Email Address
                        <span class="text-danger">*</span>
                    </label>
                    <div class = "col-md-8">
                        <input type="email" name="email_p" value="<?php echo @$basic_info[0]->email_p; ?>" class="form-control required" placeholder = "Email Address of Parent" />
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
                        <label class="radio-inline" for="radios-6">
                            <input type="radio" name="gender" id="radios-6" value="M" class="required" <?php
                            if (@$basic_info[0]->gender == 'M') {
                                echo 'checked="checked"';
                            }
                            ?>>Male
                        </label> 
                        <label class="radio-inline" for="radios-7">
                            <input type="radio" name="gender" id="radios-7" value="F" class="required" <?php
                            if (@$basic_info[0]->gender == 'F') {
                                echo 'checked="checked"';
                            }
                            ?>>Female
                        </label>
                        <span class="error_generate"></span>
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Marital Status
                        <span class="text-danger">*</span>
                    </label>
                    <div class = "col-md-8">
                        <label class="radio-inline" for="radios-4">
                            <input type="radio" name="marital_status" id="radios-4" value="U" class="required" <?php
                            if (@$basic_info[0]->marital_status == 'U') {
                                echo 'checked="checked"';
                            }
                            ?>>Single
                        </label> 
                        <label class="radio-inline" for="radios-5">
                            <input type="radio" name="marital_status" id="radios-5" value="M" class="required" <?php
                            if (@$basic_info[0]->marital_status == 'M') {
                                echo 'checked="checked"';
                            }
                            ?>>Married
                        </label>
                        <span class="error_generate"></span>
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
                        Community / Sub Caste
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
                        <div>
                            <label class="radio-inline" for="radios-0">
                                <input type="radio" name="category" id="radios-0" value="SC" class="required" <?php
                                if (@$basic_info[0]->category == 'SC') {
                                    echo 'checked="checked"';
                                }
                                ?>>SC
                            </label>

                            <label class="radio-inline" for="radios-0">
                                <input type="radio" name="category" id="radios-0" value="ST" class="required" <?php
                                if (@$basic_info[0]->category == 'ST') {
                                    echo 'checked="checked"';
                                }
                                ?>>ST
                            </label>

                            <label class="radio-inline" for="radios-0">
                                <input type="radio" name="category" id="radios-0" value="SEBC" class="required" <?php
                                if (@$basic_info[0]->category == 'SEBC') {
                                    echo 'checked="checked"';
                                }
                                ?>>SEBC
                            </label>
                        </div>

                        <div>
                            <label class="radio-inline" for="radios-0">
                                <input type="radio" name="category" id="radios-0" value="OBC" class="required" <?php
                                if (@$basic_info[0]->category == 'OBC') {
                                    echo 'checked="checked"';
                                }
                                ?>>OBC
                            </label>

                            <label class="radio-inline" for="radios-0">
                                <input type="radio" name="category" id="radios-0" value="General" class="required" <?php
                                if (@$basic_info[0]->category == 'General') {
                                    echo 'checked="checked"';
                                }
                                ?>>General
                            </label>

                            <label class="radio-inline" for="radios-0">
                                <input type="radio" name="category" id="radios-0" value="Other" class="required" <?php
                                if (@$basic_info[0]->category == 'Other') {
                                    echo 'checked="checked"';
                                }
                                ?>>Other
                            </label> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class = "col-md-6">
                    <label for="question" class="col-md-4 control-label">
                        Hostel Accommodation
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-8">
                        <label class="radio-inline" for="radios-0">
                            <input type="radio" name="hostel" id="radios-0" value="Y" class="required" <?php
                            if (@$basic_info[0]->hostel == 'Y') {
                                echo 'checked="checked"';
                            }
                            ?>>Yes
                        </label> 
                        <label class="radio-inline" for="radios-1">
                            <input type="radio" name="hostel" id="radios-1" value="N" class="required" <?php
                            if (@$basic_info[0]->hostel == 'N') {
                                echo 'checked="checked"';
                            }
                            ?>>No
                        </label>
                        <span class="error_generate"></span>
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for="question" class="col-md-4 control-label">
                        Transport Facility
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-8">
                        <label class="radio-inline" for="radios-2">
                            <input type="radio" name="transoprt" id="radios-2" value="Y" class="required" <?php
                            if (@$basic_info[0]->transoprt == 'Y') {
                                echo 'checked="checked"';
                            }
                            ?>>Yes
                        </label> 
                        <label class="radio-inline" for="radios-3">
                            <input type="radio" name="transoprt" id="radios-3" value="N" class="required" <?php
                            if (@$basic_info[0]->transoprt == 'N') {
                                echo 'checked="checked"';
                            }
                            ?>>No
                        </label>
                        <span class="error_generate"></span>
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
                $('#info_edu').validate({
                    errorPlacement: function(error, element) {
                        if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                            $('.error_generate').html(error);
                        } else {
                            return false;
                        }
                    }
                });
            });
        </script>
        <h3 class="text-center">Education Information</h3>
        <h5>Academic Record :</h5>
        <form action="<?php echo ADMISSION_URL . 'forms/update_pg_other_education/' . $student_id ?>" method="post" class="form-horizontal" id="info_edu">
            <input type="hidden" name="form_number" value="<?php echo @$basic_info[0]->form_number; ?>" />
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Course</th>
                        <th>Year</th>
                        <th>Institute</th>
                        <th>University / Board</th>
                        <th>Total Percentage</th>
                        <th>Rank</th>
                    </tr>

                    <?php for ($i = 0; $i <= 5; $i++) { ?>
                        <tr>
                        <input type="hidden" name="pg_other_edu_id[]" value="<?php echo @$edu_master_info[$i]->pg_other_edu_id; ?>" />
                        <td><input type="text" name="course[]" class="form-control required" value="<?php echo @$edu_master_info[$i]->course; ?>" /></td>
                        <td><input type="text" name="year[]" value="<?php echo @$edu_master_info[$i]->year; ?>" class="form-control required"/></td>
                        <td><input type="text" name="uni_institute[]" value="<?php echo @$edu_master_info[$i]->uni_institute; ?>" class="form-control required"/></td>
                        <td><input type="text" name="board[]" value="<?php echo @$edu_master_info[$i]->board; ?>" class="form-control required"/></td>
                        <td><input type="text" name="total_percentage[]" value="<?php echo @$edu_master_info[$i]->total_percentage; ?>" class="form-control required"/></td>
                        <td><input type="text" name="rank[]" value="<?php echo @$edu_master_info[$i]->rank; ?>" class="form-control required"/></td>
                        </tr>
                    <?php } ?>
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
                $('#info_lang').validate({
                    errorPlacement: function(error, element) {
                        if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                            $('.error_generate').html(error);
                        } else {
                            return false;
                        }
                    }
                });
            });
        </script>
        <h3 class="text-center">Languages Information</h3>
        <form action="<?php echo ADMISSION_URL . 'forms/update_ug_language/' . $student_id ?>" method="post" class="form-horizontal" id="info_lang">
            <input type="hidden" name="form_number" value="<?php echo @$basic_info[0]->form_number; ?>" />
            <table class="table table-bordered table-responsive">
                <tr>
                    <th>Language</th>
                    <th>Speaking</th>
                    <th>Reading</th>
                    <th>Writing</th>
                </tr>

                <tr>
                    <td><input value="<?php echo ucfirst(@$languages_details[0]->name); ?>" type="text" placeholder="Language Name" name="langauge_name[]" class="form-control required"/></td>

                    <th>
                        <input type="checkbox" name="speaking0" value="Y" <?php
                        if (@$languages_details[0]->speaking == 'Y') {
                            echo 'checked="checked"';
                        }
                        ?>/>
                    </th>

                    <th>
                        <input type="checkbox" name="reading0" value="Y" <?php
                        if (@$languages_details[0]->reading == 'Y') {
                            echo 'checked="checked"';
                        }
                        ?>/>
                    </th>

                    <th>
                        <input type="checkbox" name="writing0" value="Y" <?php
                        if (@$languages_details[0]->writing == 'Y') {
                            echo 'checked="checked"';
                        }
                        ?>/>
                    </th>
                </tr>

                <tr>
                    <td><input value="<?php echo ucfirst(@$languages_details[1]->name); ?>" type="text" placeholder="Language Name" name="langauge_name[]" class="form-control"/></td>

                    <th>
                        <input type="checkbox" name="speaking1" value="Y" <?php
                        if (@$languages_details[1]->speaking == 'Y') {
                            echo 'checked="checked"';
                        }
                        ?>/>
                    </th>

                    <th>
                        <input type="checkbox" name="reading1" value="Y" <?php
                        if (@$languages_details[1]->reading == 'Y') {
                            echo 'checked="checked"';
                        }
                        ?>/>
                    </th>

                    <th>
                        <input type="checkbox" name="writing1" value="Y" <?php
                        if (@$languages_details[1]->writing == 'Y') {
                            echo 'checked="checked"';
                        }
                        ?>/>
                    </th>
                </tr>

                <tr>
                    <td><input value="<?php echo ucfirst(@$languages_details[2]->name); ?>" type="text" placeholder="Language Name" name="langauge_name[]" class="form-control"/></td>

                    <th>
                        <input type="checkbox" name="speaking2" value="Y" <?php
                        if (@$languages_details[2]->speaking == 'Y') {
                            echo 'checked="checked"';
                        }
                        ?>/>
                    </th>

                    <th>
                        <input type="checkbox" name="reading2" value="Y" <?php
                        if (@$languages_details[2]->reading == 'Y') {
                            echo 'checked="checked"';
                        }
                        ?>/>
                    </th>

                    <th>
                        <input type="checkbox" name="writing2" value="Y" <?php
                        if (@$languages_details[2]->writing == 'Y') {
                            echo 'checked="checked"';
                        }
                        ?>/>
                    </th>
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
                $('#info_foreign').validate({
                    errorPlacement: function(error, element) {
                        if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                            $('.error_generate').html(error);
                        } else {
                            return false;
                        }
                    }
                });

                $("#expire_date").datepicker({dateFormat: 'dd-mm-yy', minDate:<?php echo $date; ?>, changeMonth: true, changeYear: true, yearRange: "<?php echo date('Y') . ':' . (date('Y') + 30); ?>"});
            });
        </script>
        <h3 class="text-center">Passport Details Information</h3>
        <h5 class="text-success">For <span class="text-danger">NRI Student</span> it is <span class="text-danger">compulsory</span> and for regular student it is advisable</h5>
        <form action="<?php echo ADMISSION_URL . 'forms/update_ug_foreign/' . $student_id ?>" method="post" class="form-horizontal" id="info_foreign">
            <input type="hidden" name="form_number" value="<?php echo @$basic_info[0]->form_number; ?>" />
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
                    <input type="text" name="expire_date"  value="<?php echo date('d-m-Y', strtotime(@$foreign_info[0]->expire_date)); ?>" class="form-control required" placeholder = "dd-mm-yyyy" id="expire_date"/>
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
                    AIDS clearance <br />certificate attached
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
                            extension: "jpg|jpeg|png"
                        },
                        sign: {
                            extension: "jpg|jpeg|png"
                        },
                        marksheet_1: {
                            extension: "jpg|jpeg|png"
                        },
                        marksheet_2: {
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
                        leaving_certificate: {extension: '* Select Ony JPG, JPEG, PNG files.'},
                        cast_certificate: {extension: '* Select Ony JPG, JPEG, PNG files.'},
                        aids_certificate: {extension: '* Select Ony JPG, JPEG, PNG files.'}
                    },
                    errorPlacement: function(error, element) {
                        if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                            $('.error_generate').html(error);
                        } else {
                            return false;
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
            <input type="hidden" name="form_number" value="<?php echo @$basic_info[0]->form_number; ?>" />
            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Student Image
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-8">
                    <?php if (@$image_details[0]->student_image != '') { ?>
                        <input type="file" name="student_image" id="student_image" class="form-control" />
                    <?php } else { ?>
                        <input type="file" name="student_image" id="student_image" class="form-control required" />
                    <?php } ?>

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

                    <?php if (@$image_details[0]->sign != '') { ?>
                        <input type="file" name="sign" class="form-control"/>
                    <?php } else { ?>
                        <input type="file" name="sign" class="form-control required"/>
                    <?php } ?>
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