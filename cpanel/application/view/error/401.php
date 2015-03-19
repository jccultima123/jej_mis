<style>
    html {background-color: gold;}
    .container {border: 1px solid gold;}
</style>

<div class="container" style="background-color: transparent;">
    <p>
        You have no access here.<br />
        Unless you are logged in. You can <a href="<?php echo URL; ?>home/login">LOGIN</a> here<br />
        Or else, please contact your Administrator for details.<br /><br />
        ERROR CODE: 401
        <br /><br /><a href="<?php echo URL; ?>" class="back">&larr; Go Back</a>
    </p>
</div>
