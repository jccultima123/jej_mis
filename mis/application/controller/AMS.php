<?php

class AMS extends MIS_Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        Session::init();
        // CORE
        $this->branch_model = $this->loadModel('Branch');
        $this->misc_model = $this->loadModel('Misc');
        $this->product_model = $this->loadModel('Product');
        // MIS COMPONENTS
        $this->ams_model = $this->loadModel('Ams');
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index()
    {
        if (isset($_SESSION['AMS_user_logged_in'])) {
            // load views
            $_SESSION["feedback_positive"][] = FEEDBACK_UNDER_DEVELOPMENT;
            require APP . 'view/admin/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/admin/footer.php';
            exit;
        }
        else {
            // Destroying Session
            Session::destroy();
            // load views
            require APP . 'view/AMS/login/header.php';
            require APP . 'view/AMS/login/index.php';
            require APP . 'view/AMS/login/footer.php';
            exit();
        }
    }
    
    public function about()
    {
        // load views
        require APP . 'view/AMS/header.php';
        require APP . 'view/AMS/about/index.php';
        require APP . 'view/AMS/footer.php';
    }
    
    /**
     * The login action, when you do login/login
     */
    function loginuser()
    {
        Session::destroy();
        Session::init();
        Auth::handleCred();
        // perform the login method, put result (true or false) into $login_successful
        $login_successful = $this->ams_model->login();
        // check login status
        if ($login_successful == true) {
            // if YES, then move user to dashboard/index (btw this is a browser-redirection, not a rendered view!)
            header('location: ' . URL . 'ams');
        } else {
            // if NO, then move user to login/index (login form) again
            header('location: ' . URL . 'ams');
        }
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $this->ams_model->logout();
        // redirect user to base URL
        header('location: ' . URL . 'ams');
    }
}
