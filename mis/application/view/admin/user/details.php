<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-primary" href="<?php echo URL . 'admin/editUser/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">Edit</a>
                <a type="button" class="btn btn-primary" href="<?php echo URL; ?>admin/usersdashboard">Close</a>
            </div>
            <h4 class="modal-title">User Details</h4>
        </div>
        <div class="modal-body">
            <div class="table">
                <h4>DETAILS</h4>
                <div class="row">
                    <label class="col-xs-4 control-label">User No.</label>
                    <span class="col-xs-8">
                        <?php echo $user->user_id; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">User Name</label>
                    <span class="col-xs-8">
                        <?php echo $user->user_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">User Authentication Code</label>
                    <span class="col-xs-8">
                        <?php echo $user->user_password; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">User Type</label>
                    <span class="col-xs-8">
                        <?php echo $user->user_provider_type; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Designated JEJ Branch</label>
                    <span class="col-xs-8">
                        <?php echo $user->branch_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">User Name</label>
                    <span class="col-xs-8">
                        <?php echo $user->user_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Email Address</label>
                    <span class="col-xs-8">
                        <?php echo $user->user_email; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">First Name</label>
                    <span class="col-xs-8">
                        <?php echo $user->first_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Last Name</label>
                    <span class="col-xs-8">
                        <?php echo $user->last_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Middle Name</label>
                    <span class="col-xs-8">
                        <?php echo $user->middle_name; ?>
                    </span>
                </div>
                <div class="row">
                    <span class="col-xs-8 col-xs-offset-4">
                        <br />
                        <a type="button" class="btn btn-danger" href="<?php echo URL . 'admin/deactivateUser/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">Deactivate</a>
                    </span>
                </div>
            </div>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>
