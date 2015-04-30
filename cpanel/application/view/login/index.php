<div class="wrapper_login_dialog">
    <div class="container">
        <h1>JEJ // <span class="mobilizer_logo">MOBILIZER</span></h1>
        <h2>Login</h2>
        <?php $this->renderFeedbackMessages(); ?>
        <form action="<?php echo URL; ?>login/login" method="post" autocomplete="on">
            <input type="text" name="user_name" placeholder="Username or Email" /><br /><br />
            <input type="password" name="user_password" placeholder="Password" /><br /><br />
            <input type="checkbox" name="user_rememberme" class="remember-me-checkbox" />
            <label class="remember-me-label" onclick="javascript:alert(remember_warning)">Keep me logged in (Experimental)</label><br /><br />
            <input type="submit" name="submit" value="LOGIN" id="page_loader_submit" />
        </form><br />
        <div class="footer-nav-mobi">(C) JEJ CELLMANIA TRADING CORPORATION</div><br />
    </div>
</div>
<br />
