<script>
    var file = "<?php echo 'ASSET_QUICK_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<script type="text/javascript" src="<?php echo URL; ?>assets_new/js/_MIS/AMS.js"></script>

<!-- HIDE THIS CRAP FIRST -->
<div style="display: none;">
    <?php $this->renderFeedbackMessages(); ?>
</div>

<div class="container padding-fix">
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">Quick Asset Report</strong><br />
            Generated at <?php echo $_SESSION['branch']; ?>
            <span class="pull-right">
                <strong><?php echo date(DATE_CUSTOM); ?></strong><br />
            </span>
        </div>
    </div>
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">ASSETS</strong><br />
        </div>
        <div class="panel-body">
            <?php if (!empty($assets)) { ?>
            
                <!-- Filter dates -->
                <div>
                    <form class="form-horizontal">
                        <fieldset>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="input-prepend input-group">
                                        <span class="add-on input-group-addon input-sm"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;Filter</span><input type="text" style="width: 200px;" name="reportrange" id="reportrange" class="form-control" placeholder="Between.." />
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div><br />
            
                <table class="table-striped tb-compact" id="table1">
                    <thead>
                        <tr>
                            <th>BRANCH</th>
                            <th>TYPE</th>
                            <th>ITEM</th>
                            <th>QTY</th>
                            <th>PRICE</th>
                            <th>TOTAL AMT.</th>
                            <th>LATEST DATE</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($assets as $asset) { ?>
                            <tr>
                                <td><?php if (isset($asset->branch)) echo htmlspecialchars($asset->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->type)) echo htmlspecialchars($asset->atype, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->name)) echo htmlspecialchars($asset->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->price)) echo htmlspecialchars($asset->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->price)) echo htmlspecialchars(number_format($asset->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->qty)) echo htmlspecialchars(number_format($asset->price * $asset->qty), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->timestamp)) echo htmlspecialchars(date(DATE_DDMMYY, $asset->timestamp), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->as_status)) echo htmlspecialchars($asset->status, ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <th>BRANCH</th>
                        <th>TYPE</th>
                    </tfoot>
                </table>
                <br />
                <div class="hidden-print">
                    <select class="selectpicker pull-right" data-style="btn-danger" data-width="120" onchange="doExport('#table1',{type: this.options[this.selectedIndex].value});" data-container="body">
                        <option selected data-icon="glyphicon glyphicon-book"> &nbsp;Export</option>
                        <option value="csv" data-icon="">CSV</option>
                        <option value="excel" data-icon="">Excel</option>
                        <option value="pdf" data-icon="">PDF</option>
                    </select>
                </div>
            <?php } else { ?>
                <strong>No any records yet.</strong>
            <?php } ?>
        </div>
    </div>
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">CURRENT PRODUCTS AVAILABLE TO ORDER</strong><br />
        </div>
        <div class="panel-body">
            <?php if (!empty($products)) { ?>
                <table class="table-striped tb-compact" id="table2">
                    <thead>
                        <tr>
                            <th>CATEGORY</th>
                            <th>BRAND</th>
                            <th>PRODUCT</th>
                            <th>DP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) { ?>
                            <tr>
                                <td><?php if (isset($product->category)) echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->brand)) echo htmlspecialchars($product->brand, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->DP)) echo htmlspecialchars(number_format($product->DP), ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <th>CATEGORY</th>
                        <th>BRAND</th>
                    </tfoot>
                </table>
                <br />
                <div class="hidden-print">
                    <select class="selectpicker pull-right" data-style="btn-danger" data-width="120" onchange="doExport('#table2',{type: this.options[this.selectedIndex].value});" data-container="body">
                        <option selected data-icon="glyphicon glyphicon-book"> &nbsp;Export</option>
                        <option value="csv" data-icon="">CSV</option>
                        <option value="excel" data-icon="">Excel</option>
                        <option value="pdf" data-icon="">PDF</option>
                    </select>
                </div>
            <?php } else { ?>
                <strong>No any records yet.</strong>
            <?php } ?>
        </div>
    </div>
</div>

    <script type="text/javascript" charset="utf-8">
        var url = "<?php echo URL; ?>";
    </script>
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/_MIS/report/AMS.js"></script>