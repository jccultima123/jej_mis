
<div class="modal-header">
    <a type="button" class="btn btn-danger pull-right" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Close</a>
    <h4 class="modal-title">Product Detail #<?php echo $details->product_id; ?></h4>
</div>
<div class="modal-body">
    <div class="table">
        <div class="row">
            <label class="col-xs-4 control-label">Brand/Manufacturer</label>
            <span class="col-xs-8">
                <?php echo $details->manufacturer_name; ?>
            </span>
        </div>
        <div class="row">
            <label class="col-xs-4 control-label">Category</label>
            <span class="col-xs-8">
                <?php echo $details->name; ?>
            </span>
        </div>
        <?php if (isset($details->description)) { ?>
            <div class="row">
                <label class="col-xs-4 control-label">Description</label>
                <span class="col-xs-8">
                    <?php echo $details->description; ?>
                </span>
            </div>
        <?php } ?>
        <div class="row">
            <label class="col-xs-4 control-label">Quantity</label>
            <span class="col-xs-8">
                <?php echo $details->qty; ?>
            </span>
        </div>
        <div class="row">
            <label class="col-xs-4 control-label">Price</label>
            <span class="col-xs-8">
                <?php echo '₱' . number_format($details->price); ?>
            </span>
        </div>
        <div class="row">
            <label class="col-xs-4 control-label">Status</label>
            <span class="col-xs-8">
                <?php echo $details->status; ?>
            </span>
        </div>
        <div class="row">
            <label class="col-xs-4 control-label">Created</label>
            <span class="col-xs-8">
                <?php echo date(DATE_CUSTOM, $details->created); ?>
            </span>
        </div>
        <div class="row">
            <label class="col-xs-4 control-label">Modified</label>
            <span class="col-xs-8">
                <?php echo date(DATE_CUSTOM, $details->timestamp); ?>
            </span>
        </div>
        <div class="row">
            <label class="col-xs-4 control-label">Added by</label>
            <span class="col-xs-8">
                <?php echo $details->user_name . ' (#' . $details->user . ')'; ?>
            </span>
            <span class="col-xs-8 col-xs-offset-4">
                <?php echo $details->branch_name; ?>
            </span>
        </div>
        <div class="row">
            <br />
            <select class="selectpicker pull-right" data-style="btn-primary" onchange="location = this.options[this.selectedIndex].value;">
                <option hidden disabled selected>Select/Set Action</option>
                <option value="<?php echo URL . 'AMS/edit/' . htmlspecialchars($details->asset_id, ENT_QUOTES, 'UTF-8'); ?>">Edit Record</option>
                <option value="<?php echo URL . 'AMS/delete/' . htmlspecialchars($details->asset_id, ENT_QUOTES, 'UTF-8'); ?>">Delete Record (WARNING)</option>
            </select>
        </div>
    </div>
</div>
