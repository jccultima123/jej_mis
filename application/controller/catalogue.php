<?php

/*
 * Catalogue Controller for public site
 */

class Catalogue extends PublicController {
    
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        require VIEWS_PATH . 'CRM/public/header.php';
        require VIEWS_PATH . 'CRM/public/index.php';
        require VIEWS_PATH . 'CRM/public/footer.php';
    }
    
}
