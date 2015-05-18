<div class="container">
    <div class="modal bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 100003;" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>products">Cancel</a>
                    <h4 class="modal-title" id="myModalLabel">Add a product</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo URL; ?>products/add" method="POST" style="padding: 10px;" class="form-horizontal">
                        <fieldset>  
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Category</label>
                                <div class="col-lg-9">
                                    <select class="form-control" id="select" name="category" required="true">
                                        <option disabled selected hidden value="">Please select...</option>
                                        <?php foreach ($categories as $category) { ?>
                                            <option class="option" value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">SKU</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="SKU" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Manufacturer</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="manufacturer_name" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Product Name</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="product_name" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Product Model</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="product_model" placeholder="e.g. Model No. of Device" required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Price</label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">PhP</span>
                                        <input type="number" class="form-control" name="price" placeholder="0" min="1" max="999999" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Link</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="link" placeholder="http://" />
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($products->product_id, ENT_QUOTES, 'UTF-8'); ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-9 col-lg-offset-3">
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
    <div class="modal" id="linkdialog" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 100003;" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                
            </div>
        </div>
    </div>
    
    <div class="table">
        <div class="row">
            <div class="col-md-3">
                <br />
                <div class="panel-group" id="accordion">
                    
                    <div class="panel panel-default panel-warning" id="alert">
                        <div class="panel-heading"><b>REMINDER</b>
                        </div>
                        <div class="panel-body">
                            This page was only a DEMO, hence this will not be included in final product.
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#p1"><b>Total Products</b><span class="badge pull-right"><?php echo $amount_of_products; ?></span></a>
                        </div>
                        <ul id="p1" class="list-group panel-collapse collapse in">
                            <?php foreach ($categories as $category) { ?>
                                <li class="list-group-item"><?php if (isset($category->name)) echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?> <span class="badge pull-right"><?php echo $category->count ?></span></li>
                            <?php } ?>
                        </ul>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a class="accortion-toggle" data-toggle="collapse" data-parent="#accordion" href="#p2"><b>Product Tally by Manufacturer</b><i class="indicator glyphicon glyphicon-chevron-down pull-right"></i></a>
                        </div>
                        <ul id="p2" class="list-group panel-collapse collapse out">
                            <?php foreach ($manufacturers as $manufacturer) { ?>
                                <li class="list-group-item"><?php echo htmlspecialchars($manufacturer->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?> <span class="badge pull-right"><?php echo $manufacturer->count; ?></span></li>
                            <?php } ?>
                        </ul>
                    </div>
                    
                </div>
            </div>

            <div class="col-md-9">
                <h3>Products</h3>
                <?php $this->renderFeedbackMessages(); ?>
                
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading" style="overflow-y: auto; padding: 0px;">
                        <div class="input-group" style="padding: 5px;">
                            <span class="input-group-btn">
                                <button id="load" type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg">Add a product</button>
                                <button id="load" type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg">Create Report</button>
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
                                    <th>NO.</th>
                                    <th>CATEGORY</th>
                                    <th>SKU</th>
                                    <th>MANUFACTURER</th>
                                    <th>PRODUCT</th>
                                    <th>MODEL</th>
                                    <th class="sorttable_nosort">PRICE</th>
                                    <th class="sorttable_nosort">LINK</th>
                                    <th class="sorttable_nosort"></th>
                                    <th class="sorttable_nosort"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) { ?>
                                    <tr class="">
                                        <td><?php if (isset($product->product_id)) echo htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($product->category)) echo htmlspecialchars($product->category, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($product->SKU)) echo htmlspecialchars($product->SKU, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($product->manufacturer_name)) echo htmlspecialchars($product->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($product->product_model)) echo htmlspecialchars($product->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>P<?php if (isset($product->price)) echo htmlspecialchars(number_format($product->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php if (isset($product->link)) { ?>
                                                <a href="<?php if (isset($product->link)) echo htmlspecialchars($product->link, ENT_QUOTES, 'UTF-8'); ?>" target="<?php
                                                if (isset($product->link)) {
                                                    echo '_blank';
                                                } else {
                                                    echo '';
                                                }
                                                ?>">HERE</a>
                                               <?php } ?>
                                        </td>
                                        <td><a id="load" href="<?php echo URL . 'products/delete/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">DELETE</a></td>
                                        <td><a id="load" data-toggle="modal" data-target="#linkdialog" href="<?php echo URL . 'products/edit/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">EDIT</a></td>
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
</div>
