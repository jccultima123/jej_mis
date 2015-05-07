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
    <!--link href="<?php echo URL; ?>assets_new/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"-->
    
    <!-- CSS -->
    <!--link href="<?php echo URL; ?>assets/css/mobilestyle.css" rel="stylesheet" media="all and (max-width: 720px)"-->
    <!--link href="<?php echo URL; ?>assets/css/style.css" rel="stylesheet" media="all and (min-width: 721px)"-->
    <link href="<?php echo URL; ?>assets_new/css/animation.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/style.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets/css/picol.css" rel="stylesheet">
    
    <!-- JS -->
    <!--[if lt IE 9]>
        <script src="<?php echo URL; ?>js/html5shiv.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
        <script src="<?php echo URL; ?>js/html5shiv.js"></script>
    <![endif]-->
    <script src="<?php echo URL; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets/js/sorttable.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets/js/application.js" type="text/javascript"></script>
</head>
<body>
    
    <div role="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><span id="logo">JEJ // MOBILIZER</span></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo URL; ?>"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-tasks"></span>&nbsp;Management Information&nbsp;&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>dashboard">Dashboard</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo URL; ?>som">Sales and Orders</a></li>
                            <li><a href="<?php echo URL; ?>assets">Assets</a></li>
                            <li><a href="<?php echo URL; ?>crm">Customer Relations</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo URL; ?>help"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Help</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo URL; ?>account" style="text-transform: uppercase;"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $_SESSION['user_name']; ?></a></li>
                    <li><a class="navbar-danger" href="<?php echo URL; ?>logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div id="page_loader_alt" onload="" ><div id="page_loader_alt_spinner"></div></div>
