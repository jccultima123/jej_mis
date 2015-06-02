<div class="container">
    <div class="modal bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>users">Cancel</a>
                    <h4 class="modal-title" id="myModalLabel">Registration Details</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo URL; ?>products/add" method="POST" style="padding: 10px;" class="form-horizontal">
                        <fieldset>  
                            <div class="form-group">
                                <label class="col-md-3 control-label">User Type</label>
                                <div class="col-md-9">
                                    <select class="form-control selectpicker" id="select" name="user_account_type" required="true">
                                        <option disabled selected hidden value="">Please select...</option>
                                        <?php foreach ($usertype as $type) { ?>
                                            <option class="option" value="<?php echo $type->usertype; ?>"><?php echo $type->usertype; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="user_email" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Username</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="user_name" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Password</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="user_password" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Branch</label>
                                <div class="col-md-9">
                                    <select class="form-control selectpicker" id="select" name="user_branch" required="true">
                                        <option disabled selected hidden value="">Select current branch...</option>
                                        <?php foreach ($branches as $branch) { ?>
                                            <option class="option" value="<?php echo $branch->user_branch; ?>"><?php echo $branch->user_branch; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Captcha</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">NULL</span>
                                        <input type="text" class="form-control" name="price" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <input class="btn btn-primary" type="submit" name="submit_add_user" value="Add" />
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <!-- Redirectable Dialog -->
    <div class="modal" id="linkdialog" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>

    <div class="table">
        <div class="row">
            <div class="col-md-3">
                <br />
                <div class="panel-group" id="accordion">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#p1"><b>Total Users</b><span class="badge pull-right"><?php // echo $amount_of_products; ?></span></a>
                        </div>
                        <ul id="p1" class="list-group panel-collapse collapse in">
                            <?php // foreach ($usertype as $type) { ?>
                                <a class="list-group-item"><?php // if (isset($type->name)) echo htmlspecialchars($type->name, ENT_QUOTES, 'UTF-8'); ?> <span class="badge pull-right"><?php // echo $type->count; ?></span></a>
                            <?php // } ?>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-md-9">
                <h3>Users</h3>
                <?php $this->renderFeedbackMessages(); ?>

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading" style="overflow-y: auto; padding: 0px;">
                        <div class="input-group" style="padding: 5px;">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</button>
                            </span>
                            <form action="<?php echo URL; ?>products/search" method="POST" class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="search_products">Go!</button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body" style="overflow-x: auto; padding: 0;">
                        <table class="table-bordered table-hover sortable">
                            <thead style="font-weight: bold;">
                                <tr>
                                    <th style="cursor: pointer;">USER TYPE</th>
                                    <th style="cursor: pointer;">USERNAME</th>
                                    <th style="cursor: pointer;">BRANCH</th>
                                    <th style="cursor: pointer;">STATUS</th>
                                    <th style="cursor: pointer;">REGISTERED</th>
                                    <th class="sorttable_nosort"></th>
                                    <th class="sorttable_nosort"></th>
                                    <th class="sorttable_nosort"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) { ?>
                                    <tr class="">
                                        <td><?php if (isset($user->user_account_type)) echo htmlspecialchars($user->user_account_type, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($user->user_name)) echo htmlspecialchars($user->user_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($user->product_name)) echo htmlspecialchars($user->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td></td>
                                        <td><?php if (isset($user->user_creation_timestamp)) echo htmlspecialchars(date("F j, Y, g:i a", strtotime($user->user_creation_timestamp)), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php if (isset($user->product_id)) { ?>
                                                <a data-toggle="modal" data-target="#linkdialog" href="<?php if (isset($user->product_id)) echo URL . 'products/details/' . htmlspecialchars($user->product_id, ENT_QUOTES, 'UTF-8'); ?>">DETAILS</a>
                                            <?php } ?>
                                        </td>
                                        <td><a id="load" href="<?php echo URL . 'products/delete/' . htmlspecialchars($user->product_id, ENT_QUOTES, 'UTF-8'); ?>">DELETE</a></td>
                                        <td><a data-toggle="modal" data-target="#linkdialog" href="<?php echo URL . 'products/edit/' . htmlspecialchars($user->product_id, ENT_QUOTES, 'UTF-8'); ?>">EDIT</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div><br />

            </div>
        </div>
    </div><br />
</div>             
