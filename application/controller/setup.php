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
        $this->setup_model = $this->loadModel('Setup');
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
                    Session::set('passed', true);
                    header('Location: 3');
                    exit;
                } else {
                    $this->system_check();
                    require VIEWS_PATH . 'setup/install/2.php';
                }
                break;
            case '3':
                if(!isset($_SESSION["passed"])){
                    $_SESSION["feedback_negative"][] = "ERR! Some components are not yet passed or missed the Step 2!";
                    header('Location: 2');
                    exit;
                }
                if(!isset($_SESSION["agreed"])){
                    $_SESSION["feedback_negative"][] = "You must agree first in this step before anything else";
                    header('Location: 1');
                    exit;
                }
                if (isset($_POST['submit'])) {
                    $database_host=isset($_POST['database_host'])?$_POST['database_host']:"";
                    $database_name=isset($_POST['database_name'])?$_POST['database_name']:"";
                    $database_username=isset($_POST['database_username'])?$_POST['database_username']:"";
                    $database_password=isset($_POST['database_password'])?$_POST['database_password']:"";
                    $admin_name=isset($_POST['admin_name'])?$_POST['admin_name']:"";
                    $admin_password=isset($_POST['admin_password'])?$_POST['admin_password']:"";
                    //Install from setup_model
                    $this->setup_model->sys_install($admin_name, $admin_password, $database_host, $database_username, $database_password, $database_name);

                } else if (isset($_POST['connect'])) {
                    try {
                        $this->setup_model->sql_connect(false, $_POST['database_username'], $_POST['database_password']);
                        $_SESSION["feedback_positive"][] = "Database connection test has no failures.";
                    } catch (PDOException $e) {
                        error_log($e->getMessage());
                        $_SESSION["feedback_negative"][] = "Connection Fail!<br /><br />" . $e;
                    }
                }
                require VIEWS_PATH . 'setup/install/3.php';
                break;
            case '4':
                /*
                if(!isset($_SESSION["agreed"])){
                    $_SESSION["feedback_negative"][] = "You must agree first in this step before anything else";
                    Session::destroy();
                    header('Location: 1');
                    exit;
                } else {
                    Session::destroy();
                }
                */
                //$msg = 'Hi';
                require VIEWS_PATH . 'setup/install/4.php';
                break;
            case 'finish':
                if (isset($_POST['finish'])) {
                    //auth first
                    if (isset($_POST['readme'])) {
                        $file_name = "changelog.html";
                        if (file_exists($file_name)) {
                            $file = fopen($file_name,"r");
                            while(! feof($file))
                            {
                                $_SESSION["feedback_note"][] = fgets($file);
                            }
                            fclose($file);
                        } else {
                            $_SESSION["feedback_note"][] = $file_name . " was not found at the moment.";
                        }
                    }
                    //then headers
                    if (isset($_POST['run_now'])) {
                        header('Location: '. URL . 'mis');
                    } else {
                        header('Location: '. URL);
                    }
                    exit;
                } else if (isset($_POST['start'])) {
                    header('Location: '. URL . 'setup/install');
                }
            default:
                header('Location: 1');
        }
        require VIEWS_PATH . 'setup/footer.php';
    }

    function system_check($pre_error = false)
    {
        if (phpversion() < '5.3.7') {
            $_SESSION["feedback_negative"][] = 'You need to use PHP 5.3.7 or above for our site!';
            $pre_error = true;
        }
        $lib = '../vendor' . '/autoload.php';
        if (!file_exists($lib)) {
            $_SESSION["feedback_negative"][] = 'PHP Composer is required. Go to <a style="text-decoration: underline;" target="_blank" href="http://getcomposer.org">this website</a> for more information.';
            define('NO_COMPOSER', true);
            $pre_error = true;
        }
        if (!class_exists('PDO')) {
            $_SESSION["feedback_negative"][] = 'PDO (Database Module) is required for this system.';
            $pre_error = true;
        }
        if (ini_get('session.auto_start')) {
            $_SESSION["feedback_negative"][] = 'Our site will not work with session.auto_start enabled!';
            $pre_error = true;
        }
        if (!extension_loaded('mysql')) {
            $_SESSION["feedback_negative"][] = 'MySQL extension needs to be loaded for our site to work!';
            $pre_error = true;
        }
        if (!extension_loaded('gd')) {
            $_SESSION["feedback_negative"][] = 'GD extension needs to be loaded for our site to work!';
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
        if (BrowserLib::Check() == false) {
            $_SESSION["feedback_negative"][] = 'Your current browser is not legible to continue this setup.';
            $pre_error = true;
        }
        if (isset($pre_error)) {
            unset($_SESSION["passed"]);
        }
    }

}