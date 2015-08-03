<div class="container" style="max-width: 600px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Customer Relations</h4>
        </div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Please Select Action</b>
                </div>
                <ul class="list-group">
                    <a id="load" class="list-group-item" href="<?php echo URL . 'CRM/customers'; ?>">Manage Customers</a>
                    <a id="load" class="list-group-item" href="<?php echo URL . 'CRM/feedbacks'; ?>">Manage Feedbacks</a>
                    <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                        <a id="load" class="list-group-item" href="<?php echo URL . 'CRM/feedbacks'; ?>">Generate Reports (Administrator Only)</a>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>             
