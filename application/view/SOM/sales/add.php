<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-default" href="<?php echo URL; ?>som/sales">Cancel</a>
            </div>
            <select data-container="body" class="selectpicker val pull-right" required="true" data-style="btn-primary">
                <option hidden disabled selected>New or Existing Customer?</option>
                <option value="x">New Customer</option>
                <option value="y">Existing</option>
            </select>
            <h4 class="modal-title" id="myModalLabel">Add Transaction</h4><br />
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="x box">
            <div class="modal-body">
                <form action="<?php echo URL; ?>som/salesAction" method="POST" style="padding: 10px;" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <input type="text" value="<?php echo RANDOM_NUMBER; ?>" name="customer_id" hidden />
                            <label class="control-label col-md-2">Personal Information</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control input-sm uppercase" name="first_name" placeholder="First Name" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control input-sm uppercase" name="last_name" placeholder="Last Name" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control input-sm uppercase" name="middle_name" placeholder="Middle Name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <input class="form-control input-sm email" type="email" name="email" placeholder="EMAIL ADDRESS" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <input class="form-control input-sm" type="date" name="birthday" placeholder="YYYY-MM-DD" />
                            </div>
                            <div class="col-md-8">
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
                            <label class="control-label col-md-2">Select Product</label>
                            <div class="col-md-9">
                                <select data-container="body" class="form-control selectpicker" id="select" name="product_id" required="true" data-live-search="true" data-size="5">
                                    <option disabled selected hidden>Manufacturer / Product / Model No.</option>
                                    <?php foreach ($products as $p) { ?>
                                        <option class="option" value="<?php echo $p->product_id; ?>"><?php echo $p->brand . ' / ' . $p->product_name . ' / ' . $p->product_model; ?></option>
                                    <?php } ?>
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
                            <div class="col-md-4">
                                <input class="btn btn-primary btn-block" type="submit" name="add_sales-new_cust" value="Add" />
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
            
        <div class="y box">
            <div class="modal-body">
                <form action="<?php echo URL; ?>som/salesAction" method="POST" style="padding: 10px;" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label class="control-label col-md-2">Select Customer</label>
                            <div class="col-md-4">
                                <select data-container="body" class="form-control selectpicker" id="select" name="customer_id" required="true" data-live-search="true" data-size="5">
                                    <option disabled selected hidden>Using Customers List</option>
                                    <?php foreach ($customers as $c) { ?>
                                        <option class="option" value="<?php echo $c->customer_id; ?>"><?php echo $c->last_name . ', ' . $c->first_name . ' ' . $c->middle_name; ?></option>
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
                            <label class="control-label col-md-2">Select Product</label>
                            <div class="col-md-9">
                                <select data-container="body" class="form-control selectpicker" id="select" name="product_id" required="true" data-live-search="true" data-size="5">
                                    <option disabled selected hidden>Manufacturer / Product / Model No.</option>
                                    <?php foreach ($products as $p) { ?>
                                        <option class="option" value="<?php echo $p->product_id; ?>"><?php echo $p->brand . ' / ' . $p->product_name . ' / ' . $p->product_model; ?></option>
                                    <?php } ?>
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
                            <div class="col-md-4">
                                <input class="btn btn-primary btn-block" type="submit" name="add_sales-ex_cust" value="Add" />
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>