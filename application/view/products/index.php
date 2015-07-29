<script>
    var file = "<?php echo 'STOCK_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>

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

<div class="container-fluid static-container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#export"><span class="glyphicon glyphicon-book"></span> Generate Report</a>
            </div>
            <h4>ASSET MGT. -- PRODUCT INVENTORY</h4>
            <strong><?php echo $_SESSION['branch']; ?></strong>
        </div>
        <div class="panel-body padding-fix"><br />
            <div class="table">
                <div class="row">
                    <div class="col-md-2">
                        <a id="load" class="btn btn-primary btn-block" href="<?php echo URL . 'AMS'; ?>">Go back to Assets</a><br />
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
                                            <th style="cursor: pointer;">INV. NO.</th>
                                            <th style="cursor: pointer;">PRODUCT NO.</th>
                                            <th style="cursor: pointer;">CATEGORY</th>
                                            <th style="cursor: pointer;">MANUF.</th>
                                            <th style="cursor: pointer;">PRODUCT</th>
                                            <th style="cursor: pointer;">MODEL</th>
                                            <th class="sorttable_nosort">SRP</th>
                                            <th class="sorttable_nosort">STOCKS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products as $product) { ?>
                                            <tr>
                                                <td>
                                                    <?php if (isset($product->line_id)) { ?>
                                                        <?php echo htmlspecialchars($product->line_id, ENT_QUOTES, 'UTF-8'); ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if (isset($product->product_id)) { ?>
                                                        <a data-toggle="modal" data-target="#linkdialog" href="<?php if (isset($product->product_id)) echo URL . 'AMS/inventory/details/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?></a>
                                                    <?php } ?>
                                                </td>
                                                <td><?php if (isset($product->category)) echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->manufacturer_name)) echo htmlspecialchars($product->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->product_model)) echo htmlspecialchars($product->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->SRP)) echo htmlspecialchars(number_format($product->SRP), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <?php if (isset($product->inventory)) { ?>
                                                        <a data-toggle="modal" data-target="#linkdialog" href="<?php if (isset($product->line_id)) { echo URL . 'AMS/getStocks/' . htmlspecialchars($product->line_id, ENT_QUOTES, 'UTF-8'); } ?>"><?php echo htmlspecialchars($product->inventory, ENT_QUOTES, 'UTF-8'); ?></a>
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
    </div>
        
</div>             
