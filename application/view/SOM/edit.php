<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <a id="form_submit" type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>som?page=1">Cancel</a>
            <h4 class="modal-title">Edit</h4>
        </div>
        <div class="modal-body">
            <?php $this->renderFeedbackMessages(); ?>
            <form action="<?php echo URL; ?>som/action" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Modify as</label>
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
                        <label class="col-lg-3 control-label">Category</label>
                        <div class="col-lg-4">
                            <select class="form-control selectpicker" id="select" name="category" required="true">
                                <?php foreach ($categories as $category) { ?>
                                    <?php if ($category->id == $records->category) { ?>
                                        <option class="option" selected value="<?php echo $records->category; ?>"><?php echo $category->name; ?></option>
                                    <?php } if ($category->id != $records->category) { ?>
                                        <option class="option" value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="col-lg-1 control-label">Status</label>
                        <div class="col-lg-4">
                            <select class="form-control selectpicker" id="select" name="status_id" required="true">
                                <?php foreach ($status as $st) { ?>
                                    <?php if ($st->id == $records->status_id) { ?>
                                        <option class="option" selected value="<?php echo $records->status_id; ?>"><?php echo $st->status; ?></option>
                                    <?php } if ($st->id != $records->status_id) { ?>
                                        <option class="option" value="<?php echo $st->id; ?>"><?php echo $st->status; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Manufacturer</label>
                        <div class="col-lg-9">
                            <select class="form-control selectpicker" id="select" name="manufacturer" required="true">
                                <?php foreach ($manu as $m) { ?>
                                    <?php if ($m->id == $records->manufacturer) { ?>
                                        <option class="option" selected value="<?php echo $records->manufacturer; ?>"><?php echo $m->manu_name; ?></option>
                                    <?php } if ($m->id != $records->manufacturer) { ?>
                                        <option class="option" value="<?php echo $m->id; ?>"><?php echo $m->manu_name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Product Name</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control required" name="product_name" value="<?php echo htmlspecialchars($records->product_name, ENT_QUOTES, 'UTF-8'); ?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Product Model</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control required" name="product_model" value="<?php echo htmlspecialchars($records->product_model, ENT_QUOTES, 'UTF-8'); ?>" placeholder="e.g. Model No. of Device" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">IMEI</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control required" name="IMEI" value="<?php echo htmlspecialchars($records->IMEI, ENT_QUOTES, 'UTF-8'); ?>" required="true">
                        </div>
                        <label class="col-lg-1 control-label">Qty.</label>
                        <div class="col-lg-1">
                            <div class="input-group">
                                <span class="input-group-addon">x</span>
                                    <input type="number" class="form-control required" name="qty" value="<?php echo htmlspecialchars($records->qty, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" min="1" max="999" />
                            </div>
                        </div>
                        <label class="col-lg-1 control-label">Price</label>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <span class="input-group-addon">PhP</span>
                                <input type="number" class="form-control required" name="price" value="<?php echo htmlspecialchars($records->price, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" min="1" max="999999" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <input type="text" name="sales_id" value="<?php echo htmlspecialchars($records->sales_id, ENT_QUOTES, 'UTF-8'); ?>" hidden />
                            <input id="form_submit" class="btn btn-primary" type="submit" name="update_record" value="Save Changes" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer"></div>
    </div>


</div>