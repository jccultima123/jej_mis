<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <a type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>admin/preferences/users">Cancel</a>
            <h4 class="modal-title">Registration Details</h4><br />
            <div class="alert alert-info" role="alert">
                <b>NOTE: </b>All fields are required.
            </div>
        </div>
        <div class="modal-body">
            <?php $this->renderFeedbackMessages(); ?>
            <form action="<?php echo URL; ?>admin/userAction" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Register for</label>
                            <div class="col-md-9">
                                <select class="form-control selectpicker" id="select" name="user_provider_type" required="true" data-container="body">
                                    <option disabled selected hidden>Please Select..</option>
                                    <?php foreach ($usertypes as $utype) { ?>
                                        <?php // if ($utype->provider != 'ADMIN') { ?>
                                            <option class="option" value="<?php echo $utype->provider;?>"><?php echo $utype->provider; ?> <?php echo '(' . $utype->type_desc . ')'?></option>
                                        <?php // } ?>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="myselect" value="myselectedvalue" />
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">User Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-sm required" name="user_name" required="true" value="<?php if (isset($_POST['user_name'])) { echo $_POST['user_name']; } ?>">
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control input-sm password" name="user_password_new" required="true">
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Repeat Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control input-sm password-repeat required" name="user_password_repeat" required="true">
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Designated JEJ Branch</label>
                            <div class="col-md-9">
                                <select class="form-control selectpicker" id="select" name="branch_id" required="true" data-container="body" data-size="5" data-live-search="true" data-header="Select branch">
                                    <option disabled selected hidden>Please Select..</option>
                                    <?php foreach ($branches as $branch) { ?>
                                        <option class="option" value="<?php echo $branch->branch_id; ?>"><?php echo $branch->branch_name; ?> - <?php echo $branch->branch_address; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="myselect" value="myselectedvalue" />
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Email Address</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control input-sm email" name="user_email" required="true" value="<?php if (isset($_POST['user_email'])) { echo $_POST['user_email']; } ?>">
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">First Name</label>
                            <div class="col-md-9">
                                <input type="text" style="text-transform: uppercase;" class="form-control input-sm required" name="first_name" required="true" value="<?php if (isset($_POST['first_name'])) { echo $_POST['first_name']; } ?>">
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Last Name</label>
                            <div class="col-md-9">
                                <input type="text" style="text-transform: uppercase;" class="form-control input-sm required" name="last_name" required="true" value="<?php if (isset($_POST['last_name'])) { echo $_POST['last_name']; } ?>">
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Middle Name</label>
                            <div class="col-md-9">
                                <input type="text" style="text-transform: uppercase;" class="form-control input-sm required" name="middle_name" required="true" value="<?php if (isset($_POST['middle_name'])) { echo $_POST['middle_name']; } ?>">
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <div class="col-md-9 col-md-offset-3">
                                <input class="btn btn-primary submit" type="submit" name="create_user" value="Submit" />
                            </div>
                        </div>
                    </fieldset>
            </form>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>