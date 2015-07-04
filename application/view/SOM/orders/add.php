<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-default" href="<?php echo URL; ?>som/orders?page=1">Cancel</a>
            </div>
            <h4 class="modal-title" id="myModalLabel">Add Transaction</h4><br />
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="modal-body">
            <form action="<?php echo URL; ?>som/orderAction" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-md-2">Select Supplier</label>
                        <div class="col-md-4">
                            <select class="form-control selectpicker" id="select" name="supplier" required="true" data-live-search="true" data-size="5">
                                <option disabled selected hidden>Nothing Selected</option>
                                <?php foreach ($suppliers as $s) { ?>
                                    <option title="<?php echo $s->supplier_name; ?>" class="option" value="<?php echo $s->supplier_id; ?>"><?php echo $s->supplier_name . ', ' . $s->address; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
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
                        <label class="control-label col-md-2">SRP</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon">PhP</span>
                                <input type="number" class="form-control input-sm" name="srp" placeholder="0" min="1" max="999999" required />
                            </div>
                        </div>
                        <label class="control-label col-md-1">Stocks Needed</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon">x</span>
                                <input type="number" class="form-control input-sm" name="stocks" value="<?php echo htmlspecialchars($records->qty, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" min="1" max="999" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input class="btn btn-primary btn-block" type="submit" name="add_order-ex_supp" value="Add" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Remarks</label>
                        <div class="col-md-2">
                            <textarea rows="4" cols="50" name="comments"></textarea>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>