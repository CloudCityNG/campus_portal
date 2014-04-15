<link href="<?php echo CSS_URL; ?>bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet" media="screen">

<style>
    .nav-tabs > li, .nav-pills > li {
        float:none;
        display:inline-block;
        *display:inline; /* ie7 fix */
        zoom:1; /* hasLayout ie7 trigger */
    }

    .nav-tabs, .nav-pills {
        text-align:center;
    }
</style>

<div class="col-md-12">
    <div class="form-horizontal">
        <h3 class="text-center"><?php echo $image_type; ?></h3>
        <div class = "form-group">
            <label for = "question" class = "col-md-12 control-label">
            </label>
            <div class = "col-md-12">
                <?php echo $image; ?>
            </div>
        </div>

        <hr />
        <div class = "form-group">
            <label for = "question" class = "col-md-4 control-label">
            </label>
            <div class = "col-md-8">
                <a onclick="$('#view_image').modal('hide');" class="btn btn-inverse pull-right">Close</a>
            </div>
        </div>
    </div>
</div>