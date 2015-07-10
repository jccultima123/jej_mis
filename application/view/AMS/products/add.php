<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-primary" href="<?php echo URL; ?>AMS/products?page=1">Cancel</a>
            </div>
            <h4 class="modal-title" id="myModalLabel">Add Item</h4><br />
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        
        <div class="modal-body">
            <form action="<?php echo URL; ?>products/add" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Add as</label>
                        <div class="col-md-9">
                            <input class="form-control input-sm" value="<?php echo $_SESSION['first_name'] . '&nbsp;' . $_SESSION['last_name'] ?>" disabled>
                            <input type="text" name="user" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">From</label>
                        <div class="col-md-9">
                            <input class="form-control input-sm" id="disabledInput" placeholder="<?php echo $_SESSION['branch'] ?>" disabled>
                            <input type="text" name="branch" value="<?php echo $_SESSION['branch_id'] ?>" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category</label>
                        <div class="col-md-9">
                            <select class="form-control selectpicker" id="select" name="category" required="true">
                                <option disabled selected hidden value="">Please select...</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option class="option" value="<?php echo $category->cat_id; ?>"><?php echo $category->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control selectpicker" id="select" name="category" required="true">
                            <option disabled selected hidden value="">Please select...</option>
                            <?php foreach ($categories as $category) { ?>
                                <option class="option" value="<?php echo $category->cat_id; ?>"><?php echo $category->name; ?></option>
                            <?php } ?>
                        </select>
                        <label class="col-md-3 control-label">IMEI</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="IMEI" required="true">
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
                                <input type="number" class="form-control" name="SRP" placeholder="0" min="1" max="999999" />
                            </div>
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

    </div>
</div>