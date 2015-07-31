<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-primary" href="<?php echo URL; ?>admin/branchlist">Cancel</a>
            </div>
            <h4 class="modal-title" id="myModalLabel">Branch Registrar</h4><br />
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        
        <div class="modal-body">
            <form action="<?php echo URL; ?>branches/add" method="POST" style="padding: 10px;" class="form-horizontal">
                <fieldset>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Add as</label>
                        <div class="col-md-9">
                            <input class="form-control input-sm" value="<?php echo $_SESSION['first_name'] . '&nbsp;' . $_SESSION['last_name'] ?>" disabled>
                            <input type="text" name="added_by" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Type</label>
                        <div class="col-md-9">
                            <select class="form-control selectpicker" id="select" name="type" required="true">
                                <option disabled selected hidden value="">Please select...</option>
                                <option value="MAIN">Main Branch</option>
                                <option value="MULTI">Multi-Branch</option>
                                <option value="CONCEPT">Concept Store</option>
                                <option value="KIOSK">Kiosks</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Branch Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control uppercase" name="branch_name" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Address</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control uppercase" name="branch_address" placeholder="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Contact No.</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control uppercase" name="branch_contact" required="true" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <input class="btn btn-primary" type="submit" name="add_branch" value="Add" />
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>
</div>