<div class="wrapper">
    <table style="width: 100%;">
        <tr>
            <td valign="top" class="left-container" id="sub-navigation">
                <table>
                    <tr valign="top">
                        <td>
                            <h2><a href="<?php echo URL; ?>dashboard" class="go_back_mini"><i class="picol_controls_play_back"></i></a></h2>
                        </td>
                        <td>
                            <h2>Customer Relations</h2>
                            <h3>Tasks</h3>
                            <ul>
                                <li><a href="<?php echo URL; ?>crm/customers">Manage Customers</a></li>
                                <li><a href="<?php echo URL; ?>crm/feedbacks">Manage Feedbacks</a></li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
            <td valign="top" class="left-container" id="mobile-navigation">
                <h2>Customer Relations</h2>
                <div class="navigation-mobi">
                    <select class="option-mobi" onchange="showDiv(this)">
                        <option value="">Select a Task..</option>
                        <option value="">-------------------------</option>
                        <option value="<?php echo URL; ?>crm/customers">Manage Customers</option>
                        <option value="<?php echo URL; ?>crm/feedbacks">Manage Feedbacks</option>
                    </select>
                </div>
            </td>
            <td valign="top" style="width: 2px;" class="space"></td>
            <td valign="top" class="right-container">
                <h3>Customers</h3>
                    <h4><?php echo $amount_of_customers; ?> Customer/s Recorded</h4>
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
                                    <td>NO.</td>
                                    <td>LAST NAME</td>
                                    <td>FIRST NAME</td>
                                    <td>MIDDLE NAME</td>
                                    <td>BIRTHDAY</td>
                                    <td>ADDRESS</td>
                                    <td>REGISTERED</td>
                                    <td>DETAILS</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($customers as $customer) { ?>
                                    <tr>
                                        <td><?php if (isset($customer->customer_id)) echo htmlspecialchars($customer->customer_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($customer->cust_last_name)) echo htmlspecialchars($customer->cust_last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($customer->cust_first_name)) echo htmlspecialchars($customer->cust_first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($customer->cust_middle_name)) echo htmlspecialchars($customer->cust_middle_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($customer->birthday)) echo htmlspecialchars(date("F j, Y", strtotime($customer->birthday)), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($customer->customer_address)) echo htmlspecialchars($customer->customer_address, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php if (isset($customer->registered_date)) echo htmlspecialchars(date("F j, Y, g:i a", strtotime($customer->registered_date)), ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><a href="<?php echo URL . 'customers/details/' . htmlspecialchars($customer->customer_id, ENT_QUOTES, 'UTF-8'); ?>">HERE</a></td>
                                        <td><a href="<?php echo URL . 'customers/delete/' . htmlspecialchars($customer->customer_id, ENT_QUOTES, 'UTF-8'); ?>">DELETE</a></td>
                                        <td><a href="<?php echo URL . 'customers/edit/' . htmlspecialchars($customer->customer_id, ENT_QUOTES, 'UTF-8'); ?>">EDIT</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                
            </td>
        </tr>
    </table>
</div>
