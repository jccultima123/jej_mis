<div class="container">
    <div class="table">
        <div class="row">
            <div class="col-sm-3">
                <br />
                <div class="panel-group" id="accordion">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#p1"><b>Users Dashboard</b><span class="badge pull-right"><?php // echo $amount_of_products; ?></span></a>
                        </div>
                        <ul id="p1" class="list-group panel-collapse collapse in">
                            <?php // foreach ($usertype as $type) { ?>
                                <a class="list-group-item"><?php // if (isset($type->name)) echo htmlspecialchars($type->name, ENT_QUOTES, 'UTF-8'); ?> <span class="badge pull-right"><?php // echo $type->count; ?></span></a>
                            <?php // } ?>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-sm-9">
                <h3>Users</h3>
                <?php $this->renderFeedbackMessages(); ?>
                <?php if(!empty($users)) { ?>
                <!--
                <div class="panel panel-default">
                    <div class="panel-heading" style="overflow-y: auto; padding: 0px;">
                        <div class="input-group" style="padding: 5px;">
                            <span class="input-group-btn">
                                <a id="load" class="btn btn-default" href="<?php echo URL; ?>admin/userRegister"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</a>
                            </span>
                            <form action="<?php echo URL; ?>admin/userSearch" method="POST" class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="search_products">Go!</button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
                -->
                <div class="panel panel-default">
                    <div class="panel-body" style="overflow-x: auto; padding: 0;">
                        <table class="table-bordered table-hover sortable">
                            <thead style="font-weight: bold;">
                                <tr>
                                    <th style="cursor: pointer;">USER ID</th>
                                    <th style="cursor: pointer;">USER TYPE</th>
                                    <th style="cursor: pointer;">USERNAME</th>
                                    <th style="cursor: pointer;">BRANCH ID</th>
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
                                        <td><?php if (isset($user->branch_id)) echo htmlspecialchars($user->branch_id, ENT_QUOTES, 'UTF-8'); ?></td>
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
                </div><br />
                <?php } ?>
            </div>
        </div>
    </div><br />
</div>             
