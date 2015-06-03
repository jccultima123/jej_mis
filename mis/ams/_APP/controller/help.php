<?php

/**
 * Class Help
 * The help area
 */
class Help extends Controller
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
     * This method controls what happens when you move to /help/index in your app.
     */
    function index()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/footer.php';
    }
}
