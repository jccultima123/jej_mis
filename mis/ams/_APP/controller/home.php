<?php

/**
 * Class Home
 * 
 * HOME PAGE OF THIS APPLICATION
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        
        /**
         * Auth concept was from PHP-LOGIN / HUGE
         * (c) Panique -- https://github.com/panique
         */
        
        // this controller should only be visible/usable by logged in users, so we put login-check here
        // Auth::handleLogin(); -- DISABLED FOR SAFETY
        Session::init();
    }
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/'index' (which is the default page btw)
     */
    public function index()
    {
        Session::init();
        if (isset($_SESSION['user_logged_in'])) {
            // loading some models
            $amount_of_customers = $this->loadModel('Crm')->getAmountOfCustomers();
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/index.php';
            require APP . 'view/_templates/footer.php';
            exit;
        }
        else {
            // Destroying Session
            Session::destroy();
            // load views
            require APP . 'view/login/header.php';
            require APP . 'view/login/index.php';
            require APP . 'view/login/footer.php';
            exit();
        }
    }
}
