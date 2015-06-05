<?php

/**
 * Class Auth
 * Simply checks if user is logged in. In the app, several controllers use Auth::handleLogin() to
 * check if user if user is logged in, useful to show controllers/methods only to logged-in users.
 */
class Auth
{
    public static function handleLogin()
    {
        // initialize the session
        Session::init();

        // if user is still not logged in, then destroy session, handle user as "not logged in" and
        // redirect user to login page
        if (!isset($_SESSION['user_logged_in'])) {
            Session::destroy();
            header('location: ' . URL);
            exit();
        } else if (isset($_SESSION['SOM_user_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page unless you have Administrative Access<br />';
            require_once '_fb/403.html';
            exit();
        } else if (isset($_SESSION['AMS_user_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page unless you have Administrative Access<br />';
            require_once '_fb/403.html';
            exit();
        } else if (isset($_SESSION['CRM_user_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page unless you have Administrative Access<br />';
            require_once '_fb/403.html';
            exit();
        }
    }
    
    public static function handleMIS()
    {
        // NO ACCESS FOR ADMIN SINCE THEY CAN VIEW IN THEIR DASHBOARD INSTEAD
        if (isset($_SESSION['user_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page. If you are a ADMINISTRATOR, you can go to this <a href="'. URL .'admin">page</a> instead,<br />or ELSE please logout your current session and';
            require_once '_fb/403.html';
            exit();
        } else if (isset($_SESSION['user_logged_in']) && isset($_COOKIE['rememberme'])) {
            $ERROR = 'SORRY. You are not allowed to use this page. If you are a ADMINISTRATOR, you can go to this <a href="'. URL .'admin">page</a> instead,<br />or ELSE please logout your current session and';
            require_once '_fb/403.html';
            exit();
        } 
    }
    
    public static function SOM_handleLogin()
    {
        Session::init();
        if (isset($_SESSION['user_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page.';
            require_once '_fb/403.html';
            exit();
        } else if (!isset($_SESSION['SOM_user_logged_in'])) {
            Session::destroy();
            header('location: ' . URL . 'som/login');
            exit();
        } 
    }
    
    public static function AMS_handleLogin()
    {
        Session::init();
        if (isset($_SESSION['user_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page.';
            require_once '_fb/403.html';
            exit();
        } else if (!isset($_SESSION['AMS_user_logged_in'])) {
            Session::destroy();
            header('location: ' . URL . 'ams/login');
            exit();
        }
    }
    
    public static function CRM_handleLogin()
    {
        Session::init();
        if (isset($_SESSION['user_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page.';
            require_once '_fb/403.html';
            exit();
        } else if (!isset($_SESSION['CRM_user_logged_in'])) {
            Session::destroy();
            header('location: ' . URL . 'crm/login');
            exit();
        }
    }
    
    // IN ORDER TO AVOID LOGGING IN AGAIN WHEN THE USER IS ALREADY LOGGED IN
    public static function handleCred()
    {
        // initialize the session
        Session::init();

        if (isset($_SESSION['user_logged_in'])) {
            header('location: ' . URL . 'admin');
            exit();
        } else if (!isset($_SESSION['user_logged_in']) && isset($_COOKIE['rememberme'])) {
            // user has remember-me-cookie ? then try to login with cookie ("remember me" feature)
            header('location: ' . URL . 'admin/loginWithCookie');
            exit();
        } else if (isset($_SESSION['SOM_user_logged_in'])) {
            header('location: ' . URL . 'som');
            exit();
        } else if (!isset($_SESSION['SOM_user_logged_in']) && isset($_COOKIE['rememberme'])) {
            header('location: ' . URL . 'som/loginWithCookie');
            exit();
        } else if (isset($_SESSION['AMS_user_logged_in'])) {
            header('location: ' . URL . 'ams');
            exit();
        } else if (!isset($_SESSION['AMS_user_logged_in']) && isset($_COOKIE['rememberme'])) {
            header('location: ' . URL . 'ams/loginWithCookie');
            exit();
        } else if (isset($_SESSION['CRM_user_logged_in'])) {
            header('location: ' . URL . 'crm');
            exit();
        } else if (!isset($_SESSION['CRM_user_logged_in']) && isset($_COOKIE['rememberme'])) {
            header('location: ' . URL . 'crm/loginWithCookie');
            exit();
        }
    }
    
    public static function detectEnvironment()
    {
        if (ENVIRONMENT != 'development' && ENVIRONMENT != 'test') {
            $ERROR = "Sorry. The system might no be active at this moment. ";
            require '_fb/error.html';
            exit();
        }
    }
}
