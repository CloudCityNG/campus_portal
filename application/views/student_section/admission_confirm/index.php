<div class="row">
    <?php if ($this->session->flashdata('error') != '' || $this->session->flashdata('success') != '') { ?>
        <div class="col-md-12">
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
        </div>
    <?php } ?>
    <div class="col-md-6">
        <h1>Admission Confirmed</h1>
    </div>
    <div class="col-md-6" style="margin: 5px 0 0 0;">
        <div class="form-group">
            <h1>
                <input id="tags" type="text" name="marks" value="<?php echo @$details[0]->marks; ?>" class="form-control" placeholder="1404MS19SV00001" required="required"/>
            </h1>
        </div>
    </div>
</div>
<hr class="margin-killer-tb"/>
<div id="student_history">
</div>
<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function($) {
        jQuery("#tags").autocomplete({
            source: '<?php echo STUDENT_SECTION_URL . 'confirm/get_student' ?>',
            select: function(event, ui) {
                $("#tags").val(ui.item.label);
                $.ajax({
                    type: 'GET',
                    url: "<?php echo STUDENT_SECTION_URL . 'confirm/get_student_history/' ?>" + ui.item.value,
                    success: function(data)
                    {
                        $('#student_history').empty();
                        $('#student_history').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {
                        alert('error');
                    }
                });
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