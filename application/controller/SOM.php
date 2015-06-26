<?php

class SOM extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        Auth::SOMhandleLogin();
        // CORE
        $this->branch_model = $this->loadModel('Branch');
        $this->captcha_model = $this->loadModel('Captcha');
        $this->misc_model = $this->loadModel('Misc');
        $this->product_model = $this->loadModel('Product');
        // MIS COMPONENTS
        $this->som_model = $this->loadModel('SOM');
        $this->sales_model = $this->loadModel('Sales');
        $this->order_model = $this->loadModel('Order');
        //$this->ams_model = $this->loadModel('AMS');
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    function index() {
        if (isset($_GET['action'])) {
            $categories = $this->sales_model->getCategories();
            $status = $this->misc_model->getAllStatus();
            $link = $_GET['action'];
            if ($link == 'addSales') {
                $branches = $this->branch_model->getBranches();
                require APP . 'view/SOM/header.php';
                View::adminMode();
                require APP . 'view/SOM/sales/add.php';
                require APP . 'view/_templates/null_footer.php';
            } else if ($link == 'addOrder') {
                $branches = $this->branch_model->getBranches();
                require APP . 'view/SOM/header.php';
                View::adminMode();
                require APP . 'view/_templates/notavailable.php';
                require APP . 'view/_templates/null_footer.php';
            } else {
                header('location: ' . URL . 'error');
            }
        } else {
            require APP . 'libs/pagination.php';
            $allsales = $this->sales_model->getAllSales($start, $limit);
            $manufacturers = $this->sales_model->getAllManufacturers();
            $sales_by_category = $this->sales_model->getSalesbyCategory();
            $amount_of_sales = $this->sales_model->getAmountOfSales();
            $total = ceil($amount_of_sales/$limit);
            
            $allorders = $this->order_model->getAllOrders();
            require APP . 'view/SOM/header.php';
            View::adminMode();
            require APP . 'view/SOM/index.php';
            require APP . 'view/_templates/null_footer.php';
        }
    }
    
        //SALES ACTIONS
        function salesAction()
        {
            if (isset($_POST['add_sales'])) {
                $sales = $this->sales_model->getAllSales();
                if (isset($_POST["category"]) === $sales->category) {
                    header('location: ' . URL . 'som');
                } else if (isset($_POST["SKU"]) === $sales->SKU) {
                    header('location: ' . URL . 'som');
                } else if (isset($_POST["manufacturer_name"]) === $sales->manufacturer_name) {
                    header('location: ' . URL . 'som');
                } else if (isset($_POST["product_name"]) === $sales->product_name) {
                    header('location: ' . URL . 'som');
                } else if (isset($_POST["product_model"]) === $sales->product_model) {
                    header('location: ' . URL . 'som');
                } else if (isset($_POST["price"]) === $sales->price) {
                    header('location: ' . URL . 'som');
                } else {
                    // ADD THIS in sales_model.php
                    $this->sales_model->addSales(
                            $_POST["category"],
                            $_POST["SKU"],
                            $_POST["manufacturer_name"],
                            $_POST["product_name"],
                            $_POST["product_model"],
                            $_POST["price"],
                            $_POST["status_id"],
                            date());
                }
            header('location: ' . URL . 'som');
            } else if ($_POST['update_sales']) {
                if (isset($_POST["update_sales"])) {
                    $this->sales_model->updateSales($_POST["category"], $_POST["SKU"], $_POST["manufacturer_name"], $_POST["product_name"], $_POST["product_model"], $_POST["price"], $_POST["status_id"], $_POST["sales_id"]);
                }
                header('location: ' . URL . 'som');
            }
        }
    
        function salesDetail($sales_id)
        {
            $sales = $this->sales_model->getSales($sales_id);
            if ($sales == NULL) {
                header('location: ' . URL . 'som');
                exit();
            }
            $categories = $this->sales_model->getCategories();
            require APP . 'view/SOM/header.php';
            View::adminMode();
            require APP . 'view/SOM/sales/details.php';
            require APP . 'view/_templates/null_footer.php';
        }
    
        function editSales($sales_id)
        {
            $categories = $this->sales_model->getCategories();
            $status = $this->misc_model->getAllStatus();
            if (isset($sales_id)) {
                $sales = $this->sales_model->getSales($sales_id);
                if (!isset($sales->category)) {
                    header('location: ' . URL . 'som');
                } else {
                    require APP . 'view/SOM/header.php';
                    View::adminMode();
                    require APP . 'view/SOM/sales/edit.php';
                    require APP . 'view/_templates/null_footer.php';
                }
            } else {
                header('location: ' . URL . 'som');
            }
        }
        
        function deleteSales($sales_id) {
            $amount_of_sales = $this->sales_model->getAmountOfSales();
            if ($_POST[$sales_id] <= $amount_of_products) {
                if (isset($sales_id)) {
                    $this->sales_model->deletesales($sales_id);
                    header('location: ' . URL . 'som');
                }
            }
            else {
                $this->$error = CRUD_UNABLE_TO_DELETE;
                header('location: ' . URL . 'som');
            }
        }

    function accountOverview()
    {
        require APP . 'view/SOM/header.php';
        View::adminMode();
        require APP . 'view/SOM/account/overview.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    function help()
    {
        require APP . 'view/SOM/header.php';
        View::adminMode();
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    function about()
    {   
        require APP . 'view/SOM/header.php';
        View::adminMode();
        require APP . 'view/about/index.php';
        require APP . 'view/_templates/null_footer.php';
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $logout = $this->user_model->logout($_SESSION['SOM_user_logged_in']);
        // check login status
        if ($logout == true) {
            // if YES, then move user to dashboard/index (btw this is a browser-redirection, not a rendered view!)
            header('location: ' . URL);
        } else {
            // if NO, then move user to login/index (login form) again
            header('location: ' . URL);
        }
    }
    
    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }
}
