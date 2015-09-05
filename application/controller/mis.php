<?php

/**
 * Class Mis
 * 
 * HOME PAGE OF THIS APPLICATION
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Mis extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        // CORE
        $this->admin_model = $this->loadModel('Admin');
        $this->branch_model = $this->loadModel('Branch');
        $this->misc_model = $this->loadModel('Misc');
        //$this->product_model = $this->loadModel('Product');
        $this->category_model = $this->loadModel('Category');
        // MIS COMPONENTS
        $this->som_model = $this->loadModel('SOM');
        $this->sales_model = $this->loadModel('Sales');
        $this->order_model = $this->loadModel('Order');
        //$this->ams_model = $this->loadModel('AMS');
        $this->crm_model = $this->loadModel('CRM');
    }
    
    /* Improved Render function
     * Concept by panique / (c) Corsanes (jccultima123)
     * TODO: Not should be a static since it's not / $this issues
     */
    function render($module, $sub, $profile)
    {
        if (!isset($sub)) {
            //default index
            $sub = 'index';
        }
        if (!isset($profile)) {
            //default profile
            $profile = 'default';
        }
        /* $profile
         * default -- simple render with default header and footer of your module
         * custom -- render with less limits, but more potential conflicts unless you know what you're doing
         * static -- static. right? no javascript, everything but static html
         */
        switch ($profile) {
            case 'default':
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . 'header.php';
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . $sub . '.php';
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . 'footer.php';
                break;
            case 'custom':
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . $sub . '.php';
                break;
            case 'static':
                require VIEWS_PATH . TEMPLATE . 'static_header.php';
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . $sub . '.php';
                require VIEWS_PATH . TEMPLATE . 'static_footer.php';
                break;
            case 'test':
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . '_test/header.php';
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . $sub . '.php';
                require VIEWS_PATH . strtolower($module) . DIRECTORY_SEPARATOR . '_test/footer.php';
                break;
            default:
                $ERROR = "There's something wrong in rendering views.";
                require_once "_fb/error.html";
                exit();
        }
    }
    
    function export($action) {
        Auth::loginCheck();
        if (isset($action)) {
            switch ($action) {
                case 'test':
                    //$this->render('export', '_test/index', 'test');
                    require VIEWS_PATH . 'export/_test/header.php';
                    require VIEWS_PATH . 'export/_test/index.php';
                    require VIEWS_PATH . 'export/_test/footer.php';
                    break;
                case 'quick_sales':
                    $sales = $this->sales_model->generateQuickSales();
                    if ($sales != false) {
                        $branches = $this->branch_model->getBranches();
                        $salestr = $this->sales_model->getAllSales();
                        $date = $this->sales_model->salesTimestamp();
                        $total_sales = $this->sales_model->totalSales();
                        $top_sales = $this->sales_model->topSalesSold();
                        $top_daily_sales = $this->sales_model->largestDailySalesDate();
                        require VIEWS_PATH . 'export/header.php';
                        require VIEWS_PATH . 'export/' . $action . '.php';
                    } else {
                        header('location: ' . $_SERVER['HTTP_REFERER']);
                    }
                    break;
                case 'quick_orders':
                    $orders = $this->order_model->getAllOrders();
                    if ($orders != false) {
                        $transaction_count = $this->order_model->countTransactions();
                        $orders = $this->order_model->getAllOrders();
                        $date = $this->order_model->getOrderTimestamp();
                        $latest_order = $this->order_model->getLatestOrder();
                        require VIEWS_PATH . 'export/header.php';
                        require VIEWS_PATH . 'export/' . $action . '.php';
                    } else {
                        header('location: ' . $_SERVER['HTTP_REFERER']);
                    }
                    break;
                case 'assets':
                    $sales = $this->sales_model->generateQuickSales();
                    $assets = $this->loadModel('AMS')->getAllAssets();
                    $products = $this->loadModel('Product')->getAllProducts();
                    $inventory = $this->loadModel('Inventory')->reportProducts();
                    require VIEWS_PATH . 'export/header.php';
                    require VIEWS_PATH . 'export/' . $action . '.php';
                    break;
                case 'crm':
                    $feedbacks = $this->crm_model->getAllFeedbacks();
                    $customers = $this->crm_model->getAllCustomers();
                    require VIEWS_PATH . 'export/header.php';
                    require VIEWS_PATH . 'export/' . $action . '.php';
                    break;
                case 'exportExcel':
                    $this->render('export', $action, 'default');
                    break;
                default:
                    header('location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
            }
            require VIEWS_PATH . 'export/footer.php';
        } else {
            header('location: ' . URL . 'error');
        }
    }
    
    /** ----------------------------------- **/
    
    public function index()
    {
        require VIEWS_PATH . '_templates/null_header.php';
        require VIEWS_PATH . 'mis.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    public function login()
    {
        // perform the login method, put result (true or false) into $login_successful
        $login_successful = $this->user_model->login();
        // check login status
        if ($login_successful == true) {
            $this->audit_model->set_log('Login', 'MIS: ' . $_POST['user_name'] . ' was logged in.');
            // if YES, then move user to dashboard/index (btw this is a browser-redirection, not a rendered view!)
            Auth::MIShandleCred();
        } else {
            $this->audit_model->set_log('Login', 'MIS: Login user ' . $_POST['user_name'] . ' was failed to continue.');
            // if NO, then move user to login/index (login form) again
            header('location: ' . URL . 'mis');
        }
    }

    public function account($id, $sub) {
        if (isset($id)) {
            $details = $this->user_model->getUser($id);
            switch ($sub) {
                case 'profile':
                    require View::header('x');
                    require VIEWS_PATH . 'user/' . $sub . '.php';
                    require View::footerCust('_templates/null_footer');
                    break;
                case 'actions':
                    require View::header('x');
                    require VIEWS_PATH . 'user/' . $sub . '.php';
                    require View::footerCust('_templates/null_footer');
                    break;
                case 'edit':
                    require View::header('x');
                    require VIEWS_PATH . 'user/' . $sub . '.php';
                    require View::footerCust('_templates/null_footer');
                    break;
                default:
                    header('location: ' . URL . 'error');
            }
        }
    }
    
}
