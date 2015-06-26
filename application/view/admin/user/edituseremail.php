<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-danger" href="<?php echo URL; ?>admin/preferences">Cancel</a>
            </div>
            <h4 class="modal-title" id="REG_DETAILS">Edit</h4>
        </div>
        <div class="modal-body">
            <?php $this->renderFeedbackMessages(); ?>
            <form action="<?php echo URL; ?>admin/userAction" method="POST">
                <label>New email adress:</label>
                <input type="text" name="user_email" required />
                <input type="submit" value="Submit" />
            </form>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>
