<?php $session = $this->session->userdata('admin_session'); ?>
<script type="text/javascript" >
    $(document).ready(function() {
        $('#list').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "bProcessing": true,
            "bServerSide": true,
            "iDisplayLength": 50,
            "bSort": false,
            "aoColumns": [
                {"sClass": ""}, {"sClass": "text-center"},
                {"sClass": "text-center"}, {"sClass": "text-center"},
                {"sClass": "text-center"}
            ],
            "sAjaxSource": "<?php echo ADMISSION_URL . "eet/json"; ?>",
            'fnRowCallback': function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                if (aData[3] == null || aData[3] == '0.00') {
                    nRow.className = "danger";
                }
            }
        });
    });
</script>
<div class="row">
    <div class="col-md-12">
        <h3>Entrance Exam Result</h3>
        <hr>
    </div>

    <div class="col-md-12">
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
        <table class="table table-bordered" id="list">
            <thead>
                <tr align="left">
                    <th>Name</th>
                    <th width="150">Form No</th>
                    <th width="125">Hall Ticket</th>
                    <th width="250">Marks</th>
                    <th width="50">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>etc</td>
                    <td>etc</td>
                    <td>etc</td>
                    <td>etc</td>
                    <td>etc</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="update_student_marks" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        </div>
    </div>
</div>