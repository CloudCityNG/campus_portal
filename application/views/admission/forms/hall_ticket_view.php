<div class="container">
    <div class="col-md-4">
        <img src="<?php echo IMAGE_URL . 'hall_ticket_logo.jpg'; ?>" class="col-md-12"/>
    </div>

    <div class="col-md-4">
        <h2 class="text-center">HALL TICKET</h2>
    </div>

    <div class="col-md-4 text-center">
        <p>&nbsp;</p>
        <p>Date of Entrance Test</p>
        <b>Saturday,</b><br />
        <b>31st May, 2014</b>
    </div>

    <div class="col-md-12">
        &nbsp;
    </div>

    <div class="col-md-8">

    </div>

    <div class="col-md-4 text-center">
        <p>Application Number</p>
        <b><?php echo $detail->form_number; ?></b>
        <br /> <br />
        <p>Hall Ticket Number</p>
        <b><?php echo $detail->hall_ticket; ?></b>
        <br /> <br />
        <p style="margin: 0 0 0 85px;">
            <img src="<?php echo base_url() . 'assets/students/' . $detail->student_id . '/' . $image_details[0]->student_image; ?>" class="col-md-8 img-responsive img-thumbnail"/></p>
    </div>
</div>