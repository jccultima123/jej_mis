<?php

class Registration extends Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->branch_model = $this->loadModel('Branch');
        $this->captcha_model = $this->loadModel('Captcha');
    }
    
    function index()
    {
        $branches = $this->branch_model->getBranches();
        $usertypes = $this->user_model->getUsertype();
        require APP . 'view/_templates/null_header.php';
        require APP . 'view/registration.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    function action()
    {
        if (isset($_POST['create_user'])) {
            $action_successful = $this->user_model->registerNewUser();
            if ($action_successful == true) {
                header('location: ' . URL);
            } else {
                header('location: ' . URL . 'registration');
            }
        } else {
            header('location: ' . URL);
        }
    }
    
    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }
    
}
