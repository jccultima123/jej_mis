<div class="container-fluid">
    
    <div class="modal fade registration fluid" tabindex="-1" role="dialog" aria-labelledby="REG_DETAILS" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>ams">Cancel</a>
                    <h4 class="modal-title" id="REG_DETAILS">Registration Details</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo URL; ?>ams/registerUser" method="POST" style="padding: 10px;" class="form-horizontal">
                        <fieldset>  
                            <div class="form-group">
                                <label class="col-md-3 control-label">User Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="user_name" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="user_password" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Repeat Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="user_password" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">First Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="first_name" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Last Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="last_name" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Middle Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="middle_name" required="true">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-3 control-label"></div>
                                <div class="col-md-9">
                                    <label>
                                        Please enter these characters
                                    </label><br />
                                    <img id="captcha" src="<?php echo URL; ?>ams/showCaptcha" />&nbsp;&nbsp;
                                    <a href="#" onclick="document.getElementById('captcha').src = '<?php echo URL; ?>login/showCaptcha?' + Math.random(); return false"><span class="glyphicon glyphicon-refresh"></span></a>
                                    <br /><br />
                                    <input type="text" class="form-control" name="captcha" required />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <input class="btn btn-primary" type="submit" name="submit_request" value="Submit" />
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    
    <div class="row-fluid" id="login_dialog" style="width: auto;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b style="font-size: 28px;">JEJ // <span class="mobilizer_logo">MOBILIZER</span></b><br />
                <strong>Asset Management Module</strong>
            </div>
            <div class="panel-body" style="padding: 0; padding-top: 20px;">
                <div class="col-sm-4">
                    <form action="<?php echo URL; ?>ams/loginuser" method="post" autocomplete="on">
                        <div class="panel-body" id="login-body">
                            <input type="text" name="user_name" class="form-control" placeholder="Username or Email" /><br />
                            <div class="input-group">
                                <input type="password" name="user_password" class="form-control" placeholder="Password" /><br />
                                <span class="input-group-btn">
                                    <input type="submit" name="submit" class="btn btn-default" value="LOGIN" id="page_loader_submit" />
                                </span>
                            </div><br />
                        </div>
                    </form>
                </div>
                <div class="col-sm-8">
                    <?php $this->renderFeedbackMessages(); ?>
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <strong>WELCOME</strong>
                            <span class="pull-right">New User? You can send Registration Request
                            <a data-toggle="modal" data-target=".registration" href="#"><u>here</u>.</a></span>
                        </div>
                        <div class="panel-body">
                            <p>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IN THIS MODULE,
                                <ul>
                                    <li>Can manage assets such as products owned, etc.</li>
                                    <li>Can manage requests.</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                (C) JEJ CELLMANIA TRADING CORP.
            </div>
        </div>
    </div>
</div>