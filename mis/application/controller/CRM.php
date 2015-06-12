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
        if (isset($_SESSION['CRM_user_logged_in'])) {
            require APP . 'view/crm/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
        }
        else {
            // load views
            require APP . 'view/CRM/login/header.php';
            require APP . 'view/CRM/login/index.php';
            require APP . 'view/_templates/null_footer.php';
            exit();
        }
    }
    
    public function accountOverview()
    {
        Auth::CRM_handleLogin();
        require APP . 'view/CRM/header.php';
        require APP . 'view/CRM/account/overview.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    public function about()
    {
        Auth::CRM_handleLogin();
        require APP . 'view/CRM/header.php';
        require APP . 'view/about/index.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    /**
     * The login action, when you do login/login
     */
    function loginuser()
    {
        Auth::MIShandleCred();
        // perform the login method, put result (true or false) into $login_successful
        $login_successful = $this->crm_model->login();
        // check login status
        if ($login_successful == true) {
            // if YES, then move user to dashboard/index (btw this is a browser-redirection, not a rendered view!)
            header('location: ' . URL . 'crm');
        } else {
            // if NO, then move user to login/index (login form) again
            header('location: ' . URL . 'crm');
        }
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $this->crm_model->logout();
        // redirect user to base URL
        header('location: ' . URL . 'crm');
    }
    
    function registration()
    {
        $branches = $this->branch_model->getBranches();
        require APP . 'view/_templates/null_header.php';
        require APP . 'view/CRM/login/registration.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    function registerUser()
    {
        $branches = $this->branch_model->getBranches();
        $registration_successful = $this->crm_model->submitRequest();
        if ($registration_successful == true) {
            header('location: ' . URL . 'crm');
        } else {
            header('location: ' . URL . 'crm/registration');
            //require APP . 'view/CRM/login/registration.php';
            //exit;
        }
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
