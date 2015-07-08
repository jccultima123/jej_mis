<div class="container-fluid">
    <div class="table">
        <div class="row">
            <div class="col-md-12">
                <br />
                <div>
                    <?php $this->renderFeedbackMessages(); ?>
                </div>
                <div class="row">
                    <div class="col-md-3">
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
                    <div class="col-sm-3">
                        <div class="panel panel-info" id="live">
                            <div class="panel-heading">Pending Count</div>
                            <?php if ($pending_orders > 0) { ?>
                                <li class="list-group-item">Orders <a id="load" class="badge pull-right" href="<?php echo URL . 'som/orders?page=1'; ?>"><?php echo $pending_orders; ?></a></li>
                            <?php } ?>
                            <?php if ($pending_users > 0) { ?>
                                <li class="list-group-item">Users <a id="load" class="badge pull-right" href="<?php echo URL . 'admin/preferences/users'; ?>"><?php echo $pending_users; ?></a></li>
                            <?php } ?>
                        </div>
                        <ul class="list-unstyled panel panel-info">
                            <li class="panel-heading">Total Count</li>
                            <a id="load" class="list-group-item" href="<?php echo URL; ?>som/sales?page=1"><i class="picol_label"></i>Sales<?php if ($sales_count > 0) { ?> <span class="badge pull-right"><?php echo $sales_count; ?></span> <?php } ?></a>
                            <a id="load" class="list-group-item" href="<?php echo URL; ?>som/orders?page=1"><i class="picol_document_text"></i>Orders<?php if ($order_count > 0) { ?> <span class="badge pull-right"><?php echo $order_count; ?></span> <?php } ?></a>
                            <a id="load" class="list-group-item" href="<?php echo URL; ?>ams"><i class="picol_document_sans"></i>Assets<?php if ($asset_count > 0) { ?> <span class="badge pull-right"><?php echo $asset_count ?></span> <?php } ?></a>
                            <a id="load" class="list-group-item" href="<?php echo URL; ?>crm"><i class="picol_user_full"></i>Customers <?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo $amount_of_customers; ?></span> <?php } ?></a>
                            <a id="load" class="list-group-item" href="<?php echo URL; ?>crm/feedbacks"><i class="glyphicon glyphicon-comment"></i> Feedbacks <?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php  ?></span> <?php } ?></a>
                            <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/products"><i class="picol_list"></i>Products <?php if ($product_count > 0) { ?> <span class="badge pull-right"><?php  ?></span> <?php } ?></a>
                        </ul>
                    </div>
                    <div class="col-sm-3">
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

