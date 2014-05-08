<?php
$session = $this->session->userdata('admin_session');
if ($session->role == 3) {
    $col = '[{"sClass": "text-center"}, {"sClass": ""},{"sClass": "text-center"}, {"sClass": "text-center"}, {"sClass": "text-center"}, {"sClass": "text-center"}]';
} else {
    $col = '[{"sClass": "text-center"}, {"sClass": ""},{"sClass": "text-center"}, {"sClass": "text-center"}, {"sClass": "text-center"}]';
}
?>
<script type="text/javascript" >
    $(document).ready(function() {
        loadTable();
        $('#degree').change(function() {
            loadTable();
            
            var deg = $('#degree').val();
            $.ajax({
                type: 'GET',
                url: '<?php echo ADMISSION_URL; ?>forms/getCourse/' + deg,
                success: function(data)
                {
                    $('#course_id').empty();
                    $('#course_id').append(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('error 1');
                }
            });
            
            $.ajax({
                type: 'GET',
                url: '<?php echo ADMISSION_URL; ?>forms/getYear/' + deg,
                success: function(data)
                {
                    $('#year').empty();
                    $('#year').append(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('error 2');
                }
            });
        });
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
            "aoColumns":<?php echo $col; ?>,
            "sAjaxSource": "<?php echo ADMISSION_URL . "list_forms_json/"; ?>" + $('#degree').val() + '/' + $('#year').val() + '/' + $('#course_id').val() + '/' + $('#admission_status_id').val()
        });
    }

    function deleteRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();
        $.confirm({
            'title': 'Manage Faculty',
            'message': 'Do you Want to  the Form ?',
            'buttons': {
                'Yes': {'class': 'btn btn-default',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'faculty/delete/' + current_id,
                            data: id = current_id,
                            beforeSend: function() {
                                parent.animate({'backgroundColor': '#fb6c6c'}, 500);
                            },
                            success: function() {
                                window.location.reload();
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert('error 3');
                            }
                        });
                    }
                },
                'No': {
                    'class': 'btn btn-default',
                    'action': function() {
                    }	// Nothing to do in this case. You can as well omit the action property.
                }
            }
        });
        return false;
    }
</script>
<div class="row">
    <div class="col-md-12 text-center">
        <h3>Admission Forms Lists</h3>
    </div>
    <div class="clear"></div>

    <?php if ($session->role == 2 || $session->role == 3) { ?>
        <div class="col-md-12">
            <hr>
        </div>
            <div class="col-md-4">
                <a href="<?php echo ADMISSION_URL . 'forms/add_ug'; ?>" class="col-md-12 btn btn-primary">
                    UG Form
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo ADMISSION_URL . 'forms/add_pg'; ?>" class="col-md-12 btn btn-primary">
                    PG MDS/MD/MS/Super Speciality Form
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo ADMISSION_URL . 'forms/add_pg_other'; ?>" class="col-md-12 btn btn-primary">
                    PG Other Form
                </a>
            </div>
        <div class="clear"></div>
    <?php } ?>
    <div class="col-md-12">
        <hr>
    </div>



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

    <div class="col-md-12">
        <div class="col-md-12 padding-killer">
            <div class="col-md-2 text-center">
                <label class="">Degree</label>
                <select class="form-control text-center" id="degree">
                        <option value="UG">UG</option>
                        <option value="PG">PG</option>
                </select>
            </div>
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
        <div class="table-responsive">
            <table class="table table-bordered" id="list">
                <thead>
                    <tr align="left">
                        <th width="150">Form No</th>
                        <th>Name</th>
                        <th width="150">Course</th>
                        <th width="200">Status</th>
                        <th width="200">Hall Ticket</th>
                        <?php if ($session->role == 3) { ?>
                            <th>&nbsp;</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>etc</td>
                        <td>etc</td>
                        <td>etc</td>
                        <td>etc</td>
                        <td>etc</td>
                        <?php if ($session->role == 3) { ?>
                            <td>etc</td>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="update_student_status" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        </div>
    </div>
</div>

<div class="modal fade" id="view_hall_ticket" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>