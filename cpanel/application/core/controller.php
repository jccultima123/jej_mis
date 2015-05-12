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
            header('location: ' . URL . 'login/loginWithCookie');
        }
        
        /*
         * COMPATIBILITY CHECK
         */
        $browser = new Browser();
        
        if (($browser->getBrowser() == Browser::BROWSER_IE && $browser->getVersion() < 9)) {
            echo 'CRITICAL ERROR<br />This system is not compatible with your version of Internet Explorer.';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_SAFARI && $browser->getVersion() <= 7)) {
            echo 'CRITICAL ERROR<br />This system is not compatible with your version of Apple Safari.';
            exit;
        }
        else if ($browser->getBrowser() == Browser::PLATFORM_BLACKBERRY) {
            echo 'CRITICAL ERROR<br />This system is not compatible with your Blackberry Device.';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_FIREFOX && $browser->getVersion() <= 30)) {
            echo 'CRITICAL ERROR<br />This system is not compatible with your version of Firefox.';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_CHROME && $browser->getVersion() <= 30)) {
            echo 'CRITICAL ERROR<br />This system is not compatible with your version of Google Chrome.';
            exit;
        }
        else if (($browser->getBrowser() == Browser::BROWSER_ANDROID && $browser->getVersion() <= 4)) {
            echo 'CRITICAL ERROR<br />This system is not compatible with your Browser.';
            exit;
        } else {
            if (version_compare(PHP_VERSION, '5.3.7', '<')) {
                header('Location: phperror.html');
                exit();
            } else {
                try {
                    $this->openDatabaseConnection();
                } catch (PDOException $e) {
                    error_log($e->getMessage());
                    header('Location: database.html');
                    exit();
                }
                $this->loadModel();
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
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    /**
     * Loads the "model".
     * @return object model
     */
    public function loadModel()
    {
        // Smart model detection. It will exit if the model does not exist
        // MAIN MODELS
        
        /** LOGIN MODEL **/
        if (file_exists(APP . '/model/login_model.php')) {
            require APP . '/model/login_model.php';
            $this->login_model = new LoginModel($this->db);
        } else {
            header('Location: missing.html');
        }
        
        /** MIS **/
        if (file_exists(APP . '/model/account_model.php')) {
            require APP . '/model/account_model.php';
            $this->account_model = new AccountModel($this->db);
        } else {
            header('Location: missing.html');
        }
        if (file_exists(APP . '/model/asset_model.php')) {
            require APP . '/model/asset_model.php';
            $this->asset_model = new AssetModel($this->db);
        } else {
            header('Location: missing.html');
        }
        if (file_exists(APP . '/model/crm_model.php')) {
            require APP . '/model/crm_model.php';
            $this->crm_model = new CrmModel($this->db);
        } else {
            header('Location: missing.html');
        }
        /** SALES AND ORDERS MANAGEMENT **/
        if (file_exists(APP . '/model/som_model.php')) {
            require APP . '/model/som_model.php';
            $this->sales_model = new SalesModel($this->db);
            $this->orders_model = new OrdersModel($this->db);
        } else {
            header('Location: missing.html');
        }
        // OTHER MODELS
        if (file_exists(APP . '/model/dev_model.php')) {
            require APP . '/model/dev_model.php';
            $this->dev_model = new DevModel($this->db);
        } else {
            header('Location: missing.html');
        }
        if (file_exists(APP . '/model/product_model.php')) {
            require APP . '/model/product_model.php';
            $this->product_model = new ProductModel($this->db);
        } else {
            header('Location: missing.html');
        }
        if (file_exists(APP . '/model/note_model.php')) {
            require APP . '/model/note_model.php';
            $this->note_model = new NoteModel($this->db);
        } else {
            header('Location: missing.html');
        }
        if (file_exists(APP . '/model/misc_model.php')) {
            require APP . '/model/misc_model.php';
            $this->model = new Model($this->db);
        } else {
            header('Location: missing.html');
        }
    }
    
    /**
     * renders the feedback messages into the view
     */
    public function renderFeedbackMessages()
    {
        // echo out the feedback messages (errors and success messages etc.),
        // they are in $_SESSION["feedback_positive"] and $_SESSION["feedback_negative"]
        require APP . 'view/_templates/feedback.php';

        // delete these messages (as they are not needed anymore and we want to avoid to show them twice
        Session::set('feedback_positive', null);
        Session::set('feedback_negative', null);
    }

}
