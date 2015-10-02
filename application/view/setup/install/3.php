<?php
if (isset($_POST['submit']) && $_POST['submit']=="Install!") {
    $database_host=isset($_POST['database_host'])?$_POST['database_host']:"";
    $database_name=isset($_POST['database_name'])?$_POST['database_name']:"";
    $database_username=isset($_POST['database_username'])?$_POST['database_username']:"";
    $database_password=isset($_POST['database_password'])?$_POST['database_password']:"";
    $admin_name=isset($_POST['admin_name'])?$_POST['admin_name']:"";
    $admin_password=isset($_POST['admin_password'])?$_POST['admin_password']:"";

    if (empty($admin_name) || empty($admin_password) || empty($database_host) || empty($database_username) || empty($database_name)) {
        echo "All fields are required! Please re-enter.<br />";
    } else {
        $connection = mysql_connect($database_host, $database_username, $database_password);
        mysql_select_db($database_name, $connection);

        $file ='DB.sql';
        if ($sql = file($file)) {
            $query = '';
            foreach($sql as $line) {
                $tsl = trim($line);
                if (($sql != '') && (substr($tsl, 0, 2) != "--") && (substr($tsl, 0, 1) != '#')) {
                    $query .= $line;

                    if (preg_match('/;\s*$/', $line)) {

                        mysql_query($query, $connection);
                        $err = mysql_error();
                        if (!empty($err))
                            break;
                        $query = '';
                    }
                }
            }
            @mysql_query("INSERT INTO admin SET admin_name='".$admin_name."', admin_password = md5('" . $admin_password . "')");
            mysql_close($connection);
        }
        $f=fopen("config.php","w");
        $database_inf="<?php
                             define('DB_HOST', '".$database_host."');
                             define('DB_NAME', '".$database_name."');
                             define('DB_USERNAME', '".$database_username."');
                             define('DB_PASSWORD', '".$database_password."');
                             define('ADMIN_NAME', '".$admin_name."');
                             define('ADMIN_PASSWORD', '".$admin_password."');
                             ?>";
        if (fwrite($f,$database_inf)>0){
            fclose($f);
        }
        header("Location: setup?step=4");
    }
}
?>
    <form method="post" action="3">
        <p>
            <input type="text" name="database_host" value='localhost' size="30">
            <label for="database_host">Database Host</label>
        </p>
        <p>
            <input type="text" name="database_name" size="30" value="<?php echo $database_name; ?>">
            <label for="database_name">Database Name</label>
        </p>
        <p>
            <input type="text" name="database_username" size="30" value="<?php echo $database_username; ?>">
            <label for="database_username">Database Username</label>
        </p>
        <p>
            <input type="text" name="database_password" size="30" value="<?php echo $database_password; ?>">
            <label for="database_password">Database Password</label>
        </p>
        <br/>
        <p>
            <input type="text" name="admin_name" size="30" value="<?php echo $username; ?>">
            <label for="username">Admin Login</label>
        </p>
        <p>
            <input name="admin_password" type="text" size="30" maxlength="15" value="<?php echo $password; ?>">
            <label for="password">Admin Password</label>
        </p>
        <p>
            <input type="submit" name="submit" value="Install!">
        </p>
    </form>
<?php