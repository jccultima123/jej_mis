<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <a type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>admin/usersdashboard">Cancel</a>
            <h4 class="modal-title">Registration Details</h4>
        </div>
        <div class="modal-body">
            <?php $this->renderFeedbackMessages(); ?>
            <form action="<?php echo URL; ?>admin/userAction" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">User Type</label>
                        <div class="col-lg-9">
                            <select class="form-control selectpicker" id="select" name="user_provider_type" required="true">
                                <option disabled selected hidden>Please Select..</option>
                                <option value="ADMIN" disabled>ADMIN</option>
                                <option value="SALES">Sales Management</option>
                                <option value="ORDER">Order Management</option>
                                <option value="ASSET">Asset Management</option>
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
                        <label class="col-lg-3 control-label">Designated JEJ Branch</label>
                        <div class="col-lg-9">
                            <select class="form-control selectpicker" id="select" name="user_branch" required="true">
                                <option disabled selected hidden>Please Select..</option>
                                <?php foreach ($branches as $branch) { ?>
                                    <option class="option" value="<?php echo $branch->branch_name; ?>"><?php echo $branch->branch_name; ?> - <?php echo $branch->branch_address; ?></option>
                                <?php } ?>
                            </select>
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
                            <label>Do you want to Activate it now?</label><br />
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary">
                                    <input type="radio" name="user_active" id="" value="1" autocomplete="off"> YES
                                </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="user_active" id="" value="0" autocomplete="off"> NOT NOW
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input class="btn btn-primary" type="submit" name="create_user" value="Submit" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>