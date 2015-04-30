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
                            <h2>Sales and Orders</h2>
                            <h3>Tasks</h3>
                            <ul>
                                <li><a href="<?php echo URL; ?>som/sales">Manage Sales</a></li>
                                <li><a href="<?php echo URL; ?>som/orders">Manage Orders</a></li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
            <td valign="top" class="left-container" id="mobile-navigation">
                <h2>Sales And Orders</h2>
                <div class="navigation-mobi">
                    <select class="option-mobi" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                        <option value="">Select a Task..</option>
                        <option value="">-------------------------</option>
                        <option value="<?php echo URL; ?>som/sales">Manage Sales</option>
                        <option value="<?php echo URL; ?>som/orders">Manage Orders</option>
                    </select>
                </div>
            </td>
            <td valign="top" style="width: 2px;" class="space"></td>
            <td valign="top" class="null-container">
                
            </td>
        </tr>
    </table>
</div>

