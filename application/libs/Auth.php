<?php

/**
 * Class Auth
 * Simply checks if user is logged in. In the app, several controllers use Auth::handleLogin() to
 * check if user if user is logged in, useful to show controllers/methods only to logged-in users.
 */
class Auth
{
    public static function handlePassReset()
    {
        // initialize the session
        Session::init();

        if (isset($_SESSION['admin_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page. Please logout your current session and';
            require_once '_fb/403.html';
            exit();
        } else if (isset($_SESSION['MIS_user_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page. Please logout your current session and';
            require_once '_fb/403.html';
            exit();
        } else if (isset($_SESSION['CRM_user_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page. Please logout your current session and';
            require_once '_fb/403.html';
            exit();
        }
    }
    
    public static function handleMIS()
    {
        Session::init();
        if (isset($_SESSION['MIS_user_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page. Please logout your current session and';
            require_once '_fb/403_2.html';
            exit();
        } else if (isset($_SESSION['CRM_user_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page. Please logout your current session and';
            require_once '_fb/403_2.html';
            exit();
        }
    }
    
    public static function handleLogin()
    {
        // initialize the session
        Session::init();

        // if user is still not logged in, then destroy session, handle user as "not logged in" and
        // redirect user to login page
        if (!isset($_SESSION['admin_logged_in'])) {
            Session::destroy();
            header('location: ' . URL);
            exit();
        }
    }
    
        public static function MIShandleLogin()
        {
            if (isset($_SESSION['admin_logged_in'])) {
                return true;
            } else if (!isset($_SESSION['MIS_user_logged_in'])) {
                Session::destroy();
                header('location: ' . URL);
                exit();
            }
        }
        
        public static function CRMhandleLogin()
        {
            if (isset($_SESSION['admin_logged_in'])) {
                return true;
            } else if (!isset($_SESSION['CRM_user_logged_in'])) {
                Session::destroy();
                header('location: ' . URL);
                exit();
            }
        }


        // IN ORDER TO AVOID LOGGING IN AGAIN WHEN THE USER IS ALREADY LOGGED IN
    public static function handleCred()
    {
        // initialize the session
        Session::init();

        if (isset($_SESSION['admin_logged_in'])) {
            header('location: ' . URL . 'admin');
            exit();
        } else if (!isset($_SESSION['admin_logged_in']) && isset($_COOKIE['rememberme'])) {
            // user has remember-me-cookie ? then try to login with cookie ("remember me" feature)
            header('location: ' . URL . 'admin/loginWithCookie');
            exit();
        } else if (isset($_SESSION['MIS_user_logged_in'])) {
            header('location: ' . URL . 'panel');
            exit();
        } else if (isset($_SESSION['CRM_user_logged_in'])) {
            header('location: ' . URL . 'crm');
            exit();
        }
    }
    
    public static function MIShandleCred()
    {
        // initialize the session
        Session::init();
        
        if (isset($_SESSION['MIS_user_logged_in'])) {
            header('location: ' . URL . 'panel');
            exit();
        } else if (isset($_SESSION['CRM_user_logged_in'])) {
            header('location: ' . URL . 'crm');
            exit();
        }
    }
    
    public static function detectEnvironment()
    {
        if (ENVIRONMENT != 'development' && ENVIRONMENT != 'test') {
            $ERROR = "Sorry. The system might no be active at this moment. ";
            require '_fb/error_2.html';
            exit();
        }
    }
    
        public static function detectDBEnv($helper)
        {
            if (ENVIRONMENT != 'release') {
                $output = '<br /><br />PDO DEBUG : ' . $helper;
                return $output;
            }
        }
    
    public static function isInternetAvailible($address, $port) {
        //check, if internet connection exists
        $connected = fsockopen($address, $port);
        //website, port  (try 80 or 443)
        if ($connected) {
            fclose($connected);
            return true;
        } else {
            return false;
        }
    }
    
    public static function setuser($type) {
        if ($type == 'STAFF') {
            Session::set('MIS_user_logged_in', true);
        } else if ($type == 'CRM') {
            Session::set('CRM_user_logged_in', true);
        } else {
            return false;
        }
    }

}