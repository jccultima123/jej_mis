<div class="container">
    <div class="modal-dialog animated fadeInDown">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-group pull-right">
                    <a type="button" class="btn btn-warning" href="<?php echo URL . 'passwordAction/reset'?>">I have my code</a>
                    <a type="button" class="btn btn-default" href="<?php echo URL; ?>">Cancel</a>
                </div>
                <h4 class="modal-title" id="REG_DETAILS">Forgot Password System 1.0</h4><br />
                <div class="alert alert-info" role="alert">
                    Have you forgotten the password? We can recover your password in two ways, to the mail (Sending you a password reset mail) and to the administrator.
                    <br /><br /><strong>NOTE: </strong>Maximum Password Reset Validity -- 1 HOUR
                </div>
            </div>
            <div class="modal-body">
                <?php $this->renderFeedbackMessages(); ?>
                <form action="<?php echo URL; ?>passwordAction/passAction" method="POST" style="padding: 10px;" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">User Type</label>
                            <div class="col-lg-9">
                                <select class="form-control selectpicker" id="select" name="user_provider_type" required="true">
                                    <option disabled selected hidden>Please Select..</option>
                                    <option value="ADMIN" disabled>ADMIN (Not yet available)</option>
                                    <option value="SALES">Sales Management</option>
                                    <option value="ORDER">Order Management</option>
                                    <option value="AMS">Asset Management</option>
                                    <option value="CRM">Cust. Relationship Management</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">User Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-sm" name="user_name" required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <label>Please enter these characters</label><br />
                                <img id="captcha" src="<?php echo URL; ?>misc/showCaptcha" />&nbsp;&nbsp;
                                <a href="#" onclick="document.getElementById('captcha').src = '<?php echo URL; ?>misc/showCaptcha?' + Math.random();
                                            return false"><span class="glyphicon glyphicon-refresh"></span></a>
                                <br /><br />
                                <input type="text" class="form-control input-sm" name="captcha" required />
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

