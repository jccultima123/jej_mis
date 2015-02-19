
<div class="container">
    <p>
        <h3>Products</h3>
        <h4>Total Products Available - <?php echo $amount_of_products; ?></h4>
        <table>
            <thead style="background-color: #ddd; font-weight: bold;">
            <tr>
                <td>Product Number</td>
                <td>Category</td>
                <td>SKU</td>
                <td>Product Name</td>
                <td>Model</td>
                <td>Manufacturer</td>
                <td>Release Date</td>
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
                    <td><?php if (isset($product->release_date)) echo htmlspecialchars($product->release_date, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>P<?php if (isset($product->price)) echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <?php if (isset($product->link)) { ?>
                            <a href="<?php echo htmlspecialchars($product->link, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($product->link, ENT_QUOTES, 'UTF-8'); ?></a>
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