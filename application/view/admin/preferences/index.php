<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-cog"></span>&nbsp;Preferences</h4>
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="panel-body">
            <div class="tabs-left col-md-2">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a>Dashboard</a>
                    </li>
                    <li>
                        <a id="load" href="<?php echo URL . 'admin/preferences/profile' ?>">Admin's Profile</a>
                    </li>
                    <li>
                        <a id="load" href="<?php echo URL . 'admin/preferences/appearance' ?>">Appearance</a>
                    </li>
                    <li>
                        <a id="load" href="<?php echo URL . 'admin/preferences/users' ?>">Users</a>
                    </li>
                    <li>
                        <a id="load" href="<?php echo URL . 'admin/preferences/branches' ?>">Branches</a>
                    </li>
                    <li>
                        <a id="load" href="<?php echo URL . 'admin/preferences/recovery' ?>">Recovery</a>
                    </li>
                    <li>
                        <a id="load" href="<?php echo URL . 'admin/preferences/recovery' ?>">Troubleshooting</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content col-md-10">
                <div class="alert alert-info">
                    Not yet available
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>

