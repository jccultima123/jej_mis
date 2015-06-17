<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <a type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>admin/som">Cancel</a>
            <h4 class="modal-title" id="myModalLabel">Add a Sales</h4>
        </div>
        <div class="modal-body">
            <form action="<?php echo URL; ?>admin/salesAction" method="POST" style="padding: 10px;" class="form-horizontal">
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
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($sales->product_id, ENT_QUOTES, 'UTF-8'); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input class="btn btn-primary" type="submit" name="add_product" value="Add" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>