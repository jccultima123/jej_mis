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
                <li class="list-group-item disabled">
                    <a>STEP 1 : License Agreement</a>
                </li>
                <li class="list-group-item disabled">
                    <a>STEP 2 : System Check</a>
                </li>
                <li class="list-group-item disabled">
                    <a>STEP 3 : Configurations</a>
                </li>
                <li class="list-group-item active">
                    STEP 4 : Finish
                </li>
            </ul>

        </div>
        <div class="col-md-9">
            <form action="finish" method="post">
                <h4>Nicely Done!</h4>
                <p>
                    System Installation is complete. You may now using the JEJ // MIS at the moment you press the Finish button
                </p>
                <?php if (isset($msg)) {
                    echo '<span class="text-muted"><br /><p>Additional Message:</p>';
                    echo (isset($msg)) ? $msg . '</span>' : NULL;
                }; ?>
                <hr />
                <p>
                    <input type="checkbox" name="run_now" />
                    I would like to run the JEJ // MIS System<br />
                    <input type="checkbox" name="readme" />
                    I want to see update logs
                </p>
                <div class="btn-group pull-right">
                    <input class="btn btn-primary" type="submit" name="finish" value="Finish" />
                    <input class="btn btn-primary" type="submit" name="start" value="Start Over" />
                </div>
            </form>
        </div>
    </div>
</div>