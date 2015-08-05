<div class="container" style="max-width: 600px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Sales and Order Management</h4>
        </div>
        <div class="panel-body">
            <?php $this->renderFeedbackMessages(); ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Please Select Action</b>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><a id="load" href="<?php echo URL; ?>som/sales">I am looking for SALES</a></li>
                    <li class="list-group-item"><a id="load" href="<?php echo URL; ?>som/orders">I am looking for ORDERS</a></li>
                    <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                        <li class="list-group-item">
                            <label>Generate Reports</label>
                            <select class="form-control selectpicker" onchange="location = this.options[this.selectedIndex].value;">
                                <option hidden disabled selected>Please Select Type</option>
                                <option value="<?php echo URL . 'mis/export/quick_sales/';?>">Quick Sales Report</option>
                                <option value="<?php echo URL . 'mis/export/quick_orders/';?>">Quick Order Report</option>
                            </select>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>


