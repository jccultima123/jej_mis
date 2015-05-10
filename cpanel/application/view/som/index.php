<div class="container">
    <div class="table">
        <div class="row">
            <div class="col-md-3 visible-sm visible-xs">
                <br />
                <div class="panel panel-heading panel-success" style="border-width: 2px; background-color: #00FF00;">
                    This System is still under development. Sorry for any inconvenience.
                    <a id="close" href="#"><span class="glyphicon glyphicon-remove pull-right"></span></a>
                </div>
                <div class="visible-sm visible-xs"><?php $this->renderFeedbackMessages(); ?></div>
                <div class="panel panel-default">
                    <ul class="list-group pull-left">
                        <li class="list-group-item" style="background: #CCCCCC;"><a id="load" href="<?php echo URL; ?>"><span class="picol_arrow_full_left" style="font-size: 13px;"></span></a></li>
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
                <div class="panel panel-heading panel-success visible-lg visible-md" style="border-width: 2px; background-color: #00FF00;">
                    This System is still under development. Sorry for any inconvenience.
                    <a id="close" href="#"><span class="glyphicon glyphicon-remove pull-right"></span></a>
                </div>
                <div class="visible-lg visible-md"><?php $this->renderFeedbackMessages(); ?></div>
            </div>
        </div>
    </div>
</div>
