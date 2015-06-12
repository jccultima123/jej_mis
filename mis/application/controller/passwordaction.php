<?php

class passwordAction extends Controller
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
    }
    
    public function forgot()
    {
        $branches = $this->branch_model->getBranches();
        require APP . 'view/_templates/null_header.php';
        require APP . 'view/password/forgot.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    public function reset()
    {
        $branches = $this->branch_model->getBranches();
        require APP . 'view/_templates/null_header.php';
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    public function passAction()
    {
        if (isset($_POST['submit_request'])) {
            $action_successful = $this->user_model->requestPasswordReset();
            if ($action_successful == true) {
                header('location: ' . URL);
            } else {
                header('location: ' . URL . 'forgotpassword');
            }
        }
    }
}
