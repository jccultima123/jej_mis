<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Order Request #<?php echo $details->order_id; ?></h4>
        </div>
        <div class="modal-body">
            <div class="table">
                <h4>DETAILS</h4>
                <div class="row">
                    <label class="col-md-4 control-label">Description</label>
                    <span class="col-md-8">
                        <?php echo $details->stocks . ' stocks of ' . $details->brand . ' ' . $details->product_name . ' - Model No: ' . $details->product_model; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label">Designated JEJ Branch</label>
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
            <form action="<?php echo URL; ?>admin/orderAction" method="POST">
                <fieldset>
                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($details->order_id, ENT_QUOTES, 'UTF-8'); ?>" />
                    <input type="hidden" name="category" value="<?php echo htmlspecialchars($details->category, ENT_QUOTES, 'UTF-8'); ?>" />
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($details->product_id, ENT_QUOTES, 'UTF-8'); ?>" />
                    <input type="hidden" name="stocks" value="<?php echo htmlspecialchars($details->stocks, ENT_QUOTES, 'UTF-8'); ?>" />
                    <div class="form-group">
                        <div class="btn-group">
                            <input class="btn btn-success" type="submit" name="accept_request" value="ACCEPT" />
                            <input class="btn btn-danger" type="submit" name="reject_request" value="REJECT" />
                            <a href="<?php echo URL . 'som/orders?page=1'; ?>" class="btn btn-danger">NOT NOW</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

