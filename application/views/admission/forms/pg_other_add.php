<script>
    $(function() {
        $('#add_new_form a[href="#basic_info"]').tab('show')

        $('#manage').validate({
            errorPlacement: function(error, element) {
                if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                    $('.error_generate').html(error);
                } else {
                    return false;
                }
            }
        });

        $('input:radio[name="cid"]').change(function() {
            var cid = $(this).val();
            $.ajax({
                type: 'GET',
                url: '<?php echo ADMISSION_URL; ?>forms/getPGCourseSpecialization/' + cid + '/0',
                success: function(data)
                {
                    $('#preference_1').empty();
                    $('#preference_1').append(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('error');
                }
            });
        });

        $('input:radio[name="cid"]').change(function() {
            var cid = $(this).val();
            $.ajax({
                type: 'GET',
                url: '<?php echo ADMISSION_URL; ?>forms/getPGCourseSpecialization/' + cid,
                success: function(data)
                {
                    $('#preference_1').empty();
                    $('#preference_2').empty();
                    $('#preference_3').empty();
                    $('#preference_1').append(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('error');
                }
            });
        });

        $('#preference_1').change(function() {
            var cid = $('input:radio[name="cid"]:checked').val();
            $.ajax({
                type: 'GET',
                url: '<?php echo ADMISSION_URL; ?>forms/getPGCourseSpecialization/' + cid,
                success: function(data)
                {
                    $('#preference_2').empty();
                    $('#preference_3').empty();
                    $('#preference_2').append(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('error');
                }
            });
        });

        $('#preference_2').change(function() {
            var cid = $('input:radio[name="cid"]:checked').val();
            var p = $('#preference_2').val();
            $.ajax({
                type: 'GET',
                url: '<?php echo ADMISSION_URL; ?>forms/getPGCourseSpecialization/' + cid,
                success: function(data)
                {
                    $('#preference_3').empty();
                    $('#preference_3').append(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('error');
                }
            });
        });

<?php $date = date('m/d/Y', strtotime(get_current_date_time()->get_date_for_db())); ?>
        $("#dob").datepicker({dateFormat: 'dd-mm-yy', maxDate:<?php echo $date; ?>, changeMonth: true, changeYear: true, yearRange: "1900:<?php echo date('Y'); ?>"});
    })

</script>

<h2 class="text-center">New PG Admission</h2>

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
        <form action="<?php echo ADMISSION_URL . 'forms/save_pg_other' ?>" method="post" id="manage" class="form-horizontal">
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
                                    <input type="radio" name="cid" id="<?php echo @$course->course_id; ?>" value="<?php echo @$course->course_id; ?>" class="required"/> <?php echo @$course->name; ?>
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
                    <select class="form-control" required="required" name="preference_1" id="preference_1">
                        <option value="">Select First Preference</option>
                    </select>
                    <br />
                    <select class="form-control" required="required" name="preference_2" id="preference_2">
                        <option value="">Select Second Preference</option>
                    </select>
                    <br />
                    <select class="form-control" required="required" name="preference_3" id="preference_3">
                        <option value="">Select Third Preference</option>
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
                        <input type="text" name="pincode" class="form-control required" placeholder = "Pincode" />
                    </div>
                </div>
                <div class = "col-md-6">
                    <label for="question" class="col-md-4 control-label">
                        Date of Birth
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-8">
                        <input type="text" name="dob" id="dob" class="form-control required" placeholder = "Date of Birth" />
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
                        <input type="text" name="mobile_s" class="form-control required" placeholder = "Moblie No Student" />
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Parent Contact
                        <span class="text-danger"></span>
                    </label>
                    <div class = "col-md-8">
                        <input type="text" name="mobile_p" class="form-control" placeholder = "Moblie No Parent" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Student Email Address
                        <span class="text-danger"></span>
                    </label>
                    <div class = "col-md-8">
                        <input type="email" name="email_s" class="form-control" placeholder = "Email Address of Student" />
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Parent Email Address
                        <span class="text-danger"></span>
                    </label>
                    <div class = "col-md-8">
                        <input type="email" name="email_p" class="form-control" placeholder = "Email Address of Parent" />
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
                            <input type="radio" name="gender" id="radios-6" value="M" class="required" />Male
                        </label> 
                        <label class="radio-inline" for="radios-7">
                            <input type="radio" name="gender" id="radios-7" value="F" class="required" />Female
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
                            <input type="radio" name="marital_status" id="radios-4" value="U" class="required" />Single
                        </label> 
                        <label class="radio-inline" for="radios-5">
                            <input type="radio" name="marital_status" id="radios-5" value="M" class="required" />Married
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
                        Community / Sub Caste
                        <span class="text-danger">&nbsp;</span>
                    </label>
                    <div class="col-md-8">
                        <input type="text" name="community" class="form-control" placeholder = "Community" />
                    </div>
                </div>

                <div class = "col-md-6">
                    <label for = "question" class = "col-md-4 control-label">
                        Category
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-8">
                        <div>
                            <label class="radio-inline" for="radios-0">
                                <input type="radio" name="category" id="radios-0" value="SC" class="required" />SC
                            </label>

                            <label class="radio-inline" for="radios-0">
                                <input type="radio" name="category" id="radios-0" value="ST" class="required" />ST
                            </label>

                            <label class="radio-inline" for="radios-0">
                                <input type="radio" name="category" id="radios-0" value="SEBC" class="required" />SEBC
                            </label>
                        </div>

                        <div>
                            <label class="radio-inline" for="radios-0">
                                <input type="radio" name="category" id="radios-0" value="OBC" class="required" />OBC
                            </label>

                            <label class="radio-inline" for="radios-0">
                                <input type="radio" name="category" id="radios-0" value="General" class="required" />General
                            </label>

                            <label class="radio-inline" for="radios-0">
                                <input type="radio" name="category" id="radios-0" value="Other" class="required" />Other
                            </label>
                        </div>
                        <span class="error_generate"></span>
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
                            <input type="radio" name="transoprt" id="radios-2" value="Y" class="required" />Yes
                        </label> 
                        <label class="radio-inline" for="radios-3">
                            <input type="radio" name="transoprt" id="radios-3" value="N" class="required" />No
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