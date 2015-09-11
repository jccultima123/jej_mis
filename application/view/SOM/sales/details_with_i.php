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
                        <?php echo $details->customer_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Description</label>
                    <span class="col-xs-8">
                        <?php echo $details->qty . ' piece/s of ' . $details->brand . ' ' . $details->product_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Manufacturer</label>
                    <span class="col-xs-8">
                        <?php echo $details->brand; ?>
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
                        <?php echo number_format($details->price); ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Amount Due</label>
                    <span class="col-xs-8">
                        <?php echo number_format($details->price * $details->qty); ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Latest Balance Remaining</label>
                    <span class="col-xs-8">
                        <?php echo number_format($details->remaining); ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Date</label>
                    <span class="col-xs-8">
                        <?php echo date(DATE_CUSTOM, $details->time); ?>
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
