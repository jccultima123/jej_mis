<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-danger" href="<?php echo URL; ?>admin/preferences">Cancel</a>
            </div>
            <h4 class="modal-title" id="REG_DETAILS">Change your username</h4>
        </div>
        <div class="modal-body">
            <!-- echo out the system feedback (error and success messages) -->
            <?php $this->renderFeedbackMessages(); ?>
            <form action="<?php echo URL; ?>admin/userAction" method="POST">
                <label>New username</label>
                <br />
                <input type="text" name="user_name" required />
                <input type="submit" value="update_username" />
            </form>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>
