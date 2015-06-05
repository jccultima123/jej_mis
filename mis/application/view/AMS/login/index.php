<div class="container-fluid">
    
    <div class="modal fade registration" tabindex="-1" role="dialog" aria-labelledby="REG_DETAILS" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>ams">Cancel</a>
                    <h4 class="modal-title" id="REG_DETAILS">Registration Details</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo URL; ?>products/add" method="POST" style="padding: 10px;" class="form-horizontal">
                        <fieldset>  
                            <div class="form-group">
                                <label class="col-md-3 control-label">Category</label>
                                <div class="col-md-9">
                                    <select class="form-control selectpicker" id="select" name="category" required="true">
                                        <option disabled selected hidden value="">Please select...</option>
                                        <?php foreach ($categories as $category) { ?>
                                            <option class="option" value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">SKU</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="SKU" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Manufacturer</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="manufacturer_name" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Product Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="product_name" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Product Model</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="product_model" placeholder="e.g. Model No. of Device" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Price</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">PhP</span>
                                        <input type="number" class="form-control" name="price" placeholder="0" min="1" max="999999" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Link</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="link" placeholder="http://" />
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($products->product_id, ENT_QUOTES, 'UTF-8'); ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <input class="btn btn-primary" type="submit" name="submit_add_product" value="Add" />
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    
    <div class="row-fluid" id="login_dialog" style="width: auto;">
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
                            <span class="pull-right">New User? You can send Registration Request
                            <a data-toggle="modal" data-target=".registration" href="#"><u>here</u>.</a></span>
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