<div class="container-fluid">
    <div class="table">
        <div class="row">
            <div class="col-md-3">
                <br />
                <div class="panel panel-default">
                    <div class="panel-heading"><b>MIS Module</b></div>
                    <ul class="list-group">
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/som">Sales and Order Management</a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/ams">Asset Management</a>
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
                <div class="panel">
                    <div class="panel-heading">
                        <span style="font-size: 19px;">Dashboard</span>
                        <?php $this->renderFeedbackMessages(); ?>
                    </div>
                    <div class="panel-body table">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="list-unstyled panel panel-default">
                                    <li class="panel-heading">MIS Status</li>
                                    <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/som"><i class="picol_label"></i>Sales<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></a>
                                    <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/som"><i class="picol_document_text"></i>Orders<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></a>
                                    <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/ams"><i class="picol_document_sans"></i>Assets<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></a>
                                    <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/crm"><i class="picol_user_full"></i>Customers <?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo $amount_of_customers; ?></span> <?php } ?></a>
                                    <a id="load" class="list-group-item visible-sm-block visible-xs-block" href="<?php echo URL; ?>admin/dashboard/reports">View Full Report Summary</a>
                                </ul>
                            </div>
                            <div class="col-sm-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">News</div>
                                    <div class="panel-body">
                                        Not yet available.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Requests</div>
                                    <div class="panel-body">
                                        Not yet available.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Analysis</div>
                                    <div class="panel-body">
                                        Not yet available.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <i class="picol_script"></i> <a href="<?php echo URL; ?>admin/dashboard/reports">View Full Report</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

