<div class="wrapper">
    <table style="width: 100%;">
        <tr>
            <td valign="top" class="left-container">
                <h2></h2>
                <h3>Tasks</h3>
                <ul>
                    <li><a href="<?php echo URL; ?>sales">Manage Sales</a></li>
                    <li><a href="<?php echo URL; ?>assets">Manage Assets</a></li>
                    <li><a href="<?php echo URL; ?>crm">Customer Relations</a></li>
                </ul>
                <h3>Account</h3>
                <ul>
                <li><a href="<?php echo URL; ?>account">Edit Account</a></li>
                <li><a href="<?php echo URL; ?>profile">Edit Profile</a></li>
                <li><a href="<?php echo URL; ?>settings">More Settings</a></li>
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

