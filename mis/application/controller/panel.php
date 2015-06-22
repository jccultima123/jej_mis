<?php

class Panel extends MIS_Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        Auth::MIShandleLogin();
        // CORE
        $this->branch_model = $this->loadModel('Branch');
        $this->captcha_model = $this->loadModel('Captcha');
        $this->misc_model = $this->loadModel('Misc');
        $this->product_model = $this->loadModel('Product');
        // MIS COMPONENTS
        $this->som_model = $this->loadModel('Som');
        $this->sales_model = $this->loadModel('Sales');
        $this->order_model = $this->loadModel('Order');
        $this->ams_model = $this->loadModel('Ams');
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    function index() {
        if (isset($_GET['action'])) {
            $categories = $this->sales_model->getCategories();
            $link = $_GET['action'];
            if ($link == 'addSales') {
                $branches = $this->branch_model->getBranches();
                require APP . 'view/MIS/header.php';
                View::adminMode();
                require APP . 'view/MIS/sales/add.php';
                require APP . 'view/_templates/null_footer.php';
            } else if ($link == 'addOrder') {
                $branches = $this->branch_model->getBranches();
                require APP . 'view/MIS/header.php';
                View::adminMode();
                require APP . 'view/_templates/notavailable.php';
                require APP . 'view/_templates/null_footer.php';
            } else {
                header('location: ' . URL . 'error');
            }
        } else {
            $allsales = $this->sales_model->getAllSales();
            $manufacturers = $this->sales_model->getAllManufacturers();
            $sales_by_category = $this->sales_model->getSalesbyCategory();
            $amount_of_sales = $this->sales_model->getAmountOfSales();
            
            $allorders = $this->order_model->getAllOrders();
            require APP . 'view/MIS/header.php';
            View::adminMode();
            require APP . 'view/MIS/sales/index.php';
            require APP . 'view/_templates/null_footer.php';
        }
    }
    
        //SALES ACTIONS
        function salesAction()
        {
            if (isset($_POST['add_sales'])) {
                $sales = $this->sales_model->getAllSales();
                if (isset($_POST["category"]) === $sales->category) {
                    header('location: ' . URL . 'panel');
                } else if (isset($_POST["SKU"]) === $sales->SKU) {
                    header('location: ' . URL . 'panel');
                } else if (isset($_POST["manufacturer_name"]) === $sales->manufacturer_name) {
                    header('location: ' . URL . 'panel');
                } else if (isset($_POST["product_name"]) === $sales->product_name) {
                    header('location: ' . URL . 'panel');
                } else if (isset($_POST["product_model"]) === $sales->product_model) {
                    header('location: ' . URL . 'panel');
                } else if (isset($_POST["price"]) === $sales->price) {
                    header('location: ' . URL . 'panel');
                } else {
                    // ADD THIS in product_model/product_model.php
                    $this->sales_model->addSales(
                            $_POST["category"],
                            $_POST["SKU"],
                            $_POST["manufacturer_name"],
                            $_POST["product_name"],
                            $_POST["product_model"],
                            $_POST["price"]);
                }
            header('location: ' . URL . 'panel');
            } else if ($_POST['update_sales']) {
                if (isset($_POST["update_sales"])) {
                    $this->sales_model->updateSales($_POST["category"], $_POST["SKU"], $_POST["manufacturer_name"], $_POST["product_name"], $_POST["product_model"], $_POST["price"], $_POST["product_id"]);
                }
                header('location: ' . URL . 'panel');
            }
        }
    
        function salesDetail($sales_id)
        {
            $sales = $this->sales_model->getSales($sales_id);
            if ($sales == NULL) {
                header('location: ' . URL . 'panel');
                exit();
            }
            require APP . 'view/MIS/header.php';
            require APP . 'view/MIS/sales/details.php';
            require APP . 'view/_templates/null_footer.php';
        }
    
        function editSales($sales_id)
        {
            $categories = $this->sales_model->getCategories();
            if (isset($sales_id)) {
                $sales = $this->sales_model->getSales($sales_id);
                require APP . 'view/MIS/header.php';
                require APP . 'view/MIS/sales/edit.php';
                require APP . 'view/_templates/null_footer.php';
            } else {
                header('location: ' . URL . 'panel');
            }
        }
        
        function deleteSales($sales_id) {
            $amount_of_sales = $this->sales_model->getAmountOfSales();
            if ($_POST[$sales_id] <= $amount_of_products) {
                if (isset($sales_id)) {
                    $this->sales_model->deletesales($sales_id);
                    header('location: ' . URL . 'panel');
                }
            }
            else {
                $this->$error = CRUD_UNABLE_TO_DELETE;
                header('location: ' . URL . 'panel');
            }
        }

    function accountOverview()
    {
        require APP . 'view/MIS/header.php';
        View::adminMode();
        require APP . 'view/MIS/account/overview.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    function help()
    {
        require APP . 'view/MIS/header.php';
        View::adminMode();
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    function about()
    {   
        require APP . 'view/MIS/header.php';
        View::adminMode();
        require APP . 'view/about/index.php';
        require APP . 'view/_templates/null_footer.php';
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $logout = $this->user_model->logout($_SESSION['MIS_user_logged_in']);
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
