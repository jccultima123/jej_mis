<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-primary" href="<?php echo URL . 'AMS/details/' . htmlspecialchars($details->asset_id, ENT_QUOTES, 'UTF-8'); ?>">Cancel</a>
                <a type="button" class="btn btn-primary" href="<?php echo URL; ?>AMS">Go back to list</a>
            </div>
            <h4 class="modal-title" id="myModalLabel">Edit Asset #<?php echo $details->asset_id; ?></h4><br />
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
                            <select data-container="body" class="form-control selectpicker" name="branch" required="true" data-size="4" title='Select Branch'>
                                <option disabled selected hidden></option>
                                <?php foreach ($branches as $branch) { ?>
                                    <?php if ($branch->branch_id == $details->branch) { ?>
                                        <option class="option" <?php echo 'selected'; ?> value="<?php echo $details->branch; ?>"><?php echo $branch->branch_name; ?></option>
                                    <?php } if ($branch->branch_id != $details->branch) { ?>
                                        <option class="option" value="<?php echo $branch->branch_id; ?>"><?php echo $branch->branch_name; ?></option>
                                    <?php } ?>
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
                                    <?php if ($type->id == $details->type) { ?>
                                        <option class="option" <?php echo 'selected'; ?> value="<?php echo $details->type; ?>"><?php echo $type->type; ?></option>
                                    <?php } if ($type->id != $details->type) { ?>
                                        <option class="option" value="<?php echo $type->id; ?>"><?php echo $type->type; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <input type="text" class="form-control uppercase" name="name" value="<?php echo $details->name; ?>" placeholder="Enter Item Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <textarea class="form-control uppercase" rows="2" name="description" style="resize: vertical;" required placeholder="Description" ><?php echo $details->description; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-3">
                            <div class="input-group">
                                <span class="input-group-addon">Qty.</span>
                                <input type="number" class="form-control input-sm" name="qty" value="<?php echo $details->qty; ?>" placeholder="0" min="1" max="999" required />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon">₱</span>
                                <input type="number" class="form-control input-sm" name="price" value="<?php echo $details->price; ?>" placeholder="0" min="1" max="999999" />
                                <span class="input-group-addon">per item</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Set Status</label>
                        <div class="col-md-9">
                            <select class="form-control selectpicker" data-style="btn-primary" name="as_status" required="true" data-size="4">
                                <?php foreach ($status as $st) { ?>
                                    <?php if ($st->as_id == $details->as_status) { ?>
                                        <option class="option" <?php echo 'selected'; ?> value="<?php echo $details->as_status; ?>"><?php echo $st->status; ?></option>
                                    <?php } if ($st->as_id != $details->as_status) { ?>
                                        <option class="option" value="<?php echo $st->as_id; ?>"><?php echo $st->status; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <input type="hidden" name="asset_id" value="<?php echo $details->asset_id; ?>" />
                            <input class="btn btn-primary btn-block" type="submit" name="update_transaction" value="UPDATE" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>
</div>