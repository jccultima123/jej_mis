<div class="wrapper_login_dialog">
    <div style="width: 400px;" class="container">
        <span class="logo">MOBILIZER</span>
        <h2>Login</h2>
        <p>
            You must LOGIN first.<br />
            If you are new here, please contact your Administrator to register.
        </p>
        <?php $this->renderFeedbackMessages(); ?>
        <form action="<?php echo URL; ?>login/login" method="post" autocomplete="on">
            <h4>Username</h4>
            <input type="text" name="user_name" placeholder="" /><br />
            <h4>Password</h4>
            <input type="password" name="user_password" placeholder="" /><br /><br />
            <input type="checkbox" name="user_rememberme" class="remember-me-checkbox" />
            <label class="remember-me-label">Keep me logged in (for 2 weeks)</label><br /><br />
            <input type="submit" name="submit" value="LOGIN" />
        </form><br />Forgot your password? 
        <a href="<?php echo URL; ?>login/requestpasswordreset">Click Here.</a><br /><br />
        <div class="footer-nav-mobi">(C) JEJ CELLMANIA TRADING CORPORATION</div>
    </div>
</div>
<br />
