<?php

/**
 * Class Help
 * The help area
 *
 * PS: For developers, they can help code themselves with these annotations and notes
 */
class Help extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        
        // this controller should only be visible/usable by logged in users, so we put login-check here
        Auth::loginCheck();
    }

    /**
     * This method controls what happens when you move to /help/index in your app.
     */
    function index()
    {
        // load views
        require View::header();
        require APP . 'view/help/index.php';
        require View::footerCust('_templates/null_footer');
    }

    function SOM()
    {
        // load views
        require View::header();
        require APP . 'view/help/SOM.php';
        require View::footerCust('_templates/null_footer');
    }

    function AMS()
    {
        // load views
        require View::header();
        require APP . 'view/help/AMS.php';
        require View::footerCust('_templates/null_footer');
    }

    function CRM()
    {
        // load views
        require View::header();
        require APP . 'view/help/CRM.php';
        require View::footerCust('_templates/null_footer');
    }

    function FAQ()
    {
        // load views
        require View::header();
        require APP . 'view/help/FAQ.php';
        require View::footerCust('_templates/null_footer');
    }
}
