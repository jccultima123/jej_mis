<!-- MODALS -->
<div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="export">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-label="Close">Cancel</button>
                <h4 class="modal-title">Export</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    <strong>NOTE: </strong>
                    If you want to export all available data, make sure the<br /><br /> <button class="btn btn-primary"><span class="glyphicon glyphicon-info-sign"></span> Expand All: is On</button>.
                </div>
                <input type="text" id="export_name" />
                <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExport('#full',{type:'excel'});"> Export to Excel</a>
                <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExport('#full',{type:'doc'});"> Export to Word</a>
                <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExportPDF('#full',{type:'pdf'});"> Export to PDF (Recommended)</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>AMS/add/record"><span class="glyphicon glyphicon-plus"></span> Add</a>
                <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#export"><span class="glyphicon glyphicon-book"></span> Export</a>
                <?php if (isset($total)) { ?><a id="load" class="btn btn-default" href="<?php echo URL; ?>AMS?page=full"><span class="glyphicon glyphicon-info-sign"></span> Expand All: is Off</a>
                <?php } else { ?><a id="load" class="btn btn-primary" href="<?php echo URL; ?>AMS?page=1"><span class="glyphicon glyphicon-info-sign"></span> Expand All: is On</a><?php } ?>
            </div>
            <h4>ASSET MGT.</h4>
            <strong><?php echo $_SESSION['branch']; ?></strong>
        </div>
        <div class="panel-body padding-fix"><br />
            <div class="table">
                <div class="row">
                    <div class="col-md-2">
                        <a id="load" class="btn btn-primary btn-block" href="<?php echo URL . 'ams/products' ?>">Switch to Inventory</a><br />
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
                            <!--
                            <div class="panel panel-default">
                                <div style="overflow-y: auto;">
                                    <div class="input-group" style="padding: 5px;">
                                        <span class="input-group-btn">
                                            <a id="load_timed" type="button" class="btn btn-default" href="#"><span class="glyphicon glyphicon-refresh"></span></a>
                                        </span>
                                        <input type="text" class="form-control search" name="search" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                            -->

                            <div class="row-fluid table-responsive">
                                <table class="table table-striped table-hover sortable" id="full">
                                    <thead style="font-weight: bold;">
                                        <tr>
                                            <th style="cursor: pointer;">ID</th>
                                            <th style="cursor: pointer;">TYPE</th>
                                            <th style="cursor: pointer;">ITEM</th>
                                            <th style="cursor: pointer;">DEPARTMENT</th>
                                            <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                                <th style="cursor: pointer;">BRANCH</th>
                                            <?php } ?>
                                            <th class="sorttable_nosort"></th>
                                            <th style="cursor: pointer;">PRICE</th>
                                            <th style="cursor: pointer;">QTY</th>
                                            <th class="sorttable_nosort">LATEST</th>
                                            <th class="sorttable_nosort">STATUS</th>
                                            <th class="sorttable_nosort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($assets as $asset) { ?>
                                            <tr>
                                                <td><?php if (isset($asset->asset_id)) echo htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->type)) echo htmlspecialchars($asset->atype, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->name)) echo htmlspecialchars($asset->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->department)) echo htmlspecialchars($asset->department_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                                    <td><?php if (isset($asset->branch)) echo htmlspecialchars($asset->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <?php } ?>
                                                <td>₱</td>
                                                <td><?php if (isset($asset->price)) echo htmlspecialchars(number_format($asset->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->price)) echo htmlspecialchars($asset->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->timestamp)) echo htmlspecialchars(date(DATE_CUSTOM, $asset->timestamp), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($asset->as_status)) echo htmlspecialchars($asset->status, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <?php if (isset($asset->asset_id)) { ?>
                                                        <a id="load" href="<?php if (isset($asset->asset_id)) echo URL . 'AMS/details/' . htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?>">DETAILS</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Init Pagination -->
                            <?php
                                if (isset($total)) {
                                    require APP . PAGINATION;
                                }
                            ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
</div>

