<script>
    var file = "<?php echo 'ASSET_QUICK_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<script type="text/javascript" src="<?php echo URL; ?>assets_new/js/_MIS/AMS.js"></script>

<div class="container padding-fix">
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">Quick Asset Report -- <?php echo date(DATE_CUSTOM); ?></strong><br />
            <strong>Generated at <?php echo $_SESSION['branch']; ?></strong>
        </div>
    </div>
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">ASSETS</strong><br />
        </div>
        <div class="panel-body">
            <table class="table-striped tb-compact" id="table1">
                <thead style="font-weight: bold;">
                    <tr>
                        <th style="cursor: pointer;">TYPE</th>
                        <th style="cursor: pointer;">ITEM</th>
                        <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                            <th style="cursor: pointer;">BRANCH</th>
                        <?php } ?>
                        <th style="cursor: pointer;">QTY</th>
                        <th style="cursor: pointer;">PRICE</th>
                        <th style="cursor: pointer;">TOTAL AMT.</th>
                        <th class="sorttable_nosort">LATEST DATE</th>
                        <th class="sorttable_nosort">STATUS</th>
                    </tr>
                </thead>
                <tbody class="searchable">
                    <?php foreach ($assets as $asset) { ?>
                        <tr>
                            <td><?php if (isset($asset->type)) echo htmlspecialchars($asset->atype, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($asset->name)) echo htmlspecialchars($asset->name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                <td><?php if (isset($asset->branch)) echo htmlspecialchars($asset->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <?php } ?>
                            <td><?php if (isset($asset->price)) echo htmlspecialchars($asset->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($asset->price)) echo htmlspecialchars(number_format($asset->price), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($asset->qty)) echo htmlspecialchars(number_format($asset->price * $asset->qty), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($asset->timestamp)) echo htmlspecialchars(date(DATE_CUSTOM, $asset->timestamp), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($asset->as_status)) echo htmlspecialchars($asset->status, ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
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
        </div>
    </div>
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">CURRENT PRODUCTS AVAILABLE TO TRADE</strong><br />
        </div>
        <div class="panel-body">
            <table class="table-striped tb-compact" id="table2">
                <thead style="font-weight: bold;">
                    <tr>
                        <th>CATEGORY</th>
                        <th>BRAND</th>
                        <th>PRODUCT</th>
                        <th>MODEL</th>
                        <th>SRP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) { ?>
                        <tr>
                            <td><?php if (isset($product->category)) echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($product->brand)) echo htmlspecialchars($product->brand, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($product->product_model)) echo htmlspecialchars($product->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($product->SRP)) echo htmlspecialchars(number_format($product->SRP), ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
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
        </div>
    </div>
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">PRODUCT INVENTORY</strong><br />
        </div>
        <div class="panel-body">
            <?php if (!empty($sales)) { ?>
                <table class="table-striped tb-compact" id="table3">
                    <thead style="font-weight: bold;">
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
                "paging": true,
                "jQueryUI": true,
                "searching": true,
                "ordering": true,
                "stateSave": false
            } );
            $('#table2').dataTable( {
                "paging": true,
                "jQueryUI": true,
                "searching": true,
                "ordering": true,
                "stateSave": false
            } );
            $('#table3').dataTable( {
                "paging": true,
                "jQueryUI": true,
                "searching": true,
                "ordering": true,
                "stateSave": false
            } );
            
            // For Custom Filtering
            // TODO - Return to original output when the form is blank
            
        } );
    </script>