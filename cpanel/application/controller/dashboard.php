<?php

class Dashboard extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();

        // this controller should only be visible/usable by logged in users, so we put login-check here
        Auth::handleLogin();
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    function index()
    {
        $amount_of_products = $this->model->getAmountOfProducts();
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/dashboard/index.php';
        require APP . 'view/_templates/footer.php';
    }
    
    function reports()
    {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/null_index.php';
        require APP . 'view/_templates/footer.php';
    }
}
