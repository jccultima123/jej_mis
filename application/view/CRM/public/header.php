<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>MOBILIZER</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="THE BIG FIVE from Jose Rizal University">

    <link href="<?php echo URL; ?>assets_new/css/normalize.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/public.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/bootstrap-social.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/bootstrap-table.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/picol.css" rel="stylesheet">
</head>
    <body>
    <header role="navigation" class="navbar navbar-default navbar-fixed-top animated fadeInDown" id="header">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-links" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo URL . 'catalogue'; ?>" style="padding: 5px;">
                    <img class="logo" src="img/logo.jpg" title="Copyright <?php echo date('Y'); ?> JEJ CELLMANIA TRADING CORPORATION">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="header-links">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo URL . 'catalogue'; ?>">Home</a></li>
                    <li><a data-toggle="modal" data-target="#list" href="javascript:void(0)">Products</a></li>
                    <li><a data-toggle="modal" data-target="#about" href="javascript:void(0)">About</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Need Help/Support? <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo URL . 'catalogue/contact'; ?>">Contact Us</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    