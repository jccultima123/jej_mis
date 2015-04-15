<?php

class About extends Controller
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
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/----/index
     */
    public function index()
    {
        // load views
        if (isset($_SESSION['user_logged_in'])) {
            // the user is logged in. you can do whatever you want here.
            // for demonstration purposes, we simply show the "you are logged in" view.
            require APP . 'view/_templates/header.php';
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
