<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <a type="button" class="btn btn-danger pull-right" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Close</a>
            <h4 class="modal-title">Asset Detail #<?php echo $details->asset_id; ?></h4>
        </div>
        <div class="modal-body">
            <div class="table">
                <div class="row">
                    <label class="col-xs-6 control-label">Asset Type</label>
                    <span class="col-xs-6">
                        <?php echo $details->atype; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-6 control-label">Item Information</label>
                    <span class="col-xs-6">
                        <?php echo $details->name; ?>
                    </span>
                </div>
                <?php if (isset($details->description) AND !empty($details->description)) { ?>
                    <div class="row">
                        <label class="col-xs-6 control-label">Description</label>
                        <span class="col-xs-6">
                            <?php echo $details->description; ?>
                        </span>
                    </div>
                <?php } ?>
                <div class="row">
                    <label class="col-xs-6 control-label">Quantity</label>
                    <span class="col-xs-6">
                        <?php echo $details->qty; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-6 control-label">Price</label>
                    <span class="col-xs-6">
                        <?php echo '₱' . number_format($details->price); ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-6 control-label">Status</label>
                    <span class="col-xs-6">
                        <?php echo $details->status; ?>
                    </span>
                </div>
                <?php if ($details->type != 1) { ?>
                    <hr />
                    <div class="row">
                        <label class="col-xs-6 control-label">Depreciation</label>
                    </div>
                    <div class="row">
                        <label class="col-xs-6 control-label">Age</label>
                        <span class="col-xs-6">
                            <?php echo Math::computeAge($details->value_date) . ' Year/s'; ?><br />
                        </span>
                    </div>
                    <div class="row">
                        <label class="col-xs-6 control-label">Validity</label>
                        <span class="col-xs-6">
                            <?php echo $details->lifespan . ' Year/s'; ?>
                        </span>
                    </div>
                    <div class="row">
                        <label class="col-xs-6 control-label">SV</label>
                        <span class="col-xs-6">
                            <?php echo number_format(Math::decToPer($details->depreciation), 2) . '%'; ?>
                        </span>
                    </div>
                    <div class="row">
                        <label class="col-xs-6 control-label">Accu. Depreciation per year</label>
                        <span class="col-xs-6">
                            <?php echo '₱' . number_format($details->accu_depreciation); ?>
                        </span>
                    </div>
                    <div class="row">
                        <label class="col-xs-6 control-label">Expected remaining value for next year</label>
                        <span class="col-xs-6">
                            <?php
                                $age = Math::computeAge($details->value_date);
                                $val = $details->price - ($details->accu_depreciation * ($age + 1));
                                echo '₱' . number_format($val);
                            ?>
                        </span>
                    </div>
                <?php } ?>
                <hr />
                <div class="row">
                    <label class="col-xs-6 control-label">Created</label>
                    <span class="col-xs-6">
                        <?php echo date(DATE_CUSTOM, $details->created); ?>
                    </span>
                    <span class="col-xs-6 col-xs-offset-6">
                        <?php echo Math::time_elapsed_string($details->created); ?>
                    </span>
                </div><br />
                <div class="row">
                    <label class="col-xs-6 control-label">Modified</label>
                    <span class="col-xs-6">
                        <?php echo date(DATE_CUSTOM, $details->timestamp); ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-6 control-label">Added by</label>
                    <span class="col-xs-6">
                        <?php echo $details->user_name . ' (#' . $details->user . ')'; ?>
                    </span>
                    <span class="col-xs-6 col-xs-offset-6">
                        <?php echo $details->branch_name; ?>
                    </span>
                </div>
                <div class="row">
                    <br />
                    <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                        <select class="selectpicker pull-right" data-style="btn-primary" data-container="body" onchange="location = this.options[this.selectedIndex].value;">
                            <option hidden disabled selected>Select/Set Action</option>
                            <?php if ($details->as_status != 1) { ?>
                                <option value="<?php echo URL . 'AMS/validate/asset/' . htmlspecialchars($details->asset_id, ENT_QUOTES, 'UTF-8'); ?>">Validate Record</option>
                            <?php } ?>
                            <option value="<?php echo URL . 'AMS/edit/' . htmlspecialchars($details->asset_id, ENT_QUOTES, 'UTF-8'); ?>">Edit Record</option>
                            <option value="<?php echo URL . 'AMS/delete/' . htmlspecialchars($details->asset_id, ENT_QUOTES, 'UTF-8'); ?>">Delete Record (WARNING)</option>
                        </select>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
        
</div>
</div>
