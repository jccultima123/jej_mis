<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <a href="<?php echo URL . 'CRM/feedbacks'; ?>" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a>
            <h4 class="modal-title">Feedback / Ticket #<?php echo $details->feedback_id; ?></h4>
            From  <?php echo $details->feedback_email . ' - '; if (isset($details->customer_id)) { echo $details->name . '. - ' . $details->email; }
                    else { echo $details->name . '. - ' . $details->email; } ?>, <?php echo htmlspecialchars(date(DATE_CUSTOM, $details->created), ENT_QUOTES, 'UTF-8'); ?>
        </div>
        <div class="modal-body">
            <div class="table">
                <div class="row">
                    <label class="col-xs-4 control-label">Feedback Type</label>
                    <span class="col-xs-8">
                        <?php echo $details->type; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Message</label>
                    <span class="col-xs-8">
                        <?php echo $details->feedback_text; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <select class="selectpicker pull-right" data-style="btn-primary" onchange="location = this.options[this.selectedIndex].value;" data-container="body">
                <option hidden disabled selected data-icon="glyphicon glyphicon-pencil"> &nbsp;Set Action</option>
                <option value="<?php echo URL . 'CRM/post/history/' . htmlspecialchars($details->feedback_id, ENT_QUOTES, 'UTF-8'); ?>">View History</option>
                <option value="<?php echo URL . 'CRM/post/reply/' . htmlspecialchars($details->feedback_id, ENT_QUOTES, 'UTF-8'); ?>">Reply/Respond</option>
                <option value="<?php echo URL . 'CRM/post/delete/' . htmlspecialchars($details->feedback_id, ENT_QUOTES, 'UTF-8'); ?>">Delete</option>
            </select>
        </div>
    </div>
</div>
