<div class="container" style="max-width: 600px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-book"></span>&nbsp;Sales Report</h4>
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="panel-body">
            <div class="table">
                <div class="form-group">
                    <label class="col-md-4">Report Type</label>
                    <select class="form-control selectpicker" id="select" name="user_provider_type" required="true">
                        <option selected>Please Select..</option>
                        <?php foreach ($reporttypes as $rtype) { ?>
                            <option class="option" value="<?php echo $rtype->type; ?>"><?php echo $rtype->description; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="quick box"><hr />
                    Not yet Available
                </div>
                <div class="sellout box"><hr />
                    Not yet Available
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>

