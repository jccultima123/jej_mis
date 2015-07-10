<?php

class CRM extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        Auth::CRMhandleLogin();
        // CORE
        $this->branch_model = $this->loadModel('Branch');
        $this->captcha_model = $this->loadModel('Captcha');
        $this->misc_model = $this->loadModel('Misc');
        $this->product_model = $this->loadModel('Product');
        // MIS
        $this->crm_model = $this->loadModel('CRM');
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index()
    {
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . 'CRM/header.php';
            require VIEWS_PATH . '_templates/admin_mode.php';
        } else {
            require VIEWS_PATH . 'CRM/header.php';
        }
        require VIEWS_PATH . '_templates/notavailable.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    public function accountOverview()
    {
        require VIEWS_PATH . 'CRM/header.php';
        require VIEWS_PATH . 'CRM/account/overview.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    function help()
    {
        require VIEWS_PATH . 'CRM/header.php';
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_templates/admin_mode.php';
        }
        require VIEWS_PATH . '_templates/notavailable.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    public function about()
    {
        require VIEWS_PATH . 'CRM/header.php';
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_templates/admin_mode.php';
        }
        require VIEWS_PATH . 'about/index.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $this->user_model->logout($_SESSION['CRM_user_logged_in']);
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
        require VIEWS_PATH . '_templates/header.php';
        require VIEWS_PATH . 'crm/customers.php';
        require VIEWS_PATH . '_templates/footer.php';
    }
}
