<script>
    var file = "<?php echo 'QUICK_ORDERS_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<script type="text/javascript" src="<?php echo URL; ?>assets_new/js/_MIS/ORDERS.js"></script>

<div class="container padding-fix">
    <?php if (!empty($results)) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong style="line-height:26px;">Sales Invoice #<?php echo $results->sales_id; ?></strong>
                <span class="pull-right" style="line-height: 26px;">
                    <strong><?php echo date(DATE_CUSTOM); ?></strong><br />
                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-default no-border-print">
                            <div class="panel-heading">
                                Sales Details
                            </div>
                            <div class="panel-body">
                                <ul class="list-unstyled">
                                    <li><label>Sales Timestamp:</label> <?php echo $results->time; ?></li>
                                    <li><label>Product Information:</label> <?php echo $results->brand . ' ' . $results->product_name; ?>, <?php echo $results->price . ' x' . $results->qty . ' = ' . $results->price * $results->qty; ?></li>
                                    <li><label>Amount Due:</label> Php <?php echo $results->price * $results->qty; ?></li>
                                    <li><label>Cash :</label> _________________________________</li>
                                    <li><label>Change :</label> _________________________________</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <!--
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong style="line-height:26px;">OOPS!</strong>
            </div>
            <div class="panel-body">
                No results found.
            </div>
        </div>
        -->
    <?php } ?>
</div>