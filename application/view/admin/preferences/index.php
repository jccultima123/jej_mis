<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-cog"></span>&nbsp;Preferences and Tools</h4>
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="panel-body">
            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#core" data-toggle="tab">Core</a></li>
                    <li><a href="#database" data-toggle="tab">Database</a></li>
                    <li>
                        <a id="load" href="<?php echo URL . 'admin/preferences?a=users' ?>">Users</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="core">
                        <h4>Core Preferences</h4>
                        <hr />
                        <h6>SYSTEM PROGRESS</h6>
                        <div class="progress">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%">
                                <span>35% Complete</span>
                            </div>
                        </div>
                        <h5>Please select settings</h5>
                    </div>
                    <div class="tab-pane" id="database">
                        <h4>System Database</h4>
                        Consists of Data for all submodules.
                        <hr />
                        <form action="<?php echo URL; ?>panel/salesAction" class="form-horizontal" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">BRANCHES</label>
                                    <div class="col-sm-3">
                                        
                                    </div>
                                    <label class="col-sm-1 control-label">CATEGORIES</label>
                                    <div class="col-sm-3">
                                        
                                    </div>
                                    <label class="col-sm-1 control-label">DATABASE</label>
                                    <div class="col-sm-3">
                                        
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="list-unstyled panel panel-info">
                                    <li class="panel-heading">MIS Status</li>
                                    <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/som"><i class="picol_label"></i>Sales<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></a>
                                    <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/som"><i class="picol_document_text"></i>Orders<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></a>
                                    <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/ams"><i class="picol_document_sans"></i>Assets<?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo 0; ?></span> <?php } ?></a>
                                    <a id="load" class="list-group-item" href="<?php echo URL; ?>admin/crm"><i class="picol_user_full"></i>Customers <?php if ($amount_of_customers > 0) { ?> <span class="badge pull-right"><?php echo $amount_of_customers; ?></span> <?php } ?></a>
                                    <a id="load" class="list-group-item visible-sm-block visible-xs-block" href="<?php echo URL; ?>admin/dashboard/reports">View Full Report Summary</a>
                                </ul>
                            </div>
                            <div class="col-sm-3">
                                <div class="panel panel-info">
                                    <div class="panel-heading">Pending</div>
                                    <?php
                                    if ($pending_users > 0) {
                                        echo '<a id="load" class="list-group-item" href="' . URL . 'admin/usersdashboard"><i class="glyphicon glyphicon-user"></i> Users <span class="badge pull-right">' . $pending_users . '</span></a>';
                                    } else {
                                        echo '<div class="panel-body">No requests available.</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Analysis</div>
                                    <div class="panel-body">
                                        Not yet available.
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>

