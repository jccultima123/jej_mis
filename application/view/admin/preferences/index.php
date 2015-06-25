<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Preferences and Tools</h4>
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="panel-body">
            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#core" data-toggle="tab">Core</a></li>
                    <li><a href="#database" data-toggle="tab">Database</a></li>
                    <li><a href="#user" data-toggle="tab">Users</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="core">
                        <h4>Core Preferences</h4>
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
                        <strong>BRANCHES</strong><br /><br />
                        <form action="<?php echo URL; ?>panel/salesAction" class="form-horizontal" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Category</label>
                                    <div class="col-lg-5">
                                        <select class="form-control selectpicker" id="select" name="category" required="true">
                                            <?php foreach ($categories as $category) { ?>
                                                <?php if ($category->id == $sales->category) { ?>
                                                    <option class="option" selected value="<?php echo $sales->category; ?>"><?php echo $category->name; ?></option>
                                                <?php } if ($category->id != $sales->category) { ?>
                                                    <option class="option" value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-lg-1 control-label">Status</label>
                                    <div class="col-lg-4">
                                        <select class="form-control selectpicker" id="select" name="status_id" required="true">
                                            <?php foreach ($status as $st) { ?>
                                                <?php if ($st->id == $sales->status_id) { ?>
                                                    <option class="option" selected value="<?php echo $sales->status_id; ?>"><?php echo $st->status; ?></option>
                                                <?php } if ($st->id != $sales->status_id) { ?>
                                                    <option class="option" value="<?php echo $st->id; ?>"><?php echo $st->status; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">SKU</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="SKU" value="<?php echo htmlspecialchars($sales->SKU, ENT_QUOTES, 'UTF-8'); ?>" required="true">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="tab-pane" id="user">
                        <h4>Users Configuration</h4>
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

