<div class="container" style="max-width: 900px;">
    <div class="table">
        <h3 class="text-center">Sales and Order Management</h3><hr />
        <div class="row">
            <div class="col-md-12">
                <div>
                    <?php $this->renderFeedbackMessages(); ?>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-unstyled panel panel-default">
                            <li><a id="load" class="list-group-item" href="<?php echo URL; ?>som/sales">I am looking for SALES</a></li>
                            <li><a id="load" class="list-group-item" href="<?php echo URL; ?>som/orders">I am looking for ORDERS</a></li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-5">
                            <div class="panel panel-info">
                                <div class="panel-heading">Pending</div>
                                <?php
                                    echo '<div class="panel-body">No requests available.</div>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


