<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-primary" href="<?php echo URL; ?>ams?page=1">Cancel</a>
            </div>
            <h4 class="modal-title" id="myModalLabel">Add Item</h4><br />
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="modal-body">
            <form action="<?php echo URL; ?>ams/action" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Add as</label>
                        <div class="col-md-9">
                            <input class="form-control input-sm" value="<?php echo $_SESSION['first_name'] . '&nbsp;' . $_SESSION['last_name'] ?>" disabled>
                            <input type="text" name="user" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">From</label>
                        <div class="col-md-9">
                            <input class="form-control input-sm" id="disabledInput" placeholder="<?php echo $_SESSION['branch'] ?>" disabled>
                            <input type="text" name="branch" value="<?php echo $_SESSION['branch_id'] ?>" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Department</label>
                        <div class="col-md-9">
                            <select class="form-control selectpicker" name="department" required="true" data-size="4">
                                <option disabled selected hidden>Please Select</option>
                                <?php foreach ($departments as $d) { ?>
                                    <option class="option" value="<?php echo $d->department_id; ?>"><?php echo $d->department_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Item Information</label>
                        <div class="col-md-9">
                            <select class="form-control selectpicker" name="type" required="true" data-size="4">
                                <option disabled selected hidden>Select Type</option>
                                <?php foreach ($types as $type) { ?>
                                    <option class="option" value="<?php echo $type->id; ?>"><?php echo $type->type; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <input type="text" class="form-control uppercase" name="name" placeholder="Enter Item Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <textarea class="form-control uppercase" rows="2" name="description" style="resize: vertical;" required placeholder="Description" ></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-3">
                            <div class="input-group">
                                <span class="input-group-addon">Qty.</span>
                                <input type="number" class="form-control input-sm" name="qty" placeholder="0" min="1" max="999" required />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon">₱</span>
                                <input type="number" class="form-control input-sm" name="price" placeholder="0" min="1" max="999999" />
                                <span class="input-group-addon">per item</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <input class="btn btn-primary btn-block" type="submit" name="add_transaction" value="Add" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>
</div>