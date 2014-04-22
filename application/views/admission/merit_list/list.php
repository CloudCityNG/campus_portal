<?php $session = $this->session->userdata('admin_session'); ?>
<script type="text/javascript" >
    $(document).ready(function() {
        loadTable();
        $('#dispaly_merit_year').html($('#merit_year').val());
        $('#print_merit').attr('href', ('<?php echo ADMISSION_URL . 'merit_list/print/'; ?>' + $('#merit_year').val()));

        $('#merit_year').change(function() {
            $('#dispaly_merit_year').html($('#merit_year').val());
            $('#print_merit').attr('href', ('<?php echo ADMISSION_URL . 'merit_list/print/'; ?>' + $('#merit_year').val()));
            loadTable();
        });

    });


    function loadTable() {
        if (typeof dTable != 'undefined') {
            dTable.fnDestroy();
        }
        dTable = $('#list').dataTable({
            "bJQueryUI": true,
            "bInfo": false,
            "bPaginate": false,
            "bFilter": false,
            "bSort": false,
            "bProcessing": true,
            "bServerSide": true,
            "iDisplayLength": "-1",
            "aoColumns": [
                {"sClass": ""}, {"sClass": ""},
                {"sClass": "text-center"}, {"sClass": "text-center"},
                {"sClass": "text-center"}, {"sClass": "text-center"},
                {"sClass": "text-center"}, {"sClass": "text-center"},
                {"sClass": "text-center"}
            ],
            "sAjaxSource": "<?php echo ADMISSION_URL . "merit_list/json/"; ?>" + $('#merit_year').val(),
            'fnRowCallback': function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                if (aData[4] == null || aData[4] == '0.00' || aData[5] == null || aData[5] == '0.00') {
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
    <div class="col-md-12 padding-killer">
        <div class="col-md-2">
            <select class="form-control text-center" id="merit_year">
                <?php foreach ($admission_details as $year) { ?>
                    <option value="<?php echo $year->admission_year; ?>"><?php echo $year->admission_year; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-1 pull-right">
            <a id='print_merit' class="btn btn-primary col-md-12" target="_blank">Print</a>
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
                    <th width="125">Form No</th>
                    <th width="125">Hall Ticket</th>
                    <th width="100">Merit Marks</th>
                    <th width="100">PCB (%)</th>
                    <th width="100">PCBE (%)</th>
                    <th width="100">H.S.C (%)</th>
                    <th width="100">S.S.C (%)</th>
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
                    <td>etc</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>