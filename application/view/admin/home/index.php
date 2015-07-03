<div class="container-fluid">
    <div class="table">
        <div class="row">
            <div class="col-md-3">
                <br />
                <div class="panel panel-default visible-lg visible-md">
                    <div class="panel-heading"><b>Management Info. System</b></div>
                    <ul class="list-group">
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>som">Sales and Order Management</a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>ams">Asset Management</a>
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>crm">Customer Relations</a>
                    </ul>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Administrative Tasks</b></div>
                    <ul class="list-group">
                        <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/preferences/index.php">System Preferences and Tools</a>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div>
                    <h3>Dashboard</h3>
                    <?php $this->renderFeedbackMessages(); ?>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <ul class="list-unstyled panel panel-info">
                            <li class="panel-heading">MIS Status</li>
                            <a id="load" class="list-group-item" href="<?php echo URL; ?>som/sales?page=1"><i class="picol_label"></i>Sales<?php if ($sales_count > 0) { ?> <span class="badge pull-right"><?php echo $sales_count; ?></span> <?php } ?></a>
                            <a id="load" class="list-group-item" href="<?php echo URL; ?>som/orders?page=1"><i class="picol_document_text"></i>Orders<?php if ($order_count > 0) { ?> <span class="badge pull-right"><?php echo $order_count; ?></span> <?php } ?></a>
                            <a id="load" class="list-group-item" href="<?php echo URL; ?>ams"><i class="picol_document_sans"></i>Assets<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php  ?></span> <?php } ?></a>
                            <a id="load" class="list-group-item" href="<?php echo URL; ?>crm"><i class="picol_user_full"></i>Customers <?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo $amount_of_customers; ?></span> <?php } ?></a>
                            <a id="load" class="list-group-item visible-sm-block visible-xs-block" href="<?php echo URL; ?>admin/dashboard/reports">View Full Report Summary</a>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">Pending</div>
                            <?php
                            if ($pending_users > 0) {
                                echo '<a id="load" class="list-group-item" href="' . URL . 'admin/usersdashboard"><i class="glyphicon glyphicon-user"></i> Users <span class="badge pull-right">' . $pending_users . '</span></a>';
                            } else {
                                echo '<div class="panel-body">No requests available.</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">Latest Report</div>
                            <div class="panel-body">
                                Not yet available.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

