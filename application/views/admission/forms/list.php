<?php $session = $this->session->userdata('admin_session'); ?>
<script type="text/javascript" >
    $(document).ready(function() {
        $('#list').dataTable({
        "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "bProcessing": true,
                "bServerSide": true,
                "iDisplayLength": 10,
                "bSort": false,
                "aoColumns": [
                {"sClass": "text-center"}, {"sClass": "text-center"}, {"sClass": ""},
                {"sClass": "text-center"}, {"sClass": "text-center"}, {"sClass": "text-center"}
<?php if ($session->role == 3) { ?>
                    , {"sClass": "text-center"}
<?php } ?>
                ],
                "sAjaxSource": "<?php echo ADMISSION_URL . "list_forms_json"; ?>"
    });
    });
    
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
<div class="col-md-12">
    <h3>Admission Forms Lists</h3>
    <hr>
</div>
<?php if ($session->role == 2 || $session->role == 3) { ?>
    <div class="col-md-12 add_button">
        <a href="<?php echo ADMISSION_URL . 'forms/add_ug'; ?>" class="btn btn-default">
            Add New Form
        </a>
    </div>
<?php } ?>
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
                <th width="150">Form No</th>
                <th width="125">Hall Ticket</th>
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
                <td>etc</td>
                <?php if ($session->role == 3) { ?>
                    <td>etc</td>
                <?php } ?>
            </tr>
        </tbody>
    </table>
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