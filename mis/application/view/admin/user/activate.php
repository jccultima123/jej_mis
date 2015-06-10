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
                    <div class="col-md-3">
                        <label>User Type</label>
                    </div>
                    <span class="col-md-9">
                        <?php echo $user->user_provider_type; ?>
                    </span>
                </div>    
                <div class="row">
                    <div class="col-md-3">
                        <label>User Name</label>
                    </div>
                    <span class="col-md-9">
                        <?php echo $user->user_name; ?>
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Designated JEJ Branch</label>
                    </div>
                    <span class="col-md-9">
                        <?php echo $user->user_branch; ?>
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>User Name</label>
                    </div>
                    <span class="col-md-9">
                        <?php echo $user->user_name; ?>
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Email Address</label>
                    </div>
                    <span class="col-md-9">
                        <?php echo $user->user_email; ?>
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>First Name</label>
                    </div>
                    <span class="col-md-9">
                        <?php echo $user->first_name; ?>
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Last Name</label>
                    </div>
                    <span class="col-md-9">
                        <?php echo $user->last_name; ?>
                    </span>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Middle Name</label>
                    </div>
                    <span class="col-md-9">
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
                            <input class="btn btn-primary" type="submit" name="accept_request" value="ACCEPT" />
                            <input class="btn btn-primary" type="submit" name="reject_request" value="REJECT" />
                            <a href="<?php echo URL . 'admin/usersdashboard'; ?>" class="btn btn-primary">NOT NOW</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

