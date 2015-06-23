<?php

class Error extends Controller
{
    /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
    public function index()
    {
        // load views
        require APP . 'view/error/error_header.php';
        require APP . 'view/error/index.php';
        require APP . 'view/error/error_footer.php';
    }    
    
    public function usingIE()
    {
        require APP . 'view/error/incompatible_header.php';
        require APP . 'view/error/IE.php';
        require APP . 'view/error/error_footer.php';
    }
    
    public function notcompatible()
    {
        require APP . 'view/error/incompatible_header.php';
        require APP . 'view/error/incompatible.php';
        require APP . 'view/error/error_footer.php';
    }
    
    public function forbidden()
    {
        require APP . 'view/error/error_header.php';
        require APP . 'view/error/403.php';
        require APP . 'view/error/error_footer.php';
    }
}
