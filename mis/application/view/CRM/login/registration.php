<!DOCTYPE html>
<html lang="en" onContextMenu="return false;" ondragstart="return false" onselectstart="return false">
<head>
    <meta charset="utf-8">
    <title>JEJ AMS</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- NEEDED CLASS -->
    <script src="<?php echo URL; ?>assets/js/jquery-1.11.1.min.js"></script>
    
    <!-- CSS -->
    <link href="<?php echo URL; ?>assets_new/css/normalize.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/animate.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/bootstrap-theme.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets/css/picol.css" rel="stylesheet">
    
    <!-- JS -->
    <!--[if lt IE 9]>
        <script src="<?php echo URL; ?>assets/js/html5shiv.js"></script>
        <script src="<?php echo URL; ?>assets/js/respond.min.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
        <script src="<?php echo URL; ?>assets/js/html5shiv.js"></script>
        <script src="<?php echo URL; ?>assets/js/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo URL; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets/js/sorttable.js" type="text/javascript"></script>
</head>
<body style="background-color: #FFF;">

    <div class="modal-header">
        <a type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>ams">Cancel</a>
        <h4 class="modal-title" id="REG_DETAILS">Registration Details</h4>
    </div>
    <div class="modal-body">
        <?php $this->renderFeedbackMessages(); ?>
        <form action="<?php echo URL; ?>crm/registerUser" method="POST" style="padding: 10px;" class="form-horizontal">
            <fieldset>  
                <div class="form-group">
                    <label class="col-md-3 control-label">User Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control input-sm" name="user_name" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control input-sm" name="user_password_new" required="true" placeholder="Minimum of 6 Characters">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Repeat Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control input-sm" name="user_password_repeat" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Designated JEJ Branch</label>
                    <div class="col-md-9">
                        <select class="form-control selectpicker" id="select" name="user_branch" required="true">
                            <option disabled selected hidden>Please Select..</option>
                            <?php foreach ($branches as $branch) { ?>
                                <option class="option" value="<?php echo $branch->branch_name; ?>"><?php echo $branch->branch_name; ?> - <?php echo $branch->branch_address; ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="myselect" value="myselectedvalue" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Email Address</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control input-sm" name="user_email" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">First Name</label>
                    <div class="col-md-9">
                        <input type="text" style="text-transform: uppercase;" class="form-control input-sm" name="first_name" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Last Name</label>
                    <div class="col-md-9">
                        <input type="text" style="text-transform: uppercase;" class="form-control input-sm" name="last_name" required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Middle Name</label>
                    <div class="col-md-9">
                        <input type="text" style="text-transform: uppercase;" class="form-control input-sm" name="middle_name" required="true">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <label>
                            Please enter these characters
                        </label><br />
                        <img id="captcha" src="<?php echo URL; ?>crm/showCaptcha" />&nbsp;&nbsp;
                        <a href="#" onclick="document.getElementById('captcha').src = '<?php echo URL; ?>crm/showCaptcha?' + Math.random(); return false"><span class="glyphicon glyphicon-refresh"></span></a>
                        <br /><br />
                        <input type="text" class="form-control input-sm" name="captcha" required />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <div class="alert alert-info" role="alert">
                            <strong>NOTE: </strong>
                            Once you have submitted the details, you are not yet registered unless the Administrator approved by sending email into your account.
                        </div>
                        <input class="btn btn-primary" type="submit" name="submit_request" value="Submit" />
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <div class="modal-footer"></div>

