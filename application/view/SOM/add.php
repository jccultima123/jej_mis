<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <a type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>som?page=1">Cancel</a>
            <h4 class="modal-title" id="myModalLabel">Add</h4>
        </div>
        <div class="modal-body">
            <?php $this->renderFeedbackMessages(); ?>
            <form action="<?php echo URL; ?>som/action" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Add as</label>
                        <div class="col-md-3">
                            <input class="form-control" value="<?php echo $_SESSION['first_name'] . '&nbsp;' . $_SESSION['last_name'] ?>" disabled>
                            <input type="text" name="added_by" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                        </div>
                        <label class="col-md-1 control-label">From</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="disabledInput" placeholder="<?php echo $_SESSION['branch'] ?>" disabled>
                            <input type="text" name="branch" value="<?php echo $_SESSION['branch_id'] ?>" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category</label>
                        <div class="col-md-4">
                            <select class="form-control selectpicker" id="select" name="category" required="true">
                                <option disabled selected hidden value="">Please select...</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option class="option" value="<?php echo $category->cat_id; ?>"><?php echo $category->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="col-md-1 control-label">Status</label>
                        <div class="col-md-4">
                            <select class="form-control selectpicker" id="select" name="status_id" required="true">
                                <option disabled selected hidden value="">Please select...</option>
                                <?php foreach ($status as $st) { ?>
                                    <option class="option" value="<?php echo $st->id; ?>"><?php echo $st->status; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Manufacturer</label>
                        <div class="col-md-9">
                            <select class="form-control selectpicker" id="select" name="manufacturer" required="true">
                                <option disabled selected hidden value="">Please select...</option>
                                <?php foreach ($manu as $m) { ?>
                                    <option class="option" value="<?php echo $m->manu_id; ?>"><?php echo $m->manu_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Product Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control input-sm" name="product_name" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Product Model</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control input-sm" name="product_model" placeholder="e.g. Model No. of Device" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">IMEI</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" style="text-transform: uppercase;" name="IMEI" required="true">
                        </div>
                        <label class="col-lg-1 control-label">Qty.</label>
                        <div class="col-lg-2">
                            <div class="input-group">
                                <span class="input-group-addon">x</span>
                                    <input type="number" class="form-control input-sm" name="qty" value="<?php echo htmlspecialchars($records->qty, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" min="1" max="999" />
                            </div>
                        </div>
                        <label class="col-md-1 control-label">Price</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon">PhP</span>
                                <input type="number" class="form-control input-sm" name="price" placeholder="0" min="1" max="999999" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-3">
                            <input class="btn btn-primary btn-block" type="submit" name="add_record" value="Add" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>