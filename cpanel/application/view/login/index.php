<div class="row-fluid" id="login_dialog">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b style="font-size: 28px;">JEJ // <span class="mobilizer_logo">MOBILIZER</span></b><br />
            (C) JEJ CELLMANIA TRADING CORP.
            Admin Module <?php echo file_get_contents(URL . 'version'); ?>
        </div>
        <form action="<?php echo URL; ?>login/login" method="post" autocomplete="on">
            <div class="panel-body" id="login-body">
                <!--
                <div id="page_loader_2" style="display: none;">
                    <img src="<?php echo URL; ?>img/preloader.gif" />
                </div>
                -->
                <?php $this->renderFeedbackMessages(); ?>
                <input type="text" name="user_name" class="form-control" placeholder="Username or Email" /><br />
                <input type="password" name="user_password" class="form-control" placeholder="Password" /><br />&nbsp;
                <input type="checkbox" name="user_rememberme" class="remember-me-checkbox" />
                <label class="remember-me-label" style="font-weight: normal;">Keep me logged in (14 Days)</label>
            </div>
            <div class="panel-footer">
                <input type="submit" name="submit" class="btn btn-default" value="LOGIN" id="page_loader_submit" />
            </div>
        </form>
    </div>
</div>