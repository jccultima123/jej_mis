<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-primary" href="<?php echo URL . 'admin/deletesales/' . htmlspecialchars($sales->sales_id, ENT_QUOTES, 'UTF-8'); ?>">Delete</a>
                <a type="button" class="btn btn-primary" href="<?php echo URL . 'admin/editsales/' . htmlspecialchars($sales->sales_id, ENT_QUOTES, 'UTF-8'); ?>">Edit</a>
                <a type="button" class="btn btn-primary" href="<?php echo URL; ?>admin/som">Close</a>
            </div>
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
                        <?php echo $sales->category; ?>
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
                    <label class="col-xs-4 control-label">Prize</label>
                    <span class="col-xs-8">
                        <?php echo $sales->price; ?>
                    </span>
                </div>
                </div>
            </div>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>
