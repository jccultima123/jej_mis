<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><span class="glyphicon glyphicon-cog"></span>&nbsp;<a href="../preferences/index.php">Preferences</a> / Users</h4>
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="panel-body">
            <div class="tabs-left col-md-2">
                <ul class="nav nav-tabs">
                    <li>
                        <a id="load" href="<?php echo URL . 'admin/preferences/main' ?>">Dashboard</a>
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
                    <li class="active">
                        <a>Branches</a>
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
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>branches/add">Add / Register</a>
                <br/><br/>
                <?php if (!empty($branches)) { ?>
                    <table class="table" id="branches">
                        <thead style="font-weight: bold;">
                        <tr>
                            <th>BRANCH NO.</th>
                            <th>TYPE</th>
                            <th>BRANCH NAME</th>
                            <th>ADDRESS</th>
                            <th>CONTACT NO.</th>
                            <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                <th></th>
                                <th></th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($branches as $branch) { ?>
                            <tr>
                                <td>
                                    <?php if (isset($branch->branch_id)) { ?>
                                        <?php echo htmlspecialchars($branch->branch_id, ENT_QUOTES, 'UTF-8'); ?>
                                    <?php } ?>
                                </td>
                                <td><?php if (isset($branch->type)) echo htmlspecialchars($branch->type, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($branch->branch_name)) echo htmlspecialchars($branch->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($branch->branch_address)) echo htmlspecialchars($branch->branch_address, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($branch->branch_contact)) echo htmlspecialchars($branch->branch_contact, ENT_QUOTES, 'UTF-8'); ?></td>
                                <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                    <td>
                                        <select class="btn jcc-btn" onchange="location = this.options[this.selectedIndex].value;">
                                            <option hidden disabled selected data-icon="glyphicon glyphicon-pencil"> &nbsp;Set Action</option>
                                            <option value="<?php echo URL . 'branches/edit/' . htmlspecialchars($branch->branch_id, ENT_QUOTES, 'UTF-8'); ?>">Edit Branch</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" data-href="<?php echo URL . 'branches/delete/' . htmlspecialchars($branch->branch_id, ENT_QUOTES, 'UTF-8'); ?>" data-toggle="modal" data-target="#confirm-delete">X</button>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>
    
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete / Cancel</h4>
            </div>
            <div class="modal-body">
                Are you sure about this??
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
