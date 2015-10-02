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
                    <li class="list-group-item active">
                        STEP 1 : License Agreement
                    </li>
                    <li class="list-group-item">
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
                <p>
                    <?php echo file_get_contents('license.php'); ?>
                </p>
                <form action="1" method="post">
                    <p>
                        <input type="checkbox" name="agree" required />
                        I agree to the license
                    </p>
                    <input class="btn btn-primary" type="submit" value="Continue" />
                </form>
            </div>
        </div>
    </div>