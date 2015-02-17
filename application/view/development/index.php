<div class="container">
    <b>System Information</b><br />
    <table style="font-size: 12px; text-align: left; border-spacing: 0px;">        
        <tr>
            <th>PHP Version:</th>
            <td><?php echo phpversion(); ?></td>
        </tr>
        <tr>
            <th>MySQL Version:</th>
            <td><?php ?></td>
        </tr>
        <tr>
            <th>Design:</th>
            <td>MVC (Model-View-Controller) using Modified <a href="" onclick="mini_info()">MINI</a></td>
        </tr>
        <tr>
            <th>Web Server:</th>
            <td><?php echo apache_get_version() ?></td>
        </tr>
        <tr>
            <th>Operating System:</th>
            <td><?php echo php_uname(); ?></td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>Alpha</td>
        </tr>
        <tr>
            <th>Detailed Information:</th>
            <td><a href="https://github.com/jccultima123/jej_ims">https://github.com/jccultima123/jej_ims</a></td>
        </tr>
    </table>
    <br /><br /><b>Changelog</b>
    <table style="font-size: 12px;">
        <tr>
            <th>Version</th>
            <th>Information</th>
            <th>Date</th>
        </tr>
        <tr>
            <td>0.1 Alpha</td>
            <td>
                <ul>
                    <li>Initial Nightly Release</li>
                    <li>Created Database</li>
                    <li>Integrated MVC Basic Pattern</li>
                    <li>Modified Views</li>
                </ul>
            </td>
            <td>Febuary 15, 2015</td>
        </tr>
        <tr>
            <td>0.1.01 Alpha</td>
            <td>
                <ul>
                    <li>Modified Error Controllers</li>
                    <li>Added Error Page</li>
                    <li>Added Development Page</li>
                </ul>
            </td>
            <td>Febuary 16, 2015</td>
        </tr>
        <tr>
            <td>0.1.02 Alpha</td>
            <td>
                <ul>
                    <li>Initialized .git function</li>
                    <li>First Commit at .git</li>
                    <li>Compiled Product Model from Database</li>
                </ul>
            </td>
            <td>Febuary 17, 2015</td>
        </tr>
        <tr>
            <td>0.1.03 Alpha</td>
            <td>
                <ul>
                    <li>Removed MIT License to make it Private</li>
                    <li>Updated README.MD</li>
                    <li>Fixed Version Information</li>
                    <li>Fixed Commits at .git</li>
                </ul>
            </td>
            <td></td>
        </tr>
    </table>
    <br /><br />
    Detailed Commits/Changes at <a href="https://github.com/jccultima123/jej_ims/commits/">here</a>.
    <br /><br /><a href="<?php echo URL; ?>" class="back">&larr; Go Back</a>
</div>

