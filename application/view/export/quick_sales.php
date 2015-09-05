<script>
    var file = "<?php echo 'QUICK_SALES_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<script type="text/javascript" src="<?php echo URL; ?>assets_new/js/_MIS/SALES.js"></script>
    
<div class="container padding-fix">
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">Sales Report</strong><br />
            Generated at <?php echo $_SESSION['branch']; ?>
            <span class="pull-right">
            <strong><?php echo date(DATE_CUSTOM); ?></strong><br />
        </span>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Company Sales
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li>Worth : ₱ <?php echo number_format($total_sales); ?></li>
                            <li>Largest Daily Sales occurred in:<br /><?php echo date(DATE_CUSTOM, $top_daily_sales->date); ?> worth ₱ <?php echo number_format($top_daily_sales->price); ?></li>
                            <li>At : <?php echo $top_daily_sales->branch_name; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Sales Chart
                    </div>
                    <div class="panel-body">
                        Not yet available.
                    </div>
                </div>
            </div>
        </div>
        <br />

        <div class="panel panel-default no-border-print">
            <div class="panel-heading">
                <strong style="line-height:26px;">SALES</strong><br />
            </div>
            <div class="panel-body">
                <?php if (!empty($sales)) { ?>

                    <!-- Filter dates -->
                    <div>
                        <form class="form-horizontal">
                            <fieldset>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon input-sm"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;Filter</span><input type="text" style="width: 200px;" name="reportrange" id="reportrange" class="form-control" placeholder="Between.." value="<?php echo date(DATE_MMDDYY_C, $date->min_date) . ' - ' . date(DATE_MMDDYY_C, $date->max_date); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div><br />

                    <table class="table-striped tb-compact" id="table2">
                        <thead>
                        <tr>
                            <th>BRANCH</th>
                            <th>BRAND</th>
                            <th>PRODUCT</th>
                            <th>QTY</th>
                            <th>SRP</th>
                            <th>TOTAL</th>
                            <th>NET</th>
                            <th>PROCESSED</th>
                            <th>CUSTOMER</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($sales as $sale) { ?>
                            <tr>
                                <td><?php if (isset($sale->sale_branch)) echo htmlspecialchars($sale->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->product_id)) echo htmlspecialchars($sale->brand, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->product_id)) echo htmlspecialchars($sale->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->qty)) echo htmlspecialchars($sale->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->price)) echo htmlspecialchars(number_format($sale->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->qty)) echo htmlspecialchars(number_format($sale->price * $sale->qty), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->price)) echo htmlspecialchars(number_format($sale->price - $sale->DP), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->sales_done)) echo date(DATE_DDMMYY, $sale->sales_done); ?></td>
                                <td><?php if (isset($sale->customer_id)) echo $sale->customer_name; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot class="col-borderless">
                        <tr>
                            <th>BRANCH</th>
                            <th>ID</th>
                            <th>BRAND</th>
                            <th>PRODUCT</th>
                        </tr>
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
                <strong style="line-height:26px;">BRANCH'S STOCKS</strong><br />
            </div>
            <div class="panel-body">
                <?php if (!empty($sales)) { ?>

                    <table class="table-striped tb-compact" id="table3">
                        <thead>
                        <tr>
                            <th>PRODUCT NO.</th>
                            <th>MANUFACTURER</th>
                            <th>PRODUCT</th>
                            <th>IN INVENTORY</th>
                            <th>SELLOUT / SOLD</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($sales as $sale) { ?>
                            <tr>
                                <td><?php if (isset($sale->product_id)) echo htmlspecialchars($sale->product_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->brand)) echo htmlspecialchars($sale->brand, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->product_name)) echo htmlspecialchars($sale->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->inventory)) echo htmlspecialchars(number_format($sale->inventory), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->sellout)) echo htmlspecialchars(number_format($sale->sellout), ENT_QUOTES, 'UTF-8'); ?></td>
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
        <br />
        <div class="hidden-print">

        </div>

        <div class="panel panel-default no-border-print">
            <div class="panel-heading">
                <strong style="line-height:26px;">MAIN STOCKS</strong><br />
            </div>
            <div class="panel-body">
                <?php if (!empty($sales)) { ?>

                    <table class="table-striped tb-compact" id="table3">
                        <thead>
                        <tr>
                            <th>PRODUCT NO.</th>
                            <th>MANUFACTURER</th>
                            <th>PRODUCT</th>
                            <th>IN INVENTORY</th>
                            <th>SELLOUT / SOLD</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($sales as $sale) { ?>
                            <tr>
                                <td><?php if (isset($sale->product_id)) echo htmlspecialchars($sale->product_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->brand)) echo htmlspecialchars($sale->brand, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->product_name)) echo htmlspecialchars($sale->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->inventory)) echo htmlspecialchars(number_format($sale->inventory), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->sellout)) echo htmlspecialchars(number_format($sale->sellout), ENT_QUOTES, 'UTF-8'); ?></td>
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
        <br />
        <div class="hidden-print">

        </div>
    </div>
</div>

    <script type="text/javascript" charset="utf-8">
        var url = "<?php echo URL; ?>";
        $(document).ready(function() {
            var oTable=$('#table2').dataTable( {
                // don't forget the comma!
                <?php require VIEWS_PATH . '_script/column_filter.txt'; ?>,
                /*
                "columnDefs": [
                    {
                        // Hidden targets must be starts from zero to avoid confusion
                        "targets": [ 0 ],
                        "visible": false
                    }
                ],
                */
                "lengthMenu": [[-1, 25, 50, 100, 200], ["All", 25, 50, 100, 200]],
                "paging": true,
                "jQueryUI": false,
                "searching": true,
                "ordering": true,
                "stateSave": false,
                "pageLength": 25,
                "pagination": true
                //"sDom": "tp"
            } );
            //Targeted Date
            var datecolumn = 7;
            <?php require VIEWS_PATH . '_script/date_filter.txt'; ?>
        } );
    </script>