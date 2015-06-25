<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-danger" href="<?php echo URL; ?>admin/preferences">Cancel</a>
            </div>
            <h4 class="modal-title" id="REG_DETAILS">Change the username</h4>
        </div>
        <div class="modal-body">
            <div class="alert alert-info" role="alert">
                <strong>NOTE: </strong>
                Once it's changed, please notify to this user:<br /><br />
                USER: <?php echo $user->user_name; ?> /
                USER_ID: <?php echo $user->user_id; ?> /
                EMAIL: <a href="mailto:<?php echo $user->user_email; ?>"><?php echo $user->user_email; ?></a>
            </div><hr />
            <!-- echo out the system feedback (error and success messages) -->
            <?php $this->renderFeedbackMessages(); ?>
            <form action="<?php echo URL; ?>admin/userAction" method="POST">
                <label>New username</label>
                <br />
                <input type="text" name="user_id" value="<?php echo $user->user_id; ?>" hidden />
                <input type="text" name="user_name" required />
                <input type="submit" name="update_username" value="UPDATE" />
            </form>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>
