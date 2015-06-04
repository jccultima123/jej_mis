<?php

/**
 * Obtained from PHP-LOGIN / HUGE
 * (c) Panique -- https://github.com/panique
 */

/**
 * Login Controller
 * Controls the login processes
 */

class Login extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        
        Auth::handleCred();
        $this->login_model = $this->loadModel('Login');
    }

    /**
     * Index, default action (shows the login form), when you do login/index
     */
    function index()
    {   
        require APP . 'view/login/header.php';
        require APP . 'view/login/index.php';
        require APP . 'view/login/footer.php';
    }

    /**
     * The login action, when you do login/login
     */
    function login()
    {
        // perform the login method, put result (true or false) into $login_successful
        $login_successful = $this->login_model->login();

        // check login status
        if ($login_successful == true) {
            // if YES, then move user to dashboard/index (btw this is a browser-redirection, not a rendered view!)
            header('location: ' . URL);
        } else {
            // if NO, then move user to login/index (login form) again
            header('location: ' . URL . 'login');
        }
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        //MOVED TO LOGOUT CONTROLLER
    }

    /**
     * Login with cookie
     */
    function loginWithCookie()
    {
        // run the loginWithCookie() method in the login-model, put the result in $login_successful (true or false)
        $login_successful = $this->login_model->loginWithCookie();

        if ($login_successful) {
            header('location: ' . URL);
        } else {
            // delete the invalid cookie to prevent infinite login loops
            $login_model->deleteCookie();
            // if NO, then move user to login/index (login form) (this is a browser-redirection, not a rendered view)
            header('location: ' . URL . 'login');
        }
    }
}
