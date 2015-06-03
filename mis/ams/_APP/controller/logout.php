<?php

/**
 * Obtained from PHP-LOGIN / HUGE
 * (c) Panique -- https://github.com/panique
 */

/**
 * Logout Controller
 */

class Logout extends Controller
{
    public function index()
    {
        $this->loadModel('Login')->logout();
        // redirect user to base URL
        header('location: ' . URL);
    }
}
    
?>

