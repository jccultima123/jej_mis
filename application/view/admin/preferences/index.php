<div class="container-fluid" style="max-width: 800px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Preferences and Tools</h4>
        </div>
        <div class="panel-body">
            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    <li><a href="#core" data-toggle="tab">Core</a></li>
                    <li class="active"><a href="#database" data-toggle="tab">Database</a></li>
                    <li><a href="#user" data-toggle="tab">Users</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="core">
                        <h4>Core Preferences</h4>
                        <?php $this->renderFeedbackMessages(); ?>
                        <h6>SYSTEM PROGRESS</h6>
                        <div class="progress">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%">
                                <span>35% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane active" id="database">
                        <a id="form_submit" type="button" class="btn btn-primary pull-right" href="<?php echo URL; ?>admin">Go back</a>
                        <h4>System Database</h4>
                        <?php $this->renderFeedbackMessages(); ?>
                        Consists of Data for all submodules.
                        <hr />
                        <strong>BRANCHES</strong><br /><br />
                        <form action="<?php echo URL; ?>panel/salesAction" class="form-horizontal" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Category</label>
                                    <div class="col-lg-5">
                                        <select class="form-control selectpicker" id="select" name="category" required="true">
                                            <?php foreach ($categories as $category) { ?>
                                                <?php if ($category->id == $sales->category) { ?>
                                                    <option class="option" selected value="<?php echo $sales->category; ?>"><?php echo $category->name; ?></option>
                                                <?php } if ($category->id != $sales->category) { ?>
                                                    <option class="option" value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <label class="col-lg-1 control-label">Status</label>
                                    <div class="col-lg-4">
                                        <select class="form-control selectpicker" id="select" name="status_id" required="true">
                                            <?php foreach ($status as $st) { ?>
                                                <?php if ($st->id == $sales->status_id) { ?>
                                                    <option class="option" selected value="<?php echo $sales->status_id; ?>"><?php echo $st->status; ?></option>
                                                <?php } if ($st->id != $sales->status_id) { ?>
                                                    <option class="option" value="<?php echo $st->id; ?>"><?php echo $st->status; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">SKU</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="SKU" value="<?php echo htmlspecialchars($sales->SKU, ENT_QUOTES, 'UTF-8'); ?>" required="true">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="tab-pane" id="user">
                        <h4>Users</h4>
                        <?php $this->renderFeedbackMessages(); ?>
                        Coming Soon.
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>

