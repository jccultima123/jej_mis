<?php

class Register extends Controller {
    
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
    
    public function index()
    {
        //require APP . 'view/_templates/notavailable.php';
        require APP . 'view/user/register.php';
    }
    
}
