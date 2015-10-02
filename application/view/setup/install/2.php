<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] ==''){
    header('Location: 3');
    exit;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] != '')
    echo $_POST['pre_error'];

if (phpversion() < '5.3.7') {
    $pre_error = 'You need to use PHP5 or above for our site!<br />';
}
if (ini_get('session.auto_start')) {
    $pre_error .= 'Our site will not work with session.auto_start enabled!<br />';
}
if (!extension_loaded('mysql')) {
    $pre_error .= 'MySQL extension needs to be loaded for our site to work!<br />';
}
if (!extension_loaded('gd')) {
    $pre_error .= 'GD extension needs to be loaded for our site to work!<br />';
}
if (!is_writable('config.php')) {
    $pre_error .= 'config.php needs to be writable for our site to be installed!';
}
?>
    <table width="100%">
        <tr>
            <td>PHP Version:</td>
            <td><?php echo phpversion(); ?></td>
            <td>5.0+</td>
            <td><?php echo (phpversion() >= '5.0') ? 'Ok' : 'Not Ok'; ?></td>
        </tr>
        <tr>
            <td>Session Auto Start:</td>
            <td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
            <td>Off</td>
            <td><?php echo (!ini_get('session_auto_start')) ? 'Ok' : 'Not Ok'; ?></td>
        </tr>
        <tr>
            <td>MySQL:</td>
            <td><?php echo extension_loaded('mysql') ? 'On' : 'Off'; ?></td>
            <td>On</td>
            <td><?php echo extension_loaded('mysql') ? 'Ok' : 'Not Ok'; ?></td>
        </tr>
        <tr>
            <td>GD:</td>
            <td><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></td>
            <td>On</td>
            <td><?php echo extension_loaded('gd') ? 'Ok' : 'Not Ok'; ?></td>
        </tr>
        <tr>
            <td>config.php</td>
            <td><?php echo is_writable('config.php') ? 'Writable' : 'Unwritable'; ?></td>
            <td>Writable</td>
            <td><?php echo is_writable('config.php') ? 'Ok' : 'Not Ok'; ?></td>
        </tr>
    </table>
    <form action="2" method="post">
        <input type="hidden" name="pre_error" id="pre_error" value="<?php echo $pre_error;?>" />
        <input type="submit" name="continue" value="Continue" />
    </form>
<?php