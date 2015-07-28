<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <a type="button" class="btn btn-primary pull-right" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Close</a>
            <h4 class="modal-title">Respond to Feedback #<?php echo $details->feedback_id; ?></h4>
        </div>
        <div class="modal-body">
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
                            <textarea class="form-control required" name="message" required><?php if(defined(DEFAULT_RESPONSE_TEXT)) echo DEFAULT_RESPONSE_TEXT; ?></textarea>
                        </span>
                    </div>
                    <div class="form-group has-feedback">
                        <span class="col-md-10 col-md-offset-2">
                            <input class="btn btn-primary submit" type="submit" name="submit_response" value="Submit" />
                        </span>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
        
</div>
</div>
