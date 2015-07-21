<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>JEJ MIS -- REPORT (<?php echo date(DATE_CUSTOM); ?>)</title>
    <meta name="description" content="">
    
    <!-- CSS -->
    <link href="<?php echo URL; ?>assets_new/css/normalize.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/animate.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/custom.css" rel="stylesheet" media="all">
        <style>
            html, body {
                background: #fff;
            }
            .container {
                width: 990px !important;
            }
        </style>
    <link href="<?php echo URL; ?>assets_new/css/picol.css" rel="stylesheet">
    
    <script src="<?php echo URL; ?>assets_new/js/jquery-2.1.3.min.js"></script>
    
</head>
<body>
    
    <!-- MODALS -->
    <div class="modal" id="export" tabindex="-1" role="dialog" aria-labelledby="export">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-label="Close">Cancel</button>
                    <h4 class="modal-title">Export</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info" role="alert">
                        <strong>NOTE: </strong>
                        EXPORT is Different than PRINT!
                    </div>
                    <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExport('#full',{type:'excel'});"> Export to Excel</a>
                    <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExportPDF('#full',{type:'pdf'});"> Export to PDF (Recommended)</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal processing" id="processing">
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
    
    <div role="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <span id="load" href="<?php echo URL ?>admin" class="navbar-brand no-hover" type="button" aria-expanded="false">
                    <span id="logo">JEJ // MOBILIZER</span>
                </span>
            </div>
            <div class="btn-group pull-right no-print" style="padding-top: 10px; margin-right: -15px;">
                <a class="btn btn-danger" href="javascript:void(0)" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> Print</a>
                <a class="btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#export"><span class="glyphicon glyphicon-book"></span> Export Data</a>
            </div>
        </div>
    </div>
    
    <div role="navigation" class="navbar navbar-fixed-top visible-print">
        <div class="container">
            <div class="navbar-header">
                <span class="navbar-brand no-hover" type="button" aria-expanded="false">
                    <img src="<?php echo URL . 'img/logo.jpg'; ?>" style="height: 50px; margin-top: -20px; margin-right: -15px;"/>
                </span>
            </div>
        </div>
    </div>
    
