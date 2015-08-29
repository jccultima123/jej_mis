<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-cog"></span>&nbsp;<a href="../preferences/index.php">Preferences</a> / Users</h4>
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="panel-body">
            <a id="load" class="btn btn-default" href="<?php echo URL; ?>admin/userRegister"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add / Register</a>
            <br/><br/>
            <table class="table table-striped" id="users">
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
                                <a id="load"
                                   href="<?php echo URL . 'admin/userDetails/' . htmlspecialchars($user->user_id, ENT_QUOTES, 'UTF-8'); ?>">DETAILS</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>


        </div>
        <div class="panel-footer"></div>
    </div>
</div>

    <script type="text/javascript" charset="utf-8">
        var url = "<?php echo URL; ?>";
        $(document).ready(function() {
            $('#users').dataTable( {
                // don't forget the comma!
                <?php require VIEWS_PATH . '_script/column_filter.txt'; ?>,
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

