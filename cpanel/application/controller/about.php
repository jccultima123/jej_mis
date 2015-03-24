<?php

/**
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class About extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/----/index
     */
    public function index()
    {
        // load views
        if (isset($_SESSION['user_logged_in'])) {
            // the user is logged in. you can do whatever you want here.
            // for demonstration purposes, we simply show the "you are logged in" view.
            require APP . 'view/_templates/header_logged_in.php';
        }
        else {
            Session::destroy();
            // the user is not logged in. you can do whatever you want here.
            // for demonstration purposes, we simply show the "you are not logged in" view.
            require APP . 'view/_templates/header.php';
        }
        require APP . 'view/about/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
