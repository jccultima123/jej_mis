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
                                <table class="table table-striped" id="orders">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PRODUCT</th>
                                            <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                                <th>BRANCH</th>
                                            <?php } ?>
                                            <th>STK</th>
                                            <th>SRP</th>
                                            <th>PROCESSED</th>
                                            <th>STATUS</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders as $order) { ?>
                                            <tr>
                                                <td><?php if (isset($order->order_id)) echo htmlspecialchars($order->order_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($order->product_id)) echo htmlspecialchars($order->brand . ' ' . $order->product_name . ' / ' . $order->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                                    <td><?php if (isset($order->order_branch)) echo htmlspecialchars($order->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <?php } ?>
                                                <td><?php if (isset($order->order_stocks)) echo htmlspecialchars($order->order_stocks, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($order->SRP)) echo htmlspecialchars(number_format($order->SRP), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($order->order_date)) echo date(DATE_CUSTOM, $order->order_date); ?></td>
                                                <td><?php if (isset($order->order_stats)) echo htmlspecialchars($order->status, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <td>
                                                        <select class="btn jcc-btn" onchange="location = this.options[this.selectedIndex].value;">
                                                            <option hidden disabled selected data-icon="glyphicon glyphicon-pencil"> &nbsp;Set Action</option>
                                                            <option value="<?php echo URL . 'som/orders?details=' . htmlspecialchars($order->order_id, ENT_QUOTES, 'UTF-8'); ?>">View Details</option>
                                                            <option value="<?php echo URL . 'som/orders?edit=' . htmlspecialchars($order->order_id, ENT_QUOTES, 'UTF-8'); ?>">Edit</option>
                                                        </select>
                                                    </td>
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
