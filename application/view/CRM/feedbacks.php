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
                                    <a id="load" class="list-group-item" href="<?php echo URL . 'CRM/customers'; ?>">Manage Customers</a>
                                    <a class="list-group-item active"> >> Feedbacks</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div style="overflow-x: auto; padding: 0;">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>             
