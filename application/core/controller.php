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
        BrowserLib::detectCompatibility();
        if (version_compare(PHP_VERSION, '5.3.7', '<')) {
            $ERROR = "Our servers might not be available at the moment. ";
            require_once '_fb/error_2.html';
            exit();
        } else {
            try {
                $this->openDatabaseConnection();
            } catch (PDOException $e) {
                error_log($e->getMessage());
                
                //specifies error file cause of ui conflicts (error, error_2, error_3, and so on..)
                Auth::detectEnvironment('error');
                
                $ERROR = "The database was either unable to connect or doesn't exists.<br />
                          If you are experiencing this for the first time or never logged in before. You may go to our <a href='" . URL . "setup'>setup</a>.<hr /><b>DEBUG:</b> " . $e . "<hr />";
                require_once '_fb/error.html';
                exit();
            }
        }
        Session::init();
        $this->user_model = $this->loadModel('User');
        //$this->user_model->checkUsers();
        
        //Audit Trail
        $this->audit_model = $this->loadModel('Audit');
        
        //Configs
        $this->config = $this->loadModel('Config');
        $config = $this->config->loadUserConfig();
        //MIS Wallpaper
        if ($config) {
            define('WALLPAPER', URL . 'img/' . $config->wallpaper);
        } else {
            define('WALLPAPER', DEFAULT_BG);
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
        if (defined(EMULATED_SQL)) {$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, EMULATED_SQL);}
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
                Auth::detectEnvironment('error');
                $ERROR = "The file " . $path . " exixts but the classes might be missing. ";
                require '_fb/error.html';
                exit;
            }
        }
        else {
            Auth::detectEnvironment('error_2');
            $ERROR = "The file " . $path . " might be corrupted or missing. ";
            require '_fb/error_2.html';
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
        require VIEWS_PATH . '_templates/feedback.php';

        // delete these messages (as they are not needed anymore and we want to avoid to show them twice
        Session::set('feedback_positive', null);
        Session::set('feedback_negative', null);
        Session::set('feedback_note', null);
    }
    
    /* Improved Render function
     * Concept by panique / (c) Corsanes (jccultima123)
     * TODO: Not should be a static since it's not / $this issues
     */
    public function render($module, $sub, $profile)
    {
        if (!isset($sub)) {
            //default index
            $sub = 'index';
        }
        if (!isset($profile)) {
            //default profile
            $profile = 'default';
        }
        /* $profile
         * default -- simple render with default header and footer of your module
         * custom -- render with less limits, but more potential conflicts unless you know what you're doing
         * static -- static. right? no javascript, everything but static html
         */
        switch ($profile) {
            case 'default':
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . 'header.php';
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . $sub . '.php';
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . 'footer.php';
                break;
            case 'custom':
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . $sub . '.php';
                break;
            case 'static':
                require VIEWS_PATH . TEMPLATE . 'static_header.php';
                $this->adminMode();
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . $sub . '.php';
                require VIEWS_PATH . TEMPLATE . 'static_footer.php';
                break;
            default:
                $ERROR = "There's something wrong in rendering views.";
                require_once "_fb/error.html";
                exit();
        }
    }
    
    // Custom Echo with length modifier
    public function custom_echo($x, $length)
    {
      if(strlen($x)<=$length)
      {
        echo $x;
      }
      else
      {
        $y=substr($x,0,$length) . '... (Read More)';
        echo $y;
      }
    }

}
