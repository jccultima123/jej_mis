<?php

class AMS extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        Auth::ASSEThandleLogin();
        // CORE
        $this->branch_model = $this->loadModel('Branch');
        $this->captcha_model = $this->loadModel('Captcha');
        $this->misc_model = $this->loadModel('Misc');
        $this->product_model = $this->loadModel('Product');
        // MIS
        $this->ams_model = $this->loadModel('AMS');
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index()
    {
        if (isset($_SESSION['admin_logged_in'])) {
            require APP . 'view/AMS/header.php';
            require APP . 'view/_templates/admin_mode.php';
        } else {
            require APP . 'view/AMS/header.php';
        }
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    public function accountOverview()
    {
        require APP . 'view/AMS/header.php';
        require APP . 'view/AMS/account/overview.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    function help()
    {
        require APP . 'view/AMS/header.php';
        if (isset($_SESSION['admin_logged_in'])) {
            require APP . 'view/_templates/admin_mode.php';
        }
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    public function about()
    {
        require APP . 'view/AMS/header.php';
        if (isset($_SESSION['admin_logged_in'])) {
            require APP . 'view/_templates/admin_mode.php';
        }
        require APP . 'view/about/index.php';
        require APP . 'view/_templates/null_footer.php';
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $this->user_model->logout($_SESSION['ASSET_user_logged_in']);
        // redirect user to base URL
        header('location: ' . URL);
    }
    
    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }
    
    function customers()
    {
        $customers = $this->ams_model->getAllCustomers();
        $amount_of_customers = $this->ams_model->getAmountOfCustomers();
        require APP . 'view/_templates/header.php';
        require APP . 'view/ams/customers.php';
        require APP . 'view/_templates/footer.php';
    }
}
