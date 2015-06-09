<?php

class Forgotpassword extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        Auth::handleMIS();
        // CORE
        $this->branch_model = $this->loadModel('Branch');
        $this->captcha_model = $this->loadModel('Captcha');
        $this->user_model = $this->loadModel('User');
    }
    
    public function index()
    {
        $branches = $this->branch_model->getBranches();
        $registration_successful = $this->user_model->requestPasswordReset();
        require APP . 'view/_templates/null_header.php';
        require APP . 'view/forgotpassword.php';
        require APP . 'view/_templates/null_footer.php';
    }
}
