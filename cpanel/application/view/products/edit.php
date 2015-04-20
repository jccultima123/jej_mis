<div class="container">
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
        <form action="<?php echo URL; ?>products/updateproduct" method="POST">
            <label>Category: </label>
            <select name="category" required>
                <?php if (isset($products->category) == htmlspecialchars('Mobile Phone', ENT_QUOTES, 'UTF-8')) { ?>
                    <option value="<?php echo htmlspecialchars($products->category, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($products->category, ENT_QUOTES, 'UTF-8'); ?></option>
                    <option value="Smartphone">Smartphone</option>
                    <option value="Tablet">Tablet</option>
                    <option value="Accessory">Accessory</option>
                <?php } else if (isset($products->category) == htmlspecialchars('Smartphone', ENT_QUOTES, 'UTF-8')) { ?>
                    <option value="<?php echo htmlspecialchars($products->category, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($products->category, ENT_QUOTES, 'UTF-8'); ?></option>
                    <option value="Mobile Phone">Mobile Phone</option>
                    <option value="Tablet">Tablet</option>
                    <option value="Accessory">Accessory</option>
                <?php } else if (isset($products->category) == htmlspecialchars('Tablet', ENT_QUOTES, 'UTF-8')) { ?>
                    <option value="<?php echo htmlspecialchars($products->category, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($products->category, ENT_QUOTES, 'UTF-8'); ?></option>
                    <option value="Mobile Phone">Mobile Phone</option>
                    <option value="Smartphone">Smartphone</option>
                    <option value="Accessory">Accessory</option>
                <?php } else if (isset($products->category) == htmlspecialchars('Accessory', ENT_QUOTES, 'UTF-8')) { ?>
                    <option value="<?php echo htmlspecialchars($products->category, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($products->category, ENT_QUOTES, 'UTF-8'); ?></option>
                    <option value="Mobile Phone">Mobile Phone</option>
                    <option value="Smartphone">Smartphone</option>
                    <option value="Tablet">Tablet</option>
                <?php } else { ?>
                    <option value=""></option>
                    <option value="Mobile Phone">Mobile Phone</option>
                    <option value="Smartphone">Smartphone</option>
                    <option value="Tablet">Tablet</option>
                    <option value="Accessory">Accessory</option>
                <?php } ?>
            </select><br /><br />
            <label>SKU</label><br />
            <input type="text" name="track" value="<?php echo htmlspecialchars($products->SKU, ENT_QUOTES, 'UTF-8'); ?>" required /><br /><br />
            <label>Product Name</label><br />
            <input type="text" name="link" value="<?php echo htmlspecialchars($products->product_name, ENT_QUOTES, 'UTF-8'); ?>" /><br /><br />
            <label>Model</label><br />
            <input type="text" name="link" value="<?php echo htmlspecialchars($products->product_model, ENT_QUOTES, 'UTF-8'); ?>" /><br /><br />
            <label>Manufacturer</label><br />
            <input type="text" name="link" value="<?php echo htmlspecialchars($products->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?>" /><br /><br />
            <label>Price</label><br />
            <input type="text" name="link" value="P<?php echo htmlspecialchars($products->price, ENT_QUOTES, 'UTF-8'); ?>" /><br /><br />
            <?php if (isset($products->link)) { ?>
                <label>Link</label><br />   
                <a href="<?php echo htmlspecialchars($product->link, ENT_QUOTES, 'UTF-8'); ?>">Here</a><br /><br />
            <?php } ?>
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($products->product_id, ENT_QUOTES, 'UTF-8'); ?>" /><br />
            <input type="submit" name="submit_update_song" value="Update" />
        </form>
    </div>
</div>

