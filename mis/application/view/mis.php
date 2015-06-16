<div class="row-fluid animated bounceInDown" id="login_dialog">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b style="font-size: 28px;">JEJ /// <span class="mobilizer_logo pull-right">MOBILIZER</span></b><br />
            <a id="load" href="<?php echo URL; ?>development"><b class="mobilizer_logo pull-right"><?php echo file_get_contents(URL . 'mis_version'); ?></b></a><br />
        </div>
        <div class="panel-body" id="login-body">
            <?php $this->renderFeedbackMessages(); ?>
            <strong>Please select a module.</strong><br /><br />
            <a href="<?php echo URL; ?>som" class="btn btn-primary btn-block">Sales and Order Management</a>
            <a href="<?php echo URL; ?>ams" class="btn btn-primary btn-block">Asset Management</a>
            <a href="<?php echo URL; ?>crm" class="btn btn-primary btn-block">Customer Relationship</a>
            <br />
            <a href="<?php echo URL; ?>admin" class="btn btn-danger btn-block">Administrator Panel</a>
            <a id="logout" class="btn btn-danger btn-block" href="<?php echo URL . 'passwordAction/forgot'?>">Wait, i forgot my password already.</a>
        </div>
        <div class="panel-footer">
            (C) JEJ CELLMANIA TRADING CORP.
        </div>
    </div>
</div>
