<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-primary" href="<?php echo URL . 'admin/editUserPassword/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">Edit Password</a>
                <a type="button" class="btn btn-danger" href="<?php echo URL; ?>admin/preferences">Cancel</a>
            </div>
            <h4 class="modal-title" id="REG_DETAILS">Edit</h4>
        </div>
        <div class="modal-body">
            <?php $this->renderFeedbackMessages(); ?>
            <form action="<?php echo URL; ?>admin/userAction" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">User Type</label>
                        <div class="col-lg-9">
                            <select class="form-control selectpicker" id="select" name="user_provider_type" required="true">
                                <?php foreach ($usertypes as $utype) { ?>
                                    <?php if ($utype->provider == $user->user_provider_type) { ?>
                                        <option class="option" <?php echo 'selected'; ?> value="<?php echo $user->user_provider_type; ?>"><?php echo $user->user_provider_type . ' (' . $utype->type_desc . ')'; ?></option>
                                    <?php } else if ($utype->user_provider_type != $user->user_provider_type) { ?>
                                        <option class="option" value="<?php echo $utype->provider;?>"><?php echo $utype->provider; ?> <?php echo '(' . $utype->type_desc . ')'; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">User Name</label>
                        <div class="col-md-9">
                                <input type="text" class="form-control input-sm username" name="user_name" required="true" value="<?php echo $user->user_name; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Designated JEJ Branch</label>
                        <div class="col-lg-9">
                            <select class="form-control selectpicker" id="select" name="branch_id" required="true">
                                <option disabled hidden>Please Select..</option>
                                <?php foreach ($branches as $branch) { ?>
                                    <?php if ($branch->branch_id == $user->branch_id) { ?>
                                        <option class="option" <?php echo 'selected'; ?> value="<?php echo $user->branch_id; ?>"><?php echo $branch->branch_name; ?> - <?php echo $branch->branch_address; ?></option>
                                    <?php } else { ?>
                                        <option class="option" value="<?php echo $branch->branch_id; ?>"><?php echo $branch->branch_name; ?> - <?php echo $branch->branch_address; ?></option>
                                    <?php } ?>                                    
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email Address</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control input-sm email" name="user_email" required="true" value="<?php echo $user->user_email; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" style="text-transform: uppercase;" class="form-control input-sm required" name="first_name" required="true" value="<?php echo $user->first_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" style="text-transform: uppercase;" class="form-control input-sm required" name="last_name" required="true" value="<?php echo $user->last_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Middle Name</label>
                        <div class="col-md-9">
                            <input type="text" style="text-transform: uppercase;" class="form-control input-sm required" name="middle_name" required="true" value="<?php echo $user->middle_name; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input type="text" hidden="true" name="user_id" value="<?php echo $user->user_id; ?>" />
                            <input class="btn btn-primary" type="submit" name="update_user" value="Submit" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>
