<?php

/**
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Development extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();

        // this controller should only be visible/usable by logged in users, so we put login-check here
        Auth::handleLogin();
    }
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/----/index
     */
    public function index()
    {   
        // load views.
        require APP . 'view/development/dev_header.php';
        // obtaining mysql version
        $mysql_version = $this->dev_model->getMySqlVersion2();
        require APP . 'view/development/index.php';
        require APP . 'view/_templates/null_footer.php';
    }

}
