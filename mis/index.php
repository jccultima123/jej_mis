<!DOCTYPE html>
<html lang="en" onContextMenu="return false;" ondragstart="return false" onselectstart="return false">
<head>
    <meta charset="utf-8">
    <title>JEJ / MOBILIZER MI Module</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- NEEDED CLASS -->
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    
    <!-- CSS -->
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-theme.css" rel="stylesheet">
    <link href="assets/css/picol.css" rel="stylesheet">
    
    <!-- JS -->
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
        <script src="assets/js/html5shiv.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body class="null">

<div class="row-fluid animated bounceInDown" id="login_dialog">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b style="font-size: 28px;">JEJ // <span class="mobilizer_logo">MOBILIZER</span></b><br />
            MI Module <?php echo file_get_contents('version'); ?>
        </div>
        <div class="panel-body" id="login-body">
            <strong>Please select a module.</strong><br /><br />
            <a href="som/" class="btn btn-default btn-block">Sales and Order Management</a>
            <a href="ams/" class="btn btn-default btn-block">Asset Management</a>
            <a href="_PUBLIC/" class="btn btn-default btn-block">Customer Relationship (Public)</a>
            <br />
            <a href="cpanel/" class="btn btn-default btn-block">Administrator Panel <?php echo file_get_contents('../cpanel/public/version'); ?></a>
        </div>
        <div class="panel-footer">
            (C) JEJ CELLMANIA TRADING CORP.
        </div>
    </div>
</div>
    
    <!-- TRANSITIONS ARE MUST IN THE FOOTER. This will ensure that all needed files are already loaded -->
    <script src="assets/js/animate.js" type="text/javascript"></script>

</body>
</html>
