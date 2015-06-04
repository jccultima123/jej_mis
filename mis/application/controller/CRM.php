<?php

class CRM extends MIS_Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        $this->crm_model = $this->loadModel('Crm');
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    function index()
    {
        Auth::CRM_handleLogin();
        require APP . 'view/_templates/header.php';
        require APP . 'view/crm/index.php';
        require APP . 'view/_templates/footer.php';
    }
    
    function customers()
    {
        $customers = $this->crm_model->getAllCustomers();
        $amount_of_customers = $this->crm_model->getAmountOfCustomers();
        require APP . 'view/_templates/header.php';
        require APP . 'view/crm/customers.php';
        require APP . 'view/_templates/footer.php';
    }
}
