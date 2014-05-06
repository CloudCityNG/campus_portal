<?php
$session = $this->session->userdata('admin_session');
if ($session->role == 3) {
    $col = '[{"sClass": "text-center"}, {"sClass": "text-center"}, {"sClass": ""},{"sClass": "text-center"},{"sClass": "text-center"},{"sClass": "text-center"}]';
} else {
    $col = '[{"sClass": "text-center"}, {"sClass": "text-center"}, {"sClass": ""},{"sClass": "text-center"},{"sClass": "text-center"}]';
}
?>
<script type="text/javascript" >
    $(document).ready(function() {
        loadTable();
        $('#year').change(function() {
            loadTable();
        });
        $('#course_id').change(function() {
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
            "iDisplayLength": 25,
            "bSort": false,
            "aoColumns":<?php echo $col; ?>,
            "sAjaxSource": "<?php echo HOSTEL_URL . "list_forms_json/"; ?>" + $('#year').val() + '/' + $('#course_id').val()
        });
    }

    function deleteRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();
        $.confirm({
            'title': 'Manage',
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
                                alert('error');
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
    <div class="col-md-6">
        <h3>Students List</h3>
    </div>

    <div class="col-md-6">
        <?php if ($session->role == 2 || $session->role == 3) { ?>
            <h3>
                <a href="<?php echo HOSTEL_URL . 'student/add'; ?>" class="btn btn-default pull-right">
                    Add New Student
                </a>
            </h3>
        <?php } ?>
    </div>
    <div class="clear"></div>
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
                        <th width="150">Image</th>
                        <th width="125">Form No</th>
                        <th>Name</th>
                        <th width="150">Course</th>
                        <th width="150">Mobile</th>
                        <?php
                        if ($session->role == 3) {
                            echo '<th width="150">&nbsp;</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>etc</td>
                        <td>etc</td>
                        <td>etc</td>
                        <td>etc</td>
                        <td>etc</td>
                        <?php
                        if ($session->role == 3) {
                            echo '<td>etc</td>';
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>