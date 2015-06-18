<form action="<?php echo URL; ?>mis/login" method="post" autocomplete="on">
    <input type="text" name="user_name" class="form-control" pattern=".{5,}" placeholder="Username or Email" /><br />
    <select class="form-control selectpicker" id="select" name="user_provider_type" required="true">
        <option disabled selected hidden>Please Select Module..</option>
        <option value="SOM">Sales and Order Management</option>
        <option value="ASSET">Asset Management</option>
        <option value="CRM">Customer Relations Management</option>
    </select><br /><br />
    <div class="input-group">
        <input type="password" name="user_password" class="form-control" pattern=".{5,}" placeholder="Password" /><br />
        <span class="input-group-btn">
            <input type="submit" name="submit" class="btn btn-primary" value="LOGIN" id="page_loader_submit" />
        </span>
    </div>
</form>