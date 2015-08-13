<script type="text/javascript" charset="utf-8">
    var file = "<?php echo 'CRM_DATA_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>

<!-- Redirectable Dialog -->
<div class="modal" id="linkdialog" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <a id="load" class="btn btn-danger" href="<?php echo URL . 'CRM/customers'; ?>">Manage Customers</a>
                <a id="load" class="btn btn-primary" href="<?php echo URL; ?>AMS/export/assets"><span class="glyphicon glyphicon-book"></span> Generate Reports</a>
            </div>
            <h4>Customer Relations</h4>
            <strong>FEEDBACKS - <?php echo $_SESSION['branch']; ?></strong>
        </div>
        <div class="panel-body padding-fix">
            <div class="table">
                <div class="row">
                    <div class="col-md-12">
                        <br />
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($feedbacks)) { ?>
                            <div class="table-responsive" style="overflow-x: auto; padding: 0;">
                                <table class="table table-striped" id="feedbacks">
                                    <thead>
                                        <tr>
                                            <th>ID / TICKET</th>
                                            <th>FEEDBACK TYPE</th>
                                            <th>PRIORITY</th>
                                            <th>MSG.</th>
                                            <th>FROM CUSTOMER</th>
                                            <th>POSTED</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($feedbacks as $feedback) { ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($feedback->feedback_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($feedback->type)) echo htmlspecialchars($feedback->type, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($feedback->priority)) echo htmlspecialchars($feedback->priority, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><a href="<?php if (isset($feedback->feedback_text)) echo URL . 'CRM/post/details/' . $feedback->feedback_id; ?>"><?php echo htmlspecialchars($this->custom_echo($feedback->feedback_text, 50), ENT_QUOTES, 'UTF-8'); ?></a></td>
                                                <td><?php if (isset($feedback->customer_id)) echo $feedback->last_name . ', ' . $feedback->first_name . ' ' . substr($feedback->middle_name, 0, 1) . '.'; ?></td>
                                                <td><?php if (isset($feedback->created)) echo htmlspecialchars(date(DATE_CUSTOM, $feedback->created), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <select class="selectpicker pull-right" data-style="btn-primary" data-width="60" onchange="location = this.options[this.selectedIndex].value;" data-container="body">
                                                        <option hidden disabled selected data-icon="glyphicon glyphicon-pencil"> &nbsp;Set Action</option>
                                                        <option value="<?php echo URL . 'CRM/post/details/' . $feedback->feedback_id; ?>">View Details</option>
                                                        <option value="<?php echo URL . 'CRM/post/history/' . $feedback->feedback_id; ?>">View Response History</option>
                                                        <option value="<?php echo URL . 'CRM/post/reply/' . htmlspecialchars($feedback->feedback_id, ENT_QUOTES, 'UTF-8'); ?>">Reply/Respond</option>
                                                        <option value="<?php echo URL . 'CRM/post/delete/' . htmlspecialchars($feedback->feedback_id, ENT_QUOTES, 'UTF-8'); ?>">Delete</option>
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
