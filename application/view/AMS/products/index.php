<!-- MODALS -->
<div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="export">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal" aria-label="Close">Cancel</button>
                <h4 class="modal-title">Export</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    <strong>NOTE: </strong>
                    If you want to export all available data, make sure the<br /><br /> <button class="btn btn-primary"><span class="glyphicon glyphicon-info-sign"></span> Expand All: is On</button>.
                </div>
                <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExport('#full',{type:'excel'});"> Export to Excel</a>
                <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExport('#full',{type:'doc'});"> Export to Word</a>
                <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExportPDF('#full',{type:'pdf'});"> Export to PDF (Recommended)</a>
            </div>
        </div>
    </div>
</div>

    <!-- Redirectable Dialog -->
    <div class="modal" id="linkdialog" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>AMS/add/product"><span class="glyphicon glyphicon-plus"></span> Add</a>
                <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#export"><span class="glyphicon glyphicon-book"></span> Export</a>
                <?php if (isset($total)) { ?><a id="load" class="btn btn-default" href="<?php echo URL; ?>AMS/products?page=full"><span class="glyphicon glyphicon-info-sign"></span> Expand All: is Off</a>
                <?php } else { ?><a id="load" class="btn btn-primary" href="<?php echo URL; ?>AMS/products?page=1"><span class="glyphicon glyphicon-info-sign"></span> Expand All: is On</a><?php } ?>
            </div>
            <h4>ASSET MGT. -- PRODUCT INVENTORY</h4>
            <strong>This is all list of stocks from Main Branch</strong>
        </div>
        <div class="panel-body padding-fix"><br />
            <div class="table">
                <div class="row">
                    <div class="col-md-2">
                        <a id="load" class="btn btn-primary btn-block" href="<?php echo URL . 'AMS'; ?>">Go back to Assets</a><br />
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Stock Records</b>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Today <span class="badge pull-right"><?php echo 'NONE'; ?></span>
                                </li>
                                <li class="list-group-item">
                                    This week <span class="badge pull-right"><?php echo 'NONE'; ?></span>
                                </li>
                                <li class="list-group-item">
                                    This month <span class="badge pull-right"><?php echo 'NONE'; ?></span>
                                </li>
                                <li class="list-group-item">
                                    Total <span class="badge pull-right"><?php echo 'NONE'; ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion" href="#p1"><b>Total Products</b><span class="badge pull-right"><?php echo $product_count; ?></span></a>
                            </div>
                            <ul id="p1" class="list-group list-unstyled panel-collapse collapse in">
                                <?php foreach ($product_by_category as $category) { ?>
                                    <li class="list-group-item"><?php if (isset($category->name)) echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?> <span class="badge pull-right"><?php echo $category->count; ?></span><li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a class="accortion-toggle" data-toggle="collapse" data-parent="#accordion" href="#p2"><b>Product Tally by Manufacturer</b><i class="indicator glyphicon glyphicon-chevron-down pull-right"></i></a>
                            </div>
                            <ul id="p2" class="list-group list-unstyled panel-collapse collapse out">
                                <?php foreach ($manufacturers as $manufacturer) { ?>
                                    <li class="list-group-item"><?php echo htmlspecialchars($manufacturer->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?> <span class="badge pull-right"><?php echo $manufacturer->count; ?></span></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($products)) { ?>
                            <!--
                            <div class="panel panel-default">
                                <div style="overflow-y: auto;">
                                    <div class="input-group" style="padding: 5px;">
                                        <span class="input-group-btn">
                                            <a id="load_timed" type="button" class="btn btn-default" href="#"><span class="glyphicon glyphicon-refresh"></span></a>
                                        </span>
                                        <input type="text" class="form-control search" name="search" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                            -->

                            <div class="row-fluid table-responsive">
                                <table class="table table-striped table-hover sortable" id="full">
                                    <thead style="font-weight: bold;">
                                        <tr>
                                            <th style="cursor: pointer;">NO.</th>
                                            <th style="cursor: pointer;">CATEGORY</th>
                                            <th style="cursor: pointer;">MANUF.</th>
                                            <th style="cursor: pointer;">PRODUCT</th>
                                            <th style="cursor: pointer;">MODEL</th>
                                            <th style="cursor: pointer;">STATUS</th>
                                            <th class="sorttable_nosort">SRP</th>
                                            <th class="sorttable_nosort">INVENTORY</th>
                                            <th class="sorttable_nosort">SELLOUT</th>
                                            <th class="sorttable_nosort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products as $product) { ?>
                                            <tr>
                                                <td><?php if (isset($product->product_id)) echo htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->category)) echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->manufacturer_name)) echo htmlspecialchars($product->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->product_model)) echo htmlspecialchars($product->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->status_id)) echo htmlspecialchars($product->status, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->SRP)) echo htmlspecialchars(number_format($product->SRP), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->stocks)) echo htmlspecialchars($product->stocks, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <?php if (isset($product->product_id)) { ?>
                                                        <a data-toggle="modal" data-target="#linkdialog" href="<?php if (isset($product->product_id)) echo URL . 'AMS/productDetails/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">DETAILS</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Init Pagination -->
                            <?php
                                if (isset($total)) {
                                    require APP . PAGINATION;
                                }
                            ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
</div>             
