<div class="container">
    <div class="modal bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 100003;" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>admin/products">Cancel</a>
                    <h4 class="modal-title" id="myModalLabel">Add a product</h4>
                </div>
                <div class="modal-body">
                    
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
                            <form action="<?php echo URL; ?>admin/products/search" method="POST" class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="<?php echo $search; ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="search_products">Go!</button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body" style="overflow-x: auto; padding: 0;">
                    <?php if(!empty($search)) { ?>
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
                                        <td><?php if (isset($product->name)) echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
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
                    <?php } ?>
                    </div>
                </div><br />
                    
                </div>
            </div>
        </div><br />
    </div>             
</div>
