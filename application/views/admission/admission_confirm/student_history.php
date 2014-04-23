<h3>History of Student : <?php echo @$basic_info[0]->firstname . ' ' . @$basic_info[0]->lastname; ?></h3>
<hr />
<div class="col-md-12">
    <form action="<?php echo ADMISSION_URL . 'confirm/updateData/' . @$basic_info[0]->student_id; ?>" method="post" id="manage" class="form-horizontal">
        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                Update Status :
                <span class="text-danger">*</span>
            </label>
            <div class="col-md-4">
                <select name="admission_status_id" class="form-control required">
                    <?php
                    foreach ($candidate_status_info as $details) {
                        if ($details->admission_status_id > 4) {
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
<hr />
<div class="row">
    <table class="table">
        <tr>
            <td class="col-md-2">
                <img src="<?php echo base_url() . 'assets/students/' . $student_id . '/' . @$image_details[0]->student_image; ?>" alt="" class="img-rounded img-responsive" />
                <br />
                <img src="<?php echo base_url() . 'assets/students/' . $student_id . '/' . @$image_details[0]->sign; ?>" alt="" class="img-rounded img-responsive" style="display: block; margin: 0 auto;"/>
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

                    <tr>
                        <td>
                            PCB
                        </td>
                        <td>
                            <?php echo @$edu_master_info[0]->pcb_percentage; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            PCBE
                        </td>
                        <td>
                            <?php echo @$edu_master_info[0]->pcbe_percentage; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            H.S.C Pertentage
                        </td>
                        <td>
                            <?php echo @$edu_master_info[0]->total_percentage; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>