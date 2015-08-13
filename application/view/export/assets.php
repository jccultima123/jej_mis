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
                    <tbody class="searchable">
                        <?php foreach ($assets as $asset) { ?>
                            <tr>
                                <td><?php if (isset($asset->branch)) echo htmlspecialchars($asset->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->type)) echo htmlspecialchars($asset->atype, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->name)) echo htmlspecialchars($asset->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->price)) echo htmlspecialchars($asset->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->price)) echo htmlspecialchars(number_format($asset->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->qty)) echo htmlspecialchars(number_format($asset->price * $asset->qty), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($asset->timestamp)) echo htmlspecialchars(date(DATE_CUSTOM, $asset->timestamp), ENT_QUOTES, 'UTF-8'); ?></td>
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
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">PRODUCT INVENTORY</strong><br />
        </div>
        <div class="panel-body">
            <?php if (!empty($sales)) { ?>
                <table class="table-striped tb-compact" id="table3">
                    <thead>
                        <tr>
                            <th>PRODUCT NO.</th>
                            <th>MANUFACTURER</th>
                            <th>PRODUCT</th>
                            <th>MODEL</th>
                            <th>IN INVENTORY</th>
                            <th>SELLOUT / SOLD</th>
                            <th>DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sales as $sale) { ?>
                            <tr>
                                <td><?php if (isset($sale->product_id)) echo htmlspecialchars($sale->product_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->brand)) echo htmlspecialchars($sale->brand, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->product_name)) echo htmlspecialchars($sale->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->product_model)) echo htmlspecialchars($sale->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->inventory)) echo htmlspecialchars(number_format($sale->inventory), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->sellout)) echo htmlspecialchars(number_format($sale->sellout), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->created)) echo htmlspecialchars(date(DATE_CUSTOM, $sale->created), ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br />
                <div class="hidden-print">
                    <select class="selectpicker pull-right" data-style="btn-danger" data-width="120" onchange="doExport('#table3',{type: this.options[this.selectedIndex].value});" data-container="body">
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
        $(document).ready(function() {
            $('#table1').dataTable( {
                // don't forget the comma!
                <?php require VIEWS_PATH . '_script/column_filter.txt'; ?>,
                "paging": true,
                "jQueryUI": true,
                "searching": true,
                "ordering": true,
                "stateSave": true
            } );
            $('#table2').dataTable( {
                // don't forget the comma!
                <?php require VIEWS_PATH . '_script/column_filter.txt'; ?>,
                "paging": true,
                "jQueryUI": true,
                "searching": true,
                "ordering": true,
                "stateSave": true
            } );
            $('#table3').dataTable( {
                // don't forget the comma!
                <?php require VIEWS_PATH . '_script/column_filter.txt'; ?>,
                "paging": true,
                "jQueryUI": true,
                "searching": true,
                "ordering": true,
                "stateSave": true
            } );
            
            // For Custom Filtering
            // TODO - Return to original output when the form is blank
            
        } );
    </script>