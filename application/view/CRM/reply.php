<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <a type="button" class="btn btn-primary pull-right" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Close</a>
            <h4 class="modal-title">Respond to Feedback #<?php echo $details->feedback_id; ?></h4>
        </div>
        <div class="modal-body">
            <?php $this->renderFeedbackMessages(); ?>
            <form action="<?php echo URL; ?>CRM/post/action/<?php echo $details->feedback_id ?>" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group has-feedback">
                        <label class="col-md-2 control-label">Subject</label>
                        <span class="col-md-10">
                            <textarea class="form-control required" name="subject" placeholder="i.e. THE TITLE" required></textarea>
                        </span>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="col-md-2 control-label">Message</label>
                        <span class="col-md-10">
                            <textarea class="form-control required" name="message" required placeholder="Howdy?" rows="10"></textarea>
                        </span>
                    </div>
                    <div class="form-group has-feedback">
                        <span class="col-md-10 col-md-offset-2">
                            <input type="hidden" value="<?php echo $details->feedback_email; ?>" name="email" />
                            <input class="btn btn-primary submit" type="submit" name="submit_response" value="Submit" />
                        </span>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
        
</div>
</div>
