<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <a id="form_submit" type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>admin/som">Cancel</a>
            <h4 class="modal-title">Edit</h4>
            <?php if (!isset($sales->category)) { ?>
                <?php echo '<div class="alert alert-success alert-dismissible" role="alert">' . CRUD_MISSING_ITEM . '</div>' ?>
                <br /><br />
            <?php } ?>
        </div>
        <div class="modal-body">
            <form action="<?php echo URL; ?>admin/salesAction" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>  
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Category</label>
                        <div class="col-lg-9">
                            <select class="form-control selectpicker" id="select" name="category" required="true">
                                <option disabled selected hidden value="">Please select...</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option class="option" value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="myselect" value="myselectedvalue" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">SKU</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="SKU" value="<?php echo htmlspecialchars($sales->SKU, ENT_QUOTES, 'UTF-8'); ?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Manufacturer</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="manufacturer_name" value="<?php echo htmlspecialchars($sales->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Product Name</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="product_name" value="<?php echo htmlspecialchars($sales->product_name, ENT_QUOTES, 'UTF-8'); ?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Product Model</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="product_model" value="<?php echo htmlspecialchars($sales->product_model, ENT_QUOTES, 'UTF-8'); ?>" placeholder="e.g. Model No. of Device" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Price</label>
                        <div class="col-lg-9">
                            <div class="input-group">
                                <span class="input-group-addon">PhP</span>
                                <input type="number" class="form-control" name="price" value="<?php echo htmlspecialchars($sales->price, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" min="1" max="999999" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Link</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="link" <?php echo htmlspecialchars($sales->link, ENT_QUOTES, 'UTF-8'); ?>" placeholder="http://" />
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($sales->sales_id, ENT_QUOTES, 'UTF-8'); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <input id="form_submit" class="btn btn-primary" type="submit" name="update_sales" value="Save Changes" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer"></div>
    </div>


</div>