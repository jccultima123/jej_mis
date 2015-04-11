<div class="wrapper">
    <table style="width: 100%;">
        <tr>
            <td valign="top" class="left-container">
                <h2>Customer Relations</h2>
                <h3><a href="<?php echo URL; ?>dashboard" class="go_back_mini"><i class="picol_controls_play_back"></i> Go Back</a></h3>
                <h3>Tasks</h3>
                <ul>
                    <li><a href="<?php echo URL; ?>crm">Manage Products</a></li>
                    <li><a href="<?php echo URL; ?>sales">Manage Customers</a></li>
                    <li><a href="<?php echo URL; ?>assets">Manage Feedbacks</a></li>
                </ul>
            </td>
            <td valign="top" style="width: 2px;"></td>
            <td valign="top" class="right-container">
                <h3> </h3>
                <h4> </h4>
                <?php $this->renderFeedbackMessages(); ?>
                <span class="error_text">Sorry, this page is not available for now.</span>
            </td>
        </tr>
    </table>
</div>

