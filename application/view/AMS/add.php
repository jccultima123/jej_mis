<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-primary" href="<?php echo URL; ?>AMS">Cancel</a>
            </div>
            <h4 class="modal-title" id="myModalLabel">Add Record</h4><br />
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="modal-body">
            <form action="<?php echo URL; ?>AMS/action" method="POST" style="padding: 10px;" class="form-horizontal">
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
                            <select data-container="body" class="form-control selectpicker" name="branch" required="true" data-size="4" title='Select Branch' data-live-search="true">
                                <option disabled selected hidden style="display: none;"></option>
                                <?php foreach ($branches as $branch) { ?>
                                    <option value="<?php echo $branch->branch_id; ?>"><?php echo $branch->branch_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Asset Details</label>
                        <div class="col-md-9">
                            <select data-container="body" class="form-control val_asset_type selectpicker" name="type" required="true" data-size="4" title="Select Type">
                                <option disabled selected hidden style="display: none;"></option>
                                <?php foreach ($types as $type) { ?>
                                    <option title="<?php echo $type->type . ' ASSET'; ?>" value="<?php echo $type->id; ?>"><?php echo $type->type; ?></option>
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
                            <textarea class="form-control uppercase" rows="2" name="description" style="resize: vertical;" placeholder="Description" ></textarea>
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
                    <div class="box b">
                        <div class="alert col-md-9 col-md-offset-3">
                            NOTE: Modifying Fixed Asset will be available once its validated
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