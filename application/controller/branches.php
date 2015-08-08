<?php

class Branches extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        Auth::handleMIS();
        // CORE
        $this->admin_model = $this->loadModel('Admin');
        $this->branch_model = $this->loadModel('Branch');
        $this->misc_model = $this->loadModel('Misc');
        //OTHERS
        $this->captcha_model = $this->loadModel('Captcha');
    }
    
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/'index' (which is the default page btw)
     */
    function index()
    {
        $branches = $this->branch_model->getBranches();
        require View::header('admin');
        require VIEWS_PATH . 'branches/index.php';
        require View::footer('admin');
    }
    
        function add()
        {
            Auth::handleLogin();
            if (isset($_POST['add_branch'])) {
                $request = $this->branch_model->add(
                            strtoupper($_POST['type']),
                            strtoupper($_POST['branch_name']),
                            strtoupper($_POST['branch_address']),
                            strtoupper($_POST['branch_contact'])
                            );
                if ($request) {
                    header('location: ' . URL . 'branches');
                }
            }
            require View::header('admin');
            require VIEWS_PATH . 'branches/add.php';
            require View::footer('admin');
        }
        
        function edit($branch_id)
        {
            Auth::handleLogin();
            require View::header('admin');
            require VIEWS_PATH . '_templates/notavailable.php';
            require View::footer('admin');
        }
        
        function update($branch_id)
        {
            Auth::handleLogin();
            require View::header('admin');
            require VIEWS_PATH . '_templates/notavailable.php';
            require View::footer('admin');
        }
        
        function delete($branch_id)
        {
            Auth::handleLogin();
            if (isset($branch_id)) {
                $this->branch_model->delete($branch_id);
                header('location: ' . URL . 'branches');
            }
        }
    
    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }
}