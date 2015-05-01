<div class="container">
    <table>
        <tr>
            <td>
                <h1><a href="<?php echo URL; ?>dashboard" class="go_back_mini"><i class="picol_controls_play_back"></i></a></h1>
            </td>
            <td>
                <table style="width: 100%;">
                    <tr>
                        <th>
                            <h2>Products</h2>
                            <?php if (isset($message)) { ?>
                                <span class="feedback_success"><?php echo $this->$message; ?></span>
                                <br />
                            <?php } ?>
                            <?php if (isset($error)) { ?>
                                <span class="error_text"><?php echo $this->$error; ?></span>
                                <br /><br />
                            <?php } ?>
                            <?php $this->renderFeedbackMessages(); ?>
                        </th>
                    </tr>
                    <tr>
                        <th><h4 style="float: left;">Total Products Available - <?php echo $amount_of_products; ?></h4></th>
                        <th>
                            [&nbsp; Commands: 
                            <i class="picol_document_sans_add"></i><a href="<?php echo URL . 'products/add' ?>">Add</a>
                            <i class="picol_refresh"></i><a href="<?php echo URL . 'products' ?>">Refresh</a>
                            <i class="picol_printer"></i><a href="<?php echo URL . 'products/export' ?>">Export</a>
                            &nbsp;]
                        </th>
                        <th>
                            <form style="float: right;" action="<?php echo URL; ?>products/search" method="POST">
                                <input type="text" name="search_products" value="" placeholder="Search" required />
                            </form>
                        </th>
                    </tr>
                </table>
                
                <table style="font-size: 13px; text-align: center;" class="sortable">
                    <thead style="background-color: #ddd; font-weight: bold;">
                        <tr>
                            <th>NO.</th>
                            <th>CATEGORY</th>
                            <th>SKU</th>
                            <th>MANUFACTURER</th>
                            <th>PRODUCT NAME</th>
                            <th>MODEL</th>
                            <th>PRICE</th>
                            <th class="sorttable_nosort">MORE INFO</th>
                            <th class="sorttable_nosort"></th>
                            <th class="sorttable_nosort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) { ?>
                            <tr>
                                <td><?php if (isset($product->product_id)) echo htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->category)) echo htmlspecialchars($product->category, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->SKU)) echo htmlspecialchars($product->SKU, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->manufacturer_name)) echo htmlspecialchars($product->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->product_model)) echo htmlspecialchars($product->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>P<?php if (isset($product->price)) echo htmlspecialchars(number_format($product->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <?php if (isset($product->link)) { ?>
                                        <a href="<?php if (isset($product->link)) echo htmlspecialchars($product->link, ENT_QUOTES, 'UTF-8'); ?>" target="<?php if (isset($product->link)) {echo '_blank';} else {echo '';} ?>">HERE</a>
                                    <?php } ?>
                                </td>
                                <td><a href="<?php echo URL . 'products/delete/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">DELETE</a></td>
                                <td><a href="<?php echo URL . 'products/edit/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">EDIT</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
                
</div>
