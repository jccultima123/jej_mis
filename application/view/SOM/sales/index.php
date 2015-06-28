<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Sales</h4>
        </div>
        <div class="panel-body padding-fix">
            <div class="table">
                <div class="row">
                    <div class="col-md-2">
                        <br />
                        <div class="panel-group" id="accordion">
                            <?php $this->renderFeedbackMessages(); ?>
                            <div class="panel">
                                <a id="load" class="btn btn-primary btn-block" href="<?php echo URL; ?>som/sales?action=addSales">Create / Add</a>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#p1"><b>Total Sales</b><span class="badge pull-right"><?php echo $amount_of_sales; ?></span></a>
                                </div>
                                <ul id="p1" class="list-group panel-collapse collapse in">
                                    <?php foreach ($sales_by_category as $category) { ?>
                                        <a class="list-group-item"><?php if (isset($category->name)) echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?> <span class="badge pull-right"><?php echo $category->count; ?></span></a>
                                    <?php } ?>
                                </ul>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a class="accortion-toggle" data-toggle="collapse" data-parent="#accordion" href="#p2"><b>Product Tally by Manufacturer</b><i class="indicator glyphicon glyphicon-chevron-down pull-right"></i></a>
                                </div>
                                <ul id="p2" class="list-group panel-collapse collapse out">
                                    <?php foreach ($manufacturers as $manufacturer) { ?>
                                        <a class="list-group-item"><?php echo htmlspecialchars($manufacturer->manu_name, ENT_QUOTES, 'UTF-8'); ?> <span class="badge pull-right"><?php echo $manufacturer->count; ?></span></a>
                                    <?php } ?>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-10">
                        <br />
                        <?php if(!empty($allsales)) { ?>
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
                                                <button class="btn btn-default" type="submit" name="search_products">Go!</button>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body" style="overflow-x: auto; padding: 0;">
                                    <table class="table-bordered table-hover sortable">
                                        <thead style="font-weight: bold;">
                                            <tr>
                                                <th style="cursor: pointer;">ID</th>
                                                <th style="cursor: pointer;">CATEGORY</th>
                                                <th style="cursor: pointer;">MANUFACTURER</th>
                                                <th style="cursor: pointer;">PRODUCT</th>
                                                <th style="cursor: pointer;">MODEL</th>
                                                <th style="cursor: pointer;">BRANCH</th>
                                                <th style="cursor: pointer;">IMEI</th>
                                                <th style="cursor: pointer;">STATUS</th>
                                                <th class="sorttable_nosort"></th>
                                                <th style="cursor: pointer;">PRICE</th>
                                                <th style="cursor: pointer;">UPDATED</th>
                                                <th class="sorttable_nosort"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($allsales as $sales) { ?>
                                                <tr>
                                                    <td><?php if (isset($sales->sales_id)) echo htmlspecialchars($sales->sales_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?php if (isset($sales->category)) echo htmlspecialchars($sales->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?php if (isset($sales->manufacturer)) echo htmlspecialchars($sales->manu_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?php if (isset($sales->product_name)) echo htmlspecialchars($sales->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?php if (isset($sales->product_model)) echo htmlspecialchars($sales->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?php if (isset($sales->branch)) echo htmlspecialchars($sales->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?php if (isset($sales->IMEI)) echo htmlspecialchars($sales->IMEI, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?php if (isset($sales->status)) echo htmlspecialchars($sales->status, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td>₱</td>
                                                    <td><?php if (isset($sales->price)) echo htmlspecialchars(number_format($sales->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?php if (isset($sales->latest_timestamp)) echo date(DATE_MMDDYY, $sales->latest_timestamp); ?></td>
                                                    <td>
                                                        <?php if (isset($sales->sales_id)) { ?>
                                                            <a id="load" href="<?php if (isset($sales->sales_id)) echo URL . 'som/salesdetail/' . htmlspecialchars($sales->sales_id, ENT_QUOTES, 'UTF-8'); ?>">DETAILS</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
