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
                    STEP 4 : Process
                </li>
                <li class="list-group-item">
                    Finish
                </li>
            </ul>

        </div>
        <div class="col-md-9">
            <?php $this->renderFeedbackMessages(); ?>
            <h4>System Check</h4>
            <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <td></td>
                        <td>Current</td>
                        <td>Requires</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <tr>
                    <td>PHP Version:</td>
                    <td><?php echo phpversion(); ?></td>
                    <td>5.3.7+</td>
                    <td><?php echo (phpversion() >= '5.3.7') ? 'Ok' : 'Not Ok'; ?></td>
                </tr>
                <tr>
                    <td>Session Auto Start:</td>
                    <td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
                    <td>Off</td>
                    <td><?php echo (!ini_get('session_auto_start')) ? 'Ok' : 'Not Ok'; ?></td>
                </tr>
                <tr>
                    <td>MySQL Extension:</td>
                    <td><?php echo extension_loaded('mysql') ? 'On' : 'Off'; ?></td>
                    <td>On</td>
                    <td><?php echo extension_loaded('mysql') ? 'Ok' : 'Not Ok'; ?></td>
                </tr>
                <tr>
                    <td>GD:</td>
                    <td><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></td>
                    <td>On</td>
                    <td><?php echo extension_loaded('gd') ? 'Ok' : 'Not Ok'; ?></td>
                </tr>
                <tr>
                    <td>config.php</td>
                    <td><?php echo is_writable('config.php') ? 'Writable' : 'Unwritable'; ?></td>
                    <td>Writable</td>
                    <td><?php echo is_writable('config.php') ? 'Ok' : 'Not Ok'; ?></td>
                </tr>
            </table><br />
            <form action="2" method="post">
                <input class="btn btn-primary" type="submit" name="continue" value="Continue" />
            </form>
        </div>
    </div>
</div>
