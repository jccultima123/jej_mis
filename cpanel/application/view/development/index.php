<div class="container">
    <b>System Information</b><br />
    <table style="font-size: 12px; text-align: left; border-spacing: 0px;">
        <tr>
            <th>System Version:</th>
            <td><?php echo file_get_contents(URL .'version.txt'); ?></td>
        </tr>
        <tr>
            <th>PHP Version:</th>
            <td><?php echo phpversion(); ?></td>
        </tr>
        <tr>
            <th>MySQL Version:</th>
            <td><?php echo $mysql_version; ?></td>
        </tr>
        <tr>
            <th>Design:</th>
            <td>MVC (Model-View-Controller) using <a href="" onclick="javascript:alert(x)">MINI</a> and <a href="" onclick="javascript:alert(y)">HUGE</a></td>
        </tr>
        <tr>
            <th>Web Server:</th>
            <td><?php echo apache_get_version() ?></td>
        </tr>
        <tr>
            <th>Browser's User Agent:</th>
            <td><?php
                    echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";
                ?></td>
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
            <td><a href="https://github.com/jccultima123/jej_mis" target="_blank">https://github.com/jccultima123/jej_mis</a></td>
        </tr>
    </table>
    <br /><b><a href="<?php echo URL; ?>download/dev/JEJ_MIS 0.1.9 Draft.pdf"><i class="picol_download"></i>More information here (.pdf)</a></b>
</div>

