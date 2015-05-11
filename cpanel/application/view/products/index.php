<div class="container">
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
            <div class="col-md-9" style="overflow-x: auto;">
                <h3 class="visible-lg visible-md">Products</h3>
                <?php $this->renderFeedbackMessages(); ?>
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
