<div class="row-fluid animated bounceInDown" id="login_dialog">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b style="font-size: 28px;">JEJ // <span class="mobilizer_logo">MOBILIZER</span></b><br />
            Admin Module <?php echo file_get_contents(URL . 'version'); ?>
        </div>
        <form action="<?php echo URL; ?>login/login" method="post" autocomplete="on">
            <div class="panel-body" id="login-body">
                <?php $this->renderFeedbackMessages(); ?>
                <input type="text" name="user_name" class="form-control" placeholder="Username or Email" /><br />
                <div class="input-group">
                    <input type="password" name="user_password" class="form-control" placeholder="Password" /><br />
                    <span class="input-group-btn">
                        <input type="submit" name="submit" class="btn btn-default" value="LOGIN" id="page_loader_submit" />
                    </span>
                </div><br />
                <input type="checkbox" name="user_rememberme" class="remember-me-checkbox" />
                <label class="remember-me-label" style="font-weight: normal;">Keep me logged in (Unstable)</label>
            </div>
            <div class="panel-footer">
                (C) JEJ CELLMANIA TRADING CORP.
            </div>
        </form>
    </div>
</div>