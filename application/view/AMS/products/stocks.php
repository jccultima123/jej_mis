<div class="modal-dialog">
    <div class="modal-content no-shadow">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-primary" href="<?php echo URL; ?>AMS/inventory">Close</a>
            </div>
            <h4 class="modal-title" id="myModalLabel">Manage Stocks for #<?php echo $details->product_id; ?></h4><br />
            <?php $this->renderFeedbackMessages(); ?>
        </div>

        <div class="modal-body">
            <div class="alert">
                CURRENT COUNT: <strong><?php echo $details->inventory_count; ?> Stocks for this item.</strong>
            </div>
            <form action="<?php echo URL; ?>AMS/productAction" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Maintenance</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <span class="input-group-addon">Fill</span>
                                <input type="number" class="form-control" name="fill" placeholder="0" max="999999" />
                                <span class="input-group-addon">stocks</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input class="btn btn-primary" type="submit" name="fill_stocks" value="GO" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-7 col-md-offset-3">
                            <div class="input-group">
                                <span class="input-group-addon">Decrease</span>
                                <input type="number" class="form-control" name="decrease" placeholder="0" max="999999" />
                                <span class="input-group-addon">stocks</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input class="btn btn-primary" type="submit" name="decrease_stocks" value="GO" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-7 col-md-offset-3">
                            <div class="input-group">
                                <span class="input-group-addon">Replace into</span>
                                <input type="number" class="form-control" name="stocks" placeholder="0" max="999999" value="<?php echo $details->inventory_count; ?>" />
                                <span class="input-group-addon">stocks</span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input class="btn btn-primary" type="submit" name="modify_stocks" value="GO" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-5 col-md-offset-3">
                            <p class="form-control-static">I want to empty these stocks</p>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="product_id" value="<?php echo $details->product_id; ?>">
                            <input class="btn btn-primary" type="submit" name="empty_stocks" value="Continue" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>
</div>