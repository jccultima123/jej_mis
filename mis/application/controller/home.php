<?php

/**
 * Class Home
 * 
 * HOME PAGE OF THIS APPLICATION
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        require APP . 'view/_templates/null_header.php';
        require APP . 'view/mis.php';
        require APP . 'view/_templates/null_footer.php';
    }
}
