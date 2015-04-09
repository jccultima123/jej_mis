<?php

/**
 * Logout Controller
 */

class Logout extends Controller
{
    public function index()
    {
        $login_model = $this->login_model;
        $login_model->logout();
        // redirect user to base URL
        header('location: ' . URL . 'login');
    }
}
    
?>

