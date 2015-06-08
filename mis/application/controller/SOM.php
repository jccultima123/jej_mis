<?php

class SOM extends MIS_Controller
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
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    function index()
    {
        if (isset($_SESSION['SALES_user_logged_in'])) {
            // load views
            $_SESSION["feedback_positive"][] = FEEDBACK_UNDER_DEVELOPMENT;
            require APP . 'view/SOM/sales/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/SOM/footer.php';
        } else if (isset($_SESSION['ORDER_user_logged_in'])) {
            // load views
            $_SESSION["feedback_positive"][] = FEEDBACK_UNDER_DEVELOPMENT;
            require APP . 'view/SOM/order/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/SOM/footer.php';
        }
        else if ((!isset($_SESSION['SALES_user_logged_in'])) OR (!isset($_SESSION['ORDER_user_logged_in']))) {
            $branches = $this->branch_model->getBranches();
            // load views
            require APP . 'view/SOM/login/header.php';
            require APP . 'view/SOM/login/index.php';
            require APP . 'view/SOM/login/footer.php';
            exit();
        } else {
            $branches = $this->branch_model->getBranches();
            // load views
            require APP . 'view/SOM/login/header.php';
            require APP . 'view/SOM/login/index.php';
            require APP . 'view/SOM/login/footer.php';
            exit();
        }
    }
    
    function accountOverview()
    {
        Auth::SOM_handleLogin();
        require APP . 'view/SOM/header.php';
        require APP . 'view/SOM/account/overview.php';
        require APP . 'view/SOM/footer.php';
    }
    
    function help()
    {
        Auth::SOM_handleLogin();
        require APP . 'view/_templates/null_header.php';
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/SOM/footer.php';
    }
    
    function about()
    {
        Auth::SOM_handleLogin();
        require APP . 'view/_templates/null_header.php';
        require APP . 'view/about/index.php';
        require APP . 'view/SOM/footer.php';
    }
    
    /**
     * The login action, when you do login/login
     */
    function loginuser()
    {
        Auth::handleCred();
        // perform the login method, put result (true or false) into $login_successful
        $login_successful = $this->som_model->login();
        // check login status
        if ($login_successful == true) {
            // if YES, then move user to dashboard/index (btw this is a browser-redirection, not a rendered view!)
            header('location: ' . URL . 'som');
        } else {
            // if NO, then move user to login/index (login form) again
            header('location: ' . URL . 'som');
        }
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $this->som_model->logout();
        // redirect user to base URL
        header('location: ' . URL . 'som');
    }
    
    function registerUser()
    {
        $branches = $this->branch_model->getBranches();
        $registration_successful = $this->som_model->submitRequest();
        if ($registration_successful == true) {
            header('location: ' . URL . 'som');
        } else {
            header('location: ' . URL . 'som');
            //require APP . 'view/SOM/login/registration.php';
            //exit;
        }
    }
    
    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }
}
