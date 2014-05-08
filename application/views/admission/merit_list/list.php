<?php $session = $this->session->userdata('admin_session'); ?>
<script type="text/javascript" >
    $(document).ready(function() {
        loadTable();
        $('#dispaly_merit_year').html($('#year').val());
        $('#print_merit').attr('href', ('<?php echo ADMISSION_URL . 'merit_list/print/'; ?>' + $('#year').val() + '/' + $('#course_id').val()));

        $('#year').change(function() {
            loadTable($('#course_id').attr("data-degree"));
            $('#dispaly_merit_year').html($('#year').val());
            $('#print_merit').attr('href', ('<?php echo ADMISSION_URL . 'merit_list/print/'; ?>' + $('#year').val() + '/' + $('#course_id').val()));
        });

        $('#course_id').change(function() {
            loadTable();
            $('#dispaly_merit_year').html($('#year').val());
            $('#print_merit').attr('href', ('<?php echo ADMISSION_URL . 'merit_list/print/'; ?>' + $('#year').val() + '/' + $('#course_id').val()));
        });
    });
    function loadTable(degree) {
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
            "aoColumns": [{"sClass": ""}, {"sClass": ""}, {"sClass": "text-center"}, {"sClass": "text-center"}, {"sClass": "text-center"}],
            "sAjaxSource": "<?php echo ADMISSION_URL . "merit_list/json/"; ?>" + $('#year').val() + '/' + $('#course_id').val(),
            'fnRowCallback': function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                if (aData[4] == null || aData[4] == '0.00') {
                    nRow.className = "danger";
                }
            }
        });
    }
</script>
<div class="row">
    <div class="col-md-12 margin-killer">
        <h2 class="text-center margin-killer-tb">Merit List (<span id="dispaly_merit_year"></span>)</h2>
    </div>
    <div class="col-md-12">
        <hr />
    </div>
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
                    <?php foreach ($course_details as $detail) { ?>
                        <option value="<?php echo $detail->course_id; ?>" data-degree="<?php echo $detail->degree; ?>"><?php echo $detail->name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-1 pull-right">
                <a id='print_merit' class="btn btn-primary col-md-12" target="_blank">Print</a>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="col-md-12">
        <hr />
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
                    <th width="100">Merit No</th>
                    <th>Name</th>
                    <th width="150">Form No</th>
                    <th width="150">Hall Ticket</th>
                    <th width="150">Merit Marks</th>
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