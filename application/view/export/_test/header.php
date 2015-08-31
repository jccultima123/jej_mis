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
            @media screen and (max-width: 799px){
                #main-body {
                    display: none;
                }
                div#resolution-warning {
                    display: block;
                }
            }            
            
            html, body {
                background: #fff;
            }
            @media screen {
                body {
                    padding-bottom: 50px;
                }
            }
            .container {
                width: 1300px !important;
            }
            table {
                width: 100% !important;
            }
        </style>
    <link href="<?php echo URL; ?>assets_new/css/picol.css" rel="stylesheet">
    
    <script src="<?php echo URL; ?>assets_new/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo URL; ?>assets_new/js/jquery-ui.js"></script>
    <script src="<?php echo URL; ?>assets_new/js/moment.min.js"></script>
    
</head>
<body>
    
    <!-- MODALS -->
    <div class="modal" style="padding: 8px;" id="resolution-warning" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="box-shadow: none;">
                <div class="modal-header">
                    <h4 class="modal-title">Sorry!</h4>
                </div>
                <div class="modal-body">
                    This page does not support with this screen resolution.
                </div>
            </div>
        </div>
    </div>
    
<div id="main-body">
    
    <div class="modal" id="export" tabindex="-1" role="dialog" aria-labelledby="export">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-label="Close">Cancel</button>
                    <h4 class="modal-title">Export</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info" role="alert">
                        <strong>NOTE: </strong>
                        EXPORT is <strong>different</strong> to the PRINT!
                    </div>
                    <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExport('#full',{type:'excel'});"> Export to Excel</a>
                    <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExport('#full',{type:'csv'});"> Export to CSV (Recommended for Spreadsheets)</a>
                    <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExportPDF('#full',{type:'pdf'});"> Export to PDF (Recommended for Printing)</a>
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
                <span id="load" href="" class="navbar-brand no-hover" type="button" aria-expanded="false">
                    <span id="logo">JEJ // MOBILIZER</span>
                    <span style="font-size: 12px; color: #fff;"> Report Generator Beta</span>
                </span>
            </div>
        </div>
    </div>
    
    <div role="navigation" class="navbar navbar-default navbar-fixed-bottom pull-right">
        <div class="container">
            <div class="btn-group no-print" style="padding-top: 10px; margin-right: -15px;">
                <a class="btn btn-danger" href="javascript:void(0)" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> DONE</a>
                <a class="btn btn-danger" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><span class="glyphicon glyphicon-remove"></span> CANCEL</a>
            </div>
        </div>
    </div>
    
    <div role="navigation" class="navbar visible-print" id="print-header">
        <div class="container">
            <div class="navbar-header">
                <span class="navbar-brand no-hover" type="button" aria-expanded="false">
                    <img src="<?php echo URL . 'img/logo.jpg'; ?>" style="height: 50px; margin-top: -20px; margin-right: -15px;"/>
                </span>
            </div><br />
            Powered by JEJ_MIS Version <?php echo file_get_contents(URL . 'mis_version'); ?>
        </div>
    </div>
    
    <div class="container padding-fix hidden-print" style="padding-bottom: 0px; margin-bottom: -10px;">
        <div role="alert" class="alert alert-info">
            <strong>REMINDER: </strong>
            <p>
                This is not yet a final report preview. Printed records may vary across different browsers.<br />
                You may modify data by <strong>filter, search (may vary), and sort</strong> as well.
                If you want to print by pages, you may do it <strong>separately</strong>
            </p>
        </div>
    </div>
    
