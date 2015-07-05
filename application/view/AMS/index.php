<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>ams/add"><span class="glyphicon glyphicon-plus"></span> Add</a>
                <a id="load" class="btn btn-primary <?php if ($assets==NULL) { echo 'disabled'; } ?>" href="<?php echo URL; ?>ams/export"><span class="glyphicon glyphicon-book"></span> Create Report</a>
            </div>
            <h4>ASSET MGT.</h4>
        </div>
        <div class="panel-body padding-fix"><br />
            <div class="table">
                <div class="row">
                    <div class="col-md-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Asset Records</b>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Today <span class="badge pull-right"><?php echo 'NONE'; ?></span>
                                </li>
                                <li class="list-group-item">
                                    This week <span class="badge pull-right"><?php echo 'NONE'; ?></span>
                                </li>
                                <li class="list-group-item">
                                    This month <span class="badge pull-right"><?php echo 'NONE'; ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($assets)) { ?>
                            <div class="panel panel-default">
                                <!-- Default panel contents -->
                                <div style="overflow-y: auto;">
                                    <div class="input-group" style="padding: 5px;">
                                        <span class="input-group-btn">
                                            <a id="load_timed" type="button" class="btn btn-default" href="#"><span class="glyphicon glyphicon-refresh"></span></a>
                                        </span>
                                        <input type="text" class="form-control search" name="search" placeholder="Search...">
                                    </div>
                                </div>
                            </div>

                            <div class="row-fluid table-responsive">
                                <table class="table table-striped table-hover sortable">
                                    <thead style="font-weight: bold;">
                                        <tr>
                                            <th style="cursor: pointer;">ID</th>
                                            <th style="cursor: pointer;">PRODUCT</th>
                                            <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                                <th style="cursor: pointer;">BRANCH</th>
                                            <?php } ?>
                                            <th style="cursor: pointer;">STK</th>
                                            <th class="sorttable_nosort"></th>
                                            <th style="cursor: pointer;">SRP</th>
                                            <th class="sorttable_nosort">PROCESSED</th>
                                            <th style="cursor: pointer;">SHIPPED</th>
                                            <th style="cursor: pointer;">STATUS</th>
                                            <th style="cursor: pointer;">ACCEPTED</th>
                                            <th class="sorttable_nosort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($assets as $asset) { ?>
                                            <tr>
                                                <td><?php if (isset($asset->asset_id)) echo htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->product_id)) echo htmlspecialchars($asset->manufacturer_name . ' ' . $asset->product_name . ' / ' . $asset->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                                    <td><?php if (isset($asset->asset_branch)) echo htmlspecialchars($asset->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <?php } ?>
                                                <td><?php if (isset($asset->stocks)) echo htmlspecialchars($asset->stocks, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>₱</td>
                                                <td><?php if (isset($asset->srp)) echo htmlspecialchars(number_format($asset->srp), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->asset_date)) echo date(DATE_MMDDYY, $asset->asset_date); ?></td>
                                                <td><?php if (isset($asset->shipped_date)) echo date(DATE_MMDDYY, $asset->shipped_date); ?></td>
                                                <td><?php if (isset($asset->asset_stats)) echo htmlspecialchars($asset->status, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                  <?php if (isset($asset->accepted) && ($asset->accepted != 0)) {
                                                      echo 'YES';
                                                  } else {
                                                      echo 'NO';
                                                  } ?>
                                                </td>
                                                <td>
                                                    <?php if (isset($asset->asset_id)) { ?>
                                                        <a id="load" href="<?php if (isset($asset->asset_id)) echo URL . 'som/assets?details=' . htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?>">DETAILS</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Init Pagination -->
                            <?php require APP . PAGINATION; ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
</div>

