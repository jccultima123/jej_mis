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
        //$this->sales_model = $this->loadModel('Sales');
        //$this->order_model = $this->loadModel('Order');
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    function index() {
        if (isset($_GET['action'])) {
            $categories = $this->som_model->getCategories();
            $manu = $this->misc_model->getAllManufacturers();
            $branches = $this->branch_model->getBranches();
            $brcount = $this->branch_model->countBranches();
            $status = $this->som_model->getStatus();
            $link = $_GET['action'];
            if ($link == 'addRecord') {
                require APP . 'view/SOM/header.php';
                View::adminMode();
                require APP . 'view/SOM/add.php';
                require APP . 'view/_templates/null_footer.php';
            } else {
                header('location: ' . URL . 'error');
            }
        } else {
            View::getPagedList('som');
            require APP . 'libs/pagination.php';
            $records = $this->som_model->getAllRecords($start, $limit);
            $manufacturers = $this->som_model->getAllManufacturers();
            $record_by_category = $this->som_model->getRecordbyCategory();
            $amount_of_records = $this->som_model->getAmountOfRecords();
            $total = ceil($amount_of_records / $limit);
            require APP . 'view/SOM/header.php';
            View::adminMode();
            require APP . 'view/SOM/index.php';
            require APP . 'view/_templates/null_footer.php';
        }
    }
    
        //SALES ACTIONS
        function action()
        {
            if (isset($_POST['add_record'])) {
                if (isset($_POST['customer'])) {
                    $customer = $_POST['customer'];
                    if ($customer === 'new') {
                        $this->som_model->addRecord(
                        $_POST["category"],
                        $_POST["manufacturer"],
                        $_POST["product_name"],
                        $_POST["product_model"],
                        $_POST["IMEI"],
                        $_POST["added_by"],
                        $_POST["branch"],
                        $_POST["qty"],
                        $_POST["price"],
                        $_POST["status_id"]);
                        $this->misc_model->addCustomer(
                        $_POST["first_name"],
                        $_POST["last_name"],
                        $_POST["middle_name"],
                        $_POST["birthday"],
                        $_POST["address"],
                        $_POST["branch"]);
                    } else {
                        
                    }
                }
                // ADD THIS in som_model.php
                $this->som_model->addRecord(
                        $_POST["category"],
                        $_POST["manufacturer"],
                        $_POST["product_name"],
                        $_POST["product_model"],
                        $_POST["IMEI"],
                        $_POST["added_by"],
                        $_POST["branch"],
                        $_POST["price"],
                        $_POST["status_id"]);
                header('location: ' . URL . 'som?page=1');
            } else if ($_POST['update_record']) {
                if (isset($_POST["update_record"])) {
                    $this->som_model->updateRecord(
                            $_POST["category"],
                            $_POST["manufacturer"],
                            $_POST["product_name"],
                            $_POST["product_model"],
                            $_POST["IMEI"],
                            $_POST["added_by"],
                            $_POST["branch"],
                            $_POST["price"],
                            $_POST["status_id"],
                            $_POST["id"]);
                }
                header('location: ' . URL . 'som?page=1');
            } else {
                header('location: ' . URL . 'som');
            }
        }
    
        function details($record_id)
        {
            $record = $this->som_model->getRecord($record_id);
            /*
            if ($record == NULL) {
                header('location: ' . URL . 'som?page=1');
                exit();
            }
             */
            $categories = $this->som_model->getCategories();
            require APP . 'view/SOM/header.php';
            View::adminMode();
            require APP . 'view/SOM/details.php';
            require APP . 'view/_templates/null_footer.php';
        }
    
        function editSales($record_id)
        {
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
                    header('location: ' . URL . 'som?page=1');
                }
            }
            else {
                header('location: ' . URL . 'som?page=1');
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
            $reporttypes = $this->misc_model->getReportTypes();
            $manu = $this->misc_model->getAllManufacturers();
            require APP . 'view/SOM/header.php';
            View::adminMode();
            if ($module == 'sales') {
                require APP . 'view/SOM/reports/sales.php';
            } else if ($module == 'orders') {
                require APP . 'view/SOM/reports/orders.php';
            } else {
                header('location: ' . URL . 'som?page=1');
            }
            require APP . 'view/_templates/null_footer.php';
        } else {
            header('location: ' . URL . 'som?page=1');
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
