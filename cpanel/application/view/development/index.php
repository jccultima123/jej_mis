<div class="container">
    <p>(C) Copyright 2014-15. This system is not affiliated to any groups/names involved.<br />This was Designed and Maintained by THE BIG FIVE GROUP from JOSE RIZAL UNIVERSITY, Metro Manila, Philippines</p><hr />
    <table style="font-size: 12px; text-align: left; left: 0; border-spacing: 0px;">
        <tr>
            <th>Team Leader</th>
            <td>Del Rosario, Hazel Sheena C.</td>
        </tr>
        <tr>
            <th>System Analyst</th>
            <td>Bagsican, Angelica M.</td>
        </tr>
        <tr>
            <th>Software Engineer / Head Programmer / Designer</th>
            <td>Corsanes, John Cyrill C. (jccultima123)</td>
        </tr>
        <tr>
            <th>Programmer</th>
            <td>Tabuso, John David C.</td>
        </tr>
        <tr>
            <th>Document Specialist</th>
            <td>Quiben, Gerald</td>
        </tr>
    </table><br /><hr /><br />
    <b>System Information</b><br />
    <table style="font-size: 12px; text-align: left; left: 0; border-spacing: 0px;">
        <tr>
            <th>System Version:</th>
            <td><?php echo file_get_contents(URL .'version'); ?></td>
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

