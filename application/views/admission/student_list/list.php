<?php $session = $this->session->userdata('admin_session'); ?>
<script type="text/javascript" >
    $(document).ready(function() {
        loadTable();
        $('#dispaly_year').html($('#year').val());
        $('#dispaly_course').html($('#course_id option:selected').text());
        $('#print_list').attr('href', ('<?php echo ADMISSION_URL . 'list/print/'; ?>' + $('#year').val() + '/' + $('#course_id').val() + '/' + $('#admission_status_id').val()));

        $('#year').change(function() {
            $('#dispaly_year').html($('#year').val());
            $('#dispaly_course').html($('#course_id option:selected').text());
            $('#print_list').attr('href', ('<?php echo ADMISSION_URL . 'list/print/'; ?>' + $('#year').val() + '/' + $('#course_id').val() + '/' + $('#admission_status_id').val()));
            loadTable();
        });

        $('#course_id').change(function() {
            $('#dispaly_year').html($('#year').val());
            $('#dispaly_course').html($('#course_id option:selected').text());
            $('#print_list').attr('href', ('<?php echo ADMISSION_URL . 'list/print/'; ?>' + $('#year').val() + '/' + $('#course_id').val() + '/' + $('#admission_status_id').val()));
            loadTable();
        });

        $('#admission_status_id').change(function() {
            $('#dispaly_year').html($('#year').val());
            $('#dispaly_course').html($('#course_id option:selected').text());
            $('#print_list').attr('href', ('<?php echo ADMISSION_URL . 'list/print/'; ?>' + $('#year').val() + '/' + $('#course_id').val() + '/' + $('#admission_status_id').val()));
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
                {"sClass": ""}, {"sClass": "text-center"},
                {"sClass": "text-center"}, {"sClass": "text-center"},
                {"sClass": "text-center"}, {"sClass": "text-center"}
            ],
            "sAjaxSource": "<?php echo ADMISSION_URL . "list/json/"; ?>" + $('#year').val() + '/' + $('#course_id').val() + '/' + $('#admission_status_id').val()
        });
    }
</script>
<div class="row">
    <div class="col-md-12 margin-killer">
        <h2 class="text-center margin-killer-tb">Student List of : <span id="dispaly_course"></span> - <span id="dispaly_year"></span></h2>
    </div>
    <div class="col-md-12">
        <hr />
    </div>
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
        <div class="col-md-1 pull-right">
            <a id='print_list' class="btn btn-primary col-md-12" target="_blank">Print</a>
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
        <div class="table-responsive">
            <table class="table table-bordered" id="list">
                <thead>
                    <tr align="left">
                        <th width="75">Sr. No.</th>
                        <th width="150">Form No</th>
                        <th>Name</th>
                        <th width="135">Stud. Mobile No</th>
                        <th width="135">Stud. Email</th>
                        <th width="135">Parent Mobile No</th>
                        <th width="135">Parent Email</th>
                        <th width="135">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>etc</td>
                        <td>etc</td>
                        <td>etc</td>
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
</div>