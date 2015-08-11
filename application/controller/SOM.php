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
        $this->inventory_model = $this->loadModel('Inventory');
        $this->crm_model = $this->loadModel('CRM');
        $this->sales_model = $this->loadModel('Sales');
        $this->order_model = $this->loadModel('Order');
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    function index() {
        require View::header('SOM');
        View::adminMode();
        require VIEWS_PATH . 'SOM/index.php';
        require View::footerCust('_templates/null_footer');
    }

    function sales() {
        $transaction_count = $this->sales_model->countTransactions();
        $transaction_count_by_branch = $this->sales_model->countTransactionsByBranch($_SESSION['branch_id']);
        if (isset($_GET['a'])) {
            //SALES ACTIONS
            if ($_GET['a'] == 'add') {
                $customers = $this->crm_model->getAllCustomers();
                $products = $this->inventory_model->getAllProducts();
                require View::header('SOM');
                View::adminMode();
                require VIEWS_PATH . 'SOM/sales/add.php';
                require View::footerCust('_templates/null_footer');
            } else {
                header('location: ' . URL . 'som/sales');
            }
        } else if (isset($_GET['details'])) {
            //SALES DETAILS
            $sales_id = $_GET['details'];
            $details = $this->sales_model->getSales($sales_id);
            if ($details == NULL) {
                header('location: ' . URL . 'som/sales');
                exit();
            }
            require View::header('SOM');
            View::adminMode();
            require VIEWS_PATH . 'SOM/sales/details.php';
            require View::footerCust('_templates/null_footer');
        } else if (isset($_GET['edit'])) {
            //EDIT SALES
            $sales_id = $_GET['edit'];
            $details = $this->sales_model->getSales($sales_id);
            $customers = $this->crm_model->getAllCustomers();
            $products = $this->inventory_model->getAllProducts();
            if ($details == NULL) {
                header('location: ' . URL . 'som/sales');
                exit();
            }
            require View::header('SOM');
            View::adminMode();
            require VIEWS_PATH . 'SOM/sales/edit.php';
            require View::footerCust('_templates/null_footer');
        } else if (isset($_GET['del'])) {
            //VIOLATE THE SALES AND TRANSFER TO ANOTHER TABLE
            $sales_id = $_GET['del'];
            $details = $this->sales_model->getSales($sales_id);
            if ($details != NULL) {
                $this->sales_model->deleteSales($sales_id);
            }
            header('location: ' . URL . 'som/sales');
            exit();
        } else {
            //DEFAULT HOMEPAGE
            require View::header('SOM');
            View::adminMode();
            $sales = $this->sales_model->getAllSales();
            //$record_by_category = $this->som_model->getSalesbyCategory();
            require VIEWS_PATH . 'SOM/sales/index.php';
            require View::footerCust('_templates/null_footer');
        }
    }

        //SALES ACTIONS
        function salesAction() {
            if (isset($_POST['add_sales-new_cust'])) {
                $email = $_POST["email"];
                if (empty($email)) {$email = strtolower($_POST["first_name"] . $_POST["last_name"] . '@jej.com');}
                $this->crm_model->addCustomer(
                        $_POST["customer_id"], strtoupper($_POST["first_name"]), strtoupper($_POST["last_name"]), strtoupper($_POST["middle_name"]), $email, $_POST["birthday"], strtoupper($_POST["address"]), $_POST["branch"]);
                $this->sales_model->addSales(
                        $_POST["added_by"], $_POST["branch"], $_POST["product_id"], $_POST["qty"], $_POST["customer_id"]);
            } else if (isset($_POST['add_sales-ex_cust'])) {
                $this->sales_model->addSales(
                        $_POST["added_by"], $_POST["branch"], $_POST["product_id"], $_POST["qty"], $_POST["customer_id"]);
            } else if (isset($_POST["update_sales"])) {
                $this->sales_model->updateSales(
                        $_POST["product_id"], $_POST["qty"], $_POST["customer_id"], $_POST["sales_id"]);
            } else if (isset($_POST['void_this'])) {
                $this->sales_model->voidSales();
            }
            header('location: ' . URL . 'som/sales');
        }
        
    function orders() {
        $transaction_count = $this->order_model->countTransactions();
        $transaction_count_by_branch = $this->order_model->countTransactionsByBranch($_SESSION['branch_id']);
        if (isset($_GET['a'])) {
            //ORDER ACTIONS
            if ($_GET['a'] == 'add') {
                $suppliers = $this->som_model->getSuppliers();
                $products = $this->product_model->getAllProducts();
                //ORDER REQUEST
                require View::header('SOM');
                View::adminMode();
                require VIEWS_PATH . 'SOM/orders/add.php';
                require View::footerCust('_templates/null_footer');
            } else {
                header('location: ' . URL . 'som/orders');
            }
        } else if (isset($_GET['details'])) {
            //ORDER DETAILS
            $order_id = $_GET['details'];
            $details = $this->order_model->getOrder($order_id);
            if ($details == NULL) {
                header('location: ' . URL . 'som/orders');
                exit();
            }
            require View::header('SOM');
            View::adminMode();
            if ($details->accepted == 0) {
                if (isset($_SESSION['admin_logged_in'])) {
                    require VIEWS_PATH . 'SOM/orders/acceptance.php';
                } else {
                    require VIEWS_PATH . 'SOM/orders/details.php';
                }
            } else {
                require VIEWS_PATH . 'SOM/orders/details.php';
            }
            require View::footerCust('_templates/null_footer');
        } else if (isset($_GET['edit'])) {
            // Admin only
            Auth::handleLogin();
            //EDIT ORDER
            $order_id = $_GET['edit'];
            $details = $this->order_model->getOrder($order_id);
            if ($details == NULL) {
                header('location: ' . URL . 'som/orders');
                exit();
            }
            require View::header('SOM');
            View::adminMode();
            require VIEWS_PATH . 'SOM/orders/edit.php';
            require View::footerCust('_templates/null_footer');
        } else if (isset($_GET['delete'])) {
            //DELETE SALES
            $order_id = $_GET['delete'];
            if ($_POST[$order_id] <= $transaction_count) {
                if (isset($order_id)) {
                    $this->order_model->deleteOrder($order_id);
                    header('location: ' . URL . 'som/orders');
                }
            } else {
                header('location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            //DEFAULT HOMEPAGE
            require View::header('SOM');
            View::adminMode();
            $orders = $this->order_model->getAllOrders();
            require VIEWS_PATH . 'SOM/orders/index.php';
            require View::footerCust('_templates/null_footer');
        }
    }
    
        function orderAction() {
            if (isset($_POST['add_order'])) {
                $this->order_model->addOrder($_POST['added_by'], $_POST['order_branch'], $_POST['product_id'], $_POST['SRP'], $_POST['stocks'], $_POST['comments']);
            }
            header('location: ' . URL . 'som/orders');
        }

    function inventory() {
        require View::header('SOM');
        View::adminMode();
        
        require View::footerCust('_templates/null_footer');
    }

    function help() {
        require View::header('SOM');
        View::adminMode();
        require VIEWS_PATH . '_templates/notavailable.php';
        require View::footerCust('_templates/null_footer');
    }

    function about() {
        require View::header('SOM');
        View::adminMode();
        require VIEWS_PATH . 'about/index.php';
        require View::footerCust('_templates/null_footer');
    }

    /**
     * The logout action, login/logout
     */
    function logout() {
        $logout = $this->user_model->logout($_SESSION['SOM_user_logged_in']);
        // check login status
        if ($logout == true) {
            $this->audit_model->set_log('Login', 'SOM: ' . $_GET['user'] . ' was logged out.');
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
