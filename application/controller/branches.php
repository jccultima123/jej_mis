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
            require VIEWS_PATH . 'admin/branches/add.php';
            require View::footer('admin');
        }
        
        function update()
        {
            Auth::handleLogin();
            if (isset($_POST['update_branch'])) {
                $request = $this->branch_model->update(
                            strtoupper($_POST['type']),
                            strtoupper($_POST['branch_name']),
                            strtoupper($_POST['branch_address']),
                            $_POST['branch_contact'],
                            $_POST['branch_id']
                            );
                if ($request) {
                    header('location: ' . URL . 'branches');
                } else {
                    header('location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
        }
        
        function edit($branch_id)
        {
            Auth::handleLogin();
            if (isset($branch_id)) {
                require View::header('admin');
                $details = $this->branch_model->getBranch($branch_id);
                    if ($details) {
                        require VIEWS_PATH . 'admin/branches/edit.php';
                    } else {
                        header('location: ' . URL . 'branches');
                        exit();
                    }
                require View::footer('admin');
            } else {
                header('location: ' . URL . 'branches');
                exit();
            }
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
