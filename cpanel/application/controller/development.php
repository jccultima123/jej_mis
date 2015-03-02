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
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/----/index
     */
    public function index()
    {
       // obtaining mysql version
        $mysql_version = $this->model->getMySqlVersion();
        
       // load views.
        require APP . 'view/development/dev_header.php';
        require APP . 'view/development/index.php';
        require APP . 'view/development/dev_footer.php';
    }

}