<?php

class AMS extends MIS_Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    function index()
    {
        Auth::AMS_handleLogin();
        require APP . 'view/_templates/header.php';
        require APP . 'view/ams/index.php';
        require APP . 'view/_templates/footer.php';
    }
    
    function login()
    {
        require APP . 'view/_admin/ams/login/header.php';
        require APP . 'view/_admin/ams/login/index.php';
        require APP . 'view/_admin/ams/login/footer.php';
    }
}
