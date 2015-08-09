<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-cog"></span>&nbsp;Preferences</h4>
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="panel-body">
            <div class="tabs-left col-md-2">
                <ul class="nav nav-tabs">
                    <li><a href="#confirm" data-toggle="tab">Core</a></li>
                    <li class="active">
                        <a id="load" href="<?php echo URL . 'admin/preferences/users' ?>">Users</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content col-md-10">
                <div class="tab-pane" id="confirm">
                    <h4>Returning</h4>
                    <strong>Are you sure?</strong><br /><br />
                    <a class="btn btn-primary" href="<?php echo URL . 'admin/preferences/index.php' ?>">Yes</a>
                    <a class="btn btn-primary" href="<?php echo URL . 'admin/preferences/users' ?>">No</a>
                </div>
                <div class="tab-pane active" id="user">
                    <h4>Users Configuration</h4>
                    <hr />
                    <div style="overflow-x: auto; padding: 0;">
                        <div class="input-group" style="padding: 5px;">
                            <span class="input-group-btn">
                                <a id="load" class="btn btn-default" href="<?php echo URL; ?>admin/userRegister"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add / Register</a>
                            </span>
                        </div><br />
                        <table class="table table-striped" id="table1">
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
        <div class="panel-footer"></div>
    </div>
</div>

    <script type="text/javascript" charset="utf-8">
        var url = "<?php echo URL; ?>";
        $(document).ready(function() {
            $('#table1').dataTable( {
                // don't forget the comma!
                <?php require VIEWS_PATH . '_script/column_filter.js'; ?>,
                "columnDefs": [
                    {
                        // Hidden targets must be starts from zero to avoid confusion
                        "targets": [ 6 ],
                        "sortable": false
                    }
                ],
                "paging": true,
                "jQueryUI": false,
                "searching": true,
                "ordering": true,
                "stateSave": true
            } );
        } );        
    </script>

