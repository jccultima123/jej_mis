<div class="modal-dialog">
    <div class="modal-content" id="modal-no-shadow">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-primary" href="<?php echo URL . 'admin/preferences/branches'; ?>">Cancel</a>
            </div>
            <h4 class="modal-title" id="myModalLabel">Branch Registrar / Edit Branch #<?php echo $details->branch_id; ?></h4><br />
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        
        <div class="modal-body">
            <form action="<?php echo URL; ?>branches/update" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Type</label>
                        <div class="col-md-9">
                            <select class="form-control selectpicker" id="select" name="type" required="true">
                                <option disabled selected hidden value="">Please select...</option>
                                <option value="MAIN" <?php if ($details->type == 'MAIN') {echo 'selected';} ?>>Main Branch</option>
                                <option value="MULTI" <?php if ($details->type == 'MULTI') {echo 'selected';} ?>>Multi-Branch</option>
                                <option value="CONCEPT" <?php if ($details->type == 'CONCEPT') {echo 'selected';} ?>>Concept Store</option>
                                <option value="KIOSK" <?php if ($details->type == 'KIOSK') {echo 'selected';} ?>>Kiosks</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Branch Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control uppercase" name="branch_name" required="true" value="<?php echo $details->branch_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Address</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control uppercase" name="branch_address" placeholder="" required="true" value="<?php echo $details->branch_address; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Contact No.</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control uppercase" name="branch_contact" required="true" value="<?php echo $details->branch_contact; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input type="hidden" name="branch_id" value="<?php echo $details->branch_id; ?>" />
                            <input class="btn btn-primary" type="submit" name="update_branch" value="UPDATE" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>
</div>