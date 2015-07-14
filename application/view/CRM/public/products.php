                        <div class="panel panel-default" style="max-height: 410px; overflow-x: auto;">
                            <div class="panel-heading">
                                AS OF <?php echo date(DATE_CUSTOM, $latest_prod_time); ?>
                            </div>
                            <table class="table table-bordered table-hover sortable">
                                <thead style="font-weight: bold;">
                                    <tr>
                                        <th style="cursor: pointer;">CATEGORY</th>
                                        <th style="cursor: pointer;">MANUFACTURER</th>
                                        <th style="cursor: pointer;">PRODUCT</th>
                                        <th style="cursor: pointer;">MODEL</th>
                                        <th class="sorttable_nosort">SRP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product) { ?>
                                        <tr>
                                            <td><?php if (isset($product->category)) echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($product->manufacturer_name)) echo htmlspecialchars($product->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($product->product_model)) echo htmlspecialchars($product->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($product->SRP)) echo htmlspecialchars(number_format($product->SRP), ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>