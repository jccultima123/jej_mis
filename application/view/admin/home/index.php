<div class="container-fluid padding-fix">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <?php $this->renderFeedbackMessages(); ?>
                </div>
                <div class="row">
                    <div class="drag">
                        <div class="col-md-3">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <span class="fa fa-bar-chart-o"></span>&nbsp;
                                    Total Count (in All Branches)
                                </div>
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>SOM/sales?page=1"><i class="picol_label"></i>Sales<?php if ($sales_count > 0) { ?> <span class="badge pull-right"><?php echo number_format($sales_count); ?></span> <?php } ?></a>
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>SOM/orders?page=1"><i class="picol_document_text"></i>Orders<?php if ($order_count > 0) { ?> <span class="badge pull-right"><?php echo number_format($order_count); ?></span> <?php } ?></a>
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>AMS"><i class="picol_document_sans"></i>Assets<?php if ($asset_count > 0) { ?> <span class="badge pull-right"><?php echo number_format($asset_count); ?></span> <?php } ?></a>
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>CRM/customers"><i class="picol_user_full"></i>Customers <?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo number_format($amount_of_customers); ?></span> <?php } ?></a>
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>CRM/feedbacks"><i class="glyphicon glyphicon-comment"></i> Feedbacks <?php if ($feedback_count > 0) { ?> <span class="badge pull-right"><?php echo number_format($feedback_count);  ?></span> <?php } ?></a>
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/audit"><i class="glyphicon glyphicon-list"></i> Audit Logs <?php if ($audit_count > 0) { ?> <span class="badge pull-right"><?php echo number_format($audit_count);  ?></span> <?php } ?></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <span class="fa fa-bell"></span>&nbsp;
                                    Notifications
                                </div>
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>SOM/orders?page=1">Pending Orders<div class="badge pull-right" id="pending_orders">...</div></a>
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/preferences/users">Pending Users<div class="badge pull-right" id="pending_users">...</div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

