<script>
    var file = "<?php echo 'QUICK_SALES_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<script type="text/javascript" src="<?php echo URL; ?>assets_new/js/_MIS/AMS.js"></script>
    
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
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Mostly Sold Product
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled">
                                <li>Sales Count: </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <h5>QUICK STOCKS TABLE</h5>
            <table class="hidden-print" style="width: 300px;">
                <label class="hidden-print">Custom filters</label>
                <tbody>
                    <tr>
                        <td>Minimum age:</td>
                        <td><input id="min" name="min" type="text"></td>
                    </tr>
                    <tr>
                        <td>Maximum age:</td>
                        <td><input id="max" name="max" type="text"></td>
                    </tr>
                </tbody>
            </table><br />
            <table class="table tb-compact" id="full">
                <thead style="font-weight: bold;">
                    <tr>
                        <th style="cursor: pointer;">PRODUCT NO.</th>
                        <th style="cursor: pointer;">MANUFACTURER</th>
                        <th style="cursor: pointer;">PRODUCT</th>
                        <th style="cursor: pointer;">MODEL</th>
                        <th class="sorttable_nosort">IN INVENTORY</th>
                        <th class="sorttable_nosort">SELLOUT / SOLD</th>
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
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>