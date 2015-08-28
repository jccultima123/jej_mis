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
    <link href="<?php echo URL; ?>assets_new/css/bootstrap-table.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/picol.css" rel="stylesheet">
    
        <?php require VIEWS_PATH . '_templates/default_css.php'; ?>
    
</head>
<body>
    
    <div class="modal js-loading-bar" id="js-loading-bar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Please wait...</h4>
                    <div class="progress progress-popup">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- HEADER -->
    <div role="navigation" class="navbar navbar-default navbar-fixed-top" id="header">
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
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-tasks"></span>&nbsp;SOM Module&nbsp;&nbsp;</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a id="load" href="<?php echo URL; ?>SOM">SOM Home Page</a></li>
                            <li><a id="load" href="<?php echo URL; ?>SOM/sales?page=1">Manage Sales</a></li>
                            <li><a id="load" href="<?php echo URL; ?>SOM/orders">Manage Orders</a></li>
                        </ul>
                    </li>
                    <li><a id="load" href="<?php echo URL; ?>SOM/help"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Help</a></li>
                    <li><a id="load" href="<?php echo URL; ?>SOM/about"><span class="glyphicon glyphicon-globe"></span>&nbsp;About</a></li>
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