<script>
    var file = "<?php echo 'ASSET_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>

<div class="container-fluid static-container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>AMS/add/record"><span class="glyphicon glyphicon-plus"></span> Add</a>
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>AMS/export/assets"><span class="glyphicon glyphicon-book"></span> Generate Reports</a>
            </div>
            <h4>ASSET MGT.</h4>
            <strong><?php echo $_SESSION['branch']; ?></strong>
        </div>
        <div class="panel-body padding-fix"><br />
            <div class="table">
                <div class="row">
                    <div class="col-md-12">
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($assets)) { ?>
                            <div class="row-fluid table-responsive">
                                <table class="table tb-compact" id="full">
                                    <thead style="font-weight: bold;">
                                        <tr>
                                            <th>ID</th>
                                            <th>TYPE</th>
                                            <th>ITEM</th>
                                            <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                                <th>BRANCH</th>
                                            <?php } ?>
                                            <th></th>
                                            <th>DP</th>
                                            <th>QTY</th>
                                            <th>LATEST DATE</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="searchable">
                                        <?php foreach ($assets as $asset) { ?>
                                            <tr>
                                                <td><?php if (isset($asset->asset_id)) echo htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->type)) echo htmlspecialchars($asset->atype, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->name)) echo htmlspecialchars($asset->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                                    <td><?php if (isset($asset->branch)) echo htmlspecialchars($asset->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <?php } ?>
                                                <td>₱</td>
                                                <td><?php if (isset($asset->price)) echo htmlspecialchars(number_format($asset->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->price)) echo htmlspecialchars($asset->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->timestamp)) echo htmlspecialchars(date(DATE_CUSTOM, $asset->timestamp), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><a id="load" href="<?php if (isset($asset->asset_id)) echo URL . 'AMS/details/' . htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?>"><?php if (isset($asset->as_status)) echo htmlspecialchars($asset->status, ENT_QUOTES, 'UTF-8'); ?></a></td>
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

