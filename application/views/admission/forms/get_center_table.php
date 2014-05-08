<table class="table table-bordered table-responsive">
    <tr>
        <th rowspan="2" style="vertical-align: middle;">Examination Center</th>
        <th rowspan="2" style="vertical-align: middle;">Code</th>
        <th colspan="4">Preference</th>
    </tr>
    <tr>
        <th>1</th>
        <th>2</th>
        <th>3</th>
    </tr>

    <?php
    $i = 1;
    foreach ($center_details as $center) {
        ?>
        <tr>
            <td><?php echo @$center->name; ?></td>
            <td class="text-center"><?php echo @$center->code; ?></td>
            <th>
                <label for="<?php echo $i; ?>" >
                    <input type="checkbox" name="p1[]" id="<?php echo $i; ?>" class="required" value="<?php echo @$center->center_id; ?>" onclick="countCheckBoxes(<?php
                    echo $i;
                    $i++;
                    ?>, 'p1[]', '1')">
                </label>
            </th>
            <th>
                <label for="<?php echo $i; ?>" >
                    <input type="checkbox" name="p2[]" id="<?php echo $i; ?>" class="required" value="<?php echo @$center->center_id; ?>" onclick="countCheckBoxes(<?php
                    echo $i;
                    $i++;
                    ?>, 'p2[]', '1')">
                </label>
            </th>
            <th>
                <label for="<?php echo $i; ?>" >
                    <input type="checkbox" name="p3[]" id="<?php echo $i; ?>" class="required" value="<?php echo @$center->center_id; ?>" onclick="countCheckBoxes(<?php
                           echo $i;
                           $i++;
                           ?>, 'p3[]', '1')">
                </label>
            </th>
        </tr>
        <?php
    }
    ?>
</table>