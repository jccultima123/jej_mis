<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"><a class="btn btn-danger" href="<?php echo URL . 'CRM/post/details/' . $id; ?>"><i class="fa fa-arrow-left"></i></a><span class="pull-right">History for #<?php echo $id; ?></span></h4>
        </div>
        <div class="modal-body">
            <div class="table">
                <div class="row">
                    <span class="col-md-12">
                        <ul class="list-unstyled">
                            <?php if ($details != NULL) { foreach ($details as $d) { ?>
                                <li>
                                    <div class="alert <?php if ($d->from_sys == 1) { echo 'alert-success'; } else {echo 'alert-info';} ?>">
                                        <?php if ($d->from_sys == 1) { echo '<b>From System</b><hr />'; } ?>
                                        <p><b><?php echo $d->subject; ?></b><br /><?php echo $d->text; ?></p><p class="pull-right"><?php echo date(DATE_CUSTOM, $d->timestamp); ?></p><br />
                                    </div>
                                </li><br />
                            <?php }} else { ?>
                                <div class="alert alert-info">
                                    <?php echo 'No history found'; ?>
                                </div>
                            <?php } ?>
                        </ul>
                    </span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <select class="selectpicker pull-right" data-style="btn-primary" onchange="location = this.options[this.selectedIndex].value;" data-container="body">
                <option hidden disabled selected data-icon="glyphicon glyphicon-pencil"> &nbsp;Set Action</option>
                <option value="">View History</option>
                <option value="<?php echo URL . 'CRM/post/reply/' . htmlspecialchars($details->feedback_id, ENT_QUOTES, 'UTF-8'); ?>">Reply/Respond</option>
                <option value="<?php echo URL . 'CRM/post/delete/' . htmlspecialchars($details->feedback_id, ENT_QUOTES, 'UTF-8'); ?>">Delete</option>
            </select>
        </div>
    </div>
</div>
