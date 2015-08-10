<script>
    var file = "<?php echo 'ASSET_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>

<div class="container-fluid static-container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>AMS/add/record"><span class="glyphicon glyphicon-plus"></span> Add</a>
                <select class="selectpicker" data-style='btn-primary btn-sm' onchange="location = this.options[this.selectedIndex].value;">
                    <option disabled hidden selected title="Generate Reports">Select Type</option>
                    <option value="<?php echo URL . 'mis/export/assets/';?>">Quick Asset Report</option>
                </select>
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
                                            <th>DP</th>
                                            <th>QTY</th>
                                            <th>TOTAL</th>
                                            <th>LATEST</th>
                                            <th>STATUS</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($assets as $asset) { ?>
                                            <tr>
                                                <td><?php if (isset($asset->asset_id)) echo htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->type)) echo htmlspecialchars($asset->atype, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->name)) echo htmlspecialchars($asset->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->branch)) echo htmlspecialchars($asset->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->price)) echo htmlspecialchars(number_format($asset->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->price)) echo htmlspecialchars($asset->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->price)) echo htmlspecialchars(number_format($asset->price * $asset->qty), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->timestamp)) echo htmlspecialchars(date(DATE_CUSTOM, $asset->timestamp), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->asset_id)) echo htmlspecialchars($asset->status, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <select class="selectpicker show-menu-arrow pull-right" data-width="60" data-style="btn-primary" onchange="location = this.options[this.selectedIndex].value;" data-container="body">
                                                        <option hidden disabled selected data-icon="glyphicon glyphicon-pencil"> &nbsp;Set Action</option>
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

