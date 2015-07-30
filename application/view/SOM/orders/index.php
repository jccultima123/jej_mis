<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>som/orders?a=add"><span class="glyphicon glyphicon-plus"></span> Add</a>
            </div>
            <h4>Order Transactions</h4>
            <strong><?php echo $_SESSION['branch']; ?></strong>
        </div>
        <div class="panel-body padding-fix">
            <div class="table">
                <div class="row">
                    <div class="col-md-12">
                        <br />
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($orders)) { ?>
                            <div class="row-fluid table-responsive">
                                <table class="table table-striped" id="full">
                                    <thead style="font-weight: bold;">
                                        <tr>
                                            <th style="cursor: pointer;">ID</th>
                                            <th style="cursor: pointer;">PRODUCT</th>
                                            <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                                <th style="cursor: pointer;">BRANCH</th>
                                            <?php } ?>
                                            <th style="cursor: pointer;">STK</th>
                                            <th class="sorttable_nosort"></th>
                                            <th style="cursor: pointer;">SRP</th>
                                            <th class="sorttable_nosort">PROCESSED</th>
                                            <th style="cursor: pointer;">STATUS</th>
                                            <th class="sorttable_nosort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders as $order) { ?>
                                            <tr>
                                                <td><?php if (isset($order->order_id)) echo htmlspecialchars($order->order_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($order->product_id)) echo htmlspecialchars($order->manufacturer_name . ' ' . $order->product_name . ' / ' . $order->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                                    <td><?php if (isset($order->order_branch)) echo htmlspecialchars($order->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <?php } ?>
                                                <td><?php if (isset($order->order_stocks)) echo htmlspecialchars($order->order_stocks, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>₱</td>
                                                <td><?php if (isset($order->SRP)) echo htmlspecialchars(number_format($order->SRP), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($order->order_date)) echo date(DATE_MMDDYY, $order->order_date); ?></td>
                                                <td><?php if (isset($order->order_stats)) echo htmlspecialchars($order->status, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <?php if (isset($order->order_id)) { ?>
                                                        <a id="load" href="<?php if (isset($order->order_id)) echo URL . 'som/orders?details=' . htmlspecialchars($order->order_id, ENT_QUOTES, 'UTF-8'); ?>">DETAILS</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>             
