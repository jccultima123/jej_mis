<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-default" href="<?php echo URL; ?>som/orders">Cancel</a>
            </div>
            <h4 class="modal-title" id="myModalLabel">Add Transaction</h4><br />
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="modal-body">
            <form action="<?php echo URL; ?>som/orderAction" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-md-2">Add as</label>
                        <div class="col-md-3">
                            <input class="form-control input-sm" value="<?php echo $_SESSION['first_name'] . '&nbsp;' . $_SESSION['last_name'] ?>" disabled>
                            <input type="text" name="added_by" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                        </div>
                        <label class="col-md-1 control-label">From</label>
                        <div class="col-md-5">
                            <input class="form-control input-sm" id="disabledInput" placeholder="<?php echo $_SESSION['branch'] ?>" disabled>
                            <input type="text" name="order_branch" value="<?php echo $_SESSION['branch_id'] ?>" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Select Product</label>
                        <div class="col-md-9">
                            <select class="form-control selectpicker" id="select" name="product_id" required="true" data-live-search="true" data-size="5">
                                <option disabled selected hidden>Manufacturer / Product / Model No.</option>
                                <?php foreach ($products as $p) { ?>
                                    <option class="option" value="<?php echo $p->product_id; ?>"><?php echo $p->manufacturer_name . ' / ' . $p->product_name . ' / ' . $p->product_model; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-2">
                            <div class="input-group">
                                <span class="input-group-addon">Stocks Needed</span>
                                <input type="number" class="form-control input-sm" name="stocks" value="" placeholder="0" min="1" max="999" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <input class="btn btn-primary btn-block" type="submit" name="add_order-ex_supp" value="Add" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Remarks / Description</label>
                        <div class="col-md-6">
                            <textarea class="form-control" rows="4" cols="50" name="comments"></textarea>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>