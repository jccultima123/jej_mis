<div class="row-fluid" id="login_dialog">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b style="font-size: 28px;">JEJ /// <span class="mobilizer_logo pull-right">MOBILIZER</span></b><br />
            Admin Module <?php echo file_get_contents(URL . 'version'); ?>
        </div>
        <form action="<?php echo URL; ?>admin/loginuser" method="post" autocomplete="on">
            <div class="panel-body" id="login-body">
                <?php $this->renderFeedbackMessages(); ?>
                <input type="text" name="user_name" class="form-control" placeholder="Username or Email" /><br />
                <div class="input-group">
                    <input type="password" name="user_password" class="form-control" placeholder="Password" /><br />
                    <span class="input-group-btn">
                        <input type="submit" name="submit" class="btn btn-default" value="LOGIN" id="page_loader_submit" />
                    </span>
                </div><br />
                <div class="checkbox">
                    <label data-toggle="tooltip" data-placement="bottom" title="This function will lasts in 14 days but still unstable for now.">
                        <input type="checkbox" name="user_rememberme" class="remember-me-checkbox" />
                        Remember Me?
                    </label>
                </div>
            </div>
            <div class="panel-footer">
                (C) JEJ CELLMANIA TRADING CORP.
            </div>
        </form>
    </div>
</div>