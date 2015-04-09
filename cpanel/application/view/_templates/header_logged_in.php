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
        <a href="<?php echo URL; ?>">home</a>
        <a href="<?php echo URL; ?>dashboard">dashboard</a>
        <a href="<?php echo URL; ?>settings">settings</a>
        <a href="<?php echo URL; ?>about">about</a>
        
        <a href="<?php echo URL; ?>logout" style="float: right; margin-right: 28px; margin-left: 4px;">logout</a>
        <a href="<?php echo URL; ?>account" style="float: right;">Hi<?php echo 'USER!'; ?></a>
            
        <br /><br />
    </div>
