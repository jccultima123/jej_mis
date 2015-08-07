<script>
    var file = "<?php echo 'QUICK_ORDERS_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<script type="text/javascript" src="<?php echo URL; ?>assets_new/js/_MIS/ORDERS.js"></script>

<div class="container padding-fix">
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">Quick Order Report</strong><br />
            Generated at <?php echo $_SESSION['branch']; ?>
            <span class="pull-right">
                <strong><?php echo date(DATE_CUSTOM); ?></strong><br />
            </span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Total Orders
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled">
                                <li><strong>Entire Orders:</strong> <?php echo $transaction_count; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Latest Order Occurred
                        </div>
                        <div class="panel-body">
                            <?php if (!empty($latest_order)) { ?>
                                <ul class="list-unstyled">
                                    <li><strong>Product:</strong> <?php echo $latest_order->brand . ' ' . $latest_order->product_name . ' ' . $latest_order->product_model; ?></li>
                                    <li><strong>Count:</strong> About <?php echo $latest_order->stocks; ?></li>
                                    <li><strong>Ordered:</strong> <?php echo date(DATE_CUSTOM, $latest_order->order_date); ?></li>
                                    <li><strong>Where:</strong> <?php echo $latest_order->branch_name; ?></li>
                                    <li><strong>Status:</strong> <?php echo $latest_order->status; ?></li>
                                </ul>
                            <?php } else { ?>
                                None
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!empty($orders)) { ?>
                <hr /><h5>QUICK ORDER TABLE</h5>
                <table class="table-striped tb-compact" id="table1">
                    <thead>
                        <tr>
                            <th>BRANCH</th>
                            <th>PRODUCT</th>
                            <th>STK</th>
                            <th></th>
                            <th>DP</th>
                            <th>PROCESSED</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) { ?>
                            <tr>
                                <td><?php if (isset($order->order_branch)) echo htmlspecialchars($order->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($order->product_id)) echo htmlspecialchars($order->brand . ' ' . $order->product_name . ' / ' . $order->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($order->order_stocks)) echo htmlspecialchars($order->order_stocks, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>₱</td>
                                <td><?php if (isset($order->SRP)) echo htmlspecialchars(number_format($order->SRP), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($order->order_date)) echo date(DATE_CUSTOM, $order->order_date); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>BRANCH</th>
                            <th>PRODUCT</th>
                        </tr>
                    </tfoot>
                </table>
                <br />
                <div class="hidden-print">
                    <select class="selectpicker pull-right" data-style="btn-danger" data-width="120" onchange="doExport('#full',{type: this.options[this.selectedIndex].value});" data-container="body">
                        <option selected data-icon="glyphicon glyphicon-book"> &nbsp;Export</option>
                        <option value="csv" data-icon="">CSV</option>
                        <option value="excel" data-icon="">Excel</option>
                        <option value="pdf" data-icon="">PDF</option>
                    </select>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

    <script type="text/javascript" charset="utf-8">
        var url = "<?php echo URL; ?>";
        $(document).ready(function() {
            $('table#table1').dataTable( {
                // don't forget the comma!
                <?php require VIEWS_PATH . '_script/column_filter.js'; ?>,
                "paging": true,
                "jQueryUI": false,
                "searching": true,
                "ordering": true,
                "stateSave": false
            } );
            
            // For Custom Filtering
            // TODO - Return to original output when the form is blank
            
        } );
    </script>