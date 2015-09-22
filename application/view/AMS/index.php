<script>
    var file = "<?php echo 'ASSET_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>

<div class="container-fluid static-container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>AMS/add/record"><span class="glyphicon glyphicon-plus"></span> Add</a>
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>mis/export/assets/"><span class="glyphicon glyphicon-book"></span> Generate Reports</a>
            </div>
            <h4>ASSET MGT. / COMPANY ASSETS</h4>
        </div>
        <div class="panel-body padding-fix"><br />
            <div class="table">
                <div class="row">
                    <div class="col-md-12">
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($assets)) { ?>
                            <div class="table-responsive" style="overflow-x: auto; padding: 0;">
                                <table class="table table-striped tb-compact" id="assets">
                                    <thead style="font-weight: bold;">
                                        <tr>
                                            <th>ID</th>
                                            <th>TYPE</th>
                                            <th>ITEM</th>
                                            <th>BRANCH</th>
                                            <th>O_VAL</th>
                                            <th>Q</th>
                                            <th>TOTAL</th>
                                            <th>RCRDED</th>
                                            <th>MOD</th>
                                            <th>REM_VAL</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($assets as $asset) { ?>
                                            <tr>
                                                <td><?php if (isset($asset->asset_id)) echo htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->type)) echo htmlspecialchars($asset->atype, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->name)) { ?>
                                                    <a href="<?php echo URL . 'AMS/details/' . htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?>">
                                                        <?php echo htmlspecialchars($asset->name, ENT_QUOTES, 'UTF-8'); ?>
                                                    </a>
                                                <?php } ?></td>
                                                <td><?php if (isset($asset->branch)) echo htmlspecialchars($asset->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->price)) echo htmlspecialchars(number_format($asset->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->price)) echo htmlspecialchars($asset->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->price)) echo htmlspecialchars(number_format($asset->price * $asset->qty), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->created)) echo htmlspecialchars(DataControl::time_elapsed_string($asset->created), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->timestamp)) echo htmlspecialchars(date(DATE_YYDDMM_TIME, $asset->timestamp), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if ($asset->depreciation != 0) echo htmlspecialchars($asset->price - $asset->depreciation, ENT_QUOTES, 'UTF-8'); else echo '0'; ?></td>
                                                <td><?php if (isset($asset->asset_id)) echo htmlspecialchars($asset->status, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <select class="btn jcc-btn" style="width: 50px;" onchange="location = this.options[this.selectedIndex].value;">
                                                        <option hidden disabled selected>--</option>
                                                        <option value="<?php echo URL . 'AMS/validate/asset/' . htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?>">Validate Record</option>
                                                        <option value="<?php echo URL . 'AMS/edit/' . htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?>">Edit Record</option>
                                                        <option value="<?php echo URL . 'AMS/delete/' . htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?>">Delete Record</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div><br />
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
        
</div>

