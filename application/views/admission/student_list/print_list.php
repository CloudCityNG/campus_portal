<title>Student List</title>
<style>
    table, table td, table th {border: 1px solid; border-collapse: collapse; }
</style>
<div style>
    <img src="<?php echo IMAGE_URL . 'hall_ticket_logo.jpg'; ?>" style="display: block; margin: 0 auto; height: 125px;"/>
</div>
<br />
<table style="width: 95%; margin: 0 auto;" border="1">
    <thead>
        <tr>
            <th colspan="6">
                Student List of <?php echo @$course_details[0]->name, ' ', @$year; ?>
            </th>
        </tr>
        <tr>
            <th width="100">Sr. No.</th>
            <th width="200">Form No</th>
            <th>Name</th>
            <th width="135">Student Mobile No <br /> Email Address</th>
            <th width="135">Parent Mobile No <br /> Email Address</th>
            <th width="135">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($table_data)) {
            $i = 0;
            foreach ($table_data as $table) {
                ?>
                <tr>
                    <td width="100" align="center"><?php echo ++$i; ?></td>
                    <td width="200" align="center"><?php echo $table->form_number; ?></td>
                    <td width="500"> &nbsp; <?php echo $table->student_name; ?></td>
                    <td width="135" align="center"><?php echo $table->mobile_s, '<br />', $table->email_s; ?></td>
                    <td width="135" align="center"><?php echo $table->mobile_p, '<br />', $table->email_p; ?></td>
                    <td width="135" align="center"><?php echo $table->status; ?></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <th colspan="6">No Data available</th>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>