<div class="container" style="max-width: 900px;">
    <div class="table">
        <h3 class="text-center">Sales and Order Management</h3><hr />
        <div class="row">
            <div class="col-md-12">
                <div>
                    <?php $this->renderFeedbackMessages(); ?>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-unstyled panel panel-default">
                            <li><a id="load" class="list-group-item" href="<?php echo URL; ?>som/sales">I am looking for SALES</a></li>
                            <li><a id="load" class="list-group-item" href="<?php echo URL; ?>som/orders">I am looking for ORDERS</a></li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                    <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                        <label class="col-md-4">Generate Reports</label>
                        <select class="form-control selectpicker" onchange="location = this.options[this.selectedIndex].value;">
                            <option hidden disabled selected>Please Select Type</option>
                            <option value="<?php echo URL . 'mis/export/quick_sales/';?>">Quick Sales Report (Loads All Available Records)</option>
                        </select>
                    <?php } else { ?>
                        Hello!
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


