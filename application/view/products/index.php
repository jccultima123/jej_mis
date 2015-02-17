
<div class="container">
    <p>
        <h3>Products</h3>
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
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tb_products as $product) { ?>
                <tr>
                    <td><?php if (isset($product->product_id)) echo htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($product->product_id)) echo htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($product->product_id)) echo htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($product->artist)) echo htmlspecialchars($product->artist, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php if (isset($product->track)) echo htmlspecialchars($product->track, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <?php if (isset($product->link)) { ?>
                            <a href="<?php echo htmlspecialchars($product->link, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($product->link, ENT_QUOTES, 'UTF-8'); ?></a>
                        <?php } ?>
                    </td>
                    <td><a href="<?php echo URL . 'songs/deletesong/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>" onclick="confirmation()">delete</a></td>
                    <td><a href="<?php echo URL . 'songs/editsong/' . htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?>">edit</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </p>
</div>