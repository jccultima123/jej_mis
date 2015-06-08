<div class="container">
    <div class="table">
        <div class="row">
            <div class="col-md-3">
                <br />
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Management Info. System</b></div>
                    <ul class="list-group">
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/som">Sales and Order Management</a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/assetmgt">Asset Management</a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/crm">Customer Relations</a>
                    </ul>
                    <div class="panel-heading"><b>Options</b></div>
                    <ul class="list-group">
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/usersdashboard" onclick="">Users Dashboard</a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/settings" onclick="">System Preferences</a>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <br />
                <?php $this->renderFeedbackMessages(); ?>
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Dashboard</b></div>
                    <ul class="list-group">
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/som"><i class="picol_label"></i>Sales<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/som"><i class="picol_document_text"></i>Orders<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/assetmgt"><i class="picol_document_sans"></i>Assets<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/crm"><i class="picol_user_full"></i>Customers <?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo $amount_of_customers; ?></span> <?php } ?></a>
                        <a id="load" class="list-group-item visible-sm-block visible-xs-block" href="<?php echo URL; ?>admin/dashboard/reports">View Full Report Summary</a>
                    </ul>
                </div>
                &nbsp;<h5 class="visible-lg visible-md"><i class="picol_script"></i> <a href="<?php echo URL; ?>admin/dashboard/reports">View Full Report</a></h5>
            </div>
        </div>
    </div>
</div>

