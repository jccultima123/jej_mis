<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <a type="button" class="btn btn-primary pull-right" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Close</a>
            <h4 class="modal-title">Sales Detail #<?php echo $details->sales_id; ?></h4>
        </div>
        <div class="modal-body">
            <div class="table">
                <div class="row">
                    <label class="col-xs-4 control-label">Customer</label>
                    <span class="col-xs-8">
                        <?php echo $details->first_name . ' ' . substr($details->middle_name, 0, 1) . '. ' . $details->last_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Description</label>
                    <span class="col-xs-8">
                        <?php echo $details->qty . ' piece/s of ' . $details->brand . ' ' . $details->product_name . ' - Model No: ' . $details->product_model; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">IMEI</label>
                    <span class="col-xs-8">
                        <?php echo $details->IMEI; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Manufacturer</label>
                    <span class="col-xs-8">
                        <?php echo $details->brand; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Product Name</label>
                    <span class="col-xs-8">
                        <?php echo $details->product_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Product Model</label>
                    <span class="col-xs-8">
                        <?php echo $details->product_model; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Quantity</label>
                    <span class="col-xs-8">
                        <?php echo $details->qty; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Price</label>
                    <span class="col-xs-8">
                        <?php echo $details->price; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Created</label>
                    <span class="col-xs-8">
                        <?php echo date(DATE_CUSTOM, $details->created); ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Added by</label>
                    <span class="col-xs-8">
                        <?php echo $details->user_name . ' (#' . $details->added_by . ')'; ?>
                    </span>
                    <span class="col-xs-8 col-xs-offset-4">
                        <?php echo $details->branch_name; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            
        </div>
    </div>
        
</div>
</div>
