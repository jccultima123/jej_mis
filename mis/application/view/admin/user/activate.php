<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="REG_DETAILS">Oh wait..</h4>
            <strong>This user was not yet activated.</strong>
        </div>
        <div class="modal-body">
            <div class="table">
                <h4>DETAILS</h4>
                <div class="row">
                    <label class="col-md-4 control-label">User No.</label>
                    <span class="col-md-8">
                        <?php echo $user->user_id; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label">User Name</label>
                    <span class="col-md-8">
                        <?php echo $user->user_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label">User Authentication Code</label>
                    <span class="col-md-8">
                        <?php echo $user->user_password; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label">User Type</label>
                    <span class="col-md-8">
                        <?php echo $user->user_provider_type; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label">Designated JEJ Branch</label>
                    <span class="col-md-8">
                        <?php echo $user->user_branch; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label">User Name</label>
                    <span class="col-md-8">
                        <?php echo $user->user_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label">Email Address</label>
                    <span class="col-md-8">
                        <?php echo $user->user_email; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label">First Name</label>
                    <span class="col-md-8">
                        <?php echo $user->first_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label">Last Name</label>
                    <span class="col-md-8">
                        <?php echo $user->last_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label">Middle Name</label>
                    <span class="col-md-8">
                        <?php echo $user->middle_name; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <form action="<?php echo URL; ?>admin/userAction" method="POST">
                <fieldset>
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>" />
                    <div class="form-group">
                        <div class="btn-group">
                            <input class="btn btn-success" type="submit" name="accept_request" value="ACCEPT" />
                            <input class="btn btn-danger" type="submit" name="reject_request" value="REJECT" />
                            <a href="<?php echo URL . 'admin/usersdashboard'; ?>" class="btn btn-danger">NOT NOW</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

