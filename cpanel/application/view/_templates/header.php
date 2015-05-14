<!DOCTYPE html>
<!--html lang="en" onContextMenu="return false;" ondragstart="return false" onselectstart="return false"-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>JEJ CPANEL</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- NEEDED CLASS -->
    <script src="<?php echo URL; ?>assets/js/jquery-1.11.1.min.js"></script>
    
    <!-- CSS -->
    <link href="<?php echo URL; ?>assets_new/css/animation_1.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/bootstrap-theme.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets/css/picol.css" rel="stylesheet">
    
    <!-- JS -->
    <!--[if lt IE 9]>
        <script src="<?php echo URL; ?>assets/js/html5shiv.js"></script>
        <script src="<?php echo URL; ?>assets/js/respond.min.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
        <script src="<?php echo URL; ?>assets/js/html5shiv.js"></script>
        <script src="<?php echo URL; ?>assets/js/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo URL; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets/js/sorttable.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets/js/application.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/misc_ges.js" type="text/javascript"></script>
</head>
<body>
    
    <div id="page_loader" style="display: none;">
        <div class="loader">
            <svg class="circular">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
            </svg>
        </div>
    </div>
    
    <!-- HEADER -->
    <div role="navigation" class="navbar navbar-default navbar-fixed-top" id="header">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a id="load" class="navbar-brand" href="<?php echo URL; ?>"><span id="logo">JEJ // MOBILIZER</span></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle visible-md visible-lg visible-sm" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-tasks"></span>&nbsp;Management Info.&nbsp;&nbsp;</a>
                        <a href="#" class="dropdown-toggle visible-xs" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-tasks"></span>&nbsp;Management Info. System&nbsp;&nbsp;</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a id="load" href="<?php echo URL; ?>som">Sales and Orders</a></li>
                            <li><a id="load" href="<?php echo URL; ?>assetmgt">Assets</a></li>
                            <li><a id="load" href="<?php echo URL; ?>crm">Customer Relations</a></li>
                            <li class="divider"></li>
                            <li><a id="load" href="<?php echo URL; ?>products">Products</a></li>
                        </ul>
                    </li>
                    <li></li>
                    <li class="dropdown visible-lg visible-md">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-menu-down"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a id="load" href="<?php echo URL; ?>help"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Help</a></li>
                            <li><a id="load" href="<?php echo URL; ?>about"><span class="glyphicon glyphicon-play"></span>&nbsp;About</a></li>
                        </ul>
                    </li>
                    <li class="visible-sm visible-xs"><a id="load" href="<?php echo URL; ?>help"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Help</a></li>
                    <li class="visible-sm visible-xs"><a id="load" href="<?php echo URL; ?>about"><span class="glyphicon glyphicon-play"></span>&nbsp;About</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a id="load" href="<?php echo URL; ?>account" style="text-transform: uppercase;"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $_SESSION['user_name']; ?></a></li>
                    <li><a id="load_dark" class="navbar-danger" href="<?php echo URL; ?>logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- FOOTER -->
    <div role="navigation" class="navbar navbar-default navbar-fixed-bottom" id="footer">
        <p class="navbar-text" style="text-align: center; float: none;">
            (C) JEJ CELLMANIA TRADING CORPORATION<br />
            System Version: <a id="load" href="<?php echo URL; ?>development"><?php echo file_get_contents(URL .'version'); ?></a>
        </p>
    </div>
    
    <div id="page_loader_dim">
        <div class="loader">
            <svg class="circular">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"/>
            </svg>
        </div>
    </div>
