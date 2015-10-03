<div class="container">
    <h3><span class="glyphicon glyphicon-wrench"></span>&nbsp;Setup Wizard</h3>
    <ol class="breadcrumb">
        <li><a href="..">Home</a></li>
        <li class="active">System Installation</li>
    </ol>
    <hr />
    <div class="row">
        <div class="col-md-3">

            <ul class="list-group list-group-item-info">
                <li class="list-group-item">
                    <a href="1">STEP 1 : License Agreement</a>
                </li>
                <li class="list-group-item active">
                    STEP 2 : System Check
                </li>
                <li class="list-group-item">
                    STEP 3 : Configurations
                </li>
                <li class="list-group-item">
                    STEP 4 : Finish
                </li>
            </ul>

        </div>
        <div class="col-md-9">
            <?php $this->renderFeedbackMessages(); ?>
            <h4>System Check</h4>
            <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Current</th>
                        <th>Required</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PHP Version:</td>
                        <td><?php echo phpversion(); ?></td>
                        <td>5.3.7+</td>
                        <td><?php echo (phpversion() >= '5.3.7') ? 'Ok' : '<span class="text-warning">Not Ok</span>'; ?></td>
                    </tr>
                    <tr>
                        <td>Session Auto Start:</td>
                        <td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
                        <td>Yes (must be Off)</td>
                        <td><?php echo (!ini_get('session_auto_start')) ? 'Ok' : '<span class="text-warning">Not Ok</span>'; ?></td>
                    </tr>
                    <tr>
                        <td>MySQL Extension:</td>
                        <td><?php echo extension_loaded('mysql') ? 'On' : 'Off'; ?></td>
                        <td>Yes</td>
                        <td><?php echo extension_loaded('mysql') ? 'Ok' : '<span class="text-warning">Not Ok</span>'; ?></td>
                    </tr>
                    <tr>
                        <td>GD:</td>
                        <td><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></td>
                        <td>Yes</td>
                        <td><?php echo extension_loaded('gd') ? 'Ok' : '<span class="text-warning">Not Ok</span>'; ?></td>
                    </tr>
                    <tr>
                        <td>DB.sql (Database File)</td>
                        <td><?php echo file_exists('DB.sql') ? 'Exists' : 'Not exists'; ?></td>
                        <td>Yes</td>
                        <td><?php echo file_exists('DB.sql') ? 'Ok' : '<span class="text-warning">Not Ok</span>'; ?></td>
                    </tr>
                    <tr>
                        <td>config.php</td>
                        <td><?php echo is_writable('config.php') ? 'Writable' : 'Unwritable'; ?></td>
                        <td>Writable</td>
                        <td><?php echo is_writable('config.php') ? 'Ok' : '<span class="text-warning">Not Ok</span>'; ?></td>
                    </tr>
                </tbody>
            </table><br />
            <form action="2" method="post">
                <input hidden type="hidden" name="pre_error" id="pre_error" value="<?php echo $pre_error;?>" />
                <?php if (isset($pre_error)) { ?>
                    <a class="btn btn-danger" href="javascript:void(0);" onclick="location.href=''">Refresh</a>
                <?php } else { ?>
                    <input class="btn btn-primary" type="submit" name="continue" value="Continue" />
                <?php } ?>
            </form>
        </div>
    </div>
</div>
