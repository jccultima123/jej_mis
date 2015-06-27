<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <a id="form_submit" type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>som/sales">Cancel</a>
            <h4 class="modal-title">Edit</h4>
        </div>
        <div class="modal-body">
            <?php $this->renderFeedbackMessages(); ?>
            <form action="<?php echo URL; ?>som/salesAction" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Category</label>
                        <div class="col-lg-4">
                            <select class="form-control selectpicker" id="select" name="category" required="true">
                                <?php foreach ($categories as $category) { ?>
                                    <?php if ($category->id == $sales->category) { ?>
                                        <option class="option" selected value="<?php echo $sales->category; ?>"><?php echo $category->name; ?></option>
                                    <?php } if ($category->id != $sales->category) { ?>
                                        <option class="option" value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="col-lg-1 control-label">Status</label>
                        <div class="col-lg-4">
                            <select class="form-control selectpicker" id="select" name="status_id" required="true">
                                <?php foreach ($status as $st) { ?>
                                    <?php if ($st->id == $sales->status_id) { ?>
                                        <option class="option" selected value="<?php echo $sales->status_id; ?>"><?php echo $st->status; ?></option>
                                    <?php } if ($st->id != $sales->status_id) { ?>
                                        <option class="option" value="<?php echo $st->id; ?>"><?php echo $st->status; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">SKU</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control required" name="SKU" value="<?php echo htmlspecialchars($sales->SKU, ENT_QUOTES, 'UTF-8'); ?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Manufacturer</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control required" name="manufacturer_name" value="<?php echo htmlspecialchars($sales->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Product Name</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control required" name="product_name" value="<?php echo htmlspecialchars($sales->product_name, ENT_QUOTES, 'UTF-8'); ?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Product Model</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control required" name="product_model" value="<?php echo htmlspecialchars($sales->product_model, ENT_QUOTES, 'UTF-8'); ?>" placeholder="e.g. Model No. of Device" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Price</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-addon">PhP</span>
                                <input type="number" class="form-control required" name="price" value="<?php echo htmlspecialchars($sales->price, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" min="1" max="999999" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <input type="hidden" name="sales_id" value="<?php echo htmlspecialchars($sales->sales_id, ENT_QUOTES, 'UTF-8'); ?>" />
                            <input id="form_submit" class="btn btn-primary" type="submit" name="update_sales" value="Save Changes" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer"></div>
    </div>


</div>