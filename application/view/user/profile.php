<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6 col-md-3">
                    <a href="" class="thumbnail">
                        <img src="../../../img/preloader.gif" alt="<?php echo $details->user_name; ?>">
                    </a>
                </div>
                <div class="col-md-9">
                    <h4><?php echo $details->first_name . ' ' . $details->last_name; ?></h4>
                    <ul class="list-unstyled">
                        <li>User: <?php echo $details->user_name; ?> / <?php echo $details->user_email; ?></li>
                        <li>Designated Branch: <?php echo $details->branch_name; ?> </li>
                        <li><?php ?></li>
                    </ul>
                </div>
            </div>
            <?php $this->renderFeedbackMessages(); ?>
        </div>
        <div class="panel-body">
            <div class="alert alert-info">
                Not yet Available. Still more updates are coming. Stay tuned.
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>

