<div class="container padding-fix">
    <?php if (!empty($results)) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong style="line-height:26px;">Sales Invoice #<?php echo $results->sales_id; ?></strong>
                <span class="pull-right" style="line-height: 26px;">
                    <strong><?php echo date(DATE_CUSTOM, $results->time); ?></strong><br />
                </span>
            </div>
            <div class="panel-body">
                <ul class="list-unstyled">
                    <li><label>Item:</label></li>
                    <li><?php echo $results->brand . ' ' . $results->product_name; ?> <span class="pull-right"><?php echo $results->price . ' x' . $results->qty;?></span></li>
                    <hr />
                    <li><label>Amount Due (x<?php echo $results->qty; ?>):</label> <span class="pull-right">Php <?php echo $results->price * $results->qty; ?></span></li>
                    <li style="padding-bottom: 3px;"><label>Cash :</label> <input type="text" class="" style="text-align: right; float: right;" /></li>
                    <li><label>Change :</label> <input type="text" class="" style="text-align: right; float: right;" value="0" /></li>
                </ul>
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