<?php

class Development extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        $this->dev_model = $this->loadModel('Dev');
    }
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/----/index
     */
    public function index()
    {   
        // load views.
        require APP . 'view/_templates/null_header.php';
        // obtaining mysql version
        $mysql_version = $this->dev_model->getMySqlVersion2();
        require APP . 'view/development/index.php';
        require APP . 'view/_templates/null_footer.php';
    }

}
