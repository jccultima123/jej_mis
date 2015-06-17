<!DOCTYPE html>
<html lang="en" onContextMenu="return false;" ondragstart="return false" onselectstart="return false">
<head>
    <meta charset="utf-8">
    <title>JEJ CPANEL</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- NEEDED CLASS -->
    <script src="<?php echo URL; ?>assets/js/jquery-1.11.1.min.js"></script>
    
    <!-- CSS -->
    <link href="<?php echo URL; ?>assets_new/css/normalize.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/animate.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/custom.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets/css/picol.css" rel="stylesheet">
</head>
<body>
    
    <div class="modal js-loading-bar" id="js-loading-bar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Processing...</h4>
                </div>
                <div class="modal-body">
                    <div class="progress progress-popup">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                </div>
            </div>
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
                <a id="load" href="<?php echo URL ?>admin" class="navbar-brand" type="button" aria-expanded="false">
                    <span id="logo">JEJ // MOBILIZER</span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-tasks"></span>&nbsp;Management Info.&nbsp;&nbsp;</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a id="load" href="<?php echo URL; ?>admin/som">Sales and Orders</a></li>
                            <li><a id="load" href="<?php echo URL; ?>admin/ams">Assets</a></li>
                            <li><a id="load" href="<?php echo URL; ?>admin/crm">Customer Relations</a></li>
                            <li class="divider"></li>
                            <li><a id="load" href="<?php echo URL; ?>admin/reports">Generate Report</a></li>
                            <li><a id="load" href="<?php echo URL; ?>admin/usersdashboard">Manage Users</a></li>
                        </ul>
                    </li>
                    <li><a id="load" href="<?php echo URL; ?>admin/help"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Help</a></li>
                    <li><a id="load" href="<?php echo URL; ?>admin/about"><span class="glyphicon glyphicon-globe"></span>&nbsp;About</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>&nbsp;Hello, <?php echo $_SESSION['first_name']; ?>!&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="text-center">Logged in as:<br /><?php echo $_SESSION['user_name']; ?></li>
                            <li class="divider"></li>
                            <li><a id="load" class="navbar-danger" href="<?php echo URL; ?>admin/preferences"><span class="glyphicon glyphicon-wrench"></span>&nbsp;Settings</a></li>
                            <li><a id="logout" class="navbar-danger" href="<?php echo URL; ?>admin/logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                        </ul>
                    </li>
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
