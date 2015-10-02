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