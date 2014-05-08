<link href="<?php echo CSS_URL; ?>bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet" media="screen">
<div class="container">
    <div class="col-md-12">
        <h3 class="text-center">Update Status</h3>
        <form action="<?php echo ADMISSION_URL . 'eet/update_marks/' . @$basic_info[0]->student_id; ?>" method="post" id="manage" class="form-horizontal">
            <div class = "form-group">
                <label for = "question" class = "col-md-4 control-label">
                    Form No
                    <span class="text-danger">&nbsp;</span>
                </label>
                <div class = "col-md-8">
                    <input value="<?php echo @$basic_info[0]->form_number; ?>" class="form-control" disabled="disabled"/>
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-4 control-label">
                    Hall Ticket No
                    <span class="text-danger">&nbsp;</span>
                </label>
                <div class = "col-md-8">
                    <input value="<?php echo getHallTicket(@$basic_info[0]->student_id, @$basic_info[0]->degree); ?>" class="form-control" disabled="disabled"/>
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-4 control-label">
                    Name
                    <span class="text-danger">&nbsp;</span>
                </label>
                <div class = "col-md-8">
                    <input value="<?php echo @$basic_info[0]->firstname . ' ' . @$basic_info[0]->lastname; ?>" class="form-control" disabled="disabled"/>
                </div>
            </div>

            <div class = "form-group">
                <label for = "question" class = "col-md-4 control-label">
                    Marks
                    <span class="text-danger">&nbsp;</span>
                </label>
                <div class = "col-md-8">
                    <input type="text" name="marks" value="<?php echo @$details[0]->marks; ?>" class="form-control" placeholder = "Marks Obtained" required="required"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a onclick="$('#update_student_marks').modal('hide');" class="btn btn-inverse">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>