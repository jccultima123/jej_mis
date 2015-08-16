<script>
    var file = "<?php echo 'QUICK_SALES_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<script type="text/javascript" src="<?php echo URL; ?>assets_new/js/_MIS/SALES.js"></script>
    
<div class="container padding-fix">
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">Quick Sales Report</strong><br />
            Generated at <?php echo $_SESSION['branch']; ?>
            <span class="pull-right">
                <strong><?php echo date(DATE_CUSTOM); ?></strong><br />
            </span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Total Branch Sales
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled">
                                <li>Worth : ₱ <?php echo number_format($total_sales); ?></li>
                                <li>Largest Daily Sales occurred in:<br /><?php echo date(DATE_CUSTOM, $top_daily_sales->date); ?> worth ₱ <?php echo number_format($top_daily_sales->price); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Top Mostly Sold (Largest Item Sellout)
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled">
                                <li>Product: <?php echo $top_sales->brand . ' ' . $top_sales->product_name; ?></li>
                                <li>Count: <?php echo $top_sales->sellout; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="">
                <h6><strong>QUICK SALES TABLE</strong></h6>
                <table class="table-striped tb-compact" id="table2">
                    <thead>
                        <tr>
                            <th>BRANCH</th>
                            <th>ID</th>
                            <th>BRAND</th>
                            <th>PRODUCT</th>
                            <th>QTY</th>
                            <th>SRP</th>
                            <th>TOTAL AMT.</th>
                            <th>PROCESSED</th>
                            <th>CUSTOMER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sales as $sale) { ?>
                            <tr>
                                <td><?php if (isset($sale->branch)) echo htmlspecialchars($sale->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->sales_id)) echo htmlspecialchars($sale->sales_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->product_id)) echo htmlspecialchars($sale->brand, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->product_id)) echo htmlspecialchars($sale->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->qty)) echo htmlspecialchars($sale->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->SRP)) echo htmlspecialchars(number_format($sale->SRP), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->qty)) echo htmlspecialchars(number_format($sale->SRP * $sale->qty), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($sale->created)) echo date(DATE_MMDDYY, $sale->created); ?></td>
                                <td><?php if (isset($sale->customer_id)) echo $sale->last_name . ', ' . $sale->first_name . ' ' . substr($sale->middle_name, 0, 1) . '.'; ?></td>
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
            </div>
                
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
</div>

    <script type="text/javascript" charset="utf-8">
        var url = "<?php echo URL; ?>";
        $(document).ready(function() {
            $('#table2').dataTable( {
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
                "stateSave": true
            } );
        } );        
    </script>