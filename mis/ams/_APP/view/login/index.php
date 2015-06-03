<!-- Redirectable Dialog -->
<div class="modal fade" id="linkdialog" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid" id="login_dialog">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b style="font-size: 28px;">JEJ // <span class="mobilizer_logo">MOBILIZER</span></b><br />
                <strong>Asset Management Module</strong>
            </div>
            <div class="panel-body" style="padding: 0; padding-top: 20px;">
                <div class="col-sm-4">
                    <form action="<?php echo URL; ?>login/login" method="post" autocomplete="on">
                        <div class="panel-body" id="login-body">
                            <input type="text" name="user_name" class="form-control" placeholder="Username or Email" /><br />
                            <div class="input-group">
                                <input type="password" name="user_password" class="form-control" placeholder="Password" /><br />
                                <span class="input-group-btn">
                                    <input type="submit" name="submit" class="btn btn-default" value="LOGIN" id="page_loader_submit" />
                                </span>
                            </div><br />
                            <div class="checkbox">
                                <label data-toggle="tooltip" data-placement="right" title="This function will lasts in 14 days but still unstable for now.">
                                    <input type="checkbox" name="user_rememberme" class="remember-me-checkbox" />
                                    Remember Me?
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-8">
                    <?php $this->renderFeedbackMessages(); ?>
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <strong>WELCOME</strong>
                            <span class="pull-right">New User? You can send Registration Request <a data-toggle="modal" data-target="#linkdialog" href="javascript:void(0)" onclick="href='<?php echo URL; ?>register'"><u>here</u>.</a></span>
                        </div>
                        <div class="panel-body">
                            <p>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IN THIS MODULE,
                                <ul>
                                    <li>Can manage assets such as products owned, etc.</li>
                                    <li>Can manage requests.</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                (C) JEJ CELLMANIA TRADING CORP.
            </div>
        </div>
    </div>
</div>