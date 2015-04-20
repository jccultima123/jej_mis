<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MOBILIZER</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <script src="<?php echo URL; ?>js/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>js/modernizr.js" type="text/javascript"></script>
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/mobilestyle.css" rel="stylesheet" media="all and (max-width: 720px)">
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet" media="all and (min-width: 721px)">
    <link href="<?php echo URL; ?>css/picol.css" rel="stylesheet">
</head>
<body>

    <div class="header">
        <span class="logo">
            MOBILIZER
        </span>
        <div class="navigation-mobi">
            <select class="option-mobi" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                <option value="">MAIN MENU</option>
                <option value="">-------------------------</option>
                <option value="<?php echo URL; ?>">home</option>
                <option value="<?php echo URL; ?>dashboard">dashboard</option>
                <option value="<?php echo URL; ?>settings">settings</option>
                <option value="<?php echo URL; ?>help">help</option>
                <option value="<?php echo URL; ?>about">about</option>
            </select><br /><br />
            <a href="<?php echo URL; ?>logout" style="float: right; margin-left: 4px;">logout</a>
            <a href="<?php echo URL; ?>account" style="float: right;">Hi <?php echo $_SESSION['user_name']; ?></a>
        </div>
        <div class="navigation">
            <a href="<?php echo URL; ?>">home</a>
            <a href="<?php echo URL; ?>dashboard">dashboard</a>
            <a href="<?php echo URL; ?>settings">settings</a>
            <a href="<?php echo URL; ?>help">help</a>
            <a href="<?php echo URL; ?>about">about</a>
            
            <a href="<?php echo URL; ?>logout" style="float: right; margin-left: 4px;">logout</a>
            <a href="<?php echo URL; ?>account" style="float: right;">Hi <?php echo $_SESSION['user_name']; ?></a>
        </div>
    </div>
    <div style="height: 140px;" class="space"></div>
