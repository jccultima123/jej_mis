<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MOBILIZER</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
</head>
<body>
    <!-- logo -->
    <div class="logo">
        MOBILIZER
    </div>

    <!-- navigation -->
    <div class="navigation">
        <a href="<?php echo URL; ?>home/dashboard">dashboard</a>
        <a href="<?php echo URL; ?>articles">articles</a>
        <a href="<?php echo URL; ?>products">products</a>
        <a href="<?php echo URL; ?>services">services</a>
        <a href="<?php echo URL; ?>about">about us</a>
        
        <a href="<?php echo URL; ?>account" style="float: right; margin-right: 28px;">Hi<?php echo 'USER!'; ?></a>
        <a href="<?php echo URL; ?>home/logout" style="float: right;">logout</a>
            
        <br /><br />
    </div>
