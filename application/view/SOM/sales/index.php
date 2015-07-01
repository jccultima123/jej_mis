<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Sales Transactions</h4>
        </div>
        <div class="panel-body padding-fix">
            <div class="table">
                <div class="row">
                    <div class="col-md-2">
                        <br />
                        <div class="panel-group" id="accordion">
                            <?php $this->renderFeedbackMessages(); ?>
                            <div class="panel">
                                <a id="load" class="btn btn-primary btn-block" href="<?php echo URL; ?>som/sales?a=add">Add</a>
                                <a id="load" class="btn btn-primary btn-block" href="<?php echo URL; ?>som/sales?a=request">Request Stocks</a>
                                <a id="load" class="btn btn-primary <?php if ($sales==NULL) echo 'disabled'; ?> btn-block" href="<?php echo URL; ?>som/export/sales">Create Reports</a>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <b>Total</b><span class="badge pull-right"><?php echo $transaction_count; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <br />
                        <?php if (!empty($sales)) { ?>
                            <div class="panel panel-default">
                                <!-- Default panel contents -->
                                <div style="overflow-y: auto;">
                                    <div class="input-group" style="padding: 5px;">
                                        <span class="input-group-btn">
                                            <a id="load" type="button" class="btn btn-default" href="<?php echo URL; ?>som/export/sales" target="">Create Report</a>
                                        </span>
                                        <form action="<?php echo URL; ?>som/sales/search" method="POST" class="input-group">
                                            <input type="text" class="form-control search" name="search" placeholder="Search...">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit" name="search">Go!</button>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="row-fluid table-responsive">
                                <table class="table table-striped table-hover sortable">
                                    <thead style="font-weight: bold;">
                                        <tr>
                                            <th style="cursor: pointer;">ID</th>
                                            <th style="cursor: pointer;">PRODUCT</th>
                                            <th style="cursor: pointer;">BRANCH</th>
                                            <th style="cursor: pointer;">QTY</th>
                                            <th class="sorttable_nosort"></th>
                                            <th style="cursor: pointer;">PRICE</th>
                                            <th style="cursor: pointer;">CREATED</th>
                                            <th style="cursor: pointer;">CUSTOMER</th>
                                            <th class="sorttable_nosort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($sales as $sale) { ?>
                                            <tr>
                                                <td><?php if (isset($sale->sales_id)) echo htmlspecialchars($sale->sales_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($sale->product_id)) echo htmlspecialchars($sale->manufacturer_name . ' ' . $sale->product_name . ' / ' . $sale->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($sale->branch)) echo htmlspecialchars($sale->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($sale->qty)) echo htmlspecialchars($sale->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>₱</td>
                                                <td><?php if (isset($sale->price)) echo htmlspecialchars(number_format($sale->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($sale->created)) echo date(DATE_MMDDYY, $sale->created); ?></td>
                                                <td><?php if (isset($sale->customer_id)) echo $sale->last_name . ', ' . $sale->first_name . ' ' . $sale->middle_name; ?></td>
                                                <td>
                                                    <?php if (isset($sale->sales_id)) { ?>
                                                        <a id="load" href="<?php if (isset($sale->sales_id)) echo URL . 'som/details/' . htmlspecialchars($sale->sales_id, ENT_QUOTES, 'UTF-8'); ?>">DETAILS</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php require APP . 'view/_templates/pager.php'; ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>             
