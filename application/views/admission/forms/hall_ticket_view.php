<table border="0" style="width:100%">
    <tr>
        <td width="150">
            <img src="<?php echo IMAGE_URL . 'hall_ticket_logo.jpg'; ?>" style="height: 75px; margin: 0 0 0 20px;"/>
        </td>

        <td width="250">
            <h2 style="text-align: center;">HALL TICKET</h2>
        </td>

        <td width="250">
            <div style="text-align: center;">
                <p style="margin: 0;">Date of Entrance Test</p>
                <b style="margin: 0 0 10px;"><?php echo date('l', strtotime(@$admission_details[0]->exam_date)), '<br/>', date('dS F, Y', strtotime(@$admission_details[0]->exam_date)); ?></b><br >
                <p style="margin: 10px 0 0px;">Time</p>
                <b style="margin: 0 0 10px;"><?php echo @$admission_details[0]->exam_time; ?></b>
            </div>
            <br />
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <hr />
        </td>
    </tr>

    <tr>
        <td colspan="2" valign="top">
            <div style="display: block; width: 90%; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #000; vertical-align: middle; background-color: #ffffff; border: 1px solid #000000; border-radius: 4px;"><?php echo 'Name & Address of the Candidate :' . "<br /><b>" . ucwords(@$detail->firstname . ' ' . @$detail->middlename . ' ' . @$detail->lastname) . "</b><br />" . strip_tags(@$detail->address); ?></div>
            <br />
            <div style="display: block; width: 90%;padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #000; vertical-align: middle; background-color: #ffffff; border: 1px solid #000000; border-radius: 4px;"><?php echo 'Name & Address of the Center allotted to the Candidate :' . "<br /><b>" . ucwords(@$center_details[0]->name) . "</b><br />" . @$center_details[0]->address; ?></div>
            <br />
            <div style="float: left; height: 75px; width: 40%; height: 75px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #000; background-color: #ffffff; border: 1px solid #000000; border-radius: 4px; margin: 0 18px 0 0;">**Candidate's Signature</div>
            <div style="float: left;  width: 40%;  height: 75px;  padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #000;  background-color: #ffffff; border: 1px solid #000000; border-radius: 4px;">Coordinator's Signature (AICET - <?php echo date('Y', strtotime(@$admission_details[0]->exam_date)); ?>)</div>
            <br />
            <div style="clear:both; display: block; width: 100%;">
                ** to be signed in the presence of the Invigilator in Examination Hall
            </div>
        </td>
        <td>
            <div style="text-align: center;">
                <p>Application Number</p>
                <span style="border: 1px black solid; padding: 0px 25px;">
                    <b><?php echo $detail->form_number; ?></b>
                </span>
            </div>
            <br />
            <div style="text-align: center;">
                <p>Hall Ticket Number</p>
                <span style="border: 1px black solid; padding: 0px 25px;">
                    <b><?php echo $detail->hall_ticket; ?></b>
                </span>
            </div>
            <br />
            <div style="text-align: center;">
                <img src="<?php echo base_url() . 'assets/students/' . $detail->student_id . '/' . $image_details[0]->student_image; ?>"  style="border: 1px black solid; height: 125px; display: block; margin-left: auto; margin-right: auto;" />
            </div>
            <br />
            <div style="text-align: center;">
                <img src="<?php echo base_url() . 'assets/students/' . $detail->student_id . '/' . $image_details[0]->sign; ?>"  style="border: 1px black solid; height: 50px; width: 175px; display: block; margin-left: auto; margin-right: auto;" />
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <hr />
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <div>
                <b>NOTE :</b><br />
                <ul>
                    <li>Come with your own pen / Pencils (H.B.), Sharpner & Eraser</li>
                    <li>Candidates are not permitted to bring with him Calculator, Cellular/Mobile Phones or any other Electronic gadgets etc. Candidates are not permitted to bring</li>
                </ul>
            </div>
        </td>
    </tr>
</table>


<!--
<div class="container">
    <div class="col-md-9">
        <div class="form-control" style="height: 100px">
<?php echo 'Name & Address of the Candidate :' . "<br /><b>" . ucwords(@$detail->firstname . ' ' . @$detail->middlename . ' ' . @$detail->lastname) . "</b><br />" . strip_tags(@$detail->address); ?>

        </div>
        <div class="clear"></div>
        <br />
        <div class="form-control" style="height: 100px">
<?php echo 'Name & Address of the Center allotted to the Candidate :' . "<br /><b>" . ucwords(@$center_details[0]->name) . "</b><br />" . @$center_details[0]->address; ?>
        </div>
        <div class="clear"></div>
        <br />
        <div class="col-md-7" style="padding-left: 0px; padding-right: 0px;">
            <div class="form-control" style="height: 50px">**Candidate's Signature</div>
            <p class="help-block">** to be signed in the presence of the Invigilator in Examination Hall</p>
        </div>
        <div class="col-md-5">
            <div class="form-control" style="height: 50px">Coordinator's Signature (AICET - <?php echo date('Y', strtotime(@$admission_details[0]->exam_date)); ?>)</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="col-md-12 text-center">
            <div>
                <p>Application Number</p>
                <span style="border: 1px black solid; padding: 0px 25px;">
                    <b><?php echo $detail->form_number; ?></b>
                </span>
            </div>
            <div>
                <p>Hall Ticket Number</p>
                <span style="border: 1px black solid; padding: 0px 25px;">
                    <b><?php echo $detail->hall_ticket; ?></b>
                </span>
            </div>
            <br />
            <div class="">
                <img src="<?php echo base_url() . 'assets/students/' . $detail->student_id . '/' . $image_details[0]->student_image; ?>" class="img-thumbnail hall-ticket-student-image" style="border: 1px black solid;" />
            </div>
            <div class="clear"></div>
            <br />
            <div>
                <img src="<?php echo base_url() . 'assets/students/' . $detail->student_id . '/' . $image_details[0]->sign; ?>" class="hall-ticket-student-sign"/>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <hr />
    <div class="co-md-12">
        <b>NOTE :</b><br />
        <ul>
<li>** to be signed in the presence of the Invigilator in Examination Hall</li>
            <li>Come with your own pen / Pencils (H.B.), Sharpner & Eraser</li>
            <li>Candidates are not permitted to bring with him Calculator, Cellular/Mobile Phones or any other Electronic gadgets etc. Candidates are not permitted to bring</li>
        </ul>
    </div>
    <div class="clear"></div>
</div>
-->