<link href="<?php echo CSS_URL; ?>bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet" media="screen">
<div class="container">
    <div class="col-md-12">
        <h3 class="text-center">Update Status</h3>
        <form action="<?php echo ADMISSION_URL . 'forms/update_ug_status/' . @$basic_info[0]->student_id; ?>" method="post" id="manage" class="form-horizontal">
            <div class = "form-group">
                <select name="admission_status_id" class="form-control col-md-12 required">
                    <?php
                    foreach ($candidate_status_info as $details) {
                        ?>
                        <option value="<?php echo $details->admission_status_id; ?>" <?php echo ($details->admission_status_id == @$basic_info[0]->status) ? 'selected="selected"' : ''; ?>><?php echo $details->name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a onclick="$('#update_student_status').modal('hide');" class="btn btn-inverse">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>