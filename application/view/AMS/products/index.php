<script>
    var file = "<?php echo 'PRODUCT_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<script type="text/javascript" src="<?php echo URL; ?>assets_new/js/_MIS/PRODUCTS.js"></script>

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
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>AMS/add/item">Add Product</a>
                <select class="selectpicker pull-right" data-style="btn-danger btn-sm" data-width="120" onchange="doExport('#products',{type: this.options[this.selectedIndex].value, ignoreColumn: [6,7]});" data-container="body" title="Export">
                    <option title="Export">Select Format</option>
                    <option value="csv" data-icon="">CSV</option>
                    <option value="excel" data-icon="">Excel</option>
                    <option value="pdf" data-icon="">PDF</option>
                </select>
            </div>
            <h4>ASSET MGT. / MAIN PRODUCT INVENTORY</h4>
        </div>
        <div class="panel-body padding-fix"><br />
            <div class="table">
                <div class="row">
                    <div class="col-md-12">
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($products)) { ?>
                            <div class="row-fluid table-responsive">
                                <table class="table table-striped tb-compact" id="products">
                                    <thead style="font-weight: bold;">
                                        <tr>
                                            <th>PRODUCT NO.</th>
                                            <th>CATEGORY</th>
                                            <th>BRAND</th>
                                            <th>NAME</th>
                                            <th>DP</th>
                                            <th>DEPR</th>
                                            <th>STOCKED</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products as $product) { ?>
                                            <tr>
                                                <td>
                                                    <?php if (isset($product->product_id)) { ?>
                                                        <?php echo htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>
                                                    <?php } ?>
                                                </td>
                                                <td><?php if (isset($product->category)) echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->brand)) echo htmlspecialchars($product->brand, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->DP)) echo htmlspecialchars(number_format($product->DP), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->depr_value)) echo htmlspecialchars(number_format($product->depr_value) . ' (Total DP: ' . number_format($product->DP - $product->depr_value) . ')', ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->inventory_count)) echo htmlspecialchars(number_format($product->inventory_count), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <select class="btn jcc-btn" onchange="location = this.options[this.selectedIndex].value;" data-container="body">
                                                        <option hidden disabled selected data-icon="glyphicon glyphicon-pencil"> &nbsp;Set Action</option>
                                                        <option value="<?php echo URL . 'AMS/product/details/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">View Details</option>
                                                        <option value="<?php echo URL . 'AMS/product/edit/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">Edit Record</option>
                                                        <option value="<?php echo URL . 'AMS/product/manageStock/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">Manage Stocks</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" data-href="<?php echo URL . 'AMS/product/delete/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>" data-toggle="modal" data-target="#confirm-delete">X</button>
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
    
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete / Cancel</h4>
            </div>
            <div class="modal-body">
                Are you sure about this?? If you do, please check other records occurred from this item.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
