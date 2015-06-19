<div class="container">
    <div class="modal-dialog animated fadeInDown">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-group pull-right">
                    <a type="button" class="btn btn-danger" href="<?php echo URL; ?>">Cancel (No Returning Back!)</a>
                </div>
                <h4 class="modal-title">Change your Password</h4><br />
                <div class="alert alert-info" role="alert">
                    Please note: using a long sentence as a password is much much safer then something like "!c00lPa$$w0rd"). Have a look on
                    <a target="_blank" href="http://security.stackexchange.com/questions/6095/xkcd-936-short-complex-password-or-long-dictionary-passphrase">this interesting security.stackoverflow.com thread</a>.
                </div>
            </div>
            <div class="modal-body">
                <?php $this->renderFeedbackMessages(); ?>
                <form action="<?php echo URL; ?>passwordAction/passAction" method="POST" onsubmit="return checkForm(this);" style="padding: 10px;" class="form-horizontal">
                    <fieldset>
                        <input type='hidden' name='user_name' value='<?php echo $this->user_name; ?>' />
                        <input type='hidden' name='user_password_reset_hash' value='<?php echo $this->user_password_reset_hash; ?>' />
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Your New Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control input-sm password required" name="reset_input_password" pattern=".{5,}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Repeat New Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control input-sm password-repeat required" name="reset_input_password_repeat" pattern=".{5,}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <input class="btn btn-primary" type="submit" name="submit_new_password" value="Submit" />
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

