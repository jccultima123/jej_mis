<!DOCTYPE html>
<html lang="en" onContextMenu="return false;" ondragstart="return false" onselectstart="return false">
<head>
    <meta charset="utf-8">
    <title>JEJ MIS -- CPANEL</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <!-- CSS -->
    <link href="<?php echo URL; ?>assets_new/css/normalize.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/animate.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/custom.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/picol.css" rel="stylesheet">
    <!-- JS -->
    <!--[if lt IE 9]>
        <script src="<?php echo URL; ?>assets_new/js/html5shiv.js"></script>
        <script src="<?php echo URL; ?>assets_new/js/h5f.min.js"></script>
        <script src="<?php echo URL; ?>assets_new/js/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo URL; ?>assets_new/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo URL; ?>assets_new/js/jquery-ui.js"></script>
    
    <?php require VIEWS_PATH . '_script/admin.php'; ?>
</head>
<body>
    
    <div id="wrapper">
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
                    <?php View::adminLogo(); ?>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>&nbsp;Hello, <?php echo $_SESSION['first_name']; ?>!&nbsp;<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-header">System Version:</li>
                                <li><a id="load" href="<?php echo URL; ?>development"><?php echo file_get_contents(URL .'version'); ?></a></li>
                                <li class="dropdown-header">Logged in as:</li>
                                <li><a><?php echo $_SESSION['user_name']; ?></a></li>
                                <li class="divider"></li>
                                <li><a id="load" class="navbar-danger" href="<?php echo URL; ?>admin/preferences/index.php"><span class="glyphicon glyphicon-wrench"></span>&nbsp;Preferences</a></li>
                                <li><a id="logout" class="navbar-danger" href="<?php echo URL; ?>admin/logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li><a id="load" href="<?php echo URL; ?>">Run Public Page</a></li>
                <li><a id="load" href="<?php echo URL; ?>admin">Dashboard</a></li>
                <li><a id="load" href="<?php echo URL; ?>som">Sales and Order Management</a></li>
                <li><a id="load" href="<?php echo URL; ?>ams">Asset Management</a></li>
                <li><a id="load" href="<?php echo URL; ?>crm">Customer Relations</a></li>
                <li><a id="load" href="<?php echo URL; ?>admin/preferences/index.php">System Preferences and Tools</a></li>
                <li><a id="load" href="<?php echo URL; ?>admin/help">Help</a></li>
                <li><a id="load" href="<?php echo URL; ?>admin/about">About</a></li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    
    
        <div id="page-content-wrapper">
            
            <div class="modal js-loading-bar" id="js-loading-bar">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4>Please wait...</h4>
                            <div class="progress progress-popup">
                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
