<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>JEJ MIS</title>
    <meta name="description" content="">

    <!-- CSS -->
    <link href="<?php echo URL; ?>assets_new/css/normalize.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/animate.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/custom.css" rel="stylesheet" media="all">
    <link href="<?php echo URL; ?>assets_new/css/picol.css" rel="stylesheet">

    <style type="text/css">
        html, body {
            background: #fff;
            padding-bottom: 60px;
        }
        header {
            -webkit-box-shadow: 0px 4px 17px -6px rgba(0,0,0,0.5);
            -moz-box-shadow: 0px 4px 17px -6px rgba(0,0,0,0.5);
            box-shadow: 0px 4px 17px -6px rgba(0,0,0,0.5);
        }
        footer {
            -webkit-box-shadow: 0px -4px 17px -6px rgba(0,0,0,0.37);
            -moz-box-shadow: 0px -4px 17px -6px rgba(0,0,0,0.37);
            box-shadow: 0px -4px 17px -6px rgba(0,0,0,0.37);
        }
    </style>

    <script src="<?php echo URL; ?>assets_new/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo URL; ?>assets_new/js/jquery-ui.js"></script>

</head>
<body style="padding-left: 10px; padding-right: 10px;">

    <header role="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div style="padding: 5px;">
                <span id="load" href="" style="font-size: 28px;" type="button" aria-expanded="false">
                    <span style="color: #CC0000; font-weight: bold;">
                        JEJ // MIS
                    </span>
                    <span style="font-size: 12px; color: #CC0000;"> <?php echo file_get_contents(URL . 'mis_version'); ?></span><br />
                </span>
            </div>
        </div>
    </header>

