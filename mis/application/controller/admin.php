<?php

class Admin extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        
    }
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/'index' (which is the default page btw)
     */
    public function index()
    {
        if (isset($_SESSION['user_logged_in'])) {
            // loading some models
            $amount_of_customers = $this->loadModel('Crm')->getAmountOfCustomers();
            // load views
            require APP . 'view/_templates/header.php';
            require APP . 'view/home/index.php';
            require APP . 'view/_templates/footer.php';
            exit;
        }
        else {
            // Destroying Session
            Session::destroy();
            // load views
            require APP . 'view/login/header.php';
            require APP . 'view/login/index.php';
            require APP . 'view/login/footer.php';
            exit();
        }
    }
}
