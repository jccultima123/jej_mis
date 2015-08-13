<div class="container animated fadeInDown">
    <div class="table" style="max-width: 750px; margin: 0 auto;">
        <div class="row">
            <div class="col-md-12">
                <h2>Technical Information</h2>
                <p>(C) Copyright 2014-15. All Rights Reserved.<br />This system is not affiliated to any groups/names involved.<br />This was Designed and Maintained by THE BIG FIVE GROUP from JOSE RIZAL UNIVERSITY, Metro Manila, Philippines</p><hr />
                <table style="font-size: 12px; text-align: left; left: 0; border-spacing: 0px;">
                    <b>THE BIG FIVE GROUP</b><br /><br />
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
                        <th>Assistant Programmer</th>
                        <td>Tabuso, John David C.</td>
                    </tr>
                    <tr>
                        <th>Document Specialist</th>
                        <td>Quiben, Gerald</td>
                    </tr>
                </table><hr />
                <b>System Information</b><br /><br />
                <table style="font-size: 12px; text-align: left; left: 0; border-spacing: 0px;">
                    <tr>
                        <th>Core Version:</th>
                        <td><?php echo file_get_contents(URL . 'mis_version'); ?></td>
                    </tr>
                    <tr>
                        <th>Administrator Module Version:</th>
                        <td><?php echo file_get_contents(URL . 'version'); ?></td>
                    </tr>
                    <tr>
                        <th>System Build:</th>
                        <td><?php echo ENVIRONMENT; ?></td>
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
                        <th>Web Server:</th>
                        <td><?php echo apache_get_version() ?></td>
                    </tr>
                    <tr>
                        <th>Browser's User Agent:</th>
                        <td><?php
                            $browser = new Browser();
                            echo $browser->getUserAgent();
                            ?></td>
                    </tr>
                    <tr>
                        <th>Server's Operating System:</th>
                        <td><?php echo php_uname(); ?></td>
                    </tr>
                    <tr>
                        <th>Your IP Address (IPv4):</th>
                        <td><?php
                        $ip = $_SERVER['REMOTE_ADDR'];
                        if ($ip != '::1') {
                            echo $_SERVER['REMOTE_ADDR'];
                        } else {
                            echo 'Not Available';
                        }
                        ?></td>
                    </tr>
                    <tr>
                        <th>License:</th>
                        <td><a href="http://opensource.org/licenses/GPL-2.0" target="_blank">GNU General Public License</a></td>
                    </tr>
                    <tr>
                        <th>Detailed Information:</th>
                        <td><a href="https://github.com/jccultima123/jej_mis" target="_blank">https://github.com/jccultima123/jej_mis</a></td>
                    </tr>
                </table>
                <br /><b><a href="<?php echo URL; ?>download/dev/JEJ_MIS_0.5.XX.pdf"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;More information here (.pdf)</a></b>
                <hr /><b>Credits</b><br /><br />
                <table style="font-size: 12px; text-align: left; left: 0; border-spacing: 0px;">
                    <tr>
                        <td>NetBeans IDE</td>
                    </tr>
                    <tr>
                        <td>.git Client</td>
                    </tr>
                    <tr>
                        <td>XAMPP</td>
                    </tr>
                    <tr>
                        <td><a href="https://github.com/" target="_blank">GitHub Social Coding</a></td>
                    </tr>
                    <tr>
                        <td>Bootstrap</td>
                    </tr>
                    <tr>
                        <td>Picol</td>
                    </tr>
                    <tr>
                        <td><a href="http://www.kryogenix.org/code/browser/sorttable/" target="_blank">sorttable</a></td>
                    </tr>
                    <tr>
                        <td>PHPMailer</td>
                    </tr>
                    <tr>
                        <td>JQuery</td>
                    </tr>
                    <tr>
                        <td>PHPtoExcel</td>
                    </tr>
                    <tr>
                </table>
                <br />
            </div>
	</div>
    </div>
</div>

