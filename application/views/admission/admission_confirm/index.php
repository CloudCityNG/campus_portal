
<h1>Admission Confirmed</h1>
<hr />
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
<div class="col-md-12">
    <form action="<?php echo ADMISSION_URL . 'eet/update_marks/' . @$basic_info[0]->student_id; ?>" method="post" id="manage" class="form-horizontal">
        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                Enter Form No :
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-md-4">
                <input id="tags" type="text" name="marks" value="<?php echo @$details[0]->marks; ?>" class="form-control" placeholder="1404MS19SV00001" required="required"/>
            </div>
        </div>
        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                &nbsp;
            </label>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Get Details</button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function($) {
        jQuery("#tags").autocomplete({
            source: '<?php echo ADMISSION_URL . 'confirm/get_student' ?>',
            select: function(event, ui) {
                $("#tags").val(ui.item.label);
                location.href = "<?php echo ADMISSION_URL . 'confirm/get_student_history/' ?>" + ui.item.value
                return false;
            },
            focus: function(event, ui) {
                $("#tags").val(ui.item.label);
                return false;
            }
        });
    });
    //]]>
</script>