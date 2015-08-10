<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <a type="button" class="btn btn-primary pull-right" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Close</a>
            <h4 class="modal-title">Order Detail #<?php echo $details->order_id; ?></h4>
        </div>
        <div class="modal-body">
            <div class="table">
                <div class="row">
                    <label class="col-md-4 control-label">Description</label>
                    <span class="col-md-8">
                        <?php echo $details->stocks . ' stocks of ' . $details->brand . ' ' . $details->product_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label">Costs</label>
                    <span class="col-md-8">
                        <?php echo 'PhP ' . number_format($details->SRP); ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label">Branch</label>
                    <span class="col-md-8">
                        <?php echo $details->branch_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label">Added by</label>
                    <span class="col-md-8">
                        <?php echo $details->user_name . ' - ' . date(DATE_CUSTOM, $details->order_date); ?>
                    </span>
                </div>
                <?php if (!empty($details->comments)) { ?>
                    <div class="row">
                        <label class="col-md-4 control-label">Remarks</label>
                        <span class="col-md-8">
                            <?php echo $details->comments; ?>
                        </span>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="modal-footer">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-primary" href="<?php echo URL . 'som/orders?edit=' . htmlspecialchars($details->order_id, ENT_QUOTES, 'UTF-8'); ?>">Edit</a>
            </div>
        </div>
    </div>
        
</div>
</div>
