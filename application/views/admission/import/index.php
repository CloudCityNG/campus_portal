<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#manage").validate({
            errorPlacement: function(error, element) {
                if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                    $('.error_generate').html(error);
                } else {
                    return false;
                }
            }
        })
    });
</script>
<div class="col-md-12">
    <h3>Import Excel</h3>
    <hr>

    <div class="col-lg-12 margin-killer padding-killer">
        <?php if ($this->session->flashdata('error') != '' || $this->session->flashdata('success') != '') { ?>
            <?php
            if ($this->session->flashdata('error') != '') {
                echo '<div class="alert alert-danger"><a href="' . current_url() . '" class="close" data-dismiss="alert">&times;</a>' . $this->session->flashdata('error') . '</div>';
            }
            ?>

            <?php
            if ($this->session->flashdata('success') != '') {
                echo '<div class="alert alert-success"><a href="' . current_url() . '" class="close" data-dismiss="alert">&times;</a>' . $this->session->flashdata('success') . '</div>';
            }
            ?>
        <?php } ?>
    </div>

    <form action="<?php echo ADMISSION_URL . 'import/upload' ?>" method="post" id="manage" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                Full Name
                <span class="text-danger">*</span>
            </label>
            <div class="col-md-4">
                <input type="file" name="excel_file" required="required" class="form-control"/>
            </div>
        </div>
        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                Select From
                <span class="text-danger">*</span>
            </label>
            <div class="col-md-10">
                <label class="radio-inline" for="radios-1">
                    <input type="radio" name="degree" id="radios-1" value="UG" class="required">UG Form
                </label>
                <label class="radio-inline" for="radios-2">
                    <input type="radio" name="degree" id="radios-2" value="PG" class="required">PG MDS/MD/MS/Super Speciality Form
                </label>
                <label class="radio-inline" for="radios-3">
                    <input type="radio" name="degree" id="radios-3" value="PG_OTHER" class="required">PG Other Form
                </label>
                 <span class="error_generate"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?php echo ADMISSION_URL; ?>" class="btn btn-inverse">Cancel</a>
            </div>
        </div>

        <div class="form-group">
            Fields marked with  <span class="text-danger">*</span>  are mandatory.
        </div>
    </form>
</div>