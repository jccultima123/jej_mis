<?php

/**
 * Created
 * Date: 10/2/2015
 * Time: 9:55 AM
 */

class Setup extends Controller
{
    function __construct()
    {
        //parent::__construct();
        //should be logout first
        Auth::handleMIS();
    }

    //Database Actions
    function databaseAction($action)
    {

    }

    function index()
    {
        Session::destroy();
        require VIEWS_PATH . 'setup/header.php';
        require VIEWS_PATH . 'setup/index.php';
        require VIEWS_PATH . 'setup/footer.php';
    }

    function install($step)
    {
        require VIEWS_PATH . 'setup/header.php';
        switch($step){
            case '1':
                if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agree'])){
                    Session::set('agreed', true);
                    header('Location: 2');
                    exit;
                }
                else if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['agree'])){
                    $_SESSION["feedback_negative"][] = "You must agree to the license.";
                } else {
                     Session::destroy();
                 }
                require VIEWS_PATH . 'setup/install/1.php';
                break;
            case '2':
                if(!isset($_SESSION["agreed"])){
                    $_SESSION["feedback_negative"][] = "You must agree first in this step before anything else";
                    header('Location: 1');
                    exit;
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] ==''){
                    header('Location: 3');
                    exit;
                }
                if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] != '')
                    echo $_POST['pre_error'];

                if (phpversion() < '5.3.7') {
                    $pre_error = 'You need to use PHP 5.3.7 or above for our site!<br />';
                }
                if (ini_get('session.auto_start')) {
                    $_SESSION["feedback_negative"][] = 'Our site will not work with session.auto_start enabled!<br />';
                }
                if (!extension_loaded('mysql')) {
                    $_SESSION["feedback_negative"][] = 'MySQL extension needs to be loaded for our site to work!<br />';
                }
                if (!extension_loaded('gd')) {
                    $_SESSION["feedback_negative"][] = 'GD extension needs to be loaded for our site to work!<br />';
                }
                if (!file_exists('config.php')) {
                    $_SESSION["feedback_negative"][] = 'config.php not found';
                }
                if (!is_writable('config.php')) {
                    $_SESSION["feedback_negative"][] = 'config.php needs to be writable for our site to be installed!';
                }
                require VIEWS_PATH . 'setup/install/2.php';
                break;
            case '3':
                if(!isset($_SESSION["agreed"])){
                    $_SESSION["feedback_negative"][] = "You must agree first in this step before anything else";
                    header('Location: 1');
                }
                if (isset($_POST['submit']) && $_POST['submit']=="Install!") {
                    $database_host=isset($_POST['database_host'])?$_POST['database_host']:"";
                    $database_name=isset($_POST['database_name'])?$_POST['database_name']:"";
                    $database_username=isset($_POST['database_username'])?$_POST['database_username']:"";
                    $database_password=isset($_POST['database_password'])?$_POST['database_password']:"";
                    $admin_name=isset($_POST['admin_name'])?$_POST['admin_name']:"";
                    $admin_password=isset($_POST['admin_password'])?$_POST['admin_password']:"";

                    if (empty($admin_name) || empty($admin_password) || empty($database_host) || empty($database_username) || empty($database_name)) {
                        $_SESSION["feedback_negative"][] = "All fields are required! Please re-enter.<br />";
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
                        header("Location: 4");
                    }
                }
                require VIEWS_PATH . 'setup/install/3.php';
                break;
            case '4':
                if(!isset($_SESSION["agreed"])){
                    $_SESSION["feedback_negative"][] = "You must agree first in this step before anything else";
                    header('Location: 1');
                }
                require VIEWS_PATH . 'setup/install/4.php';
                break;
            default:
                header('Location: 1');
        }
        require VIEWS_PATH . 'setup/footer.php';
    }

}