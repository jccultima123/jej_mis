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
            View::adminMode();
        } else {
            require VIEWS_PATH . 'CRM/header.php';
        }
        require VIEWS_PATH . 'CRM/index.php';
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
        $customer_count = $this->crm_model->getAmountOfCustomers();
        require VIEWS_PATH . 'CRM/header.php';
        View::adminMode();
        require VIEWS_PATH . 'CRM/customers.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    function feedbacks()
    {
        $feedbacks = $this->crm_model->getAllFeedbacks();
        $feedback_count = $this->crm_model->countFeedbacks();
        require VIEWS_PATH . 'CRM/header.php';
        View::adminMode();
        require VIEWS_PATH . 'CRM/feedbacks.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
}
