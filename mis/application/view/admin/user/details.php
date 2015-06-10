<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-warning" href="<?php echo URL . 'admin/deleteUser/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">Delete User</a>
                <a type="button" class="btn btn-default" href="<?php echo URL; ?>admin/usersdashboard">Cancel</a>
            </div>
            <h4 class="modal-title" id="REG_DETAILS">Registration Details</h4>
        </div>
        <div class="modal-body">
            <form action="<?php echo URL; ?>ams/userAction" method="POST" style="padding: 10px;" class="form-horizontal">
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
                            <input type="text" class="form-control input-sm" name="user_name" required="true" value="<?php echo $user->user_name; ?>">
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
                            <input type="text" class="form-control input-sm" name="user_email" required="true" value="<?php echo $user->user_email; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" style="text-transform: uppercase;" class="form-control input-sm" name="first_name" required="true" value="<?php echo $user->first_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" style="text-transform: uppercase;" class="form-control input-sm" name="last_name" required="true" value="<?php echo $user->last_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Middle Name</label>
                        <div class="col-md-9">
                            <input type="text" style="text-transform: uppercase;" class="form-control input-sm" name="middle_name" required="true" value="<?php echo $user->middle_name; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <label>Please enter these characters</label><br />
                            <img id="captcha" src="<?php echo URL; ?>ams/showCaptcha" />&nbsp;&nbsp;
                            <a href="#" onclick="document.getElementById('captcha').src = '<?php echo URL; ?>ams/showCaptcha?' + Math.random();
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
