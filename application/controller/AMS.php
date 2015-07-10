<?php

class AMS extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        Auth::ASSEThandleLogin();
        // CORE
        $this->branch_model = $this->loadModel('Branch');
        $this->captcha_model = $this->loadModel('Captcha');
        $this->misc_model = $this->loadModel('Misc');
        $this->product_model = $this->loadModel('Product');
        // MIS
        $this->ams_model = $this->loadModel('AMS');
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index()
    {
        $transaction_count = $this->ams_model->countTransactions();
        $transaction_count_by_branch = $this->ams_model->countTransactionsByBranch($_SESSION['branch_id']);
        
        if (isset($_GET['page'])) {
            if ($_GET['page'] == 'full') {
                $assets = $this->ams_model->getAllAssets();
            } else {
                require APP . 'libs/pagination.php';
                $assets = $this->ams_model->getSomeAssets($start, $limit);
                $total = ceil($transaction_count / $limit);
            }
        } else {
            View::getPagedList('AMS');
        }
        require VIEWS_PATH . 'AMS/header.php';
        View::adminMode();
        require VIEWS_PATH . 'AMS/index.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    public function add()
    {
        $types = $this->ams_model->getAssetTypes();
        $departments = $this->ams_model->departments();
        require VIEWS_PATH . 'AMS/header.php';
        View::adminMode();
        require VIEWS_PATH . 'AMS/add.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    public function details($asset_id)
    {
        $details = $this->ams_model->asset($asset_id);
        require VIEWS_PATH . 'AMS/header.php';
        View::adminMode();
        require VIEWS_PATH . 'AMS/details.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    public function edit($asset_id)
    {
        $details = $this->ams_model->asset($asset_id);
        $types = $this->ams_model->getAssetTypes();
        $departments = $this->ams_model->departments();
        $status = $this->ams_model->getStatus();
        require VIEWS_PATH . 'AMS/header.php';
        View::adminMode();
        require VIEWS_PATH . 'AMS/edit.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    public function delete($asset_id)
    {
        if (isset($asset_id)) {
            // do deleteSong() in model/model.php
            $this->ams_model->delete($asset_id);
        }

        // where to go after song has been deleted
        header('location: ' . URL . 'ams?page=1');
    }
    
    public function action()
    {
        if (isset($_POST['add_transaction'])) {
            $this->ams_model->addTransaction(
                                $_POST['user'],
                                $_POST['branch'],
                                $_POST['type'],
                                $_POST['name'],
                                $_POST['description'],
                                $_POST['qty'],
                                $_POST['price'],
                                $_POST['department']);
        } else if (isset($_POST['update_transaction'])) {
            $this->ams_model->updateTransaction(
                                $_POST['type'],
                                $_POST['name'],
                                $_POST['description'],
                                $_POST['qty'],
                                $_POST['price'],
                                $_POST['department'],
                                $_POST['as_status'],
                                $_POST['asset_id']);
        }
        header('location: ' . URL . 'ams?page=1');
    }
    
    public function accountOverview()
    {
        require VIEWS_PATH . 'AMS/header.php';
        require VIEWS_PATH . 'AMS/account/overview.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    function help()
    {
        require VIEWS_PATH . 'AMS/header.php';
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_templates/admin_mode.php';
        }
        require VIEWS_PATH . '_templates/notavailable.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    public function about()
    {
        require VIEWS_PATH . 'AMS/header.php';
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_templates/admin_mode.php';
        }
        require VIEWS_PATH . 'about/index.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $this->user_model->logout($_SESSION['ASSET_user_logged_in']);
        // redirect user to base URL
        header('location: ' . URL);
    }
    
    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }
    
    function export($options)
    {
        if (isset($options)) {
            require VIEWS_PATH . 'AMS/header.php';
            View::adminMode();
            if ($options == 'quick') {
                require VIEWS_PATH . 'AMS/export_quick.php';
            } else if ($options == 'detailed') {
                require VIEWS_PATH . 'AMS/export_details.php';
            }
            require VIEWS_PATH . '_templates/null_footer.php';
        } else {
            header('location: ' . URL . 'AMS?page=1');
            exit;
        }
    }
}
