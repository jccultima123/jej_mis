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
        require APP . 'view/SOM/header.php';
        View::adminMode();
        require APP . 'view/SOM/index.php';
        require APP . 'view/_templates/null_footer.php';
    }

        function sales()
        {
            if (isset($_GET['action'])) {
                $categories = $this->sales_model->getCategories();
                $manu = $this->misc_model->getAllManufacturers();
                $branches = $this->branch_model->getBranches();
                $status = $this->sales_model->getStatus();
                $link = $_GET['action'];
                if ($link == 'addSales') {
                    require APP . 'view/SOM/header.php';
                    View::adminMode();
                    require APP . 'view/SOM/sales/add.php';
                    require APP . 'view/_templates/null_footer.php';
                } else if ($link == 'addOrder') {
                    require APP . 'view/SOM/header.php';
                    View::adminMode();
                    require APP . 'view/_templates/notavailable.php';
                    require APP . 'view/_templates/null_footer.php';
                } else {
                    header('location: ' . URL . 'error');
                }
            } else {
                View::getPagedListSOM('sales');
                require APP . 'libs/pagination.php';
                $allsales = $this->sales_model->getAllSales($start, $limit);
                $manufacturers = $this->sales_model->getAllManufacturers();
                $sales_by_category = $this->sales_model->getSalesbyCategory();
                $amount_of_sales = $this->sales_model->getAmountOfSales();
                $total = ceil($amount_of_sales/$limit);

                $allorders = $this->order_model->getAllOrders();
                require APP . 'view/SOM/header.php';
                View::adminMode();
                require APP . 'view/SOM/sales/index.php';
                require APP . 'view/_templates/null_footer.php';
            }
        }
    
        //SALES ACTIONS
        function salesAction()
        {
            if (isset($_POST['add_sales'])) {
                // ADD THIS in sales_model.php
                $this->sales_model->addSales(
                        $_POST["category"],
                        $_POST["manufacturer"],
                        $_POST["product_name"],
                        $_POST["product_model"],
                        $_POST["IMEI"],
                        $_POST["added_by"],
                        $_POST["branch"],
                        $_POST["price"],
                        $_POST["status_id"]);
                header('location: ' . URL . 'som/sales?page=1');
            } else if ($_POST['update_sales']) {
                if (isset($_POST["update_sales"])) {
                    $this->sales_model->updateSales(
                            $_POST["category"],
                            $_POST["manufacturer"],
                            $_POST["product_name"],
                            $_POST["product_model"],
                            $_POST["IMEI"],
                            $_POST["added_by"],
                            $_POST["branch"],
                            $_POST["price"],
                            $_POST["status_id"],
                            $_POST["sales_id"]);
                }
                header('location: ' . URL . 'som/sales?page=1');
            } else {
                header('location: ' . URL . 'som/sales');
            }
        }
    
        function salesDetail($sales_id)
        {
            $sales = $this->sales_model->getSales($sales_id);
            if ($sales == NULL) {
                header('location: ' . URL . 'som/sales');
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
            $status = $this->sales_model->getStatus();
            $branches = $this->branch_model->getBranches();
            $manu = $this->misc_model->getAllManufacturers();
            if (isset($sales_id)) {
                $sales = $this->sales_model->getSales($sales_id);
                if (!isset($sales->category)) {
                    header('location: ' . URL . 'som/sales');
                } else {
                    require APP . 'view/SOM/header.php';
                    View::adminMode();
                    require APP . 'view/SOM/sales/edit.php';
                    require APP . 'view/_templates/null_footer.php';
                }
            } else {
                header('location: ' . URL . 'som/sales');
            }
        }
        
        function deleteSales($sales_id) {
            $amount_of_sales = $this->sales_model->getAmountOfSales();
            if ($_POST[$sales_id] <= $amount_of_products) {
                if (isset($sales_id)) {
                    $this->sales_model->deletesales($sales_id);
                    header('location: ' . URL . 'som/sales?page=1');
                }
            }
            else {
                header('location: ' . URL . 'som/sales?page=1');
            }
        }
        
    //ORDERS
    function orders()
        {
            if (isset($_GET['action'])) {
                $categories = $this->order_model->getCategories();
                $manu = $this->misc_model->getAllManufacturers();
                $branches = $this->branch_model->getBranches();
                $status = $this->order_model->getStatus();
                $link = $_GET['action'];
                if ($link == 'addSales') {
                    require APP . 'view/SOM/header.php';
                    View::adminMode();
                    require APP . 'view/SOM/orders/add.php';
                    require APP . 'view/_templates/null_footer.php';
                } else if ($link == 'addOrder') {
                    require APP . 'view/SOM/header.php';
                    View::adminMode();
                    require APP . 'view/_templates/notavailable.php';
                    require APP . 'view/_templates/null_footer.php';
                } else {
                    header('location: ' . URL . 'error');
                }
            } else {
                View::getPagedListSOM('orders');
                require APP . 'libs/pagination.php';
                $allorders = $this->order_model->getAllOrders($start, $limit);
                $manufacturers = $this->order_model->getAllManufacturers();
                $sales_by_category = $this->order_model->getSalesbyCategory();
                //$amount_of_orders = $this->order_model->getAmountOfOrder();
                $total = ceil($amount_of_orders/$limit);

                $allorders = $this->order_model->getAllOrders();
                require APP . 'view/SOM/header.php';
                View::adminMode();
                require APP . 'view/SOM/orders/index.php';
                require APP . 'view/_templates/null_footer.php';
            }
        }
    
        //ORDERS ACTIONS
        function orderAction()
        {
            if (isset($_POST['add_orders'])) {
                // ADD THIS in sales_model.php
                $this->sales_model->addOrders(
                        $_POST["order_branch"],
                        $_POST["manufacturer"],
                        $_POST["product_name"],
                        $_POST["product_model"],
                        $_POST["quantity"]);
                header('location: ' . URL . 'som/orders?page=1');
            } else if ($_POST['update_orders']) {
                if (isset($_POST["update_orders"])) {
                    $this->order_model->updateOrders(
                        $_POST["order_branch"],
                        $_POST["manufacturer"],
                        $_POST["product_name"],
                        $_POST["product_model"],
                        $_POST["quantity"]);
                }
                header('location: ' . URL . 'som/orders?page=1');
            } else {
                header('location: ' . URL . 'som/orders');
            }
        }
    
        function orderDetail($order_id)
        {
            $orders= $this->order_model->getSales($sales_id);
            if ($orders == NULL) {
                header('location: ' . URL . 'som/orders');
                exit();
            }
            $categories = $this->order_model->getCategories();
            require APP . 'view/SOM/header.php';
            View::adminMode();
            require APP . 'view/SOM/orders/details.php';
            require APP . 'view/_templates/null_footer.php';
        }
    
        function editOrders($order_id)
        {
            $categories = $this->order_model->getCategories();
            $status = $this->order_model->getStatus();
            $branches = $this->branch_model->getBranches();
            $manu = $this->misc_model->getAllManufacturers();
            if (isset($order_id)) {
                $orders = $this->order_model->getSales($order_id);
                if (!isset($orders->category)) {
                    header('location: ' . URL . 'som/orders');
                } else {
                    require APP . 'view/SOM/header.php';
                    View::adminMode();
                    require APP . 'view/SOM/orders/edit.php';
                    require APP . 'view/_templates/null_footer.php';
                }
            } else {
                header('location: ' . URL . 'som/orders');
            }
        }
        
        function deleteOrders($order_id) {
            $amount_of_orders = $this->orders_model->getAmountOfOrders();
            if ($_POST[$order_id] <= $amount_of_products) {
                if (isset($sales_id)) {
                    $this->order_model->deleteorder($order_id);
                    header('location: ' . URL . 'som/orders?page=1');
                }
            }
            else {
                header('location: ' . URL . 'som/orders?page=1');
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
    
    function export($module) {
        if (isset($module)) {
            $branches = $this->branch_model->getBranches();
            $manu = $this->misc_model->getAllManufacturers();
            require APP . 'view/SOM/header.php';
            View::adminMode();
            if ($module == 'sales') {
                require APP . 'view/SOM/reports/sales.php';
            } else if ($module == 'orders') {
                require APP . 'view/SOM/reports/orders.php';
            } else {
                header('location: ' . URL . 'som/sales?page=1');
            }
            require APP . 'view/_templates/null_footer.php';
        } else {
            header('location: ' . URL . 'som/sales?page=1');
        }
    }
    
        function exportAction() {
            
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
