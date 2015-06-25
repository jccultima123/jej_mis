<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-primary" href="<?php echo URL; ?>admin/preferences#user">Close</a>
            </div>
            <h4 class="modal-title">User Details</h4>
        </div>
        <div class="modal-body">
            <div class="table">
                <h4>DETAILS</h4>
                <div class="row">
                    <label class="col-xs-4 control-label">User No.</label>
                    <p class="col-xs-8">
                        <?php echo $user->user_id; ?>
                    </p>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">User Name</label>
                    <p class="col-xs-8">
                        <?php echo $user->user_name; ?>
                    </p>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">User Authentication Code</label>
                    <p class="col-xs-8">
                        <?php echo $user->user_password; ?>
                    </p>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">User Type</label>
                    <p class="col-xs-8">
                        <?php echo $user->user_provider_type; ?>
                    </p>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Designated JEJ Branch</label>
                    <p class="col-xs-8">
                        <?php echo $user->branch_name; ?>
                    </p>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">User Name</label>
                    <p class="col-xs-8">
                        <?php echo $user->user_name; ?>
                    </p>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Email Address</label>
                    <p class="col-xs-8">
                        <?php echo $user->user_email; ?>
                    </p>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">First Name</label>
                    <p class="col-xs-8">
                        <?php echo $user->first_name; ?>
                    </p>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Last Name</label>
                    <p class="col-xs-8">
                        <?php echo $user->last_name; ?>
                    </p>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Middle Name</label>
                    <p class="col-xs-8">
                        <?php echo $user->middle_name; ?>
                    </p>
                </div>
                <div class="row">
                    <p class="col-xs-8 col-xs-offset-4">
                        <a type="button" class="btn btn-primary" href="<?php echo URL . 'admin/editUser/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">Edit</a>
                        <a type="button" class="btn btn-primary" href="<?php echo URL . 'admin/deactivateUser/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">Deactivate</a>
                        <a type="button" class="btn btn-danger" href="<?php echo URL . 'admin/deleteUser/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">Delete User</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>
