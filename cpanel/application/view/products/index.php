<div class="wrapper">
    <table style="width: 100%;">
        <tr>
            <td valign="top" class="left-container" id="sub-navigation" style="list-style: none;">
                <h2>Products</h2>
                <h3><a href="<?php echo URL; ?>dashboard" class="go_back_mini"><i class="picol_controls_play_back"></i> Go Back</a></h3>
                <h3>Tasks</h3>
                        <li>
                            <input type="text" name="search_products" value="" placeholder="Search" required />
                        </li><br />
                        <li>
                            or Add a Product<br />
                            <?php
                            if (isset($error))
                                echo $error;
                            ?><br />
                            <form action="<?php echo URL; ?>products/add" method="POST">
                                <label>What type?</label><br />
                                <select name="category">
                                    <option value=""></option>
                                    <option value="">_________________</option>
                                    <option value="Mobile Phone">Mobile Phone</option>
                                    <option value="Smartphone">Smartphone</option>
                                    <option value="Tablet">Tablet</option>
                                    <option value="Accessory">Accessory</option>
                                </select>
                                <br /><br />
                                <label>SKU Number</label><br />
                                <input type="text" name="SKU" value="" placeholder="" /><br /><br />
                                <label>Product Name *</label><br />
                                <input type="text" name="product_name" value="" placeholder="Without Brand" required /><br /><br />
                                <label>Model Number *</label><br />
                                <input type="text" name="product_model" value="" placeholder="(e.g. GT-S53***)" required /><br /><br />
                                <label>Manufacturer *</label><br />
                                <input type="text" name="manufacturer_name" value="" placeholder="(e.g. Brand / Samsung)" required /><br /><br />
                                <label>Price</label><br />
                                <input type="number" name="price" value="" placeholder="0" min="1" max="999999" required /><br /><br />
                                <label>Link</label><br />
                                <input type="text" name="link" value="" placeholder="http://" /><br /><br />
                                <label>* fields are required</label><br /><br />
                                <input type="submit" name="submit_add_product" value="Submit" />
                            </form>
                        </li>
            </td>
            <td valign="top" class="left-container" id="mobile-navigation">
                <h2>Dashboard</h2>
                <div class="navigation-mobi">
                    <select class="option-mobi" onchange="showDiv(this)">
                        <option value="">Select a Task..</option>
                        <option value="">-------------------------</option>
                        <option value="<?php echo URL; ?>dashboard/reports">View Reports</option>
                        <option value="<?php echo URL; ?>som">Sales and Order Mgt.</option>
                        <option value="<?php echo URL; ?>assets">Asset Management</option>
                        <option value="<?php echo URL; ?>crm">Cust. Relations</option>
                        <option value="">-------------------------</option>
                        <option value="<?php echo URL; ?>products">Manage Products</option>
                        <option value="">-------------------------</option>
                        <option value="<?php echo URL; ?>accout">Account Sett.</option>
                        <option value="<?php echo URL; ?>settings">System Pref.</option>
                    </select>
                </div>
            </td>
            <td valign="top" style="width: 2px;" class="space"></td>
            <td valign="top" class="right-container">
            
                    <h4>Total Products Available - <?php echo $amount_of_products; ?></h4>
                    <?php if (isset($message)) { ?>
                        <span class="feedback_success"><?php echo $this->$message; ?></span>
                        <br />
                    <?php } ?>
                        <?php if (isset($error)) { ?>
                        <span class="error_text"><?php echo $this->$error; ?></span>
                        <br /><br />
                    <?php } ?>
                        <h4><?php $this->renderFeedbackMessages(); ?></h4>
                        <table style="font-size: 13px; text-align: center;  ">
                            <thead style="background-color: #ddd; font-weight: bold;">
                                <tr>
                                    <td><input type="checkbox" onclick="" /></td>
                                    <td>NO.</td>
                                    <td>CATEGORY</td>
                                    <td>SKU</td>
                                    <td>MANUFACTURER</td>
                                    <td>PRODUCT NAME</td>
                                    <td>MODEL</td>
                                    <td>PRICE</td>
                                    <td>MORE INFO</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) { ?>
                                    <tr>
                                        <td><input type="checkbox" /></td>
                                        <td><?php if (isset($product->product_id)) echo htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($product->category)) echo htmlspecialchars($product->category, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($product->SKU)) echo htmlspecialchars($product->SKU, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($product->manufacturer_name)) echo htmlspecialchars($product->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($product->product_model)) echo htmlspecialchars($product->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>P<?php if (isset($product->price)) echo htmlspecialchars(number_format($product->price), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php if (isset($product->link)) { ?>
                                                <a href="<?php echo htmlspecialchars($product->link, ENT_QUOTES, 'UTF-8'); ?>">HERE</a>
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
