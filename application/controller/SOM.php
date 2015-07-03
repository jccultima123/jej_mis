<?php

class SOM extends Controller {

    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct() {
        parent::__construct();
        Auth::SOMhandleLogin();
        $this->branch_model = $this->loadModel('Branch');
        $this->captcha_model = $this->loadModel('Captcha');
        $this->misc_model = $this->loadModel('Misc');
        $this->product_model = $this->loadModel('Product');
        $this->som_model = $this->loadModel('SOM');
        $this->crm_model = $this->loadModel('CRM');
        $this->sales_model = $this->loadModel('Sales');
        $this->order_model = $this->loadModel('Order');
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

    function sales() {
        $transaction_count = $this->sales_model->countTransactions();
        $transaction_count_by_branch = $this->sales_model->countTransactionsByBranch($_SESSION['branch_id']);
        if (isset($_GET['a'])) {
            //SALES ACTIONS
            if ($_GET['a'] == 'add') {
                $customers = $this->crm_model->getAllCustomers();
                $products = $this->product_model->getAllProducts();
                require APP . 'view/SOM/header.php';
                View::adminMode();
                require APP . 'view/SOM/sales/add.php';
                require APP . 'view/_templates/null_footer.php';
            } else {
                header('location: ' . URL . 'som/sales?page=1');
            }
        } else if (isset($_GET['details'])) {
            //SALES DETAILS
            $sales_id = $_GET['details'];
            $details = $this->sales_model->getSales($sales_id);
            if ($details == NULL) {
                header('location: ' . URL . 'som/sales?page=1');
                exit();
            }
            require APP . 'view/SOM/header.php';
            View::adminMode();
            require APP . 'view/SOM/sales/details.php';
            require APP . 'view/_templates/null_footer.php';
        } else if (isset($_GET['edit'])) {
            //EDIT SALES
            $sales_id = $_GET['edit'];
            $details = $this->sales_model->getSales($sales_id);
            $customers = $this->crm_model->getAllCustomers();
            $products = $this->product_model->getAllProducts();
            if ($details == NULL) {
                header('location: ' . URL . 'som/sales?page=1');
                exit();
            }
            require APP . 'view/SOM/header.php';
            View::adminMode();
            require APP . 'view/SOM/sales/edit.php';
            require APP . 'view/_templates/null_footer.php';
        } else if (isset($_GET['delete'])) {
            //DELETE SALES
            $sales_id = $_GET['delete'];
            if ($_POST[$sales_id] <= $transaction_count) {
                if (isset($sales_id)) {
                    $this->sales_model->deleteSales($sales_id);
                    header('location: ' . URL . 'som/sales?page=1');
                }
            } else {
                header('location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            //DEFAULT HOMEPAGE
            View::getPagedListSOM('sales');
            require APP . 'libs/pagination.php';
            require APP . 'view/SOM/header.php';
            View::adminMode();
            $sales = $this->sales_model->getAllSales($start, $limit);
            //$record_by_category = $this->som_model->getSalesbyCategory();
            $total = ceil($transaction_count / $limit);
            require APP . 'view/SOM/sales/index.php';
            require APP . 'view/_templates/null_footer.php';
        }
    }

        //SALES ACTIONS
        function salesAction() {
            if (isset($_POST['add_sales-new_cust'])) {
                $this->crm_model->addCustomer(
                        $_POST["customer_id"], strtoupper($_POST["first_name"]), strtoupper($_POST["last_name"]), strtoupper($_POST["middle_name"]), $_POST["birthday"], strtoupper($_POST["address"]), $_POST["branch"]);
                $this->sales_model->addSales(
                        $_POST["added_by"], $_POST["branch"], $_POST["product_id"], $_POST["qty"], $_POST["price"], $_POST["customer_id"]);
            } else if (isset($_POST['add_sales-ex_cust'])) {
                $this->sales_model->addSales(
                        $_POST["added_by"], $_POST["branch"], $_POST["product_id"], $_POST["qty"], $_POST["price"], $_POST["customer_id"]);
            } else if (isset($_POST["update_sales"])) {
                $this->sales_model->updateSales(
                        $_POST["product_id"], $_POST["qty"], $_POST["price"], $_POST["customer_id"], $_POST["sales_id"]);
            }
            header('location: ' . URL . 'som/sales?page=1');
        }
        
    function orders() {
        $transaction_count = $this->order_model->countTransactions();
        $transaction_count_by_branch = $this->order_model->countTransactionsByBranch($_SESSION['branch_id']);
        if (isset($_GET['a'])) {
            //ORDER ACTIONS
            if ($_GET['a'] == 'add') {
                //ORDER REQUEST
                require APP . 'view/SOM/header.php';
                View::adminMode();
                require APP . 'view/SOM/orders/add.php';
                require APP . 'view/_templates/null_footer.php';
            } else {
                header('location: ' . URL . 'som/orders?page=1');
            }
        } else if (isset($_GET['details'])) {
            //ORDER DETAILS
            $order_id = $_GET['details'];
            $details = $this->order_model->getOrder($order_id);
            if ($details == NULL) {
                header('location: ' . URL . 'som/orders?page=1');
                exit();
            }
            require APP . 'view/SOM/header.php';
            View::adminMode();
            require APP . 'view/SOM/orders/details.php';
            require APP . 'view/_templates/null_footer.php';
        } else if (isset($_GET['edit'])) {
            //EDIT ORDER
            $order_id = $_GET['edit'];
            $details = $this->order_model->getOrder($order_id);
            if ($details == NULL) {
                header('location: ' . URL . 'som/orders?page=1');
                exit();
            }
            require APP . 'view/SOM/header.php';
            View::adminMode();
            require APP . 'view/SOM/orders/edit.php';
            require APP . 'view/_templates/null_footer.php';
        } else if (isset($_GET['delete'])) {
            //DELETE SALES
            $order_id = $_GET['delete'];
            if ($_POST[$order_id] <= $transaction_count) {
                if (isset($order_id)) {
                    $this->order_model->deleteOrder($order_id);
                    header('location: ' . URL . 'som/orders?page=1');
                }
            } else {
                header('location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            //DEFAULT HOMEPAGE
            View::getPagedListSOM('orders');
            require APP . 'libs/pagination.php';
            require APP . 'view/SOM/header.php';
            View::adminMode();
            $orders = $this->order_model->getAllOrders($start, $limit);
            $total = ceil($transaction_count / $limit);
            require APP . 'view/SOM/orders/index.php';
            require APP . 'view/_templates/null_footer.php';
        }
    }

    function accountOverview() {
        require APP . 'view/SOM/header.php';
        View::adminMode();
        require APP . 'view/SOM/account/overview.php';
        require APP . 'view/_templates/null_footer.php';
    }

    function help() {
        require APP . 'view/SOM/header.php';
        View::adminMode();
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/null_footer.php';
    }

    function about() {
        require APP . 'view/SOM/header.php';
        View::adminMode();
        require APP . 'view/about/index.php';
        require APP . 'view/_templates/null_footer.php';
    }

    function export($module) {
        if (isset($module)) {
            $branches = $this->branch_model->getBranches();
            $reporttypes = $this->misc_model->getReportTypes();
            $manu = $this->misc_model->getAllManufacturers();
            require APP . 'view/SOM/header.php';
            View::adminMode();
            if ($module == 'sales') {
                require APP . 'view/SOM/reports/sales.php';
            } else if ($module == 'orders') {
                require APP . 'view/SOM/reports/orders.php';
            } else {
                header('location: ' . URL . 'som');
            }
            require APP . 'view/_templates/null_footer.php';
        } else {
            header('location: ' . URL . 'som');
        }
    }

    function exportAction() {
        
    }

    /**
     * The logout action, login/logout
     */
    function logout() {
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

    function showCaptcha() {
        $this->captcha_model->generateCaptcha();
    }

}
