<script type="text/javascript" charset="utf-8">
    var file = "<?php echo 'CRM_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
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

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#export"><span class="glyphicon glyphicon-book"></span> Export</a>
                <a id="load" class="btn btn-primary" href="<?php echo URL . 'CRM/feedbacks'; ?>">Manage Customers</a>
            </div>
            <h4>Customer Relations</h4>
        </div>
        <div class="panel-body padding-fix">
            <div class="table">
                <div class="row">
                    <div class="col-md-12">
                        <br />
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($feedbacks)) { ?>
                            <div style="overflow-x: auto; padding: 0;">
                                <table class="table table-striped table-hover" id="feedbacks">
                                    <thead style="font-weight: bold;">
                                        <tr>
                                            <th>ID / TICKET</th>
                                            <th>FEEDBACK TYPE</th>
                                            <th>PRIORITY</th>
                                            <th>MSG.</th>
                                            <th>FROM CUSTOMER</th>
                                            <th>POSTED</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($feedbacks as $feedback) { ?>
                                            <tr>
                                                <td><a data-toggle="modal" data-target="#linkdialog" href="<?php if (isset($feedback->feedback_id)) { echo URL . 'CRM/details/feedback/' . htmlspecialchars($feedback->feedback_id, ENT_QUOTES, 'UTF-8'); } ?>"><?php echo htmlspecialchars($feedback->feedback_id, ENT_QUOTES, 'UTF-8'); ?></a></td>
                                                <td><?php if (isset($feedback->type)) echo htmlspecialchars($feedback->type, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($feedback->priority)) echo htmlspecialchars($feedback->priority, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($feedback->feedback_text)) echo htmlspecialchars($feedback->feedback_text, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($feedback->customer_id)) echo $feedback->last_name . ', ' . $feedback->first_name . ' ' . substr($feedback->middle_name, 0, 1) . '.'; ?></td>
                                                <td><?php if (isset($feedback->created)) echo htmlspecialchars(date(DATE_CUSTOM, $feedback->created), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <select class="selectpicker pull-right" data-style="btn-primary" data-width="60" onchange="location = this.options[this.selectedIndex].value;" data-container="body">
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
