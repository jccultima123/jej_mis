<div class="row-fluid" id="login_dialog">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="sys_logo">
                <img src="<?php echo URL . 'img/logo.jpg'; ?>" style="width: 100%;"/>
            </div><br />
            <a id="load" href="<?php echo URL; ?>development"><b class="mobilizer_logo"><?php echo file_get_contents(URL . 'mis_version'); ?></b></a><br />
        </div>
        <form action="<?php echo URL; ?>admin/loginuser" method="post" autocomplete="on">
            <div class="panel-body" id="login-body">
                <?php $this->renderFeedbackMessages(); ?>
                <h5>ADMINISTRATOR MODULE</h5>
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