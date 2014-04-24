<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $page_title; ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="keywords" content="Sumandeep Vidhyapeeth University,Soyab Rana, Rana Soyab, SVU, svu, College of Medical, College of Pharmacy Sumandeep Vidhyapeeth University, College of Dental Sumandeep Vidhyapeeth University, College of Management Sumandeep Vidhyapeeth University, college of physiotherapy Sumandeep Vidhyapeeth University, College of Nursing Sumandeep Vidhyapeeth University">
        <meta name="description" content="<?php echo $page_title; ?> for SVU, <?php echo $page_title; ?> for Sumandeep Vidhyapeeth University,Campus Portal, An ERP for College">
        <meta name="author" content="Sumandeep Vidhyapeeth University & Soyab Rana">
        <meta name="copyright" content="Copyrights &copy; Sumandeep Vidhyapeeth University;Design and Developed By Soyab Rana">

        <link rel="shortcut icon" href="<?php echo IMAGE_URL . 'favicon.ico'; ?>" type="image/x-icon">
        <link rel="icon" href="<?php echo IMAGE_URL . 'favicon.ico'; ?>" type="image/x-icon">

        <link href="<?php echo CSS_URL; ?>bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet" media="screen">
        <link href="<?php echo CSS_URL; ?>signin.css" rel="stylesheet" media="screen">

        <script src="<?php echo JS_URL; ?>jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="<?php echo JS_URL; ?>jquery.validate.js" type="text/javascript"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.js"></script>
        <![endif]-->
    </head>
    <body class="login-back-logo">
        <div class="container">
            <!--Header-->
            <div class="row padding-killer margin-killer login-page-header">
                <div class="container padding-killer">
                    <div class="project-logo-area text-center">
                        <h1>
                            <span class="tri-color-orange">Sumandeep</span>
                            <span class="tri-color-white">Vidyapeeth</span>
                            <span class="tri-color-green">Portal</span>
                        </h1>
                    </div>
                </div>   	
            </div>
            <!--/Header-->

            <!--Main Container-->
            <div class="">
                <?php echo @$content_for_layout; ?>
            </div>
            <!--Main Container-->

            <div class="pull-right footer-style">
                Powered By : <a href="http://sumandeepuniversity.co.in">Sumandeep Vidyapeeth University</a>
            </div>
        </div>
    </body>
</html>
