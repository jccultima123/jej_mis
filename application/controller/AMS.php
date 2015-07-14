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
        $assets = $this->ams_model->getAllAssets();
        require VIEWS_PATH . 'AMS/header.php';
        View::adminMode();
        require VIEWS_PATH . 'AMS/index.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    public function add($type)
    {
        if (isset($type)) {
            switch ($type) {
                case 'product':
                    Auth::handleLogin();
                    $categories = $this->product_model->getCategories();
                    require VIEWS_PATH . 'AMS/header.php';
                    require VIEWS_PATH . 'AMS/products/add.php';
                    require VIEWS_PATH . '_templates/null_footer.php';
                    exit;
                    break;
                case 'record':
                    $types = $this->ams_model->getAssetTypes();
                    require VIEWS_PATH . 'AMS/header.php';
                    View::adminMode();
                    require VIEWS_PATH . 'AMS/add.php';
                    require VIEWS_PATH . '_templates/null_footer.php';
                    exit;
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
        require VIEWS_PATH . 'AMS/header.php';
        View::adminMode();
        require VIEWS_PATH . 'AMS/details.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    public function edit($asset_id)
    {
        $details = $this->ams_model->asset($asset_id);
        $types = $this->ams_model->getAssetTypes();
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
        } else if (isset($_POST["add_product"])) {
                Auth::handleLogin();
                $this->product_model->addProduct(
                                $_POST['category'],
                                $_POST['IMEI'],
                                $_POST['IMEI_2'],
                                $_POST['manufacturer_name'],
                                $_POST['product_name'],
                                $_POST['product_model'],
                                $_POST['description'],
                                $_POST['SRP'],
                                $_POST['added_by']);
            header('location: ' . URL . 'AMS/products');
        } else if (isset($_POST["update_product"])) {
                Auth::handleLogin();
                $this->product_model->updateProduct(
                                $_POST['category'],
                                $_POST['IMEI'],
                                $_POST['IMEI_2'],
                                $_POST['manufacturer_name'],
                                $_POST['product_name'],
                                $_POST['product_model'],
                                $_POST['description'],
                                $_POST['SRP'],
                                $_POST['added_by']);
            header('location: ' . URL . 'AMS/products');
        } else if (isset($_POST['update_transaction'])) {
            $this->ams_model->updateTransaction(
                                $_POST['type'],
                                $_POST['name'],
                                $_POST['description'],
                                $_POST['qty'],
                                $_POST['price'],
                                $_POST['as_status'],
                                $_POST['asset_id']);
            header('location: ' . URL . 'AMS');
        }
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
            header('location: ' . URL . 'AMS');
            exit;
        }
    }
    
    /** +++++++++++++++++++++++++++++++++++++++++++++++++++  **/
    function products()
    {
        // PRODUCTS
        $product_count = $this->product_model->countProducts();
        //$product_count_by_branch = $this->product_model->countProductsByBranch($_SESSION['branch_id']);
        $manufacturers = $this->product_model->getAllManufacturers();
        $categories = $this->product_model->getCategories();
        $product_by_category = $this->product_model->getProductbyCategory();
        $products = $this->product_model->getAllProducts();
        require VIEWS_PATH . 'AMS/header.php';
        require VIEWS_PATH . 'AMS/products/index.php';
        require VIEWS_PATH . '_templates/null_footer.php';
        exit;
    }

    function editProduct($product_id)
    {
        Auth::handleLogin();
        $categories = $this->product_model->getCategories();
        if (isset($product_id)) {
            $products = $this->product_model->getProduct($product_id);
            require VIEWS_PATH . 'AMS/products/edit.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        } else {
            header('location: ' . URL . 'AMS/products');
        }
    }

    function productDetails($product_id)
    {
        if (isset($product_id)) {
            $details = $this->product_model->getProduct($product_id);
            require VIEWS_PATH . 'AMS/products/details.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        } else {
            header('location: ' . URL . 'AMS/products');
        }
    }

        function deleteProduct($product_id)
        {
            Auth::handleLogin();
            $amount_of_products = $this->product_model->countProducts();
            if ($_POST[$product_id] <= $amount_of_products) {
                if (isset($product_id)) {
                    $this->product_model->deleteProduct($product_id);
                    header('location: ' . URL . 'AMS/products');
                }
            }
            else {
                header('location: ' . URL . 'AMS/products');
            }

        }

        function generateProductReports()
        {
            Auth::handleLogin();
            require VIEWS_PATH . 'AMS/header.php';
            require VIEWS_PATH . 'AMS/notavailable.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        }
}
