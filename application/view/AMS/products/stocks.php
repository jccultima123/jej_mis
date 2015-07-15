<div class="modal-header">
    <div class="btn-group pull-right">
        <?php if (isset($_SESSION['admin_logged_in'])) { ?>
            
        <?php } ?>
        <a type="button" class="btn btn-danger" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Close</a>
    </div>
    <h4 class="modal-title">Stock Info. for Product #<?php echo $details->product_id; ?></h4>
</div>
<div class="modal-body">
    <div class="table">
        <div class="row">
            <label class="col-xs-4 control-label">Add new</label>
            <span class="col-xs-8">
                
            </span>
        </div>
    </div>
</div>
