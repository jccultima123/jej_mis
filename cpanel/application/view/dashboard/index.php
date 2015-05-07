<div class="table">
    <div class="row">
        <div class="col-md-2">
            <h2>Dashboard</h2>
            <h3>Tasks</h3>
            <ul>
                <li><a href="<?php echo URL; ?>dashboard/reports" onclick="" data-transition="fade">Report Summary</a></li>
                <li><a href="<?php echo URL; ?>som" onclick="" data-transition="fade">Sales and Order Management</a></li>
                <li><a href="<?php echo URL; ?>assets" onclick="" data-transition="fade">Asset Management</a></li>
                <li><a href="<?php echo URL; ?>crm" onclick="" data-transition="fade">Customer Relations</a></li>
            </ul>
            <h3>Options</h3>
            <ul>
                <li><a href="<?php echo URL; ?>account" onclick="">Account Dashboard</a></li>
                <li><a href="<?php echo URL; ?>settings" onclick="">System Preferences</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <h2>Management Information Report</h2>
            <?php $this->renderFeedbackMessages(); ?>
            <div class="container_table">
                <a href="<?php echo URL; ?>som" class="container_column">
                    <h3><i class="picol_label"></i>Sales</h3>
                    <h4>No Sales Defined</h4>
                </a>
                <a href="<?php echo URL; ?>som" class="container_column">
                    <h3><i class="picol_document_text"></i>Orders</h3>
                    <h4>No Orders Defined</h4>
                </a>
                <a href="<?php echo URL; ?>assets" class="container_column">
                    <h3><i class="picol_document_sans"></i>Assets</h3>
                    <h4>No Assets Defined</h4>
                </a>
                <a href="<?php echo URL; ?>crm" class="container_column">
                    <h3><i class="picol_user_full"></i>Customers</h3>
                    <h4><?php echo $amount_of_customers; ?> Customer/s Recorded</h4>
                </a>
            </div>
            &nbsp;<h4><i class="picol_script"></i> <a href="<?php echo URL; ?>dashboard/reports">View Full Report</a></h4>
        </div>
    </div>
</div>


