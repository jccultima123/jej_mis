<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-danger" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Close</a>
            </div>
            <h4 class="modal-title">Product Detail #<?php echo $details->product_id; ?></h4>
        </div>
        <div class="modal-body">
            <div class="table">
                <div class="row">
                    <label class="col-xs-4 control-label">Brand</label>
                    <span class="col-xs-8">
                        <?php echo $details->manufacturer_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Product Info.</label>
                    <span class="col-xs-8">
                        <?php echo $details->product_name . ' ' . '(' . $details->product_model . ')'; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Category</label>
                    <span class="col-xs-8">
                        <?php echo $details->name; ?>
                    </span>
                </div>
                <?php if (isset($details->description)) { ?>
                    <div class="row">
                        <label class="col-xs-4 control-label">Description</label>
                        <span class="col-xs-8">
                            <?php echo $details->description; ?>
                        </span>
                    </div>
                <?php } ?>
                <div class="row">
                    <label class="col-xs-4 control-label">SRP</label>
                    <span class="col-xs-8">
                        <?php echo '₱' . number_format($details->SRP); ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Status</label>
                    <span class="col-xs-8">
                        <?php echo $details->status; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Latest Modified</label>
                    <span class="col-xs-8">
                        <?php echo date(DATE_CUSTOM, $details->timestamp); ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Added by</label>
                    <span class="col-xs-8">
                        <?php echo $details->user_name . ' (#' . $details->added_by . ')'; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

