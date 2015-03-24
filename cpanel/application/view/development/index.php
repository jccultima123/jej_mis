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
            <td>MVC (Model-View-Controller) using Modified <a href="" onclick="alert('MINI\n\nAn extremely simple naked PHP application by Panique\nModified by jccultima\n\nSite: php-mini.com')">MINI</a> and <a href="" onclick="alert('HUGE\n\nAn MVC Framework by Panique\nModified by jccultima\n\nSite: php-login.net')">HUGE</a></td>
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
            <td><a href="https://github.com/jccultima123/jej_mis" target="_blank">https://github.com/jccultima123/jej_mis</a></td>
        </tr>
    </table>
    <br /><br /><b>Changelog</b>
    <table style="font-size: 12px;" class="exp_table">
        <tr style="text-align: center;">
            <th>Version</th>
            <th>Information</th>
            <th>Date</th>
        </tr>
        <tr>
            <td><a href="https://github.com/jccultima123/jej_mis/tree/0.1.09a" target="_blank">0.1.09a</a></td>
            <td>
                <ul>
                    <li>Fixed Models and Separated Classes to avoid redundancy</li>
                    <li>Dumped Authentication Class for Login</li>
                    <li>Dumped Controller.php Class in /lib for Login</li>
                    <li>Fixed calling MySql Version</li>
                    <li>Added Logged Out Page</li>
                </ul>
            </td>
            <td style="text-align: center;">March 16, 2015</td>
        </tr>
        <tr>
            <td><a href="https://github.com/jccultima123/jej_mis/tree/0.1.08a" target="_blank">0.1.08a</a></td>
            <td>
                <ul>
                    <li>Changed System</li>
                    <li>Implementing More Secured System.. 42%</li>
                    <li>Reversed Password Verification to SHA1 for compatibility<br />(IDK about the $password_hash by now)</li>
                    <li>Simplified Login Session Detection</li>
                    <li>Fixed Login Function</li>
                    <li>Updated README.MD</li>
                </ul>
            </td>
            <td style="text-align: center;">March 14, 2015</td>
        </tr>
        <tr>
            <td><a href="https://github.com/jccultima123/jej_mis/tree/0.1.07a" target="_blank">0.1.07a</a></td>
            <td>
                <ul>
                    <li>Dumped system for Public Site (Website)</li>
                    <li>Pulled some php-login codes (Minimal Version) for<br />Login Functionality. Thanks to panique!</li>
                    <li>Implementing More Secured System.. 40%</li>
                    <li>Implementing More Security functions to all Controllers</li>
                </ul>
            </td>
            <td style="text-align: center;">March 2, 2015</td>
        </tr>
        <tr>
            <td>0.1.06a</td>
            <td>
                <ul>
                    <li>Fully Implemented Adding Product/Item Function</li>
                    <li>Fixed Product Controller</li>
                    <li>Minor Changes to Error Detection</li>
                </ul>
            </td>
            <td style="text-align: center;">February 24, 2015</td>
        </tr>
        <tr>
            <td>0.1.05a</td>
            <td>
                <ul>
                    <li>Fixed product controller.. sigh (Fixes issue <a href="https://github.com/jccultima123/jej_mis/issues/2" target="_blank">#2</a>)</li>
                    <li>Added Login Functionality which is still unstable</li>
                    <li>Minor font changes to make it readable</li>
                    <li>Added Edit Product Page</li>
                    <li>Fixed Product Detail Table</li>
                    <li>Better Error Detection</li>
                    <li>Minor changes</li>
                </ul>
            </td>
            <td style="text-align: center;">February 20, 2015</td>
        </tr>
        <tr>
            <td>0.1.04a</td>
            <td>
                <ul>
                    <li>Updated README.MD</li>
                    <li>Completing folder structure</li>
                    <li>Minor changes</li>
                </ul>
            </td>
            <td style="text-align: center;">February 18, 2015</td>
        </tr>
        <tr>
            <td>0.1.03a</td>
            <td>
                <ul>
                    <li>Removed MIT License to make it Private</li>
                    <li>Updated README.MD</li>
                    <li>Fixed Version Information</li>
                    <li>Fixed Commits at .git</li>
                    <li>Minor changes</li>
                </ul>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>0.1.02a</td>
            <td>
                <ul>
                    <li>Initialized .git function</li>
                    <li>First Commit at .git</li>
                    <li>Compiled Product Model from Database</li>
                    <li>Minor changes</li>
                </ul>
            </td>
            <td style="text-align: center;">February 17, 2015</td>
        </tr>
        <tr>
            <td>0.1.01a</td>
            <td>
                <ul>
                    <li>Modified Error Controllers</li>
                    <li>Added Error Page</li>
                    <li>Added Development Page</li>
                    <li>Minor changes</li>
                </ul>
            </td>
            <td style="text-align: center;">February 16, 2015</td>
        </tr>
        <tr>
            <td>0.1a</td>
            <td>
                <ul>
                    <li>Initial Nightly Release</li>
                    <li>Created Database</li>
                    <li>Integrated MVC Basic Pattern</li>
                    <li>Modified Views</li>
                </ul>
            </td>
            <td style="text-align: center;">February 15, 2015</td>
        </tr>
    </table>
    <br /><br />
    <span class="show_button" tabindex="0">Show More</span>
    <span class="hide_button" tabindex="0">Hide</span>
    <br /><br />
    Detailed Commits/Changes at <a href="https://github.com/jccultima123/jej_mis/commits/">here</a>.
    <br /><br /><a href="<?php echo URL; ?>" class="back">&larr; Go Back</a>
</div>

