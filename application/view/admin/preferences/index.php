<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-cog"></span>&nbsp;Preferences</h4>
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="panel-body">
            <div class="tabs-left col-md-2">
                <ul class="nav nav-tabs">
                    <li class="active"><a>Main</a></li>
                    <li>
                        <a id="load" href="<?php echo URL . 'admin/preferences/profile' ?>">Profile</a>
                    </li>
                    <li>
                        <a id="load" href="<?php echo URL . 'admin/preferences/users' ?>">Manage Users</a>
                    </li>
                </ul>

            </div>
            <div class="tab-content col-md-10">

            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>

