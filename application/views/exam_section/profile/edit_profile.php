<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#manage").validate({
            rules: {
                username: {
                    remote: '<?php echo EXAM_SECTION_URL . 'profile/checkusername'; ?>'
                },
                email_address: {
                    remote: '<?php echo EXAM_SECTION_URL . 'profile/checkemail'; ?>'
                }
            },
            messages: {
                username: {
                    remote: 'The Username already exit.'
                },
                email_address: {
                    remote: 'The Email address already exit'
                }
            },
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
    <h3>Edit Profile</h3>
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

    <form action="<?php echo HOSTEL_URL . 'profile/updateProfile' ?>" method="post" id="manage" class="form-horizontal">
        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                Full Name
                <span class="text-danger">*</span>
            </label>
            <div class="col-md-4">
                <input type="text" name="full_name" required="required" value="<?php echo $profile[0]->full_name; ?>" class="form-control" placeholder="Full Name"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                User Name
                <span class="text-danger">*</span>
            </label>
            <div class="col-md-4">
                <input type="text" name="username" required="required" value="<?php echo $profile[0]->username; ?>" class="form-control" placeholder="User Name" autocomplete="off"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                Email Address
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-md-4">
                <input type="email" name="email_address"  value="<?php echo $profile[0]->email_address; ?>" class="form-control" placeholder="Email Address" autocomplete="off"/>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?php echo EXAM_SECTION_URL; ?>" class="btn btn-inverse">Cancel</a>
            </div>
        </div>

        <div class="form-group">
            Fields marked with  <span class="text-danger">*</span>  are mandatory.
        </div>
    </form>
</div>