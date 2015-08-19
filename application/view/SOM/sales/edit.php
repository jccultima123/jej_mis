<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-default" href="<?php echo URL; ?>som/sales?page=1">Cancel</a>
            </div>
            <h4 class="modal-title" id="myModalLabel">Edit Sales #<?php echo $details->sales_id; ?></h4>
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="modal-body">
            <form action="<?php echo URL; ?>SOM/salesAction" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-md-2">Select Customer</label>
                        <div class="col-md-4">
                            <select data-container="body" class="form-control selectpicker" id="select" name="customer_id" required="true" data-live-search="true" data-size="5">
                                <?php foreach ($customers as $customer) { ?>
                                    <?php if ($customer->customer_id == $details->customer_id) { ?>
                                        <option class="option" <?php echo 'selected'; ?> value="<?php echo $details->customer_id; ?>"><?php echo $customer->last_name . ', ' . $customer->first_name . ' ' . $customer->middle_name; ?></option>
                                    <?php } if ($customer->customer_id != $details->customer_id) { ?>
                                        <option class="option" value="<?php echo $customer->customer_id; ?>"><?php echo $customer->last_name . ', ' . $customer->first_name . ' ' . $customer->middle_name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Modify as</label>
                        <div class="col-md-3">
                            <input class="form-control input-sm" value="<?php echo $_SESSION['first_name'] . '&nbsp;' . $_SESSION['last_name'] ?>" disabled>
                            <input type="text" name="modified_by" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                        </div>
                        <label class="col-md-1 control-label">From</label>
                        <div class="col-md-5">
                            <input class="form-control input-sm" id="disabledInput" placeholder="<?php echo $_SESSION['branch'] ?>" disabled>
                            <input type="text" name="branch" value="<?php echo $_SESSION['branch_id'] ?>" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Select Item</label>
                        <div class="col-md-9">
                            <select data-container="body" class="form-control selectpicker" id="select" name="product_id" required="true" data-live-search="true" data-size="5">
                                <?php foreach ($products as $product) { ?>
                                    <?php if ($product->product_id == $details->product_id) { ?>
                                        <option class="option" <?php echo 'selected'; ?> value="<?php echo $details->product_id; ?>"><?php echo $product->brand . ' / ' . $product->product_name; ?></option>
                                    <?php } if ($product->product_id != $details->product_id) { ?>
                                        <option class="option" value="<?php echo $product->product_id; ?>"><?php $product->brand . ' / ' . $product->product_name; ?></option>
                                    <?php } ?>
                                    <option class="option" value="<?php echo $p->product_id; ?>"><?php echo $product->brand . ' / ' . $product->product_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2 col-md-offset-2">
                            <div class="input-group">
                                <span class="input-group-addon">Qty.</span>
                                <input type="number" class="form-control input-sm" name="qty" value="<?php echo $details->qty; ?>" placeholder="0" min="1" max="999" required />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">₱</span>
                                <input type="number" class="form-control input-sm" name="price" value="<?php echo $details->price; ?>" placeholder="0" min="1" max="999999" required />
                                <span class="input-group-addon">per item</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="sales_id" value="<?php echo $details->sales_id; ?>" hidden />
                            <input class="btn btn-primary btn-block" type="submit" name="update_sales" value="Update" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>