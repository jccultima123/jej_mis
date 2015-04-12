<?php

/**
 * Class Dashboard
 * This is a demo controller that simply shows an area that is only visible for the logged in user
 * because of Auth::handleLogin(); in line 19.
 */
class Settings extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();

        // this controller should only be visible/usable by logged in users, so we put login-check here
        Auth::handleLogin();
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    function index()
    {
        // load views
        //if (isset($_SESSION['user_logged_in'])) {
            // the user is logged in. you can do whatever you want here.
            // for demonstration purposes, we simply show the "you are logged in" view.
            require APP . 'view/_templates/header.php';
            require APP . 'view/settings/index.php';
            require APP . 'view/_templates/footer.php';
        /*} else {
            header('location: ' . URL . 'error/accessdenied');
        }*/
    }
    
    function account()
    {
        // load views
        //if (isset($_SESSION['user_logged_in'])) {
            // the user is logged in. you can do whatever you want here.
            // for demonstration purposes, we simply show the "you are logged in" view.
            require APP . 'view/_templates/header.php';
            require APP . 'view/settings/account.php';
            require APP . 'view/_templates/footer.php';
        /*} else {
            header('location: ' . URL . 'error/accessdenied');
        }*/
    }
}
