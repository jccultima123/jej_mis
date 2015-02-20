<table class="wrapper">
    <tr>
        <th valign="top">
            <div class="left-container">
                <p>What do you want<br />to do today?</p>
                <ul>
                    <li>
                        <input type="text" name="search" value="" placeholder="Search?" required />
                    </li><br />
                    <li>
                        or Add a Product<br /><br />
                        <form action="<?php echo URL; ?>products/add" method="POST">
                            <label>What type?</label><br />
                            <select>
                                <option value="Smartphone">Smartphone</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Accessory">Accessory</option>
                            </select>
                            <br /><br />
                            <label>SKU Number</label><br />
                            <input type="text" name="track" value="" placeholder="" required /><br /><br />
                            <label>Product Name</label><br />
                            <input type="text" name="product_name" value="" placeholder="Without Brand" required /><br /><br />
                            <label>Model Number</label><br />
                            <input type="text" name="track" value="" placeholder="(e.g. GT-S53***)" required /><br /><br />
                            <label>Manufacturer</label><br />
                            <input type="text" name="track" value="" placeholder="(e.g. Brand / Samsung)" required /><br /><br />
                            <label>Price</label><br />
                            <input type="number" name="track" value="" placeholder="0" min="1" max="999999" required /><br /><br />
                            <label>Link</label><br />
                            <input type="text" name="link" value="" placeholder="http://" /><br /><br /><br />
                            <input type="submit" name="submit_add_song" value="Submit" />
                        </form>
                    </li>
                </ul>
            </div>
        </th>
        <th valign="top">
            <div class="container">
                <p>
                <h3>Products</h3>
                <h4>Total Products Available - <?php echo $amount_of_products; ?></h4>
                <?php
                if (isset($error))
                    echo $error;
                ?>
                <table>
                    <thead style="background-color: #ddd; font-weight: bold;">
                        <tr>
                            <td>Product Number</td>
                            <td>Category</td>
                            <td>SKU</td>
                            <td>Product Name</td>
                            <td>Model</td>
                            <td>Manufacturer</td>
                            <td>Price</td>
                            <td>More Info</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) { ?>
                            <tr>
                                <td><?php if (isset($product->product_id)) echo htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->category)) echo htmlspecialchars($product->category, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->SKU)) echo htmlspecialchars($product->SKU, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->product_model)) echo htmlspecialchars($product->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($product->manufacturer_name)) echo htmlspecialchars($product->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>P<?php if (isset($product->price)) echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <?php if (isset($product->link)) { ?>
                                        <a href="<?php echo htmlspecialchars($product->link, ENT_QUOTES, 'UTF-8'); ?>">Here</a>
                                    <?php } ?>
                                </td>
                                <td><a href="<?php echo URL . 'products/delete/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>" onclick="confirmation()">delete</a></td>
                                <td><a href="<?php echo URL . 'products/edit/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">edit</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </p>
            </div>
        </th>
    </tr>
</table>
