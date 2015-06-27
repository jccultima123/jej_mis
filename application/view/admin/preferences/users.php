<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-cog"></span>&nbsp;Preferences and Tools</h4>
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="panel-body">
            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    <li><a href="#confirm" data-toggle="tab">Core</a></li>
                    <li><a href="#confirm" data-toggle="tab">Database</a></li>
                    <li class="active">
                        <a id="load" href="<?php echo URL . 'admin/preferences?a=users' ?>">Users</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="confirm">
                        <h4>Returning</h4>
                        <strong>Are you sure?</strong><br /><br />
                        <a class="btn btn-primary" href="<?php echo URL . 'admin/preferences' ?>">Yes</a>
                        <a class="btn btn-primary" href="<?php echo URL . 'admin/preferences?a=users' ?>">No</a>
                    </div>
                    <div class="tab-pane active" id="user">
                        <h4>Users Configuration</h4>
                        <hr />
                        <div style="overflow-x: auto; padding: 0;">
                            <div class="input-group" style="padding: 5px;">
                                <span class="input-group-btn">
                                    <a id="load" class="btn btn-default" href="<?php echo URL; ?>admin/userRegister"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add / Register</a>
                                </span>
                                <!--
                                <form action="<?php echo URL; ?>admin/userSearch" method="POST" class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit" name="search_products">Go!</button>
                                    </span>
                                </form>
                                -->
                            </div><br />
                            <table class="table-bordered table-hover sortable">
                                <thead style="font-weight: bold;">
                                    <tr>
                                        <th style="cursor: pointer;">USER ID</th>
                                        <th style="cursor: pointer;">USER TYPE</th>
                                        <th style="cursor: pointer;">USERNAME</th>
                                        <th style="cursor: pointer;">BRANCH</th>
                                        <th style="cursor: pointer;">STATUS</th>
                                        <th style="cursor: pointer;">REGISTERED</th>
                                        <th class="sorttable_nosort"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) { ?>
                                        <tr>
                                            <td><?php if (isset($user->user_id)) echo htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($user->user_provider_type)) echo htmlspecialchars($user->user_provider_type, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($user->user_name)) echo htmlspecialchars($user->user_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($user->branch_name)) echo htmlspecialchars($user->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td>
                                                <?php if ($user->user_active == 1) { ?>
                                                    ACTIVATED
                                                <?php } else { ?>
                                                    DISABLED
                                                <?php } ?>
                                            </td>
                                            <td><?php if (isset($user->user_creation_timestamp)) echo date(DATE_CUSTOM, $user->user_creation_timestamp); ?></td>
                                            <td>
                                                <?php if (isset($user->user_id)) { ?>
                                                    <a id="load" href="<?php echo URL . 'admin/userDetails/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">DETAILS</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>
