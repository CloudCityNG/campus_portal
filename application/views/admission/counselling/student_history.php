<script>
    $(function() {
    $('input:radio[name="course_id"]').change(function() {
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
    var cid = $('input:radio[name="course_id"]:checked').val();
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
    var cid = $('input:radio[name="course_id"]:checked').val();
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
    }
</script>

<div class="row">

    <div class="col-md-12">
        <h3>History of Student : <?php echo @$basic_info[0]->firstname . ' ' . @$basic_info[0]->lastname; ?></h3>
        <hr />
    </div>

    <div class="col-md-12">

    </div>


    <div class="col-md-12">
        <form action="<?php echo ADMISSION_URL . 'counselling/updateData/' . @$basic_info[0]->student_id; ?>" method="post" id="manage" class="form-horizontal">
            <div class="form-group">
                <label for="question" class="col-md-2 control-label">
                    Update Course :
                    <span class="text-danger">*</span>
                </label>
                <span class="error_generate text-center"></span>
                <div class="col-md-10">  
                    <?php foreach ($course_details as $course) { ?>
                        <label class="radio-inline" for="radios-6">
                            <input type="radio" name="course_id" id="radios-6" value="<?php echo @$course->course_id; ?>" class="required" <?php echo(@$basic_info[0]->course_id == $course->course_id) ? 'checked="checked"' : ''; ?>><?php echo @$course->name; ?>
                        </label>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group">
                <label for="question" class="col-md-2 control-label">
                    Preference selected

                </label>
                <div class="col-md-10"> 
                    <select class="form-control" name="preference_1" id="preference_1">
                        <?php foreach ($course_specialization as $spl) { ?>
                            <option value="<?php echo $spl->course_special_id; ?>" <?php echo (@$basic_details[0]->preference_1 == $spl->course_special_id) ? 'selected="selected"' : ''; ?>><?php echo $spl->name; ?></option>
                        <?php } ?>
                    </select>
                    <br />
                    <select class="form-control" name="preference_2" id="preference_2">
                        <?php foreach ($course_specialization as $spl) { ?>
                            <option value="<?php echo $spl->course_special_id; ?>" <?php echo (@$basic_details[0]->preference_2 == $spl->course_special_id) ? 'selected="selected"' : ''; ?>><?php echo $spl->name; ?></option>
                        <?php } ?>
                    </select>
                    <br />
                    <select class="form-control" name="preference_3" id="preference_3">
                        <?php foreach ($course_specialization as $spl) { ?>
                            <option value="<?php echo $spl->course_special_id; ?>" <?php echo (@$basic_details[0]->preference_3 == $spl->course_special_id) ? 'selected="selected"' : ''; ?>><?php echo $spl->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="question" class="col-md-2 control-label">
                    Update Status :
                    <span class="text-danger">*</span>
                </label>
                <div class="col-md-4">
                    <select name="admission_status_id" class="form-control required">
                        <?php
                        foreach ($candidate_status_info as $details) {
                            if ($details->admission_status_id > 3) {
                                ?>
                                <option value="<?php echo $details->admission_status_id; ?>" <?php echo ($details->admission_status_id == @$basic_info[0]->status) ? 'selected="selected"' : ''; ?>><?php echo $details->name; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="question" class="col-md-2 control-label">
                    &nbsp;
                </label>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Update Details</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-12">
        <table class="table">
            <tr>
                <td class="col-md-2">
                    <?php
                    $url = 'assets/students/' . $student_id . '/' . @$image_details[0]->student_image;
                    if (!file_exists($url)) {
                        if ($basic_info[0]->gender == 'M') {
                            $url = 'assets/images/no-male.png';
                        } else {
                            $url = 'assets/images/no-female.png';
                        }
                    }
                    ?>
                    <img src="<?php echo base_url() . $url; ?>" alt="" class="img-rounded img-responsive img-center" style="margin-bottom: 15px;"/>

                    <?php
                    $url = 'assets/students/' . $student_id . '/' . @$image_details[0]->sign;
                    if (!file_exists($url)) {
                        $url = 'assets/images/no-signature.png';
                    }
                    ?>
                    <img src="<?php echo base_url() . $url; ?>"alt="" class="img-rounded img-responsive img-center"/>
                </td>
                <td class="col-md-4">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="2">
                                Personal Details
                            </th>
                        </tr>
                        <tr>
                            <td><i class="glyphicon glyphicon-envelope"></i> Student Mail ID</td>
                            <td><?php echo @$basic_info[0]->email_s; ?></td>
                        </tr>

                        <tr>
                            <td><i class="glyphicon glyphicon-envelope"></i> Parent Mail ID</td>
                            <td><?php echo @$basic_info[0]->email_p; ?></td>
                        </tr>

                        <tr>
                            <td><i class="glyphicon glyphicon-gift"></i> Date of Birth</td>
                            <td><?php echo date('dS F, Y', strtotime(@$basic_info[0]->dob)); ?></td>
                        </tr>

                        <tr>
                            <td><i class="glyphicon glyphicon-phone-alt"></i> Student Mobile No</td>
                            <td><?php echo @$basic_info[0]->mobile_s; ?></td>
                        </tr>

                        <tr>
                            <td><i class="glyphicon glyphicon-phone-alt"></i> Parent Mobile No</td>
                            <td><?php echo @$basic_info[0]->mobile_s; ?></td>
                        </tr>
                    </table>
                </td>
                <td class="col-md-4">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="2">
                                Marks Details
                            </th>
                        </tr>
                        <tr>
                            <td>
                                Merits Marks
                            </td>
                            <td>
                                <?php echo @$merit_info[0]->marks; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>