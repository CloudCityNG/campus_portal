<link href="<?php echo CSS_URL; ?>bootstrap.css" rel="stylesheet" media="print">
<title>Merit List</title>
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
            <th colspan="9">Merit List (<?php echo $year; ?>)</th>
        </tr>
        <tr>
            <th width="100">Merit No</th>
            <th>Form No</th>
            <th width="125">Hall Ticket</th>
            <th width="125">Merit Marks</th>
            <th width="100">PCB (%)</th>
            <th width="100">PCBE (%)</th>
            <th width="100">H.S.C (%)</th>
            <th width="100">S.S.C (%)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($table_data)) {
            $i = 0;
            foreach ($table_data as $table) {
                if ($table->PCB > 49.99) {
                    ?>
                    <tr>
                        <td align="center"><?php echo ++$i; ?></td>
                        <td align="center"><?php echo $table->form_number; ?></td>
                        <td align="center"><?php echo $table->hall_ticket; ?></td>
                        <td align="center"><?php echo $table->marks; ?></td>
                        <td align="center"><?php echo $table->PCB; ?></td>
                        <td align="center"><?php echo $table->PCBE; ?></td>
                        <td align="center"><?php echo $table->HSC; ?></td>
                        <td align="center"><?php echo $table->SSC; ?></td>
                    </tr>
                    <?php
                }
            }
        } else {
            ?>
            <tr>
                <th colspan="9">No Data available</th>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>