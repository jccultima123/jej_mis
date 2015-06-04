<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 * Whenever a controller is created, we also
 * 1. initialize a session
 * 2. check if the user is not logged in anymore (session timeout) but has a cookie
 * 3. create a database connection (that will be passed to all models that need a database connection)
 * 4. create a view object
 */
class Controller
{   
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $model = null;

    /**
     * Whenever controller is created, open a database connection too and load "the model".
     * Experimental : Log In and Out
     */
    function __construct()
    {
        Session::init();
        
        // user has remember-me-cookie ? then try to login with cookie ("remember me" feature)
        if (!isset($_SESSION['user_logged_in']) && isset($_COOKIE['rememberme'])) {
            header('location: ' . URL .'login/loginWithCookie');
        }
        
        /*
         * COMPATIBILITY CHECK
         */
        $browser = new Browser();
        
        if (($browser->getBrowser() == Browser::BROWSER_IE && $browser->getVersion() < 9)) {
            $ERROR = 'This system is not compatible with your version of Internet Explorer unless you <a href="http://windows.microsoft.com/en-US/internet-explorer/download-ie" target="_blank">upgrade.</a>';
            require_once '_fb/error.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_SAFARI && $browser->getVersion() <= 7)) {
            $ERROR = 'This system is not compatible with your version of Apple Safari.';
            require_once '_fb/error.html';
            exit;
        }
        else if ($browser->getPlatform() == Browser::PLATFORM_BLACKBERRY) {
            $ERROR = 'This system is not compatible with your Blackberry Device.';
            require_once '_fb/error.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_FIREFOX && $browser->getVersion() <= 30)) {
            $ERROR = 'This system is not compatible with your version of Firefox.';
            require_once '_fb/error.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_OPERA && $browser->getVersion() <= 13)) {
            $ERROR = 'This system is not compatible with your version of Firefox.';
            require_once '_fb/error.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() <= 30)) {
            $ERROR = 'This system is not compatible with your version of Google Chrome.';
            require_once '_fb/error.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_ANDROID && $browser->getVersion() <= 4)) {
            $ERROR = 'This system is not compatible with your Browser.';
            require_once '_fb/error.html';
            exit;
        } else {
            if (version_compare(PHP_VERSION, '5.3.7', '<')) {
                $ERROR = "Our servers might not be available at the moment. ";
                require_once '_fb/error.html';
                exit();
            } else {
                try {
                    $this->openDatabaseConnection();
                } catch (PDOException $e) {
                    error_log($e->getMessage());
                    $ERROR = "The database was either unable to connect or doesn't exists. ";
                    require_once '_fb/error.html';
                    exit();
                }
            }
        }
        
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE .':host=' . DB_HOST .';dbname=' . DB_NAME .';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }
    
    /**
     * loads the model with the given name.
     * ALTERNATIVE WAY BUT MORE EFFICIENT!
     * @param $name string name of the model
     */
    public function loadModel($name)
    {
        $path = MODELS_PATH . strtolower($name) . '_model.php';
        
        if (file_exists($path)) {
            require $path;
            $modelName = $name . 'Model';
            if (isset($modelName)) {
                return new $modelName($this->db);
            }
            else {
                Auth::detectEnvironment();
            }
        }
        else {
            $ERROR = 'Required Model was missing.';
            require '_fb/error.html';
            exit;
        }
    }
    
    /**
     * renders the feedback messages into the view
     */
    public function renderFeedbackMessages()
    {
        // echo out the feedback messages (errors and success messages etc.),
        // they are in $_SESSION["feedback_positive"] and $_SESSION["feedback_negative"]
        require APP .'view/_templates/feedback.php';

        // delete these messages (as they are not needed anymore and we want to avoid to show them twice
        Session::set('feedback_positive', null);
        Session::set('feedback_negative', null);
    }

}

/*
 * BASE CONTROLLER FOR MIS
 */
class MIS_Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $model = null;

