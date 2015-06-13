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
        $usertypes = $this->user_model->getUsertype();
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
    
    /**
     * Verify the verification token of that user (to show the user the password editing view or not)
     * @param string $user_name username
     * @param string $verification_code password reset verification token
     */
    function verifyPasswordReset($user_name, $verification_code)
    {
        if ($this->user_model->verifyPasswordReset($user_name, $verification_code)) {
            // get variables for the view
            $this->user_name = $user_name;
            $this->user_password_reset_hash = $verification_code;
            require APP . 'view/_templates/null_header.php';
            require APP . 'view/password/change.php';
            require APP . 'view/_templates/null_footer.php';
        } else {
            header('location: ' . URL);
        }
    }
    
    public function passAction()
    {
        if (isset($_POST['submit_request'])) {
            $action_successful = $this->user_model->requestPasswordReset();
            if ($action_successful == true) {
                header('location: ' . URL);
            } else {
                header('location: ' . URL . 'passwordAction/forgot');
            }
        } else if (isset($_POST['submit_new_password'])) {
            $action_successful = $this->user_model->setNewPassword();
            if ($action_successful == true) {
                header('location: ' . URL);
            } else {
                header('location: ' . URL . 'passwordAction/forgot');
            }
        }
    }
}
