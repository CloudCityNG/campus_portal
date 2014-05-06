<?php $session = $this->session->userdata('admin_session'); ?>
<script type="text/javascript" >
    $(document).ready(function() {
        loadTable();
        $('#year').change(function() {
            loadTable();
        });
        $('#course_id').change(function() {
            loadTable();
        });
        $('#admission_status_id').change(function() {
            loadTable();
        });
    });
    function loadTable() {
        if (typeof dTable != 'undefined') {
            dTable.fnDestroy();
        }
        dTable = $('#list').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "bProcessing": true,
            "bServerSide": true,
            "iDisplayLength": 100,
            "bSort": false,
            "aoColumns": [
                {"sClass": ""}, {"sClass": "text-center"},
                {"sClass": "text-center"}, {"sClass": "text-center"},
                {"sClass": "text-center"}
            ],
            "sAjaxSource": "<?php echo ADMISSION_URL . "eet/json/"; ?>"  + $('#year').val() + '/' + $('#course_id').val() + '/' + $('#admission_status_id').val(),
            'fnRowCallback': function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                if (aData[3] == null || aData[3] == '0.00') {
                    nRow.className = "danger";
                }
            }
        });
    }
</script>
<div class="row">
    <div class="col-md-12">
        <h3>Entrance Exam Result</h3>
        <hr>
    </div>

    <div class="clear"></div>

    <div class="col-md-12">
        <div class="col-md-12 padding-killer">
            <div class="col-md-2 text-center">
                <label class="">Admission Year</label>
                <select class="form-control text-center" id="year">
                    <?php foreach ($admission_details as $year) { ?>
                        <option value="<?php echo $year->admission_year; ?>"><?php echo $year->admission_year; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 text-center">
                <label class="">Course</label>
                <select class="form-control text-center" id="course_id">
                    <option value="0">All</option>
                    <?php foreach ($course_details as $detail) { ?>
                        <option value="<?php echo $detail->course_id; ?>"><?php echo $detail->name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 text-center">
                <label class="">Status</label>
                <select class="form-control text-center" id="admission_status_id">
                    <option value="0">All</option>
                    <?php foreach ($candidate_status_info as $status) { ?>
                        <option value="<?php echo $status->admission_status_id; ?>"><?php echo $status->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <div class="clear"></div>
    <div class="col-md-12">
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