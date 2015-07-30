<script>
    var file = "<?php echo 'QUICK_SALES_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
    
<div class="container padding-fix">
    <div class="panel panel-default">
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
                                <li>Product: <?php echo $top_sales->manufacturer_name . ' ' . $top_sales->product_name . ' ' . $top_sales->product_model; ?></li>
                                <li>Count: <?php echo $top_sales->sellout; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr /><h5>QUICK STOCKS TABLE</h5>
            <table class="hidden-print" style="width: 300px;">
                <label class="hidden-print">Custom filters</label>
                <tbody>
                    <tr>
                        <td>Starting Date:</td>
                        <td><input id="min" name="min" type="text"></td>
                    </tr>
                    <tr>
                        <td>Up to Date:</td>
                        <td><input id="max" name="max" type="text"></td>
                    </tr>
                </tbody>
            </table><br />
            <table class="table tb-compact display" id="full">
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
                            <td><?php if (isset($sale->manufacturer_name)) echo htmlspecialchars($sale->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($sale->product_name)) echo htmlspecialchars($sale->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($sale->product_model)) echo htmlspecialchars($sale->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($sale->inventory)) echo htmlspecialchars(number_format($sale->inventory), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($sale->sellout)) echo htmlspecialchars(number_format($sale->sellout), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($sale->created)) echo htmlspecialchars(date(DATE_DDMMYY, $sale->created), ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <hr /><h5>QUICK SALES TABLE</h5>
            <table class="table tb-compact" id="full">
                <thead style="font-weight: bold;">
                    <tr>
                        <th>ID</th>
                        <th>PRODUCT</th>
                        <th>QTY</th>
                        <th>SRP</th>
                        <th>PROCESSED</th>
                        <th>CUSTOMER</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($salestr as $sale) { ?>
                        <tr>
                            <td><?php if (isset($sale->sales_id)) echo htmlspecialchars($sale->sales_id, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($sale->product_id)) echo htmlspecialchars($sale->manufacturer_name . ' ' . $sale->product_name . ' / ' . $sale->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($sale->qty)) echo htmlspecialchars($sale->qty, ENT_QUOTES, 'UTF-8'); ?></td>

                            <td>₱<?php if (isset($sale->SRP)) echo htmlspecialchars(number_format($sale->SRP), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($sale->created)) echo date(DATE_MMDDYY, $sale->created); ?></td>
                            <td><?php if (isset($sale->customer_id)) echo $sale->last_name . ', ' . $sale->first_name . ' ' . substr($sale->middle_name, 0, 1) . '.'; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <script type="text/javascript" charset="utf-8">
        var url = "<?php echo URL; ?>";
        $(document).ready(function() {
            $('table#full').dataTable( {
                "paging": true,
                "jQueryUI": true,
                "searching": true,
                "ordering": false,
                "stateSave": false
            } );
            
            // For Custom Filtering
            // TODO - Return to original output when the form is blank
            
        } );
    </script>