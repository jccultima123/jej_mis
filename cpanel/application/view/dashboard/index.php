<div class="wrapper" data-role="page">
    <table style="width: 100%;">
        <tr>
            <td valign="top" class="left-container">
                <h2>Management Information</h2>
                <h3>Tasks</h3>
                <ul>
                    <li><a href="<?php echo URL; ?>som" onclick="" data-transition="fade">Sales and Order Management</a></li>
                    <li><a href="<?php echo URL; ?>assets" onclick="" data-transition="fade">Asset Management</a></li>
                    <li><a href="<?php echo URL; ?>crm" onclick="" data-transition="fade">Customer Relations</a></li>
                </ul>
                <h3>Options</h3>
                <ul>
                <li><a href="<?php echo URL; ?>account" onclick="">Edit Account</a></li>
                <li><a href="<?php echo URL; ?>profile" onclick="">Edit Profile</a></li>
                <li><a href="<?php echo URL; ?>settings" onclick="">Preferences</a></li>
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

