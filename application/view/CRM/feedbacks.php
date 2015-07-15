<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Customer Relations</h4>
        </div>
        <div class="panel-body padding-fix">
            <div class="table">
                <div class="row">
                    <div class="col-md-2">
                        <br />
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <b>Please Select Action</b>
                                </div>
                                <ul class="list-group">
                                    <a id="load" class="list-group-item" href="<?php echo URL . 'CRM/feedbacks'; ?>">Manage Customers</a>
                                    <a class="list-group-item active"> >> Feedbacks</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <br />
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($feedbacks)) { ?>
                            <div style="overflow-x: auto; padding: 0;">
                                <table class="table table-striped table-hover sortable" id="full">
                                    <thead style="font-weight: bold;">
                                        <tr>
                                            <th>ID / TICKET</th>
                                            <th>FEEDBACK TYPE</th>
                                            <th>CUSTOMER</th>
                                            <th>EMAIL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($feedbacks as $feedback) { ?>
                                            <tr>
                                                <td><a><?php if (isset($feedback->feedback_id)) echo htmlspecialchars($feedback->feedback_id, ENT_QUOTES, 'UTF-8'); ?></a></td>
                                                <td><?php if (isset($feedback->type)) echo htmlspecialchars($feedback->type, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($feedback->type)) echo htmlspecialchars($feedback->type, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($feedback->email)) echo htmlspecialchars($feedback->email, ENT_QUOTES, 'UTF-8'); ?></td>
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
