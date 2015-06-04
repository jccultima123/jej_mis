<div class="row-fluid animated bounceInDown" id="login_dialog">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b style="font-size: 28px;">JEJ // <span class="mobilizer_logo">MOBILIZER</span></b><br />
            MI Module <?php echo file_get_contents(URL . 'version'); ?>
        </div>
        <div class="panel-body" id="login-body">
            <strong>Please select a module.</strong><br /><br />
            <a href="<?php echo URL; ?>som" class="btn btn-default btn-block">Sales and Order Management</a>
            <a href="<?php echo URL; ?>ams" class="btn btn-default btn-block">Asset Management</a>
            <a href="<?php echo URL; ?>crm" class="btn btn-default btn-block">Customer Relationship</a>
            <br />
            <a href="<?php echo URL; ?>admin" class="btn btn-default btn-block">Administrator Panel <?php echo file_get_contents(URL . 'version'); ?></a>
        </div>
        <div class="panel-footer">
            (C) JEJ CELLMANIA TRADING CORP.
        </div>
    </div>
</div>
