<div class="container">
    <div class="table">
        <div class="row">
            <div class="col-md-3 visible-sm visible-xs">
                <br />
                <div class="visible-sm visible-xs"><?php $this->renderFeedbackMessages(); ?></div>
                <div class="panel panel-default">
                    <ul class="list-group pull-left">
                        <a class="list-group-item" style="background: #CCCCCC;" id="load" href="<?php echo URL; ?>"><span class="picol_arrow_full_left" style="font-size: 13px;"></span></a>
                    </ul>
                    <div class="panel-heading"><b>&nbsp;&nbsp;Sales and Orders</b></div>
                    <ul class="list-group">
                        <a class="list-group-item" href="<?php echo URL; ?>som/sales">Manage Sales</a>
                        <a class="list-group-item" href="<?php echo URL; ?>som/orders">Manage Orders</a>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 visible-md visible-lg">
                <br />
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Sales and Orders</b></div>
                    <ul class="list-group">
                        <a class="list-group-item" href="<?php echo URL; ?>som/sales">Manage Sales</a>
                        <a class="list-group-item" href="<?php echo URL; ?>som/orders">Manage Orders</a>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <br />
                <div class="visible-lg visible-md"><?php $this->renderFeedbackMessages(); ?></div>
            </div>
        </div>
    </div>
</div>
