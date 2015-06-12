<?php

class Users extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();

        // this controller should only be visible/usable by logged in users, so we put login-check here
        // Auth::handleLogin();
        $this->branch_model = $this->loadModel('Branch');
    }
        
    // ACTIONS/CONTROLLER

    function verify($user_id, $user_activation_verification_code)
    {
        if (isset($user_id) && isset($user_activation_verification_code)) {
            $this->user_model->verifyNewUser($user_id, $user_activation_verification_code);
            header('location: ' . URL);
        } else {
            header('location: ' . URL);
        }
    }
}
