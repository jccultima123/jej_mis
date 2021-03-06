<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-default" href="<?php echo URL; ?>SOM/sales">Cancel</a>
            </div>
            <select data-container="body" class="selectpicker val pull-right" required="true" data-style="btn-primary" title="New or Existing Customer?">
                <option disabled selected hidden style="display: none;"></option>
                <option value="x">New Customer</option>
                <option value="y">Existing</option>
            </select>
            <h4 class="modal-title" id="myModalLabel">Add Transaction</h4><br />
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
                            <label class="control-label col-md-2">Add as</label>
                            <div class="col-md-3">
                                <input class="form-control input-sm" value="<?php echo $_SESSION['first_name'] . '&nbsp;' . $_SESSION['last_name'] ?>" disabled>
                                <input type="text" name="added_by" value="<?php echo $_SESSION['user_id'] ?>" hidden>
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
                                <select data-container="body" class="form-control selectpicker" id="select" name="product_id" required="true" data-live-search="true" data-size="5" title="Manufacturer / Product / Price">
                                    <option disabled selected hidden style="display: none;"></option>
                                    <?php foreach ($products as $p) { ?>
                                        <option class="option" value="<?php echo $p->product_id; ?>"><?php echo $p->brand . ' / ' . $p->product_name . ' / PhP ' . $p->SRP; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Payment</label>
                            <div class="col-md-3">
                                <select data-container="body" class="selectpicker val_payment" name="payment" title="Select Mode" required="true">
                                    <option value="CASH">CASH</option>
                                    <option value="INSTALLMENT">INSTALLMENT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Qty.</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">x</span>
                                    <input type="number" class="form-control input-sm" name="qty" value="<?php echo htmlspecialchars($records->qty, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" min="1" max="999" required />
                                </div>
                            </div>
                        </div>
                        <div class="b payment_box">
                            <div class="form-group">
                                <label class="control-label col-md-2">Downpayment</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Php</span>
                                        <input type="number" class="form-control input-sm" name="downpayment" value="<?php echo htmlspecialchars($records->qty, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" />
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
                            <div class="col-md-3 col-md-offset-2">
                                <input class="btn btn-primary btn-block" type="submit" name="add_sales-new_cust" value="Add" />
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
                            <div class="col-md-10">
                                <select data-container="body" class="form-control selectpicker" id="select" name="customer_id" required="true" data-live-search="true" data-size="5">
                                    <option disabled selected hidden>Using Customers List</option>
                                    <?php foreach ($customers as $c) { ?>
                                        <option class="option" value="<?php echo $c->customer_id; ?>"><?php echo $c->customer_name; ?></option>
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
                                <input type="text" name="branch" value="<?php echo $_SESSION['branch_id'] ?>" hidden>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Select Item</label>
                            <div class="col-md-9">
                                <select data-container="body" class="form-control selectpicker" id="select" name="product_id" required="true" data-live-search="true" data-size="5">
                                    <option disabled selected hidden>Manufacturer / Product / Price</option>
                                    <?php foreach ($products as $p) { ?>
                                        <option class="option" value="<?php echo $p->product_id; ?>"><?php echo $p->brand . ' / ' . $p->product_name . ' / PhP ' . $p->SRP; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Payment</label>
                            <div class="col-md-3">
                                <select data-container="body" class="selectpicker val_payment" name="payment" title="Select Mode" required="true">
                                    <option value="CASH">CASH</option>
                                    <option value="INSTALLMENT">INSTALLMENT</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Qty.</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">x</span>
                                    <input type="number" class="form-control input-sm" name="qty" value="<?php echo htmlspecialchars($records->qty, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" min="1" max="999" required />
                                </div>
                            </div>
                        </div>
                        <div class="b payment_box">
                            <div class="form-group">
                                <label class="control-label col-md-2">Downpayment</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Php</span>
                                        <input type="number" class="form-control input-sm" name="downpayment" value="<?php echo htmlspecialchars($records->qty, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" />
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
                            <div class="col-md-3 col-md-offset-2">
                                <input class="btn btn-primary btn-block" type="submit" name="add_sales-ex_cust" value="Add" />
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>