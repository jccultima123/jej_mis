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
        $this->install_model = $this->loadModel('Install');
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
                if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['pre_error'] == 0){
                    header('Location: 3');
                    exit;
                } else {
                    if (phpversion() < '5.3.7') {
                        $_SESSION["feedback_negative"][] = 'You need to use PHP 5.3.7 or above for our site!<br />';
                        $pre_error = true;
                    }
                    if (ini_get('session.auto_start')) {
                        $_SESSION["feedback_negative"][] = 'Our site will not work with session.auto_start enabled!<br />';
                        $pre_error = true;
                    }
                    if (!extension_loaded('mysql')) {
                        $_SESSION["feedback_negative"][] = 'MySQL extension needs to be loaded for our site to work!<br />';
                        $pre_error = true;
                    }
                    if (!extension_loaded('gd')) {
                        $_SESSION["feedback_negative"][] = 'GD extension needs to be loaded for our site to work!<br />';
                        $pre_error = true;
                    }
                    if (!file_exists('DB.sql')) {
                        $_SESSION["feedback_negative"][] = 'DB.sql not found. Please put dumped database file into /public folder';
                        $pre_error = true;
                    }
                    if (!file_exists('config.php')) {
                        $_SESSION["feedback_negative"][] = 'config.php not found';
                        $pre_error = true;
                    }
                    if (!is_writable('config.php')) {
                        $_SESSION["feedback_negative"][] = 'config.php needs to be writable for our site to be installed!';
                        $pre_error = true;
                    }
                    require VIEWS_PATH . 'setup/install/2.php';
                }
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

                    //Install from install_model
                    $this->install_model->sys_install($admin_name, $admin_password, $database_host, $database_username, $database_password, $database_name);
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