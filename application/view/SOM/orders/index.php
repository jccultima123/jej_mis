<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>som/orders?a=add"><span class="glyphicon glyphicon-plus"></span> Add</a>
                <a id="load" class="btn btn-primary <?php if ($orders==NULL) { echo 'disabled'; } ?>" href="<?php echo URL; ?>som/export/orders"><span class="glyphicon glyphicon-book"></span> Create Report</a>
            </div>
            <h4>Order Transactions</h4>
        </div>
        <div class="panel-body padding-fix">
            <div class="table">
                <div class="row">
                    <div class="col-md-2">
                        <br />
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>Orders Count</b>
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        Our Branch <span class="badge pull-right"><?php echo $transaction_count_by_branch; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <br />
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($orders)) { ?>
                            <div class="panel panel-default">
                                <!-- Default panel contents -->
                                <div style="overflow-y: auto;">
                                    <div class="input-group" style="padding: 5px;">
                                        <span class="input-group-btn">
                                            <a id="load_timed" type="button" class="btn btn-default" href="#"><span class="glyphicon glyphicon-refresh"></span></a>
                                        </span>
                                        <input type="text" class="form-control search" name="search" placeholder="Search...">
                                    </div>
                                </div>
                            </div>

                            <div class="row-fluid table-responsive">
                                <table class="table table-striped table-hover sortable">
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
                                            <th style="cursor: pointer;">SHIPPED</th>
                                            <th style="cursor: pointer;">STATUS</th>
                                            <th style="cursor: pointer;">ACCEPTED</th>
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
                                                <td><?php if (isset($order->stocks)) echo htmlspecialchars($order->stocks, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>₱</td>
                                                <td><?php if (isset($order->srp)) echo htmlspecialchars(number_format($order->srp), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($order->order_date)) echo date(DATE_MMDDYY, $order->order_date); ?></td>
                                                <td><?php if (isset($order->shipped_date)) echo date(DATE_MMDDYY, $order->shipped_date); ?></td>
                                                <td><?php if (isset($order->order_stats)) echo htmlspecialchars($order->status, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                  <?php if (isset($order->accepted) && ($order->accepted != 0)) {
                                                      echo 'YES';
                                                  } else {
                                                      echo 'NO';
                                                  } ?>
                                                </td>
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
                            <!-- Init Pagination -->
                            <?php require APP . PAGINATION; ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>             
