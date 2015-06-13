<div class="container">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a id="logout" type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>ams">Cancel</a>
                <h4 class="modal-title" id="REG_DETAILS">Registration Details</h4>
            </div>
            <div class="modal-body">
                <?php $this->renderFeedbackMessages(); ?>
                <form action="<?php echo URL; ?>ams/registerUser" method="POST" style="padding: 10px;" class="form-horizontal">
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
                                <img id="captcha" src="<?php echo URL; ?>ams/showCaptcha" />&nbsp;&nbsp;
                                <a href="#" onclick="document.getElementById('captcha').src = '<?php echo URL; ?>ams/showCaptcha?' + Math.random();
                                        return false"><span class="glyphicon glyphicon-refresh"></span></a>
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
        </div>
    </div>
</div>

