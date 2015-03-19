<div class="container">
    <h2>Login</h2>
    <p>
        Your account must be registered.<br />
        If you are new here, please contact your Administrator to register.
    </p>
    <form action="<?php echo URL; ?>" method="post" autocomplete="on">
        <h4>Username</h4>
        <input type="text" name="user_name" placeholder="" /><br />
        <h4>Password</h4>
        <input type="password" name="user_password" placeholder="" /><br /><br />
        <input type="submit" value="LOGIN" />
    </form><br />
    <a href="<?php echo URL; ?>" class="back">&larr; Go Back</a>
</div>
