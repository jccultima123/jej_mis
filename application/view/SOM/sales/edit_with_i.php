<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-default" href="<?php echo URL; ?>som/sales?page=1">Cancel</a>
            </div>
            <select data-container="body" class="selectpicker val pull-right" required="true" data-style="btn-primary">
                <option hidden disabled selected>New or Existing Customer?</option>
                <option value="x" disabled>Override as New Customer</option>
                <option value="y">Existing</option>
            </select>
            <h4 class="modal-title" id="myModalLabel">Edit Sales #<?php echo $details->sales_id; ?> (Installment)</h4>
            <?php $this->renderFeedbackMessages(); ?>
        </div>

        <div class="x box">
            <div class="modal-body">
                <form action="<?php echo URL; ?>SOM/salesAction" method="POST" style="padding: 10px;" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <input type="text" value="<?php echo RANDOM_NUMBER; ?>" name="customer_id" hidden />
                            <label class="control-label col-md-2">Personal Info</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control input-sm uppercase" name="customer_name" placeholder="Your Name / Company Name" />
                            </div>
                            <div class="col-md-5">
                                <input class="form-control input-sm email" type="email" name="email" placeholder="EMAIL ADDRESS" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <input class="form-control input-sm uppercase" type="text" name="address" placeholder="Complete Address" />
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-4">
                                <input type="text" name="sales_id" value="<?php echo $details->sales_id; ?>" hidden />
                                <input class="btn btn-primary btn-block" type="submit" name="update_sales_with new" value="Update" />
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <div class="y box">
            <div class="modal-body">
                <form action="<?php echo URL; ?>SOM/salesAction" method="POST" style="padding: 10px;" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="control-label col-md-2">Select Customer</label>
                            <div class="col-md-4">
                                <select data-container="body" class="form-control selectpicker" id="select" name="customer_id" required="true" data-live-search="true" data-size="5">
                                    <?php foreach ($customers as $customer) { ?>
                                        <?php if ($customer->customer_id == $details->customer_id) { ?>
                                            <option class="option" <?php echo 'selected'; ?> value="<?php echo $details->customer_id; ?>"><?php echo $customer->customer_name; ?></option>
                                        <?php } if ($customer->customer_id != $details->customer_id) { ?>
                                            <option class="option" value="<?php echo $customer->customer_id; ?>"><?php echo $customer->customer_name; ?></option>
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
                            <label class="control-label col-md-2">Item</label>
                            <div class="col-md-9">
                                <input class="form-control input-sm" id="disabledInput" placeholder="<?php echo $details->brand . ' / ' . $details->product_name .  ' / ' . $details->price; ?>" disabled>
                                <input type="text" name="product_id" value="<?php echo $details->product_id; ?>" hidden>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Payment</label>
                            <div class="col-md-3">
                                <p class="form-control-static"><?php echo $details->payment; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Qty.</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">x</span>
                                    <input type="number" class="form-control input-sm" name="qty" value="<?php echo htmlspecialchars($details->qty, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" min="1" max="999" required />
                                </div>
                            </div>
                        </div>
                        <div class="b payment_box">
                            <div class="form-group">
                                <label class="control-label col-md-2">Remaining </label>
                                <div class="col-md-3">
                                    <p class="form-control-static"><?php echo "Php " . $details->remaining; ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Last Down. Occured Worth</label>
                                <div class="col-md-3">
                                    <p class="form-control-static"><?php echo "Php " . $details->downpayment; ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Set New Downpayment</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Php</span>
                                        <input type="number" class="form-control input-sm" name="downpayment" placeholder="0" />
                                    </div>
                                </div>
                            </div>
                            <!--
                            <div class="form-group">
                                <label class="control-label col-md-2">Remaining Balance</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Php</span>
                                        <input type="number" class="form-control input-sm" name="remaining" value="<?php echo htmlspecialchars($records->qty, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" />
                                    </div>
                                </div>
                            </div>
                            -->
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-2">
                                <input type="text" name="sales_id" value="<?php echo $details->sales_id; ?>" hidden />
                                <input class="btn btn-primary btn-block" type="submit" name="update_sales" value="Update" />
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
</div>