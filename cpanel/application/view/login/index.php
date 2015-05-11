<div class="row" id="login_dialog">
    <div class="center-block">
            <b style="font-size: 28px;">JEJ // <span class="mobilizer_logo">MOBILIZER</span></b>
            <?php $this->renderFeedbackMessages(); ?>
            <h5>Admin Panel <?php echo file_get_contents(URL .'version'); ?></h5>
            <form action="<?php echo URL; ?>login/login" method="post" autocomplete="on">
                <input type="text" name="user_name" class="form-control" placeholder="Username or Email" /><br />
                <input type="password" name="user_password" class="form-control" placeholder="Password" /><br />&nbsp;
                <input type="checkbox" name="user_rememberme" class="remember-me-checkbox" />
                <label class="remember-me-label" style="font-weight: normal;">Keep me logged in (14 Days)</label><hr />
                <input type="submit" name="submit" class="btn btn-default" value="LOGIN" id="page_loader_submit" />
            </form><br />
    </div>
</div>

