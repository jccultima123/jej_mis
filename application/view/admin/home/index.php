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
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>som/sales?page=1"><i class="picol_label"></i>Sales<?php if ($sales_count > 0) { ?> <span class="badge pull-right"><?php echo $sales_count; ?></span> <?php } ?></a>
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>som/orders?page=1"><i class="picol_document_text"></i>Orders<?php if ($order_count > 0) { ?> <span class="badge pull-right"><?php echo $order_count; ?></span> <?php } ?></a>
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>ams"><i class="picol_document_sans"></i>Assets<?php if ($asset_count > 0) { ?> <span class="badge pull-right"><?php echo $asset_count ?></span> <?php } ?></a>
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>crm"><i class="picol_user_full"></i>Customers <?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo $amount_of_customers; ?></span> <?php } ?></a>
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>crm/feedbacks"><i class="glyphicon glyphicon-comment"></i> Feedbacks <?php if ($feedback_count > 0) { ?> <span class="badge pull-right"><?php echo $feedback_count;  ?></span> <?php } ?></a>
                                <a id="load" class="list-group-item" href="<?php echo URL; ?>ams/products"><i class="picol_list"></i>Products <?php if ($product_count > 0) { ?> <span class="badge pull-right"><?php echo $product_count; ?></span> <?php } ?></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <span class="fa fa-bell"></span>&nbsp;
                                    Notifications
                                </div>
                                <a class="list-group-item" href="<?php echo URL; ?>som/orders?page=1">Pending Orders<div class="badge pull-right" id="pending_orders">...</div></a>
                                <a class="list-group-item" href="<?php echo URL; ?>admin/preferences/users">Pending Users<div class="badge pull-right" id="pending_users">...</div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

