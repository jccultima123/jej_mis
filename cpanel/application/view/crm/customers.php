<div class="container">
    <div class="modal bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>crm/customers">Cancel</a>
                    <h4 class="modal-title" id="myModalLabel">Customer Information</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo URL; ?>products/add" method="POST" style="padding: 10px;" class="form-horizontal">
                        <fieldset>  
                            <div class="form-group">
                                <label class="col-md-3 control-label">Category</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="select" name="category" required="true">
                                        <option disabled selected hidden value="">Please select...</option>
                                        <?php foreach ($categories as $category) { ?>
                                            <option class="option" value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">SKU</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="SKU" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Manufacturer</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="manufacturer_name" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Product Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="product_name" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Product Model</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="product_model" placeholder="e.g. Model No. of Device" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Price</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">PhP</span>
                                        <input type="number" class="form-control" name="price" placeholder="0" min="1" max="999999" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Link</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="link" placeholder="http://" />
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($products->product_id, ENT_QUOTES, 'UTF-8'); ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <input class="btn btn-primary" type="submit" name="submit_add_product" value="Add" />
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <!-- Redirectable Dialog -->
    <div class="modal" id="linkdialog" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>

    <div class="table">
        <div class="row">
            <div class="col-md-12">
                <h3>Customers</h3>
                
                <?php $this->renderFeedbackMessages(); ?>

                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading" style="overflow-y: auto; padding: 0px;">
                        <div class="input-group" style="padding: 5px;">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</button>
                                <a type="button" class="btn btn-default" href="" target="_blank">Create Report</a>
                            </span>
                            <form action="<?php echo URL; ?>products/search" method="POST" class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="search_products">Go!</button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body" style="overflow-x: auto; padding: 0;">
                        <table class="table-bordered table-hover sortable">
                            <thead style="font-weight: bold;">
                                <tr>
                                    <th style="cursor: pointer;">NO.</th>
                                    <th style="cursor: pointer;">LAST NAME</th>
                                    <th style="cursor: pointer;">FIRST NAME</th>
                                    <th style="cursor: pointer;">MIDDLE NAME</th>
                                    <th style="cursor: pointer;">BIRTHDAY</th>
                                    <th style="cursor: pointer;">ADDRESS</th>
                                    <th style="cursor: pointer;">REGISTERED</th>
                                    <th class="sorttable_nosort">DETAILS</th>
                                    <th class="sorttable_nosort"></th>
                                    <th class="sorttable_nosort"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($customers as $customer) { ?>
                                    <tr>
                                        <td><?php if (isset($customer->customer_id)) echo htmlspecialchars($customer->customer_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($customer->cust_last_name)) echo htmlspecialchars($customer->cust_last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($customer->cust_first_name)) echo htmlspecialchars($customer->cust_first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($customer->cust_middle_name)) echo htmlspecialchars($customer->cust_middle_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($customer->birthday)) echo htmlspecialchars(date("F j, Y", strtotime($customer->birthday)), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($customer->customer_address)) echo htmlspecialchars($customer->customer_address, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($customer->registered_date)) echo htmlspecialchars(date("F j, Y, g:i a", strtotime($customer->registered_date)), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><a data-toggle="modal" data-target="#linkdialog" href="<?php echo URL . 'customers/details/' . htmlspecialchars($customer->customer_id, ENT_QUOTES, 'UTF-8'); ?>">HERE</a></td>
                                        <td><a href="<?php echo URL . 'customers/delete/' . htmlspecialchars($customer->customer_id, ENT_QUOTES, 'UTF-8'); ?>">DELETE</a></td>
                                        <td><a data-toggle="modal" data-target="#linkdialog" href="<?php echo URL . 'customers/edit/' . htmlspecialchars($customer->customer_id, ENT_QUOTES, 'UTF-8'); ?>">EDIT</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div><br />

            </div>
        </div>
    </div><br />
</div>
