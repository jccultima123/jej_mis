<div class="container">
    
    <div class="modal bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="z-index: 100003;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add a product</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo URL; ?>products/add" method="POST" style="padding: 10px;" class="form-horizontal">
                        <form class="form-horizontal">
                            <fieldset>  
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Category</label>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="select" name="category" required="true">
                                            <option>Please select...</option>
                                            <option value="Mobile Phone">Mobile Phone</option>
                                            <option value="Smartphone">Smartphone</option>
                                            <option value="Tablet">Tablet</option>
                                            <option value="Accessory">Accessory</option>
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
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    
    <div class="table">
        <div class="row margin-fix">
            <div class="col-md-3">
                <br />
                <div class="panel panel-default panel-warning">
                    <div class="panel-heading"><b>REMINDER</b></div>
                    <div class="panel-body">
                        This page was only a DEMO, hence this will not be included in final product.
                    </div>
                </div>
            </div>
            <div class="panel panel-default visible-sm visible-xs">
                    <div class="panel-heading"><b>Products</b></div>
            </div>
            <div class="btn-group visible-sm visible-xs" role="group" aria-label="...">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg">Add a product</button>
                    <br /><br /><br />
            </div>
            <div class="col-md-9" style="overflow-x: auto;">
                <h3 class="visible-lg visible-md">Products</h3>
                <?php $this->renderFeedbackMessages(); ?>
                <div class="btn-group visible-lg visible-md" role="group" aria-label="...">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg">Add a product</button>
                    <br /><br /><br />
                </div>
                    <table class="table-striped sortable">
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
                                    <td><a href="<?php echo URL . 'products/delete/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">DELETE</a></td>
                                    <td><a href="<?php echo URL . 'products/edit/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">EDIT</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>        
                &nbsp;<h5 class="visible-lg visible-md"><i class="picol_script"></i> <a href="<?php echo URL; ?>dashboard/reports">View Full Report</a></h5>
            </div>
        </div><br />
    </div>             
</div>
