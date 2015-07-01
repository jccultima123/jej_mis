<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <a type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>som/sales?page=1">Cancel</a>
            <h4 class="modal-title" id="myModalLabel">Add Transaction</h4>
        </div>
        <div class="modal-body">
            <?php $this->renderFeedbackMessages(); ?>
            <form action="<?php echo URL; ?>som/action" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <select class="form-control selectpicker" id="select" name="customer" required="true" data-style="btn-primary">
                                <option hidden disabled selected>New or Existing Customer?</option>
                                <option value="new">We have a new Customer</option>
                                <option value="existed">Existing Customer</option>
                            </select>
                        </div>
                    </div>
                    <div class="new box">
                        <label class="col-md-offset-3 control-label"><h4>&nbsp;Customer Information</h4></label>
                        <div class="form-group">
                            <input type="text" value="<?php echo RANDOM_NUMBER; ?>" name="random_id" hidden />
                            <div class="col-md-3 col-md-offset-3">
                                <input type="text" class="form-control input-sm" name="first_name" placeholder="First Name" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control input-sm" name="last_name" placeholder="Last Name" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control input-sm" name="middle_name" placeholder="Middle Name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Birthday and Address</label>
                            <div class="col-md-3">
                                <input class="form-control input-sm" type="date" name="birthday" placeholder="Format (including /) : YYYY-MM-DD" />
                            </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm" type="text" name="address" placeholder="Complete Address" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-3">
                                <input class="btn btn-primary btn-block" type="submit" name="add_record" value="Add" />
                            </div>
                        </div>
                    </div>
                    <div class="existed box">
                        <label class="col-md-offset-3 control-label"><h4>&nbsp;Existing Customer</h4></label>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-3">
                                <select class="form-control selectpicker" id="select" name="customer_id" data-live-search="true" data-size="5">
                                    <option disabled selected hidden>Search Customer</option>
                                    <?php foreach ($customers as $c) { ?>
                                        <option class="option" value="<?php echo $c->customer_id; ?>"><?php echo $c->last_name . ', ' . $c->first_name . ' ' . $c->middle_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Add as</label>
                        <div class="col-md-3">
                            <input class="form-control" value="<?php echo $_SESSION['first_name'] . '&nbsp;' . $_SESSION['last_name'] ?>" disabled>
                            <input type="text" name="added_by" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                        </div>
                        <label class="col-md-1 control-label">From</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="disabledInput" placeholder="<?php echo $_SESSION['branch'] ?>" disabled>
                            <input type="text" name="branch" value="<?php echo $_SESSION['branch_id'] ?>" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Products</label>
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
                        <label class="col-md-3 control-label">Qty.</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon">x</span>
                                <input type="number" class="form-control input-sm" name="qty" value="<?php echo htmlspecialchars($records->qty, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" min="1" max="999" required />
                            </div>
                        </div>
                        <label class="col-md-1 control-label">Price</label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon">PhP</span>
                                <input type="number" class="form-control input-sm" name="price" placeholder="0" min="1" max="999999" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-3">
                            <input class="btn btn-primary btn-block" type="submit" name="add_sales" value="Add" />
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
        <div class="modal-footer"></div>
    </div>
</div>