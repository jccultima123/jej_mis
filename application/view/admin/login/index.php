<div class="row-fluid" id="login_dialog">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b style="font-size: 28px;">JEJ // <span class="mobilizer_logo">MOBILIZER</span></b><br />
            Admin Module <?php echo file_get_contents(URL . 'version'); ?>
        </div>
        <form action="<?php echo URL; ?>admin/loginuser" method="post" autocomplete="on">
            <div class="panel-body" id="login-body">
                <?php $this->renderFeedbackMessages(); ?>
                <div class="form-group has-feedback">
                    <input type="text" name="user_name" class="form-control username-email5" placeholder="Username or Email" />
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="user_password" class="form-control admin-password" placeholder="Password" />
                </div>
                <div class="checkbox">
                    <label data-toggle="tooltip" data-placement="top" title="This function will lasts in 14 days but still unstable for now.">
                        <input type="checkbox" name="user_rememberme" />
                        Remember Me?
                    </label>
                </div>
                <input type="submit" name="submit" class="btn btn-primary submit" value="LOGIN" id="page_loader_submit" />
                <a id="logout" href="<?php echo URL; ?>" class="btn btn-primary">&larr; Go back</a>
            </div>
            <div class="panel-footer">
                (C) JEJ CELLMANIA TRADING CORP.
            </div>
        </form>
    </div>
</div>