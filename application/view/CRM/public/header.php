<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <title>JEJ MIS -- CRM</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="THE BIG FIVE from Jose Rizal University">

        <!-- CSS -->
        <link href="<?php echo URL; ?>assets_new/css/normalize.css" rel="stylesheet">
        <link href="<?php echo URL; ?>assets_new/css/animate.css" rel="stylesheet">
        <link href="<?php echo URL; ?>assets_new/css/public.css" rel="stylesheet">
        <link href="<?php echo URL; ?>assets_new/css/bootstrap-table.min.css" rel="stylesheet">
        <link href="<?php echo URL; ?>assets_new/css/picol.css" rel="stylesheet">
    </head>
    
    <body>
        
    <header class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo URL . 'catalogue'; ?>" style="padding: 5px;">
                    <img class="logo" src="img/logo.jpg" title="Copyright <?php echo date('Y'); ?> JEJ CELLMANIA TRADING CORPORATION">
                </a>
            </div>
            <!-- Links -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo URL . 'catalogue'; ?>">Home</a></li>
                    <li><a href="<?php echo URL . 'catalogue/list'; ?>">Products</a></li>
                    <li><a href="<?php echo URL . 'catalogue/about'; ?>">About</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Need Help/Support? <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->

    </header>