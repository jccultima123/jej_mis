<?php

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
        
        try
        {
            $this->openDatabaseConnection();
        }
        catch(PDOException $e) {
            error_log($e->getMessage());
            die('CRITICAL ERROR<br />An database connection error occured.');
        }
        
        if (version_compare(PHP_VERSION, '5.3.7', '<'))
                {
                    exit("Sorry, Your PHP Version does not seem to run for this system. At least version 5.3.7 or higher will work.");
                }
        else {$this->loadModel();}
        
        Session::init();

        // user has remember-me-cookie ? then try to login with cookie ("remember me" feature)
        if (!isset($_SESSION['user_logged_in']) && isset($_COOKIE['rememberme'])) {
            header('location: ' . URL . 'login/loginWithCookie');
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
        //DEFAULT MODEL
        require APP . '/model/model.php';        
        // create new "model" (and pass the database connection)
        $this->model = new Model($this->db);
        
        //LOGIN MODEL
        require APP . '/model/login_model.php';
        $this->login = new LoginModel($this->db);
        
        //MAIN
        require APP . '/model/product_model.php';
        $this->products = new product_model($this->db);
        
        //OTHERS
        require APP . '/model/dev_model.php';
        $this->dev_model = new Dev_Model($this->db);
    }
    

}
