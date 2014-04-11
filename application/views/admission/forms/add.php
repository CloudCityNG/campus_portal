<script>
    $(function() {
        $('#add_new_form a[href="#basic_info"]').tab('show')

        $('#manage').validate();

<?php $date = date('m/d/Y', strtotime(get_current_date_time()->get_date_for_db())); ?>
        $("#dob").datepicker({dateFormat: 'dd-mm-yy', maxDate:<?php echo $date; ?>, changeMonth: true, changeYear: true, yearRange: "1900:<?php echo date('Y'); ?>"});
    })

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

<ul id="add_new_form" class="nav nav-tabs">
    <li class=""><a href="#basic_info" data-toggle="tab">Basic Information</a></li>
    <li class=""><a href="#edu_info">Education Information</a></li>
    <li class=""><a href="#languages">Languages Know</a></li>
    <li class=""><a href="#foreign_detials">Foreign Details</a></li>
    <li class=""><a href="#require_doc">Require Documents</a></li>
</ul>

<div id="myTabContent" class="tab-content">
    <div class="tab-pane in active" id="basic_info">
        <h3 class="text-center">Basic Information</h3>
        <form action="<?php echo ADMISSION_URL . 'forms/save_ug' ?>" method="post" id="manage" class="form-horizontal">
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
                                <input type="radio" name="cid" value="<?php echo @$course->course_id; ?>" class="required"/>
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
                    <table class="table table-bordered">
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
                        foreach ($center_details as $center) {
                            ?>
                            <tr>
                                <td><?php echo @$center->name; ?></td>
                                <td class="text-center"><?php echo @$center->code; ?></td>
                                <th>
                                    <label for="<?php echo @$center->code . '-1'; ?>" >
                                        <input type="checkbox" name="p1[]" id="<?php echo @$center->center_id; ?>" class="<?php echo @$center->code; ?> required" value="<?php echo @$center->center_id; ?>" onclick="countCheckBoxes(<?php echo @$center->center_id; ?>, 'p1[]', '1')">
                                    </label>
                                </th>
                                <th>
                                    <label for="<?php echo @$center->code . '-2'; ?>" >
                                        <input type="checkbox" name="p2[]" id="<?php echo @$center->center_id; ?>" class="<?php echo @$center->code; ?> required" value="<?php echo @$center->center_id; ?>" onclick="countCheckBoxes(<?php echo @$center->center_id; ?>, 'p2[]', '1')">
                                    </label>
                                </th>
                                <th>
                                    <label for="<?php echo @$center->code . '-3'; ?>" >
                                        <input type="checkbox" name="p3[]" id="<?php echo @$center->center_id; ?>" class="<?php echo @$center->code; ?> required" value="<?php echo @$center->center_id; ?>" onclick="countCheckBoxes(<?php echo @$center->center_id; ?>, 'p2[]', '1')">
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
                    <input type="text" name="lastname"  class="form-control required" placeholder = "Surname" />
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    First Name
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="firstname"  class="form-control required" placeholder = "First name" />
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Middle Name
                    <span class="text-danger">&nbsp;</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="middlename"  class="form-control" placeholder = "Middle name" />
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Address
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <textarea class="form-control required" name="address"></textarea>
                </div>
            </div>

            <div class = "form-group">
                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Pincode
                        <span class="text-danger">&nbsp;</span>
                    </label>
                    <div class = "col-md-8">
                        <input type="text" name="pincode"  class="form-control" placeholder = "Pincode" />
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
                        <input type="text" name="phone_no"  class="form-control" placeholder = "Phone Number with STD code" />
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for="question" class="col-md-3 control-label">
                        Date of Birth
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" name="dob" id="dob" class="form-control required" placeholder = "Date of Birth" />
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
                        <input type="text" name="mobile_no"  class="form-control required" placeholder = "Mobile Number" />
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for = "question" class = "col-md-3 control-label">
                        Email Address
                        <span class="text-danger">*</span>
                    </label>
                    <div class = "col-md-9">
                        <input type="email" name="email"  class="form-control required" placeholder = "Email Address" />
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
                        <input type="radio" name="gender"  value="M" class="required" /> Male
                        <input type="radio" name="gender"  value="F" class="required" /> Female
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for = "question" class = "col-md-3 control-label">
                        Marital Status
                        <span class="text-danger">*</span>
                    </label>
                    <div class = "col-md-9">
                        <input type="radio" name="marital_status"  value="U" class="required" /> Single
                        <input type="radio" name="marital_status"  value="M" class="required" /> Married
                    </div>
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Father's Name
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="parent_1"  class="form-control required" placeholder = "Father's / Husband's / Guardian's Name" />
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Occupation
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="parent_1_occupation"  class="form-control required" placeholder = "Occupation" />
                </div>
            </div>


            <div class = "form-group">
                <label for = "question" class = "col-md-2 control-label">
                    Mother's Name
                    <span class="text-danger">*</span>
                </label>
                <div class = "col-md-10">
                    <input type="text" name="parent_2"  class="form-control required" placeholder = " Mother's Name" />
                </div>
            </div>



            <div class="form-group">
                <div class = "col-md-6">
                    <label for="question" class="col-md-4 control-label">
                        Nationality
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-8">
                        <input type="text" name="nationality" class="form-control required" placeholder = "Nationality" />
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for="question" class="col-md-4 control-label">
                        Religion
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-8">
                        <input type="text" name="religion"  class="form-control required" placeholder = "Religion" />
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
                        <input type="text" name="community" class="form-control" placeholder = "Community" />
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Category
                        <span class="text-danger">&nbsp;</span>
                    </label>
                    <div class="col-md-8">
                        <input type="radio" name="category" class="required" value="SC" /> SC &nbsp;
                        <input type="radio" name="category" class="required" value="ST" /> ST &nbsp;
                        <input type="radio" name="category" class="required" value="SEBC" /> SEBC <br />
                        <input type="radio" name="category" class="required" value="OBC" /> OBC &nbsp;
                        <input type="radio" name="category" class="required" value="General" /> General &nbsp;
                        <input type="radio" name="category" class="required" value="Other" /> Other 
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
                        <input type="radio" name="hostel" class="required" value="Y" /> Yes &nbsp;
                        <input type="radio" name="hostel" class="required" value="N" /> No &nbsp;
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for="question" class="col-md-6 control-label">
                        Do you need Transport Facility
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-6">
                        <input type="radio" name="transoprt" class="required" value="Y" /> Yes &nbsp;
                        <input type="radio" name="transoprt" class="required" value="N" /> No &nbsp;
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