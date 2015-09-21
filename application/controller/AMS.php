<?php

class AMS extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        //Auth::ASSEThandleLogin();
        Auth::handleLogin();
        // CORE
        $this->branch_model = $this->loadModel('Branch');
        $this->captcha_model = $this->loadModel('Captcha');
        $this->misc_model = $this->loadModel('Misc');
        $this->product_model = $this->loadModel('Product');
        // Inventory by Branch
        $this->inventory_model = $this->loadModel('Inventory');
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
        $assets = $this->ams_model->getAllAssets();
        require View::header('AMS');
        View::adminMode();
        require VIEWS_PATH . 'AMS/index.php';
        require View::footerCust('_templates/null_footer');
    }
    
    public function add($type)
    {
        if (isset($type)) {
            switch ($type) {
                case 'record':
                    $types = $this->ams_model->getAssetTypes();
                    $branches = $this->branch_model->getBranches();
                    require View::header('AMS');
                    View::adminMode();
                    require VIEWS_PATH . 'AMS/add.php';
                    require View::footerCust('_templates/null_footer');
                    exit;
                    break;
                case 'item':
                    $categories = $this->inventory_model->getCategories();
                    require View::header('AMS');
                    require VIEWS_PATH . 'AMS/products/add.php';
                    require View::footerCust('_templates/null_footer');
                    break;
                default:
                    header('location: ' . URL . 'AMS');
                    exit;
            }
        } else {
            header('location: ' . URL . 'AMS');
        }
    }
    
    public function validate($q, $asset_id)
    {
        switch($q) {
            case 'asset':
                $this->ams_model->validate($asset_id);
                break;
            case 'product':
                //$this->ams_model->validateProduct($asset_id);
                break;
            default:
                header('location: ' . $_SERVER['HTTP_REFERER']);
        }
        header('location: ' . URL . 'AMS');
    }
    
    public function details($asset_id)
    {
        $details = $this->ams_model->asset($asset_id);
        require View::header('AMS');
        View::adminMode();
        require VIEWS_PATH . 'AMS/details.php';
        require View::footerCust('_templates/null_footer');
    }
    
    public function edit($asset_id)
    {
        $details = $this->ams_model->asset($asset_id);
        $types = $this->ams_model->getAssetTypes();
        $branches = $this->branch_model->getBranches();
        $status = $this->ams_model->getStatus();
        require View::header('AMS');
        View::adminMode();
        require VIEWS_PATH . 'AMS/edit.php';
        require View::footerCust('_templates/null_footer');
    }
    
    public function delete($asset_id)
    {
        if (isset($asset_id)) {
            // do deleteSong() in model/model.php
            $this->ams_model->delete($asset_id);
        }

        // where to go after song has been deleted
        header('location: ' . URL . 'AMS');
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
                                $_POST['price']);
            header('location: ' . URL . 'AMS');
        } else if (isset($_POST['update_transaction'])) {
            $this->ams_model->updateTransaction(
                                $_POST['branch'],
                                $_POST['type'],
                                $_POST['name'],
                                $_POST['description'],
                                $_POST['qty'],
                                $_POST['price'],
                                $_POST['depreciation'],
                                $_POST['as_status'],
                                $_POST['asset_id']);
            header('location: ' . URL . 'AMS');
        }
    }
    
    function help()
    {
        require View::header('AMS');
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_templates/admin_mode.php';
        }
        require VIEWS_PATH . '_templates/notavailable.php';
        require View::footerCust('_templates/null_footer');
    }
    
    public function about()
    {
        require View::header('AMS');
        if (isset($_SESSION['admin_logged_in'])) {
            require VIEWS_PATH . '_templates/admin_mode.php';
        }
        require VIEWS_PATH . 'about/index.php';
        require View::footerCust('_templates/null_footer');
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $logout = $this->user_model->logout($_SESSION['ASSET_user_logged_in']);
        // check login status
        if ($logout == true) {
            $this->audit_model->set_log('Login', 'AMS: ' . $_GET['user'] . ' was logged out.');
            header('location: ' . URL . 'mis');
        } else {
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
    
    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }
    
    /** +++++++++++++++++++++++++++++++++++++++++++++++++++  **/    

        function generateProductReports()
        {
            Auth::handleLogin();
            require View::header('AMS');
            require VIEWS_PATH . 'AMS/notavailable.php';
            require View::footerCust('_templates/null_footer');
        }
        
    public function inventory()
    {
        if (isset($_GET['a'])) {
            if ($_GET['a'] == 'add') {
                
            } else {
                header('location: ' . URL . 'som/sales');
            }
        } else {
            //DEFAULT VIEW / INDEX
            $product_count = $this->product_model->countProducts();
            $manufacturers = $this->product_model->getAllManufacturers();
            $categories = $this->product_model->getCategories();
            $product_by_category = $this->product_model->getProductbyCategory();
            $products = $this->product_model->getAllProducts();
            require View::header('AMS');
            require VIEWS_PATH . 'AMS/products/index.php';
            require View::footerCust('_templates/null_footer');
        }
    }
    
        public function product($action, $id) {
            if (isset($action)) {
                switch($action) {
                    case 'details':
                        require View::header('admin');
                        $details = $this->product_model->getProduct($id);
                        require VIEWS_PATH . 'AMS/products/details.php';
                        require View::footer('admin.php');
                        break;
                    case 'edit':
                        require View::header('admin');
                        $categories = $this->product_model->getCategories();
                        $details = $this->product_model->getProduct($id);
                        require VIEWS_PATH . 'AMS/products/edit.php';
                        require View::footer('admin.php');
                        break;
                    case 'manageStock':
                        require View::header('admin');
                        $categories = $this->product_model->getCategories();
                        $details = $this->product_model->getProduct($id);
                        require VIEWS_PATH . 'AMS/products/stocks.php';
                        require View::footer('admin.php');
                        break;
                    case 'delete':
                        $this->product_model->deleteProduct($id);
                        header('location: ' . URL . 'AMS/inventory');
                        break;
                    default:
                        header('location: ' . URL . 'AMS/inventory');
                }
            } else {
                header('location: ' . $_SERVER['HTTP_REFERRER']);
            }
        }
        
        function productAction()
        {
            if (isset($_POST["add_product"])) {
                    $this->product_model->addProduct(
                                    $_POST['category'],
                                    $_POST['brand'],
                                    $_POST['product_name'],
                                    $_POST['description'],
                                    $_POST['DP'],
                                    $_POST['inventory_count'],
                                    $_POST['added_by'],
                                    $_POST['product_id']);
                header('location: ' . URL . 'AMS/inventory');
            } else if (isset($_POST["update_product"])) {
                    $this->product_model->updateProduct(
                                    $_POST['category'],
                                    $_POST['brand'],
                                    $_POST['product_name'],
                                    $_POST['description'],
                                    $_POST['DP'],
                                    $_POST['depr_value'],
                                    $_POST['product_id']);
                header('location: ' . URL . 'AMS/inventory');
            } else if (isset($_POST["fill_stocks"])) {
                /*
                 * Conflict Alert : Avoid duplicating POST names as much as possible
                 */
                    $this->product_model->fillStocks(
                                    $_POST['fill'],
                                    $_POST['product_id']);
                header('location: ' . URL . 'AMS/product/manageStock/' . $_POST['product_id']);
            } else if (isset($_POST["decrease_stocks"])) {
                    $this->product_model->decreaseStocks(
                                    $_POST['decrease'],
                                    $_POST['product_id']);
                header('location: ' . URL . 'AMS/product/manageStock/' . $_POST['product_id']);
            } else if (isset($_POST["modify_stocks"])) {
                    $this->product_model->modifyStocks(
                                    $_POST['stocks'],
                                    $_POST['product_id']);
                header('location: ' . URL . 'AMS/product/manageStock/' . $_POST['product_id']);
            } else if (isset($_POST["empty_stocks"])) {
                    $this->product_model->emptyStocks($_POST['product_id']);
                header('location: ' . URL . 'AMS/product/manageStock/' . $_POST['product_id']);
            }
        }
        
    public function export($module)
    {
        if (isset($module)) {
            require View::header('AMS');
            View::adminMode();
            if (file_exists(VIEWS_PATH . 'AMS/reports/' . $module . '.php')){
                require VIEWS_PATH . 'AMS/reports/' . $module . '.php';
            } else {
                header('location: ' . URL . 'error');
            }
            require View::footerCust('_templates/null_footer');
        } else {
            header('location: ' . URL . 'error');
        }
    }
}
