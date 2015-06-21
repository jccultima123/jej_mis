<div class="container animated bounceInDown" id="login_wrapper">
    <div class="panel panel-default" id="login_dialog">
        <div class="panel-heading">
            <b style="font-size: 28px;">JEJ // <span class="mobilizer_logo">MOBILIZER</span></b><br />
            <a id="load" href="<?php echo URL; ?>development"><b class="mobilizer_logo"><?php echo file_get_contents(URL . 'mis_version'); ?></b></a><br />
        </div>
        <div class="panel-body" id="login-body">
            <?php $this->renderFeedbackMessages(); ?>
            <h5>MANAGEMENT MODULE</h5>
            <?php View::detectUser(); ?>
            <br />
            <a href="<?php echo URL; ?>registration" class="btn btn-default btn-block">NEW? REGISTER HERE</a>
            <a id="logout" class="btn btn-default btn-block" href="<?php echo URL . 'passwordAction/forgot' ?>">Wait, i forgot my password already.</a>
            <a href="<?php echo URL; ?>admin" class="btn btn-primary btn-block">Administrator Panel</a>
        </div>
        <div class="panel-footer">
            (C) JEJ CELLMANIA TRADING CORPORATION
        </div>
    </div>
</div>


