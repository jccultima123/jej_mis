<?php

class CRM extends MIS_Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        // CORE
        $this->branch_model = $this->loadModel('Branch');
        $this->captcha_model = $this->loadModel('Captcha');
        $this->misc_model = $this->loadModel('Misc');
        $this->product_model = $this->loadModel('Product');
        // MIS
        $this->crm_model = $this->loadModel('Crm');
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index()
    {
        Auth::handleLogin();
        if (isset($_SESSION['admin_logged_in'])) {
            require APP . 'view/admin/header.php';
        } else {
            require APP . 'view/CRM/header.php';
        }
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    public function accountOverview()
    {
        Auth::handleLogin();
        require APP . 'view/CRM/header.php';
        require APP . 'view/CRM/account/overview.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    public function about()
    {
        Auth::handleLogin();
        require APP . 'view/CRM/header.php';
        require APP . 'view/about/index.php';
        require APP . 'view/_templates/null_footer.php';
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $this->user_model->logout();
        // redirect user to base URL
        header('location: ' . URL);
    }
    
    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
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
