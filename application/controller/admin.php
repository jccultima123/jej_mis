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
        $this->ams_model = $this->loadModel('AMS');
        $this->crm_model = $this->loadModel('CRM');
        //OTHERS
        $this->captcha_model = $this->loadModel('Captcha');
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
            // load views
            require VIEWS_PATH . 'admin/header.php';
            require VIEWS_PATH . 'admin/home/index.php';
            require VIEWS_PATH . 'admin/footer.php';
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
                        $i = $this->som_model->countPendingOrders();
                        break;
                    case 'users':
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
        Auth::handleLogin();
        require VIEWS_PATH . 'admin/header.php';
        require VIEWS_PATH . '_templates/notavailable.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    function about()
    {
        Auth::handleLogin();
        require VIEWS_PATH . 'admin/header.php';
        require VIEWS_PATH . 'about/index.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    function account()
    {
        Auth::handleLogin();
        require VIEWS_PATH . 'admin/header.php';
        require VIEWS_PATH . '_templates/notavailable.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    function preferences($link)
    {
        Auth::handleLogin();
        require VIEWS_PATH . 'admin/header.php';
        $users = $this->user_model->getAllUsers();
        $branches = $this->branch_model->getBranches();
        $brcount = $this->branch_model->countBranches();
        if (isset($link)) {
            if ($link == 'users') {
                require VIEWS_PATH . 'admin/preferences/users.php';
            } else if ($link == 'index.php') {
                require VIEWS_PATH . 'admin/preferences/index.php';
            } else if ($link == 'addbranch') {
                require VIEWS_PATH . '_templates/notavailable.php';
            } else {
                header('location: ' . URL . 'admin/preferences/index.php');
            }
        } else {
            header('location: ' . URL . 'error');
        }
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    function userDetails($user_id)
    {
        Auth::handleLogin();
        $branch = $this->branch_model->getBranches();
        if (isset($user_id)) {
            $user = $this->user_model->getUser($user_id);
            require VIEWS_PATH . 'admin/header.php';
            if ($user->user_active == 0) {
                require VIEWS_PATH . 'admin/user/activate.php';
            } else if ($user->user_password_reset_hash != NULL) {
                //require VIEWS_PATH . 'admin/user/reset.php';
                //require VIEWS_PATH . '_templates/notavailable.php';
                require VIEWS_PATH . 'admin/user/details.php';
            } else {
                require VIEWS_PATH . 'admin/user/details.php';
            }
            require VIEWS_PATH . '_templates/null_footer.php';
        } else {
            header('location: ' . URL . 'admin/preferences/index.php');
        }
    }
    
    function editUser($user_id)
    {
        Auth::handleLogin();
        if (isset($user_id)) {
            $user = $this->user_model->getUser($user_id);
            $usertypes = $this->user_model->getUsertype();
            $branches = $this->branch_model->getBranches();
            require VIEWS_PATH . 'admin/header.php';
            require VIEWS_PATH . 'admin/user/edit.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        } else {
            header('location: ' . URL . 'admin/preferences/users');
        }
    }
    
    function deactivateUser($user_id)
    {
        Auth::handleLogin();
        $user_count = $this->user_model->countUsers();
        if ($_POST[$user_id] <= $user_count) {
            if (isset($user_id)) {
                $this->user_model->deactivateUser($user_id);
                header('location: ' . URL . 'admin/preferences/users');
            }
        } else {
            header('location: ' . URL . 'admin/preferences/users');
        }
    }
    
    function deleteUser($user_id)
    {
        Auth::handleLogin();
        $user_count = $this->user_model->countUsers();
        if ($_POST[$user_id] <= $user_count) {
            if (isset($user_id)) {
                $this->user_model->deleteUser($user_id);
                header('location: ' . URL . 'admin/preferences/users');
            }
        } else {
            header('location: ' . URL . 'admin/preferences/users');
        }
    }
    
    function userAction()
    {
        Auth::handleLogin();
        if (isset($_POST['create_user'])) {
            $action_successful = $this->user_model->registerNewUser();
            if ($action_successful == true) {
                header('location: ' . URL . 'admin/preferences/users');
            } else {
                header('location: ' . URL . 'admin/userRegister/users');
            }
        } else if (isset($_POST['accept_request'])) {
            $action_successful = $this->user_model->acceptNewUser();
            if ($action_successful == true) {
                header('location: ' . URL . 'admin/preferences/users');
            } else {
                header('location: ' . URL . 'admin/preferences/users');
            }
        } else if (isset($_POST['reject_request'])) {
            $action_successful = $this->user_model->rejectNewUser();
            if ($action_successful == true) {
                header('location: ' . URL . 'admin/preferences/users');
            } else {
                header('location: ' . URL . 'admin/preferences/users');
            }
        } else if (isset($_POST['update_user'])) {
            $action_successful = $this->user_model->updateUser();
            if ($action_successful == true) {
                header('location: ' . URL . 'admin/preferences/users');
            } else {
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
        Auth::handleLogin();
        $usertypes = $this->user_model->getUsertype();
        $branches = $this->branch_model->getBranches();
        require VIEWS_PATH . 'admin/header.php';
        require VIEWS_PATH . 'admin/user/register.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
    function editUserName($user_id)
    {
        Auth::handleLogin();
        if (isset($user_id)) {
            $user = $this->user_model->getUser($user_id);
            require VIEWS_PATH . 'admin/header.php';
            require VIEWS_PATH . 'admin/user/editusername.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        } else {
            header('location: ' . URL . 'admin/preferences/index.php');
        }
    }
    
    function editUserEmail($user_id)
    {
        Auth::handleLogin();
        if (isset($user_id)) {
            require VIEWS_PATH . 'admin/header.php';
            require VIEWS_PATH . 'admin/user/edituseremail.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        } else {
            header('location: ' . URL . 'admin/preferences/index.php');
        }
    }
    
    function branches()
    {
        Auth::handleLogin();
        require VIEWS_PATH . 'admin/header.php';
        require VIEWS_PATH . '_templates/notavailable.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
        function addBranch()
        {
            Auth::handleLogin();
            require VIEWS_PATH . 'admin/header.php';
            require VIEWS_PATH . '_templates/notavailable.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        }
        
        function editBranch()
        {
            Auth::handleLogin();
            require VIEWS_PATH . 'admin/header.php';
            require VIEWS_PATH . '_templates/notavailable.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        }
        
        function updateBranch()
        {
            Auth::handleLogin();
            require VIEWS_PATH . 'admin/header.php';
            require VIEWS_PATH . '_templates/notavailable.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        }
        
        function deleteBranch()
        {
            Auth::handleLogin();
            require VIEWS_PATH . 'admin/header.php';
            require VIEWS_PATH . '_templates/notavailable.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        }
        
    function items()
    {
        Auth::handleLogin();
        require VIEWS_PATH . 'admin/header.php';
        require VIEWS_PATH . '_templates/notavailable.php';
        require VIEWS_PATH . '_templates/null_footer.php';
    }
    
        function addCategory()
        {
            Auth::handleLogin();
            require VIEWS_PATH . 'admin/header.php';
            require VIEWS_PATH . '_templates/notavailable.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        }
        
        function editCategory()
        {
            Auth::handleLogin();
            require VIEWS_PATH . 'admin/header.php';
            require VIEWS_PATH . '_templates/notavailable.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        }
        
        function updateCategory()
        {
            Auth::handleLogin();
            require VIEWS_PATH . 'admin/header.php';
            require VIEWS_PATH . '_templates/notavailable.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        }
        
        function deleteCategory()
        {
            Auth::handleLogin();
            require VIEWS_PATH . 'admin/header.php';
            require VIEWS_PATH . '_templates/notavailable.php';
            require VIEWS_PATH . '_templates/null_footer.php';
        }
    
    function productlist()
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
    
    function products($action, $id)
    {
        if (isset($action)) {
            switch($action) {
                case 'edit':
                    break;
                case 'delete':
                    break;
                default:
                    header('location: ' . URL . 'admin/productlist');
            }
        }
    }
    
    function productAction()
    {
        if (isset($_POST["add_product"])) {
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
        }
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
            // if YES, then move user to dashboard/index (btw this is a browser-redirection, not a rendered view!)
            header('location: ' . URL . 'admin');
        } else {
            // if NO, then move user to login/index (login form) again
            header('location: ' . URL . 'admin');
        }
    }

    /**
     * The logout action, login/logout
     */
    function logout()
    {
        $this->user_model->logout($_SESSION['admin_logged_in']);
        // redirect user to base URL
        header('location: ' . URL);
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
        Auth::handleLogin();
        if (isset($_POST['accept_request'])) {
            $action_successful = $this->order_model->acceptOrder($_POST['order_id'], $_POST['category'], $_POST['product_id'], $_POST['stocks'], $_SESSION['branch_id']);
            if ($action_successful == true) {
                header('location: ' . URL . 'som/orders');
            } else {
                header('location: ' . URL . 'som/orders');
            }
        } else if (isset($_POST['reject_request'])) {
            $action_successful = $this->order_model->rejectOrder($_POST['order_id']);
            if ($action_successful == true) {
                header('location: ' . URL . 'som/orders');
            } else {
                header('location: ' . URL . 'som/orders');
            }
        }
    }
    
    function showCaptcha()
    {
        $this->captcha_model->generateCaptcha();
    }
}
