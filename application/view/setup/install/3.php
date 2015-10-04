
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
                    <li class="list-group-item">
                        <a href="2">STEP 2 : System Check</a>
                    </li>
                    <li class="list-group-item active">
                        STEP 3 : Configurations
                    </li>
                    <li class="list-group-item disabled">
                        <a>STEP 4 : Finish</a>
                    </li>
                </ul>

            </div>
            <div class="col-md-9">
                <?php $this->renderFeedbackMessages(); ?>
                <form class="" method="post" action="3">
                    <div class="form-group has-feedback">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="database_host">Database Host</label>
                                <input class="form-control required" type="text" name="database_host" placeholder="e.g: localhost or 127.0.0.1" value="<?php echo (isset($_POST['database_host'])) ? $_POST['database_host'] : ''; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="database_username">Database Username</label>
                                <input class="form-control required" type="text" name="database_username" value="<?php echo (isset($_POST['database_username'])) ? $_POST['database_username'] : ''; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="database_password">Database Password</label>
                                <input class="form-control" type="password" name="database_password" value="<?php echo (isset($_POST['database_password'])) ? $_POST['database_password'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="database_name">Database Name</label>
                        <input class="form-control required" type="text" name="database_name" placeholder="Recommended Prefix: db_" value="<?php echo (isset($_POST['database_name'])) ? $_POST['database_name'] : ''; ?>">
                        <label for="username">Admin Username</label>
                        <input class="form-control required" type="text" name="admin_name" value="<?php echo (isset($_POST['admin_name'])) ? $_POST['admin_name'] : ''; ?>">
                        <label for="password">Admin Password</label>
                        <input class="form-control required" name="admin_password" type="password" max="15" value="<?php echo (isset($_POST['admin_passwordi'])) ? $_POST['admin_password'] : ''; ?>">
                    </div>
                    <div class="form-group has-feedback pull-right">
                        <input class="btn btn-primary" type="submit" name="connect" value="Test Connection">
                        <input class="btn btn btn-primary submit" type="submit" name="submit" value="Install!" id="install">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style type="text/css">

    </style>

    <div class="modal installer" style="padding: 8px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Collecting Data</h4>
                    <div class="progress progress-popup">
                        <div class="progress-bar progress-bar-striped progress-bar-danger active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $("input#install").click(function () {
            $(".installer").show();
        });
    </script>
