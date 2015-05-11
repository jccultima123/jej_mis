<div class="container">
    <div class="table">
        <div class="row">
            <div class="col-md-3 visible-sm visible-xs">
                <br />
                <div class="panel panel-heading panel-success" style="border-width: 2px; background-color: #00FF00;">
                    HI! This System is still under development. Sorry for any inconvenience.
                    <a id="close" href="#"><span class="glyphicon glyphicon-remove pull-right"></span></a>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Dashboard</b></div>
                    <ul class="list-group">
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>som/sales"><i class="picol_label"></i>Sales<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>som/orders"><i class="picol_document_text"></i>Orders<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>assetmgt"><i class="picol_document_sans"></i>Assets<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>crm"><i class="picol_user_full"></i>Customers <?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo $amount_of_customers; ?></span> <?php } ?></a>
                        <a id="load" class="list-group-item visible-sm-block visible-xs-block" href="<?php echo URL; ?>dashboard/reports">View Full Report Summary</a>
                    </ul>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading"><b>MIS</b></div>
                    <ul class="list-group">
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>som">Sales and Order Management</a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>assetmgt">Asset Management</a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>crm">Customer Relations</a>
                    </ul>
                    <div class="panel-heading"><b>Options</b></div>
                    <ul class="list-group">
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>account" onclick="">Account Dashboard</a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>settings" onclick="">System Preferences</a>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 visible-md visible-lg">
                <br />
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Management Info. System</b></div>
                    <ul class="list-group">
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>som">Sales and Order Management</a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>assetmgt">Asset Management</a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>crm">Customer Relations</a>
                    </ul>
                    <div class="panel-heading"><b>Options</b></div>
                    <ul class="list-group">
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>account" onclick="">Account Dashboard</a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>settings" onclick="">System Preferences</a>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <h3 class="visible-lg visible-md">Management Information Report</h3>
                <?php $this->renderFeedbackMessages(); ?>
                <div class="panel panel-heading panel-success visible-lg visible-md" style="border-width: 2px; background-color: #00FF00;">
                    HI! This System is still under development. Sorry for any inconvenience.
                    <a id="close" href="#"><span class="glyphicon glyphicon-remove pull-right"></span></a>
                </div>
                <div class="table" style="">
                    <div class="row visible-lg visible-md">
                        <a id="load" href="<?php echo URL; ?>som/sales" class="col-md-4">
                            <h4><i class="picol_label"></i>Sales<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></h4>
                        </a>
                        <a id="load" href="<?php echo URL; ?>som/orders" class="col-md-4">
                            <h4><i class="picol_document_text"></i>Orders<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></h4>
                        </a>
                        <a id="load" href="<?php echo URL; ?>assetmgt" class="col-md-4">
                            <h4><i class="picol_document_sans"></i>Assets<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></h4>
                        </a>
                        <a id="load" href="<?php echo URL; ?>crm" class="col-md-4">
                            <h4><i class="picol_user_full"></i>Customers <?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo $amount_of_customers; ?></span> <?php } ?></h4>
                        </a>
                    </div>
                </div>
                &nbsp;<h5 class="visible-lg visible-md"><i class="picol_script"></i> <a href="<?php echo URL; ?>dashboard/reports">View Full Report</a></h5>
            </div>
        </div>
    </div>
</div>

