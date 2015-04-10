<div class="container">
    <b>System Information</b><br /><br />
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
</div>    
<br /><br />
<div class="container">
    <b>Changelog</b><br /><br />
    <table style="font-size: 12px;" class="exp_table">
        <tr style="text-align: center;">
            <th>Version</th>
            <th>Information</th>
            <th>Date</th>
        </tr>
        <tr></tr><tr></tr><tr></tr>
        <tr>
            <td><a href="https://github.com/jccultima123/jej_mis/tree/0.1.4-Beta" target="_blank">0.1.4-Beta</a></td>
            <td>
                <ul>
                    <li>Started to add mobile compatibility</li>
                    <li>Added User Settings Controller</li>
                    <li>Fixed Various Issues (<a href="https://github.com/jccultima123/jej_mis/issues/3" target="_blank">#3</a>, <a href="https://github.com/jccultima123/jej_mis/issues/4" target="_blank">#4</a> and <a href="https://github.com/jccultima123/jej_mis/issues/6" target="_blank">#6</a>)</li>
                    <li>Implementing More Secured System.. 70%</li>
                    <li>Changes to Improve Performance and Stability</li>
                    <li>Revamped User Interface. Fixes Cross-Platform issues</li>
                </ul>
            </td>
            <td style="text-align: center;">March 30, 2015</td>
        </tr>
        <tr>
            <td><a href="https://github.com/jccultima123/jej_mis/tree/0.1.11-Beta" target="_blank">0.1.11-Beta</a></td>
            <td>
                <ul>
                    <li>Fixed Dashboard Page</li>
                    <li>Improved Authentication</li>
                    <li>Identified Login Bug (OOPS! Issue <a href="https://github.com/jccultima123/jej_mis/issues/4" target="_blank">#4</a>)</li>
                    <li>Updated README.MD</li>
                </ul>
            </td>
            <td style="text-align: center;">March 30, 2015</td>
        </tr>
        <tr>
            <td><a href="https://github.com/jccultima123/jej_mis/tree/0.1.1-Beta" target="_blank">0.1.1-Beta</a></td>
            <td>
                <ul>
                    <li>Pulled login feedbacks from PHP-LOGIN 2.4</li>
                    <li>Fixed Interface Conflicts and added feedback styles</li>
                    <li>Fixed Login functionality, YAY! (Fixes issue <a href="https://github.com/jccultima123/jej_mis/issues/3" target="_blank">#3</a>)</li>
                    <li>Pulled Gravatar API and assets (some are already included before)</li>
                    <li>Updated README.MD</li>
                </ul>
            </td>
            <td style="text-align: center;">March 29, 2015</td>
        </tr>
        <tr>
            <td><a href="https://github.com/jccultima123/jej_mis/tree/0.1.09.1a" target="_blank">0.1.09.1a</a></td>
            <td>
                <ul>
                    <li>Better README for next release</li>
                    <li>Added more Technical/Debugging Information</li>
                    <li>Added Error 403 to improve stability</li>
                    <li>Improved Login function but still unstable</li>
                    <li>Improved stability</li>
                    <li>Rewriting codes to clean extra syntaxes</li>
                    <li>Fixed Calling Models</li>
                    <li>Cleaning and replacing HUGE's mail API for PHPMailer</li>
                    <li>Rewriting Login Model (Cleaning soon)</li>
                    <li>Rewriting login/logout credentials</li>
                    <li>Pulled PHPMailer library</li>
                    <li>Added Compatibility Error pages</li>
                    <li>Minor Changes in Development Page</li>
                    <li>Added Compatibility Error pages</li>
                    <li>Revert Error Handling Changes to Default</li>
                    <li>Implementing Error Codes</li>
                    <li>Fixed Version Calls</li>
                    <li>Pulled files from PHP-LOGIN</li>
                    <li>Added 401 Error</li>
                    <li>Fixed Behaviour for public access</li>
                    <li>Minor Changes</li>
                </ul>
            </td>
            <td style="text-align: center;">March 27, 2015</td>
        </tr>
        <tr>
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
</div>

