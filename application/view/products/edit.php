<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-primary" href="<?php echo URL; ?>admin/productlist">Cancel</a>
            </div>
            <h4 class="modal-title" id="myModalLabel">Add Product</h4><br />
            <?php $this->renderFeedbackMessages(); ?>
        </div>

        <div class="modal-body">
            <form action="<?php echo URL; ?>admin/productAction" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Add as</label>
                        <div class="col-md-9">
                            <input class="form-control input-sm" value="<?php echo $_SESSION['first_name'] . '&nbsp;' . $_SESSION['last_name'] ?>" disabled>
                            <input type="text" name="added_by" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category</label>
                        <div class="col-md-9">
                            <select data-container="body" class="form-control selectpicker" id="select" name="category" required="true">
                                <option disabled selected hidden value="">Please select...</option>
                                <?php foreach ($categories as $category) { ?>
                                    <?php if ($category->cat_id == $details->category) { ?>
                                        <option class="option" <?php echo 'selected'; ?> value="<?php echo $details->category; ?>"><?php echo $category->name; ?></option>
                                    <?php } if ($category->cat_id != $details->category) { ?>
                                        <option class="option" value="<?php echo $category->cat_id; ?>"><?php echo $category->name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Manufacturer</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control uppercase" value="<?php echo $details->brand; ?>" name="brand" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Product Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control uppercase" value="<?php echo $details->product_name; ?>" name="product_name" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Product Model</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control uppercase" value="<?php echo $details->product_model; ?>" name="product_model" placeholder="e.g. Model No. of Device" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-9">
                            <textarea rows="5" class="form-control uppercase" name="description"><?php echo $details->description; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">SRP</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-addon">PhP</span>
                                <input type="number" class="form-control uppercase" name="SRP" value="<?php echo $details->SRP; ?>" placeholder="0" min="1" max="999999" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input class="btn btn-primary" type="submit" name="update_product" value="Update" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>
</div>