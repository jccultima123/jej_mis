<script>
    var file = "<?php echo 'CONSUMER_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Customer Relations</h4>
            <strong><?php echo $_SESSION['branch']; ?></strong>
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
                                    <a class="list-group-item active"> >> Customers</a>
                                    <a id="load" class="list-group-item" href="<?php echo URL . 'CRM/feedbacks'; ?>">Manage Feedbacks</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <br />
                        <?php $this->renderFeedbackMessages(); ?>
                        <div style="overflow-x: auto; padding: 0;">
                            <table class="table table-striped table-hover sortable" id="full">
                                <thead style="font-weight: bold;">
                                    <tr>
                                        <th>ID</th>
                                        <th>CUSTOMER NAME</th>
                                        <th>BIRTHDAY</th>
                                        <th>REGISTERED</th>
                                        <th>ADDRESS</th>
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
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>             
