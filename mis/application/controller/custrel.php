<?php

class Custrel extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();

        // this controller should only be visible/usable by logged in users, so we put login-check here
        Auth::handleLogin();
        $this->crm_model = $this->loadModel('Crm');
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    function index()
    {
        require APP . 'view/_templates/header.php';
        require APP . 'view/custrel/index.php';
        require APP . 'view/_templates/footer.php';
    }
    
    function customers()
    {
        $customers = $this->crm_model->getAllCustomers();
        $amount_of_customers = $this->crm_model->getAmountOfCustomers();
        require APP . 'view/_templates/header.php';
        require APP . 'view/custrem/customers.php';
        require APP . 'view/_templates/footer.php';
    }
}
