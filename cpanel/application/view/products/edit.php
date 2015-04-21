<div class="wrapper" id="wrapper_dialog">
    <div class="container" id="container_dialog">
        <h2>Products</h2>
        <!-- add song form -->
        <div>
            <h3>Edit Product</h3>
            <?php if (isset($error)) { ?>
                <span class="error_text"><?php echo $this->$error; ?></span>
                <br /><br />
            <?php } ?>
            <?php if (!isset($products->category)) { ?>
                <span class="error_text"><?php echo CRUD_MISSING_ITEM; ?></span>
                <br /><br />
            <?php } ?>
            <form action="<?php echo URL; ?>products/update" method="POST" style="form_edit">
                <table>
                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category" required>
                                <option value=""></option>
                                <option value="">_________________</option>
                                <option value="Mobile Phone">Mobile Phone</option>
                                <option value="Smartphone">Smartphone</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Accessory">Accessory</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>SKU</td>
                        <td><input type="text" name="SKU" value="<?php echo htmlspecialchars($products->SKU, ENT_QUOTES, 'UTF-8'); ?>" /></td>
                    </tr>
                    <tr>
                        <td>Manufacturer</td>
                        <td><input type="text" name="manufacturer_name" value="<?php echo htmlspecialchars($products->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?>" placeholder="(e.g. Brand / Samsung)" required /></td>
                    </tr>
                    <tr>
                        <td>Product Name</td>
                        <td><input type="text" name="product_name" value="<?php echo htmlspecialchars($products->product_name, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Without Brand" required /></td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td><input type="text" name="product_model" value="<?php echo htmlspecialchars($products->product_model, ENT_QUOTES, 'UTF-8'); ?>" placeholder="(e.g. GT-S53***)" required /></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type="number" name="price" value="<?php echo htmlspecialchars($products->price, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" min="1" max="999999" /></td>
                    </tr>
                    <tr>
                        <td>Link</td>
                        <td><input type="text" name="link" value="<?php echo htmlspecialchars($products->link, ENT_QUOTES, 'UTF-8'); ?>" placeholder="http://" /></td>
                    </tr>
                </table>
                
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($products->product_id, ENT_QUOTES, 'UTF-8'); ?>" />
                <br /><input type="submit" name="update_product" value="Update" />
            </form>
        </div>
    </div>
</div>

