<?php

class InstallModel
{

    /**
    public function __construct()
    {

    }
     **/

    public function db_check()
    {
        try {
            $this->mysql_connect();
        } catch (PDOException $e) {
            $_SESSION["feedback_negative"][] = "Unable to connect database. Make sure the DB client/server is running or configured";
            return false;
        }
    }

    public function sys_install($admin_name, $admin_password, $database_host, $database_username, $database_password, $database_name)
    {
        //Checking database server
        $this->db_check();

        if (empty($admin_name) || empty($admin_password) || empty($database_host) || empty($database_username) || empty($database_name)) {
            $_SESSION["feedback_negative"][] = "All fields are required! Please re-enter.";
        } else {
            //INSTALLATION
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
                mysql_query("INSERT INTO admin SET admin_name='".$admin_name."', admin_password = md5('" . $admin_password . "')");
                mysql_close($connection);
            }
            $f=fopen("config.user.php","w");
            $database_inf="<?php
                        $type = 'mysql';
                        $database = '".$database_name."';
                        $host = '".$database_host."';
                        $user = '".$database_username."';
                        $password = '".$database_password."';
                        $charset = 'utf8';
                        define('DB_USERNAME', '');
                        define('DB_PASSWORD', '');
                        define('ADMIN_NAME', '".$admin_name."');
                        define('ADMIN_PASSWORD', '".$admin_password."');
                        ?>";
            if (fwrite($f,$database_inf)>0){
                fclose($f);
            }
            header("Location: 4");
            $_SESSION["feedback_positive"][] = "Configuration Done!";
        }
    }

    /**
     * Open the database connection
     */
    function sql_connect($type = 'mysql', $host, $database = false, $user, $password, $charset = 'utf8')
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new PDO($type.':host='.$host.';charset=' . $charset, $user, $password, $options);
        if (defined(EMULATED_SQL)) {$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, EMULATED_SQL);}
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}