<div class="wrapper">
    <table style="width: 100%;">
        <tr>
            <td valign="top" class="left-container">
                <h2>Customer Relations</h2>
                <h3><a href="<?php echo URL; ?>dashboard" class="go_back_mini"><i class="picol_controls_play_back"></i> Go Back</a></h3>
                <h3>Tasks</h3>
                <ul>
                    <li><a href="<?php echo URL; ?>crm/products" onclick="">Manage Products</a></li>
                    <li><a href="<?php echo URL; ?>crm/customers" onclick="">Manage Customers</a></li>
                    <li><a href="<?php echo URL; ?>crm/feedbacks" onclick="">Manage Feedbacks</a></li>
                </ul>
            </td>
            <td valign="top" class="left-container" id="mobile-navigation">
                <h2>Customer Relations</h2>
                <div class="navigation-mobi">
                    <select class="option-mobi" onchange="showDiv(this)">
                        <option value="">Select a Task..</option>
                        <option value="">-------------------------</option>
                        <option value="<?php echo URL; ?>crm/products">Manage Products</option>
                        <option value="<?php echo URL; ?>crm/customers">Manage Customers</option>
                        <option value="<?php echo URL; ?>crm/feedbacks">Manage Feedbacks</option>
                    </select>
                </div>
            </td>
            <td valign="top" style="width: 2px;" class="space"></td>
            <td valign="top" class="right-container">
                <h3>Customers</h3>
                    <h4><?php //echo $amount_of_customers; ?> Customers Recorded</h4>
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
                                    <td>LAST NAME</td>
                                    <td>FIRST NAME</td>
                                    <td>MIDDLE NAME</td>
                                    <td>BIRTHDAY</td>
                                    <td>ADDRESS</td>
                                    <td>MORE INFO</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                
            </td>
        </tr>
    </table>
</div>
