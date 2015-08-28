<script>
    var file = "<?php echo 'CONSUMER_DATA_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
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
                <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExport('#full', {type: 'excel'});"> Export to Excel</a>
                <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExport('#full', {type: 'doc'});"> Export to Word</a>
                <a class="btn btn-default btn-block" href="javascript:void(0)" onClick="doExportPDF('#full', {type: 'pdf'});"> Export to PDF (Recommended)</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <a id="load" class="btn btn-danger" href="<?php echo URL . 'CRM/feedbacks'; ?>">Manage Feedbacks</a>
            </div>
            <h4>Customer Relations</h4>
            <strong>CUSTOMERS - <?php echo $_SESSION['branch']; ?></strong>
        </div>
        <div class="panel-body padding-fix">
            <div class="table">
                <div class="row">
                    <div class="col-md-12">
                        <br />
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($customers)) { ?>
                            <div class="table-responsive" style="overflow-x: auto; padding: 0;">
                                <table class="table table-striped tb-compact" id="full">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>CUSTOMER NAME</th>
                                            <th>BIRTHDAY</th>
                                            <th>REGISTERED</th>
                                            <th>ADDRESS</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($customers as $customer) { ?>
                                            <tr>
                                                <td><?php if (isset($customer->customer_id)) echo htmlspecialchars($customer->customer_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><a href="javascript:void(0)"><?php echo htmlspecialchars($customer->last_name . ', ' . $customer->first_name . ' ' . $customer->middle_name, ENT_QUOTES, 'UTF-8'); ?></a></td>
                                                <td><?php if (isset($customer->birthday)) echo htmlspecialchars($customer->birthday, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($customer->registered_date)) echo htmlspecialchars(date(DATE_COOKIE, $customer->registered_date), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($customer->address)) echo htmlspecialchars($customer->address, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <select class="btn jcc-btn" onchange="location = this.options[this.selectedIndex].value;">
                                                        <option hidden disabled selected data-icon="glyphicon glyphicon-pencil"> &nbsp;Set Action</option>
                                                        <option value="<?php echo URL . 'CRM/post/reply/' . htmlspecialchars($feedback->feedback_id, ENT_QUOTES, 'UTF-8'); ?>">Reply/Respond</option>
                                                    </select>
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
