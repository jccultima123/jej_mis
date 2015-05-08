<div class="container">
    <div class="table">
        <div class="row">
            <div class="col-md-3">
                <h3 class="visible-lg visible-md">Dashboard</h3>
                <h3 class="visible-sm visible-xs">MIS Dashboard</h3>
                <h4 class="visible-sm visible-xs">Report</h4>
                <ul class="visible-sm visible-xs">
                    <li><a href="<?php echo URL; ?>som"><i class="picol_label"></i>Sales</a></li>
                    <li><a href="<?php echo URL; ?>som"><i class="picol_document_text"></i>Orders</a></li>
                    <li><a href="<?php echo URL; ?>assetmgt"><i class="picol_document_sans"></i>Assets</a></li>
                    <li><a href="<?php echo URL; ?>crm"><i class="picol_user_full"></i>Customers <?php if ($amount_of_customers > 0) { ?> (<?php echo $amount_of_customers; ?>) <?php } ?></a></li>
                    <li class="visible-sm-block visible-xs-block"><i class="picol_script"></i><a href="<?php echo URL; ?>dashboard/reports">View Full Report Summary</a></li>
                </ul>
                <h4>Tasks</h4>
                <ul>
                    <li><a href="<?php echo URL; ?>som">Sales and Order Management</a></li>
                    <li><a href="<?php echo URL; ?>assetmgt">Asset Management</a></li>
                    <li><a href="<?php echo URL; ?>crm">Customer Relations</a></li>
                </ul>
                <h4>Options</h4>
                <ul>
                    <li><a href="<?php echo URL; ?>account" onclick="">Account Dashboard</a></li>
                    <li><a href="<?php echo URL; ?>settings" onclick="">System Preferences</a></li>
                </ul>
            </div>
            <div class="col-md-8">
                <h3 class="visible-lg visible-md">Management Information Report</h3>
                <?php $this->renderFeedbackMessages(); ?>
                <div class="table">
                    <div class="row visible-lg visible-md">
                        <a href="<?php echo URL; ?>som" class="col-md-4">
                            <h4><i class="picol_label"></i>Sales</h4>
                        </a>
                        <a href="<?php echo URL; ?>som" class="col-md-4">
                            <h4><i class="picol_document_text"></i>Orders</h4>
                        </a>
                        <a href="<?php echo URL; ?>assetmgt" class="col-md-4">
                            <h4><i class="picol_document_sans"></i>Assets</h4>
                        </a>
                        <a href="<?php echo URL; ?>crm" class="col-md-4">
                            <h4><i class="picol_user_full"></i>Customers <?php if ($amount_of_customers > 0) { ?> (<?php echo $amount_of_customers; ?>) <?php } ?></h4>
                        </a>
                    </div>
                </div>
                &nbsp;<h5 class="visible-lg visible-md"><i class="picol_script"></i> <a href="<?php echo URL; ?>dashboard/reports">View Full Report</a></h5>
            </div>
        </div><br />
    </div>
</div>