    function __construct()
    {
        Session::init();
        
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
        
        if (isset($_SESSION['SOM_user_logged_in'])) {
            $ERROR = 'SORRY. You are not allowed to use this page. Please logout your current session and';
            header('location: ' . URL . 'som');
            exit();
        }
        if (!isset($_SESSION['SOM_user_logged_in']) && isset($_COOKIE['SOM_rememberme'])) {
            header('location: ' . URL . 'som/loginWithCookie');
        } else if (!isset($_SESSION['AMS_user_logged_in']) && isset($_COOKIE['AMS_rememberme'])) {
            header('location: ' . URL . 'ams/loginWithCookie');
        } else if (!isset($_SESSION['CRM_user_logged_in']) && isset($_COOKIE['CRM_rememberme'])) {
            header('location: ' . URL . 'crm/loginWithCookie');
        }
        
        /*
         * COMPATIBILITY CHECK
         */
        $browser = new Browser();
        
        if (($browser->getBrowser() == Browser::BROWSER_IE && $browser->getVersion() < 9)) {
            $ERROR = 'This system is not compatible with your version of Internet Explorer unless you <a href="http://windows.microsoft.com/en-US/internet-explorer/download-ie" target="_blank">upgrade.</a>';
            require_once '_fb/error_2.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_SAFARI && $browser->getVersion() <= 7)) {
            $ERROR = 'This system is not compatible with your version of Apple Safari.';
            require_once '_fb/error_2.html';
            exit;
        }
        else if ($browser->getPlatform() == Browser::PLATFORM_BLACKBERRY) {
            $ERROR = 'This system is not compatible with your Blackberry Device.';
            require_once '_fb/error_2.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_FIREFOX && $browser->getVersion() <= 30)) {
            $ERROR = 'This system is not compatible with your version of Firefox.';
            require_once '_fb/error_2.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_OPERA && $browser->getVersion() <= 13)) {
            $ERROR = 'This system is not compatible with your version of Firefox.';
            require_once '_fb/error_2.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() <= 30)) {
            $ERROR = 'This system is not compatible with your version of Google Chrome.';
            require_once '_fb/error_2.html';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_ANDROID && $browser->getVersion() <= 4)) {
            $ERROR = 'This system is not compatible with your Browser.';
            require_once '_fb/error_2.html';
            exit;
        } else {
            if (version_compare(PHP_VERSION, '5.3.7', '<')) {
                $ERROR = "Our servers might not be available at the moment. ";
                require_once '_fb/error_2.html';
                exit();
            } else {
                try {
                    $this->openDatabaseConnection();
                } catch (PDOException $e) {
                    error_log($e->getMessage());
                    $ERROR = "The database was either unable to connect or doesn't exists. ";
                    require_once '_fb/error_2.html';
                    exit();
                }
            }
        }
        
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE .':host=' . DB_HOST .';dbname=' . DB_NAME .';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }
    
    /**
     * loads the model with the given name.
     * ALTERNATIVE WAY BUT MORE EFFICIENT!
     * @param $name string name of the model
     */
    public function loadModel($name)
    {
        $path = MODELS_PATH . strtolower($name) . '_model.php';
        
        if (file_exists($path)) {
            require $path;
            $modelName = $name . 'Model';
            if (isset($modelName)) {
                return new $modelName($this->db);
            }
            else {
                Auth::detectEnvironment();
            }
        }
        else {
            $ERROR = 'Required Model was missing.';
            require '_fb/error.html';
            exit;
        }
    }
    
    /**
     * renders the feedback messages into the view
     */
    public function renderFeedbackMessages()
    {
        // echo out the feedback messages (errors and success messages etc.),
        // they are in $_SESSION["feedback_positive"] and $_SESSION["feedback_negative"]
        require APP .'view/_templates/feedback.php';

        // delete these messages (as they are not needed anymore and we want to avoid to show them twice
        Session::set('feedback_positive', null);
        Session::set('feedback_negative', null);
    }
}
