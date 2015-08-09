<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>som/sales?a=add"><span class="glyphicon glyphicon-plus"></span> Add</a>
            </div>
            <h4>Sales Transactions</h4>
            <strong><?php echo $_SESSION['branch']; ?></strong>
        </div>
        <div class="panel-body padding-fix">
            <div class="table">
                <div class="row">
                    <div class="col-md-12">
                        <br />
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($sales)) { ?>
                            <div class="row-fluid table-responsive">
                                <table class="table table-striped" id="sales">
                                    <thead style="font-weight: bold;">
                                        <tr>
                                            <th>ID</th>
                                            <th>PRODUCT</th>
                                            <th>BRANCH</th>
                                            <th>QTY</th>
                                            <th>SRP</th>
                                            <th>PROCESSED</th>
                                            <th>CUSTOMER</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($sales as $sale) { ?>
                                            <tr>
                                                <td><?php if (isset($sale->sales_id)) echo htmlspecialchars($sale->sales_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($sale->product_id)) echo htmlspecialchars($sale->brand . ' ' . $sale->product_name . ' / ' . $sale->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($sale->sale_branch)) echo htmlspecialchars($sale->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($sale->qty)) echo htmlspecialchars($sale->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($sale->price)) echo htmlspecialchars(number_format($sale->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($sale->sales_done)) echo date(DATE_CUSTOM, $sale->sales_done); ?></td>
                                                <td><?php if (isset($sale->customer_id)) echo $sale->last_name . ', ' . $sale->first_name . ' ' . substr($sale->middle_name, 0, 1) . '.'; ?></td>
                                                <td>
                                                    <select class="btn jcc-btn" onchange="location = this.options[this.selectedIndex].value;">
                                                        <option hidden disabled selected data-icon="glyphicon glyphicon-pencil"> &nbsp;Set Action</option>
                                                        <option value="<?php echo URL . 'som/sales?details=' . htmlspecialchars($sale->sales_id, ENT_QUOTES, 'UTF-8'); ?>">View Details</option>
                                                        <option value="<?php echo URL . 'som/sales?edit=' . htmlspecialchars($sale->sales_id, ENT_QUOTES, 'UTF-8'); ?>">Edit</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" data-href="<?php echo URL . 'som/sales?del=' . htmlspecialchars($sale->sales_id, ENT_QUOTES, 'UTF-8'); ?>" data-toggle="modal" data-target="#confirm-delete">X</button>
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
