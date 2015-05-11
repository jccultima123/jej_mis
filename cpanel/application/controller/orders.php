<?php

class Orders extends Controller
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
    
    function index()
    {
        require APP . 'view/error/error_header.php';
        require APP . 'view/error/403.php';
        require APP . 'view/error/error_footer.php';
    }
            
    function add()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/footer.php';
    }
    
    function edit()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/footer.php';
    }
    
    function delete()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/footer.php';
    }
    
    function search()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/footer.php';
    }
}
