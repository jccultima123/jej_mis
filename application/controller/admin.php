<?php

class Admin extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        Auth::handleMIS();
        // CORE
        $this->admin_model = $this->loadModel('Admin');
        $this->branch_model = $this->loadModel('Branch');
        $this->misc_model = $this->loadModel('Misc');
        $this->product_model = $this->loadModel('Product');
        $this->category_model = $this->loadModel('Category');
        // MIS COMPONENTS
        $this->som_model = $this->loadModel('SOM');
        $this->sales_model = $this->loadModel('Sales');
        $this->order_model = $this->loadModel('Order');
        $this->inventory_model = $this->loadModel('Inventory');
        $this->ams_model = $this->loadModel('AMS');
        $this->crm_model = $this->loadModel('CRM');
        //OTHERS
        $this->captcha_model = $this->loadModel('Captcha');
    }
    
    //LOAD CORE FUNCTIONS
    function handleLogin()
    {
        // initialize the session
        Session::init();

        // if user is still not logged in, then destroy session, handle user as "not logged in" and
        // redirect user to login page
        if (!isset($_SESSION['admin_logged_in'])) {
            // Destroying Session
            Session::destroy();
            $this->audit_model->set_log('Exception', 'Non-Admin User' . $_POST['user_name'] . ' was attempting to visit Administrator Site.');
            // load views
            require VIEWS_PATH . '_templates/null_header.php';
            require VIEWS_PATH . 'admin/login/index.php';
            require VIEWS_PATH . '_templates/null_footer.php';
            exit();
        }
    }
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/'index' (which is the default page btw)
     */
    function index()
    {
        if (isset($_SESSION['admin_logged_in'])) {
            // loading some models
            $pending_users = $this->user_model->countPendUsers();
            $pending_orders = $this->som_model->countPendingOrders();
            $sales_count = $this->som_model->countSales();
            $order_count = $this->som_model->countOrders();
            $asset_count = $this->ams_model->countAssets();
            $product_count = $this->product_model->countProducts();
            $feedback_count = $this->crm_model->countFeedbacks();
            $unread_feedback_count = $this->crm_model->countUnreadFeedbacks();
            $amount_of_customers = $this->crm_model->getAmountOfCustomers();
            $audit_count = $this->audit_model->count_logs();
            $this->audit_model->set_log('Admin', 'Dashboard successfully loaded.');
            // load views
            require View::header('admin');
            require VIEWS_PATH . 'admin/home/index.php';
            require View::footer('admin');
            exit;
        }
        else {
            // Destroying Session
            Session::destroy();
            // load views
            require VIEWS_PATH . '_templates/null_header.php';
            require VIEWS_PATH . 'admin/login/index.php';
            require VIEWS_PATH . '_templates/null_footer.php';
            exit();
        }
    }
    
        function fetch($i)
        // Requires JQuery actions
        {
            if (isset($_SESSION['admin_logged_in'])) {
                // loading some models
                switch ($i) {
                    case 'orders':
                        //$this->audit_model->set_log('Admin', 'Fetched pending orders');
                        $i = $this->som_model->countPendingOrders();
                        break;
                    case 'users':
                        //$this->audit_model->set_log('Admin', 'Fetched pending users');
                        $i = $this->user_model->countPendUsers();
                        break;
                    default:
                        $i = 'OOPS!';
                }
                echo $i;
            }
        }
    
    function help()
    {
        header('location: ' . URL . 'help');
    }
    
    function about()
    {
        $this->handleLogin();
        $this->audit_model->set_log('Admin', 'Accessed About page');
        require View::header('admin');
        require VIEWS_PATH . 'about/index.php';
        require View::footer('admin');        
    }
    
    function account()
    {
        $this->handleLogin();
        require View::header('admin');
        require VIEWS_PATH . '_templates/notavailable.php';
        require View::footer('admin');
    }
    
    function preferences($link)
    {
        $this->handleLogin();
        require View::header('admin');
        $users = $this->user_model->getAllUsers();
        $branches = $this->branch_model->getBranches();
        $brcount = $this->branch_model->countBranches();
        if (isset($link)) {
            if ($link == 'users') {
                $this->audit_model->set_log('Admin', 'Visited users page');
                require VIEWS_PATH . 'admin/preferences/users.php';
            } else if ($link == 'profile') {
                $this->audit_model->set_log('Admin', 'Visited Preferences Profile page');
                require VIEWS_PATH . 'admin/preferences/profile.php';
            } else if ($link == 'branches') {
                $branches = $this->branch_model->getBranches();
                require VIEWS_PATH . 'admin/preferences/branches.php';
            } else if ($link == 'main') {
                $this->audit_model->set_log('Admin', 'Visited Preferences Main page');
                require VIEWS_PATH . 'admin/preferences/index.php';
            } else {
                header('location: ' . URL . 'admin/preferences/main');
            }
        } else {
            $this->audit_model->set_log('Error', 'Caught 404 error in preferences page');
            header('location: ' . URL . 'error');
        }
        require View::footer('admin');
    }
    
    function userDetails($user_id)
    {
        $this->handleLogin();
        $branch = $this->branch_model->getBranches();
        if (isset($user_id)) {
            $user = $this->user_model->getUser($user_id);
            $this->audit_model->set_log('Admin', 'Accessed details for User #' . $user_id);
            require View::header('admin');
            if ($user->user_active == 0 AND $user->user_provider_type != 'ADMIN') {
                require VIEWS_PATH . 'admin/user/activate.php';
            } else if ($user->user_password_reset_hash != NULL) {
                //require VIEWS_PATH . 'admin/user/reset.php';
                //require VIEWS_PATH . '_templates/notavailable.php';
                require VIEWS_PATH . 'admin/user/details.php';
            } else {
                require VIEWS_PATH . 'admin/user/details.php';
            }
            require View::footer('admin');
        } else {
            header('location: ' . URL . 'admin/preferences/index.php');
        }
    }
    
    function editUser($user_id)
    {
        $this->handleLogin();
        if (isset($user_id)) {
            $user = $this->user_model->getUser($user_id);
            $usertypes = $this->user_model->getUsertype();
            $branches = $this->branch_model->getBranches();
            $this->audit_model->set_log('Admin', 'Accessed edit form for User #' . $user_id);
            require View::header('admin');
            require VIEWS_PATH . 'admin/user/edit.php';
            require View::footer('admin');
        } else {
            $this->audit_model->set_log('Admin', 'Failed to access non-existent User #' . $user_id);
            header('location: ' . URL . 'admin/preferences/users');            
        }
    }
    
    function deactivateUser($user_id)
    {
        $this->handleLogin();
        $user_count = $this->user_model->countUsers();
        if ($_POST[$user_id] <= $user_count) {
            if (isset($user_id)) {
                $this->user_model->deactivateUser($user_id);
                $this->audit_model->set_log('Admin', 'User #' . $user_id . ' deactivated');
                header('location: ' . URL . 'admin/preferences/users');
            }
        } else {
            $this->audit_model->set_log('Admin', 'Failed to deactivate User #' . $user_id);
            header('location: ' . URL . 'admin/preferences/users');
        }
    }
    
    function deleteUser($user_id)
    {
        $this->handleLogin();
        $user_count = $this->user_model->countUsers();
        if ($_POST[$user_id] <= $user_count) {
            if (isset($user_id)) {
                $this->user_model->deleteUser($user_id);
                $this->audit_model->set_log('Admin', 'User #' . $user_id . ' deleted');
                header('location: ' . URL . 'admin/preferences/users');
            }
        } else {
            $this->audit_model->set_log('Admin', 'Failed to delete user #' . $user_id);
            header('location: ' . URL . 'admin/preferences/users');
        }
    }
    
    function userAction()
    {
        $this->handleLogin();
        if (isset($_POST['create_user'])) {
            $action_successful = $this->user_model->registerNewUser();
            if ($action_successful == true) {
                $this->audit_model->set_log('Admin', 'New User (' . $_POST['user_name'] . ') registered and pending for activation.');
                header('location: ' . URL . 'admin/preferences/users');
            } else {
                $this->userRegister();
            }
        } else if (isset($_POST['accept_request'])) {
            $action_successful = $this->user_model->acceptNewUser();
            if ($action_successful == true) {
                $this->audit_model->set_log('Admin', 'User #' . $_POST['user_name'] . ' activated');
                header('location: ' . URL . 'admin/preferences/users');
            } else {
                $this->audit_model->set_log('Admin', 'Failed to activate user #' . $_POST['user_name']);
                header('location: ' . URL . 'admin/preferences/users');
            }
        } else if (isset($_POST['reject_request'])) {
            $action_successful = $this->user_model->rejectNewUser();
            if ($action_successful == true) {
                $this->audit_model->set_log('Admin', 'User #' . $_POST['user_name'] . 'was rejected for activation. Therefore, the record to this user was deleted');
                header('location: ' . URL . 'admin/preferences/users');
            } else {
                $this->audit_model->set_log('Admin', 'Failed to reject details for user #' . $_POST['user_name']);
                header('location: ' . URL . 'admin/preferences/users');
            }
        } else if (isset($_POST['update_user'])) {
            $action_successful = $this->user_model->updateUser();
            if ($action_successful == true) {
                $this->audit_model->set_log('Admin', 'User #' . $_POST['user_name'] . ' modified and updated');
                header('location: ' . URL . 'admin/preferences/users');
            } else {
                $this->audit_model->set_log('Admin', 'Failed to modify details for user #' . $_POST['user_name']);
                header('location: ' . URL . 'admin/editUser/' . $_POST['user_id']);
            }
        } else if (isset($_POST['update_username'])) {
            $action_successful = $this->user_model->editUserName($_POST['user_id']);
            if ($action_successful == true) {
                header('location: ' . URL . 'admin/preferences/users');
            } else {
                header('location: ' . URL . 'admin/editUser/' . $_POST['user_id']);
            }
        } else if (isset($_POST['update_useremail'])) {
            $action_successful = $this->user_model->editUserEmail();
            if ($action_successful == true) {
                header('location: ' . URL . 'admin/preferences/users');
            } else {
                header('location: ' . URL . 'admin/editUser/' . $_POST['user_id']);
            }
        } else {
            header('location: ' . URL . 'admin/preferences/users');
        }
    }

    function userRegister()
    {
        $this->handleLogin();
        $usertypes = $this->user_model->getUsertype();
        $branches = $this->branch_model->getBranches();
        require View::header('admin');
        require VIEWS_PATH . 'admin/user/register.php';
        require View::footer('admin');
    }
    
    function editUserName($user_id)
    {
        $this->handleLogin();
        if (isset($user_id)) {
            $user = $this->user_model->getUser($user_id);
            require View::header('admin');
            require VIEWS_PATH . 'admin/user/editusername.php';
            require View::footer('admin');
        } else {
            header('location: ' . URL . 'admin/preferences/index.php');
        }
    }
    
    function editUserEmail($user_id)
    {
        $this->handleLogin();
        if (isset($user_id)) {
            require View::header('admin');
            require VIEWS_PATH . 'admin/user/edituseremail.php';
            require View::footer('admin');
        } else {
            header('location: ' . URL . 'admin/preferences/index.php');
        }
    }
        
    function items()
    {
        $this->handleLogin();
        require View::header('admin');
        require VIEWS_PATH . '_templates/notavailable.php';
        require View::footer('admin');
    }
    
        function addCategory()
        {
            $this->handleLogin();
            require View::header('admin');
            require VIEWS_PATH . '_templates/notavailable.php';
            require View::footer('admin');
        }
        
        function editCategory()
        {
            $this->handleLogin();
            require View::header('admin');
            require VIEWS_PATH . '_templates/notavailable.php';
            require View::footer('admin');
        }
        
        function updateCategory()
        {
            $this->handleLogin();
            require View::header('admin');
            require VIEWS_PATH . '_templates/notavailable.php';
            require View::footer('admin');
        }
        
        function deleteCategory()
        {
            $this->handleLogin();
            require View::header('admin');
            require VIEWS_PATH . '_templates/notavailable.php';
            require View::footer('admin');
        }
    
    function productlist()
    {
        require View::header('admin');
        require VIEWS_PATH . 'products/index.php';
        require View::footer('admin.php');
        exit;
    }
    
    function addProduct() {
        $categories = $this->inventory_model->getCategories();
        require View::header('admin');
        require VIEWS_PATH . 'products/add.php';
        require View::footer('admin.php');
        exit;
    }
    
    /**
     * The login action, when you do login/login
     */
    function loginuser()
    {
        Auth::handleCred();
        // perform the login method, put result (true or false) into $login_successful
        $login_successful = $this->admin_model->login();
        // check login status
        if ($login_successful == true) {
            $this->audit_model->set_log('Login', '' . $_POST['user_name'] . ' was logged in.');
            // if YES, then move user to dashboard/index (btw this is a browser-redirection, not a rendered view!)
            header('location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            $this->audit_model->set_log('Login', 'Admin Login: user ' . $_POST['user_name'] . ' was failed to continue.');
            // if NO, then move user to login/index (login form) again
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $logout = $this->user_model->logout($_SESSION['admin_logged_in']);
        if ($logout == true) {
            $this->audit_model->set_log('Login', '' . $_GET['user'] . ' was logged out.');
            header('location: ' . URL . 'mis');
        } else {
            // if NO, then move user to login/index (login form) again
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * Login with cookie
     */
    function loginWithCookie()
    {
        // run the loginWithCookie() method in the login-model, put the result in $login_successful (true or false)
        $login_successful = $this->admin_model->loginWithCookie();

        if ($login_successful) {
            header('location: ' . URL . 'admin');
        } else {
            // delete the invalid cookie to prevent infinite login loops
            $this->admin_model->deleteCookie();
            // if NO, then move user to login/index (login form) (this is a browser-redirection, not a rendered view)
            header('location: ' . URL);
        }
    }
        
    function orderAction()
    {
        $this->handleLogin();
        if (isset($_POST['accept_request'])) {
            $action_successful = $this->order_model->acceptOrder($_POST['order_id'], $_POST['category'], $_POST['product_id'], $_POST['SRP'], $_POST['stocks'], $_POST['branch']);
            if ($action_successful == true) {
                header('location: ' . URL . 'SOM/orders');
            } else {
                header('location: ' . URL . 'SOM/orders');
            }
        } else if (isset($_POST['reject_request'])) {
            $action_successful = $this->order_model->rejectOrder($_POST['order_id']);
            if ($action_successful == true) {
                header('location: ' . URL . 'SOM/orders');
            } else {
                header('location: ' . URL . 'SOM/orders');
            }
        }
    }
    
    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }
    
    function audit()
    {
        $this->handleLogin();
        $au = $this->audit_model->get_logs();
        require View::header('admin');
        require VIEWS_PATH . 'admin/audit/index.php';
        require View::footer('admin');
    }

    /*
     * sys($type, $action)
     * Set of administrative actions such as reset, recovery, etc.
     */
    function sys($type, $action)
    {
        $this->handleLogin();
        if (!isset($action)) {
            header('location: ' . URL . 'admin');
            exit;
        } else {
            switch ($type) {
                case 'database':
                    break;
                case 'users':
                    break;
                case 'core':
                    break;
                default:
                    header('location: ' . URL . 'admin');
            }
        }
        header('location: ' . URL . 'admin');
    }
    
}
