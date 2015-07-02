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
        $products = $this->product_model->getAllProducts();
        $transaction_count = $this->som_model->countTransactions();
        if (isset($_GET['a'])) {
            if ($_GET['a'] == 'add') {
                $customers = $this->crm_model->getAllCustomers();
                require APP . 'view/SOM/header.php';
                View::adminMode();
                require APP . 'view/SOM/sales/add.php';
                require APP . 'view/_templates/null_footer.php';
            } else {
                header('location: ' . URL . 'som/sales?page=1');
            }
        } else {
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

    function orders() {
        /*
        $products = $this->product_model->getAllProducts();
        $transaction_count = $this->som_model->countOrders();
        if (isset($_GET['a'])) {
            if ($_GET['a'] == 'add') {
                $customers = $this->crm_model->getAllCustomers();
                require APP . 'view/SOM/header.php';
                View::adminMode();
                require APP . 'view/SOM/sales/add.php';
                require APP . 'view/_templates/null_footer.php';
            } else {
                header('location: ' . URL . 'som/sales?page=1');
            }
        } else {
            View::getPagedListSOM('orders');
            require APP . 'libs/pagination.php';
            require APP . 'view/SOM/header.php';
            View::adminMode();
            //$sales = $this->order_model->getAllSalesTr($start, $limit);
            //$record_by_category = $this->som_model->getSalesbyCategory();
            //$total = ceil($amount_of_records / $limit);
            require APP . 'view/SOM/orders/index.php';
            require APP . 'view/_templates/null_footer.php';
        }
        */
    }

    //SALES ACTIONS
    function salesAction() {
        if (isset($_POST['add_sales-new_cust'])) {
            $this->crm_model->addCustomer(
                    $_POST["customer_id"], $_POST["first_name"], $_POST["last_name"], $_POST["middle_name"], $_POST["birthday"], $_POST["address"], $_POST["branch"]);
            $this->sales_model->addSales(
                    $_POST["added_by"], $_POST["branch"], $_POST["product_id"], $_POST["qty"], $_POST["price"], $_POST["customer_id"]);
        } else if (isset($_POST['add_sales-ex_cust'])) {
            $this->sales_model->addSales(
                    $_POST["added_by"], $_POST["branch"], $_POST["product_id"], $_POST["qty"], $_POST["price"], $_POST["customer_id"]);
        } else if (isset($_POST["update_sales"])) {
            $this->som_model->updateSales(
                    $_POST["added_by"], $_POST["branch"], $_POST["product_id"], $_POST["qty"], $_POST["price"], $_POST["customer_id"]);
        }
        header('location: ' . URL . 'som/sales?page=1');
    }

    function details($record_id) {
        $record = $this->som_model->getRecord($record_id);
        /*
          if ($record == NULL) {
          header('location: ' . URL . 'som');
          exit();
          }
         */
        $categories = $this->som_model->getCategories();
        require APP . 'view/SOM/header.php';
        View::adminMode();
        require APP . 'view/SOM/details.php';
        require APP . 'view/_templates/null_footer.php';
    }

    function editSales($record_id) {
        $categories = $this->som_model->getCategories();
        $status = $this->som_model->getStatus();
        $branches = $this->branch_model->getBranches();
        $manu = $this->misc_model->getAllManufacturers();
        if (isset($record_id)) {
            $sales = $this->som_model->getSales($record_id);
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

    function deleteRecord($record_id) {
        $amount_of_records = $this->som_model->getAmountOfRecords();
        if ($_POST[$record_id] <= $amount_of_records) {
            if (isset($record_id)) {
                $this->som_model->deletesales($record_id);
                header('location: ' . URL . 'som');
            }
        } else {
            header('location: ' . URL . 'som');
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
