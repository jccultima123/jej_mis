<form action="<?php echo URL; ?>mis/login" method="post" autocomplete="on">
    <div class="form-group has-feedback">
        <input id="required" type="text" name="user_name" class="form-control username" placeholder="Username or Email" required />
    </div>
    <select class="form-control selectpicker" id="select" name="user_provider_type" required>
        <option disabled selected hidden>Please Select Module..</option>
        <option value="SOM">Sales and Order Management</option>
        <option value="ASSET">Asset Management</option>
        <option value="CRM">Customer Relations Management</option>
    </select><br /><br />
    <div class="form-group has-feedback">
        <input id="required" type="password" name="user_password" class="form-control password" placeholder="Password" required />
    </div>
    <input type="submit" name="submit" class="btn btn-primary submit" value="LOGIN" onclick="return validate()" id="page_loader_submit" />
</form>