<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#login_form").validate({
            errorPlacement: function() {
                return false;
            }
        });
        
        $('#depratment_selection').focus();
    });
</script>

<div class="container">
    <div class="login-box-style">
        <form id="login_form" class="form-signin" action="<?php echo base_url(); ?>validate" method="post">
            <legend class="text-center"></legend>
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
            <div class="col-lg-12 margin-killer padding-killer">
                <select name="dept_id" class="form-control col-md-12 required" id="depratment_selection">
                    <option value="">Select Department</option>
                    <?php
                    foreach ($department_details as $details) {
                        ?>
                        <option value="<?php echo $details->dept_id; ?>"><?php echo $details->name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-12 margin-killer padding-killer">
                <br>
                <input name="email_address" type="text" class="form-control col-md-12 required" placeholder="Username" autofocus value="<?php echo set_value('email_address'); ?>" autocomplete="off">
            </div>
            <div class="col-lg-12 margin-killer padding-killer">
                <br>
                <input  name="password" type="password" class="form-control col-md-12 required" placeholder="Password" autocomplete="off">
            </div>
            <div class="col-lg-12 margin-killer padding-killer">
                <br>
                <span class="pull-right">
                    <button class="btn btn-primary btn-lg pull-right" type="submit">Login</button>
                </span>
            </div>
        </form>
    </div>
</div>