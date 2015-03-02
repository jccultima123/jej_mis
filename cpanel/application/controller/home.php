<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // load views
        if (isset($_SESSION['logged_in'])) {
            // the user is logged in. you can do whatever you want here.
            // for demonstration purposes, we simply show the "you are logged in" view.
            require APP . 'view/_templates/header_logged_in.php';
            require APP . 'view/home/dashboard.php';
        } else {
            // the user is not logged in. you can do whatever you want here.
            // for demonstration purposes, we simply show the "you are not logged in" view.
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/index.php';
        }
        require APP . 'view/_templates/footer.php';
    }

    /**
     * PAGE: exampleone
     * This method handles what happens when you move to http://yourproject/home/exampleone
     * The camelCase writing is just for better readability. The method name is case-insensitive.
     */
    public function exampleOne()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/example_one.php';
        require APP . 'view/_templates/footer.php';
    }
    
    public function login()
    {
        // load views
        require APP . 'view/_templates/login_header.php';
        require APP . 'view/_templates/login.php';
        require APP . 'view/_templates/footer.php';
    }
    
    public function dashboard()
    {
        // load views
        if (isset($_SESSION['logged_in'])) {
            // the user is logged in. you can do whatever you want here.
            // for demonstration purposes, we simply show the "you are logged in" view.
            require APP . 'view/_templates/header_logged_in.php';
            require APP . 'view/home/dashboard.php';
        } else {
            // the user is not logged in. you can do whatever you want here.
            // for demonstration purposes, we simply show the "you are not logged in" view.
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/login.php';
        }
        require APP . 'view/_templates/footer.php';
    }
}
