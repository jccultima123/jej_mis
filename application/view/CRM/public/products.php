                        <div class="panel panel-default" style="max-height: 410px; overflow-x: auto;">
                            <div class="panel-heading">
                                Updated <?php echo date(DATE_CUSTOM, $latest_prod_time); ?>
                            </div>
                            <table class="table table-bordered table-hover sortable">
                                <thead>
                                    <tr>
                                        <th style="cursor: pointer;">CATEGORY</th>
                                        <th style="cursor: pointer;">BRAND</th>
                                        <th style="cursor: pointer;">PRODUCT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product) { ?>
                                        <tr>
                                            <td><?php if (isset($product->category)) echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($product->brand)) echo htmlspecialchars($product->brand, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>