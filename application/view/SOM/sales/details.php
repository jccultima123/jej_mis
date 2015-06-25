<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <a type="button" class="btn btn-primary pull-right" href="<?php echo URL; ?>som">Close</a>
            <h4 class="modal-title">Sale Details</h4>
        </div>
        <div class="modal-body">
            <div class="table">
                <h4>DETAILS</h4>
                <div class="row">
                    <label class="col-xs-4 control-label">Sales No.</label>
                    <span class="col-xs-8">
                        <?php echo $sales->sales_id; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Category</label>
                    <span class="col-xs-8">
                        <?php echo $sales->name ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">SKU</label>
                    <span class="col-xs-8">
                        <?php echo $sales->SKU; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Manufacturer</label>
                    <span class="col-xs-8">
                        <?php echo $sales->manufacturer_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Product Name</label>
                    <span class="col-xs-8">
                        <?php echo $sales->product_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Product Model</label>
                    <span class="col-xs-8">
                        <?php echo $sales->product_model; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Price</label>
                    <span class="col-xs-8">
                        <?php echo $sales->price; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Status</label>
                    <span class="col-xs-8">
                        <?php echo $sales->status; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Last Updated</label>
                    <span class="col-xs-8">
                        <?php echo date(DATE_CUSTOM, $sales->latest_timestamp); ?>
                    </span>
                </div>
                <div class="row">
                    <br />
                    <span class="col-xs-11 col-xs-offset-1">
                        <div class="btn-group pull-right">
                            <a type="button" class="btn btn-primary" href="<?php echo URL . 'som/deletesales/' . htmlspecialchars($sales->sales_id, ENT_QUOTES, 'UTF-8'); ?>">Delete</a>
                            <a type="button" class="btn btn-primary" href="<?php echo URL . 'som/editsales/' . htmlspecialchars($sales->sales_id, ENT_QUOTES, 'UTF-8'); ?>">Edit</a>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer"></div>
</div>
</div>
