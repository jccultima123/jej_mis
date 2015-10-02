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
        require VIEWS_PATH . 'setup/header.php';
        require VIEWS_PATH . 'setup/index.php';
        require VIEWS_PATH . 'setup/footer.php';
    }

    function install($step)
    {
        require VIEWS_PATH . 'setup/header.php';
        switch($step){
            case '1':
                require VIEWS_PATH . 'setup/install/1.php';
                break;
            case '2':
                require VIEWS_PATH . 'setup/install/2.php';
                break;
            case '3':
                require VIEWS_PATH . 'setup/install/3.php';
                break;
            case '4':
                require VIEWS_PATH . 'setup/install/4.php';
                break;
            default:
                header('Location: install/1');
        }
        require VIEWS_PATH . 'setup/footer.php';
    }

}