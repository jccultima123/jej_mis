<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en" onContextMenu="return false;" ondragstart="return false" onselectstart="return false">
<head>
    <meta charset="utf-8">
    <title>JEJ MIS -- REPORT</title>
    <meta name="description" content="">
    
    <!-- CSS -->
    <link href="<?php echo URL; ?>assets_new/css/normalize.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/animate.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/custom.css" rel="stylesheet">
        <style>
            html, body {
                background: #fff;
            }
            .container {
                max-width: 990px !important;
            }
        </style>
    <link href="<?php echo URL; ?>assets_new/css/picol.css" rel="stylesheet">
    <script src="<?php echo URL; ?>assets_new/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo URL; ?>assets_new/js/jquery-ui.js"></script>
</head>
<body>
    
    <div role="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php View::adminLogo(); ?>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a id="load" href="<?php echo URL; ?>crm"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a>
                    </li>
                    <li><a id="load" href="<?php echo URL; ?>crm/help"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Help</a></li>
                    <li><a id="load" href="<?php echo URL; ?>crm/about"><span class="glyphicon glyphicon-globe"></span>&nbsp;About</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>&nbsp;Hello, <?php echo $_SESSION['first_name']; ?>!&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">System Version:</li>
                            <li><a id="load" href="<?php echo URL; ?>development"><?php echo file_get_contents(URL .'mis_version'); ?></a></li>
                            <li class="dropdown-header">Logged in as:</li>
                            <li><a><?php echo $_SESSION['user_name']; ?></a></li>
                            <li class="divider"></li>
                            <li><a id="logout" class="navbar-danger" href="<?php echo URL; ?>"><span class="glyphicon glyphicon-home"></span>&nbsp;Module Page</a></li>
                            <?php View::logout(); ?>
                        </ul>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
    
    <div class="bar"></div>
