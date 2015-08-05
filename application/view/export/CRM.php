<script>
    var file = "<?php echo 'CRM_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<script type="text/javascript" src="<?php echo URL; ?>assets_new/js/_MIS/CRM.js"></script>
    
<div class="container padding-fix">
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">CRM Report</strong><br />
            Generated at <?php echo $_SESSION['branch']; ?>
            <span class="pull-right">
                <strong><?php echo date(DATE_CUSTOM); ?></strong><br />
            </span>
        </div>
        <div class="panel-body">
            <div class="">
                <h5>FEEDBACKS</h5>
                <table class="table tb-compact" id="table1">
                    <thead style="font-weight: bold;">
                        <tr>
                            <th>ID / TICKET</th>
                            <th>FEEDBACK TYPE</th>
                            <th>PRIORITY</th>
                            <th>MSG.</th>
                            <th>FROM CUSTOMER</th>
                            <th>POSTED</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($feedbacks as $feedback) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($feedback->feedback_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($feedback->type)) echo htmlspecialchars($feedback->type, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($feedback->priority)) echo htmlspecialchars($feedback->priority, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($this->custom_echo($feedback->feedback_text, 50), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($feedback->customer_id)) echo $feedback->last_name . ', ' . $feedback->first_name . ' ' . substr($feedback->middle_name, 0, 1) . '.'; ?></td>
                                <td><?php if (isset($feedback->created)) echo htmlspecialchars(date(DATE_CUSTOM, $feedback->created), ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <h5>CUSTOMERS</h5>
                <table class="table tb-compact" id="table2">
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
                                <td><?php echo htmlspecialchars($customer->last_name . ', ' . $customer->first_name . ' ' . $customer->middle_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($customer->birthday)) echo htmlspecialchars($customer->birthday, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($customer->registered_date)) echo htmlspecialchars(date(DATE_COOKIE, $customer->registered_date), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($customer->address)) echo htmlspecialchars($customer->address, ENT_QUOTES, 'UTF-8'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
                
            <br />
            <div class="hidden-print">
                <select class="selectpicker pull-right" data-style="btn-danger" data-width="120" onchange="doExport('#table1',{type: this.options[this.selectedIndex].value});" data-container="body">
                    <option selected data-icon="glyphicon glyphicon-book"> &nbsp;Export</option>
                    <option value="csv" data-icon="">CSV</option>
                    <option value="excel" data-icon="">Excel</option>
                    <option value="pdf" data-icon="">PDF</option>
                </select>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript" charset="utf-8">
        var url = "<?php echo URL; ?>";
        $(document).ready(function() {
            $('#table1').dataTable( {
                "paging": true,
                "jQueryUI": true,
                "searching": true,
                "ordering": true,
                "stateSave": false
            } );
            $('#table2').dataTable( {
                "paging": true,
                "jQueryUI": true,
                "searching": true,
                "ordering": true,
                "stateSave": false
            } );
            
            // For Custom Filtering
            // TODO - Return to original output when the form is blank
            
        } );
    </script>