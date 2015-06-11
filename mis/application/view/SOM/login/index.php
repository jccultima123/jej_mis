<div class="container-fluid">
    <div class="row-fluid" id="login_dialog" style="width: auto;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b style="font-size: 28px;">JEJ // <span class="mobilizer_logo">MOBILIZER</span></b><br />
                <strong>Sales and Order Management Module</strong>
            </div>
            <div class="panel-body" style="padding: 0; padding-top: 20px;">
                <div class="col-sm-4">
                    <form action="<?php echo URL; ?>som/loginuser" method="post" autocomplete="on">
                        <div class="panel-body" id="login-body">
                            <input type="text" name="user_name" class="form-control input-sm" placeholder="Username or Email" /><br />
                            <select class="form-control selectpicker" id="select" name="user_provider_type" required="true">
                                <option disabled selected hidden>Please Select your type..</option>
                                <option value="SALES">Sales Management</option>
                                <option value="ORDER">Order Management</option>
                            </select>
                            <input type="hidden" name="myselect" value="myselectedvalue" /><br /><br />
                            <div class="input-group">
                                <input type="password" name="user_password" class="form-control input-sm" placeholder="Password" /><br />
                                <span class="input-group-btn">
                                    <input type="submit" name="submit" class="btn btn-default" value="LOGIN" id="page_loader_submit" />
                                </span>
                            </div><br />
                            <div class="btn-group">
                                <a id="logout" type="button" class="btn btn-default" href="<?php echo URL . 'passwordAction/forgot'?>">I forgot my password..</a>
                            </div>
                            <br />
                        </div>
                    </form>
                </div>
                <div class="col-sm-8">
                    <?php $this->renderFeedbackMessages(); ?>
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <strong>WELCOME</strong>
                            <span class="pull-right">New User? You can send Registration Request
                                <a id="logout" href="<?php echo URL; ?>som/registration"><u>here</u>.</a></span>
                        </div>
                        <div class="panel-body">
                            <p>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IN THIS MODULE,
                            <ul>
                                <li>Can manage Sales</li>
                                <li>Can manage Orders</li>
                                <li>Both sub-modules requires separated accounts.</li>
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