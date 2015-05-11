<?php

class Settings extends Controller
{
    function __construct()
    {
        parent::__construct();
        
        Auth::handleLogin();
    }

    function index()
    {
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/footer.php';
    }
    
}
