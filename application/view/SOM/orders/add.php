<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-default" href="<?php echo URL; ?>SOM/orders">Cancel</a>
            </div>
            <h4 class="modal-title" id="myModalLabel">Add Transaction</h4><br />
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="modal-body">
            <form action="<?php echo URL; ?>SOM/orderAction" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-md-2">Add as</label>
                        <div class="col-md-4">
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
                        <label class="control-label col-md-2">Select Item</label>
                        <div class="col-md-10">
                            <select data-container="body" data-container="body" class="form-control selectpicker" id="select" name="product_id" required="true" data-live-search="true" data-size="5">
                                <option disabled selected hidden>Brand / Product</option>
                                <?php foreach ($products as $p) { ?>
                                    <option class="option" value="<?php echo $p->product_id; ?>"><?php echo $p->brand . ' / ' . $p->product_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                            <div class="input-group">
                                <span class="input-group-addon">Stocks Needed</span>
                                <input type="number" class="form-control input-sm" name="stocks" value="" placeholder="0" min="1" max="999" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">Suggested Retail Price</span>
                                <input type="number" class="form-control input-sm" name="SRP" value="" placeholder="0" min="1" max="9999999" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Remarks / Description</label>
                        <div class="col-md-10">
                            <textarea class="form-control" rows="4" cols="50" name="comments"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <input class="btn btn-primary btn-block" type="submit" name="add_order" value="Add" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>