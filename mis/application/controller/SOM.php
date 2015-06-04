<?php

class SOM extends MIS_Controller
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
        Auth::SOM_handleLogin();
        require APP . 'view/_templates/header.php';
        require APP . 'view/som/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
