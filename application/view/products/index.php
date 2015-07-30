<script>
    var file = "<?php echo 'STOCK_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>

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
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>admin/addProduct">Add Product</a>
                <a id="load" class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#export"><span class="glyphicon glyphicon-book"></span> Generate Report</a>
            </div>
            <h4>OFFICIAL PRODUCT LISTS</h4>
        </div>
        <div class="panel-body padding-fix"><br />
            <div class="table">
                <div class="row">
                    <div class="col-md-12">
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($products)) { ?>
                            <div class="row-fluid table-responsive">
                                <table class="table" id="products">
                                    <thead style="font-weight: bold;">
                                        <tr>
                                            <th>PRODUCT NO.</th>
                                            <th>CATEGORY</th>
                                            <th>BRAND</th>
                                            <th>PRODUCT</th>
                                            <th>MODEL</th>
                                            <th>SRP</th>
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
                                                <td><?php if (isset($product->manufacturer_name)) echo htmlspecialchars($product->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->product_model)) echo htmlspecialchars($product->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($product->SRP)) echo htmlspecialchars(number_format($product->SRP), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <select class="selectpicker pull-right" data-style="btn-primary" data-width="60" onchange="location = this.options[this.selectedIndex].value;" data-container="body">
                                                        <option hidden disabled selected data-icon="glyphicon glyphicon-pencil"> &nbsp;Set Action</option>
                                                        <option value="<?php echo URL . 'admin/products/details/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">View Details</option>
                                                        <option value="<?php echo URL . 'admin/products/edit/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">Edit</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" data-href="<?php echo URL . 'admin/products/delete/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>" data-toggle="modal" data-target="#confirm-delete">X</button>
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
                Are you sure about this??
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
