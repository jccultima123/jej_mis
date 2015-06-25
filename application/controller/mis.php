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
class Mis extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        // CORE
        $this->branch_model = $this->loadModel('Branch');
        $this->captcha_model = $this->loadModel('Captcha');
    }
    
    public function index()
    {
        require APP . 'view/_templates/null_header.php';
        
        require APP . 'view/mis.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    public function login()
    {
        // perform the login method, put result (true or false) into $login_successful
        $login_successful = $this->user_model->login();
        // check login status
        if ($login_successful == true) {
            // if YES, then move user to dashboard/index (btw this is a browser-redirection, not a rendered view!)
            Auth::MIShandleCred();
        } else {
            // if NO, then move user to login/index (login form) again
            header('location: ' . URL);
        }
    }
}
