<div class="container" style="max-width: 600px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-book"></span>&nbsp;Sales Report</h4>
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-md-4">Report Type</label>
                <select class="form-control selectpicker" onchange="location = this.options[this.selectedIndex].value;">
                    <option hidden disabled selected>Please Select</option>
                    <option value="<?php echo URL . 'mis/export/sales_out/';?>">Sales Out Report</option>
                </select>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>

