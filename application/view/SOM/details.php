<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <a type="button" class="btn btn-primary pull-right" href="<?php echo URL; ?>som?page=1">Close</a>
            <h4 class="modal-title">Record Detail #<?php echo $record->record_id; ?></h4>
        </div>
        <div class="modal-body">
            <div class="table">
                <div class="row">
                    <label class="col-xs-4 control-label">Category</label>
                    <span class="col-xs-8">
                        <?php echo $record->name ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">IMEI</label>
                    <span class="col-xs-8">
                        <?php echo $record->IMEI; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Manufacturer</label>
                    <span class="col-xs-8">
                        <?php echo $record->manu_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Product Name</label>
                    <span class="col-xs-8">
                        <?php echo $record->product_name; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Product Model</label>
                    <span class="col-xs-8">
                        <?php echo $record->product_model; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Price</label>
                    <span class="col-xs-8">
                        <?php echo $record->price; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Status</label>
                    <span class="col-xs-8">
                        <?php echo $record->status; ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Last Updated</label>
                    <span class="col-xs-8">
                        <?php echo date(DATE_CUSTOM, $record->latest_timestamp); ?>
                    </span>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Last Modified by</label>
                    <span class="col-xs-8">
                        <?php echo $record->first_name . ' ' . substr($record->middle_name, 0, 1) . '. ' . $record->last_name; ?>
                    </span>
                    <span class="col-xs-8 col-xs-offset-4">
                        <?php echo $record->branch_name; ?>
                    </span>
                </div>
                <div class="row">
                    <br />
                    <span class="col-xs-11 col-xs-offset-1">
                        <div class="btn-group pull-right">
                            <a type="button" class="btn btn-primary" href="<?php echo URL . 'som/deletesales/' . htmlspecialchars($record->record_id, ENT_QUOTES, 'UTF-8'); ?>">Delete</a>
                            <a type="button" class="btn btn-primary" href="<?php echo URL . 'som/editsales/' . htmlspecialchars($record->record_id, ENT_QUOTES, 'UTF-8'); ?>">Edit</a>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer"></div>
</div>
</div>
