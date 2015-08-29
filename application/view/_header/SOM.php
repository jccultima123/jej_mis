<!DOCTYPE html>
<!-- <html lang="en" onContextMenu="return false;" ondragstart="return false" onselectstart="return false"> -->
<html lang="en" onContextMenu="return false;">
<head>
    <meta charset="utf-8">
    <title>JEJ MIS</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <!-- CSS -->
    <link href="<?php echo URL; ?>assets_new/css/normalize.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/animate.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/custom.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/picol.css" rel="stylesheet">
    
        <?php require VIEWS_PATH . '_templates/default_css.php'; ?>
    
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
                                <li><a><?php echo file_get_contents(URL .'mis_version'); ?></a></li>
                                <li><a id="load" class="list-group-item" href="<?php echo URL; ?>development">More..</a></li>
                                <li class="dropdown-header">Logged in as:</li>
                                <li><a><?php echo $_SESSION['user_name']; ?></a></li>
                                <li class="divider"></li>
                                <li><a id="load" class="navbar-danger" href="<?php echo URL; ?>preferences"><span class="glyphicon glyphicon-wrench"></span>&nbsp;Preferences</a></li>
                                <li><a id="logout" class="navbar-danger" href="<?php echo URL . 'SOM/logout?user=' . $_SESSION['user_name']; ?>"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div id="sidebar-wrapper">            
            <div id="MainMenu" class="sidebar-nav">
                <div class="list-group">
                    <a id="load" class="list-group-item" href="<?php echo URL; ?>SOM">Home</a>
                    <a id="load" class="list-group-item" href="<?php echo URL; ?>">Visit Public Page</a>
                    <a href="javascript:;" class="list-group-item" data-toggle="collapse" data-target="#menu1" data-parent="#MainMenu">
                        Sales and Order Mgt. <i class="fa fa-caret-down"></i>
                    </a>
                        <div class="collapse" id="menu1">
                            <a href="javascript:;" class="list-group-item" data-toggle="collapse" data-target="#menu1a">
                                <span class="glyphicon glyphicon-book"></span> Sales <i class="fa fa-caret-down"></i>
                            </a>
                                <div class="collapse" id="menu1a">
                                    <a id="load" class="list-group-item" href="<?php echo URL; ?>SOM/sales">Manage</a>
                                </div>
                            <a href="javascript:;" class="list-group-item" data-toggle="collapse" data-target="#menu1b">
                                <span class="glyphicon glyphicon-list-alt"></span> Orders <i class="fa fa-caret-down"></i>
                            </a>
                                <div class="collapse" id="menu1b">
                                    <a id="load" class="list-group-item" href="<?php echo URL; ?>SOM/orders">Manage</a>
                                </div>
                        </div>
                    <a id="load" class="list-group-item" href="<?php echo URL; ?>preferences/index.php">User Preferences</a>
                    <a id="load" class="list-group-item" href="<?php echo URL; ?>SOM/help">Help</a>
                    <a id="load" class="list-group-item" href="<?php echo URL; ?>SOM/about">About</a>
                </div>
            </div>
            
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
