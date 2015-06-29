<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-cog"></span>&nbsp;Preferences and Tools</h4>
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="panel-body">
            <div class="tabs-left col-md-2">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#core" data-toggle="tab">Core</a></li>
                    <li><a href="#database" data-toggle="tab">Database</a></li>
                    <li>
                        <a id="load" href="<?php echo URL . 'admin/preferences/users' ?>">Users</a>
                    </li>
                </ul>

            </div>
            <div class="tab-content col-md-10">
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
                    <div class="row">
                        <div class="col-sm-4">
                            <ul class="list-unstyled panel panel-default">
                                <div class="panel-heading">
                                    Branches
                                    <?php if ($brcount > 0) { ?><span class="badge pull-right"><?php echo $brcount; ?></span><?php } ?>
                                </div>
                                <?php foreach ($branches as $br) { ?>
                                    <li id="load" class="list-group-item">
                                        <?php echo $br->branch_name; ?><a href="<?php echo URL . 'admin/deleteBranch/' . $br->branch_id; ?>" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                                    </li>
                                <?php } ?>
                                <div class="panel-footer">
                                    <div class="btn-group-justified" role="group" aria-label="...">
                                        <a id="load" class="btn btn-default btn-block" href="<?php echo URL; ?>admin/preferences/addbranch"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</a>
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <div class="col-sm-3">
                            <div class="panel panel-default">
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

