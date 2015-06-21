<?php

class Panel extends MIS_Controller
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
        // MIS COMPONENTS
        $this->som_model = $this->loadModel('Som');
        $this->sales_model = $this->loadModel('Sales');
        $this->order_model = $this->loadModel('Order');
        $this->ams_model = $this->loadModel('Ams');
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    function index()
    {
        if (isset($_SESSION['admin_logged_in'])) {
            require APP . 'view/_templates/null_header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
        } else if (!isset($_SESSION['MIS_user_logged_in'])) {
            header('location: ' . URL);
        } else {
            require APP . 'view/MIS/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
        }
    }
    
    function accountOverview()
    {
        Auth::MIShandleLogin();
        require APP . 'view/SOM/header.php';
        require APP . 'view/SOM/account/overview.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    function help()
    {
        Auth::MIShandleLogin();
        require APP . 'view/_templates/null_header.php';
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    function about()
    {   
        Auth::MIShandleLogin();
        require APP . 'view/_templates/null_header.php';
        require APP . 'view/about/index.php';
        require APP . 'view/_templates/null_footer.php';
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $logout = $this->user_model->logout($_SESSION['MIS_user_logged_in']);
        // check login status
        if ($logout == true) {
            // if YES, then move user to dashboard/index (btw this is a browser-redirection, not a rendered view!)
            header('location: ' . URL);
        } else {
            // if NO, then move user to login/index (login form) again
            header('location: ' . URL);
        }
    }
    
    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }
}
