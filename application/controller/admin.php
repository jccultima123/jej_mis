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
            $amount_of_customers = $this->crm_model->getAmountOfCustomers();
            // load views
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/home/index.php';
            require APP . 'view/admin/footer.php';
            exit;
        }
        else {
            // Destroying Session
            Session::destroy();
            // load views
            require APP . 'view/_templates/null_header.php';
            require APP . 'view/admin/login/index.php';
            require APP . 'view/_templates/null_footer.php';
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
        require APP . 'view/admin/header.php';
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    function about()
    {
        Auth::handleLogin();
        require APP . 'view/admin/header.php';
        require APP . 'view/about/index.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    function account()
    {
        Auth::handleLogin();
        require APP . 'view/admin/header.php';
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    function preferences($link)
    {
        Auth::handleLogin();
        require APP . 'view/admin/header.php';
        $users = $this->user_model->getAllUsers();
        $branches = $this->branch_model->getBranches();
        $brcount = $this->branch_model->countBranches();
        if (isset($link)) {
            if ($link == 'users') {
                require APP . 'view/admin/preferences/users.php';
            } else if ($link == 'index.php') {
                require APP . 'view/admin/preferences/index.php';
            } else if ($link == 'addbranch') {
                require APP . 'view/_templates/notavailable.php';
            } else {
                header('location: ' . URL . 'admin/preferences/index.php');
            }
        } else {
            header('location: ' . URL . 'error');
        }
        require APP . 'view/_templates/null_footer.php';
    }
    
    function userDetails($user_id)
    {
        Auth::handleLogin();
        $branch = $this->branch_model->getBranches();
        if (isset($user_id)) {
            $user = $this->user_model->getUser($user_id);
            require APP . 'view/admin/header.php';
            if ($user->user_active == 0) {
                require APP . 'view/admin/user/activate.php';
            } else if ($user->user_password_reset_hash != NULL) {
                //require APP . 'view/admin/user/reset.php';
                //require APP . 'view/_templates/notavailable.php';
                require APP . 'view/admin/user/details.php';
            } else {
                require APP . 'view/admin/user/details.php';
            }
            require APP . 'view/_templates/null_footer.php';
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
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/user/edit.php';
            require APP . 'view/_templates/null_footer.php';
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
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/user/register.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
    function editUserName($user_id)
    {
        Auth::handleLogin();
        if (isset($user_id)) {
            $user = $this->user_model->getUser($user_id);
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/user/editusername.php';
            require APP . 'view/_templates/null_footer.php';
        } else {
            header('location: ' . URL . 'admin/preferences/index.php');
        }
    }
    
    function editUserEmail($user_id)
    {
        Auth::handleLogin();
        if (isset($user_id)) {
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/user/edituseremail.php';
            require APP . 'view/_templates/null_footer.php';
        } else {
            header('location: ' . URL . 'admin/preferences/index.php');
        }
    }
    
    function branches()
    {
        Auth::handleLogin();
        require APP . 'view/admin/header.php';
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
        function addBranch()
        {
            Auth::handleLogin();
            require APP . 'view/admin/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
        }
        
        function editBranch()
        {
            Auth::handleLogin();
            require APP . 'view/admin/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
        }
        
        function updateBranch()
        {
            Auth::handleLogin();
            require APP . 'view/admin/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
        }
        
        function deleteBranch()
        {
            Auth::handleLogin();
            require APP . 'view/admin/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
        }
        
    function items()
    {
        Auth::handleLogin();
        require APP . 'view/admin/header.php';
        require APP . 'view/_templates/notavailable.php';
        require APP . 'view/_templates/null_footer.php';
    }
    
        function addCategory()
        {
            Auth::handleLogin();
            require APP . 'view/admin/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
        }
        
        function editCategory()
        {
            Auth::handleLogin();
            require APP . 'view/admin/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
        }
        
        function updateCategory()
        {
            Auth::handleLogin();
            require APP . 'view/admin/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
        }
        
        function deleteCategory()
        {
            Auth::handleLogin();
            require APP . 'view/admin/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
        }
    
    function ams()
    {
        Auth::handleLogin();
        if (isset($_GET['action'])) {
            $link = $_GET['action'];
            if ($link == 'add') {
                $branches = $this->branch_model->getBranches();
                require APP . 'view/admin/header.php';
                require APP . 'view/_templates/notavailable.php';
                require APP . 'view/_templates/null_footer.php';
            } else {
                header('location: ' . URL . 'error');
            }
        } else {
            require APP . 'view/admin/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
        }
    }
    
    function crm()
    {
        Auth::handleLogin();
        if (isset($_GET['action'])) {
            $link = $_GET['action'];
            if ($link == 'add') {
                $branches = $this->branch_model->getBranches();
                require APP . 'view/admin/header.php';
                require APP . 'view/_templates/notavailable.php';
                require APP . 'view/_templates/null_footer.php';
            } else {
                header('location: ' . URL . 'error');
            }
        } else {
            require APP . 'view/admin/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
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
    
        // PRODUCTS
        function products()
        {
            Auth::handleLogin();
            // PRODUCTS
            $products = $this->product_model->getAllProducts();
            $manufacturers = $this->product_model->getAllManufacturers();
            $categories = $this->product_model->getCategories();
            $product_by_category = $this->product_model->getProductbyCategory();
            $amount_of_products = $this->product_model->countProducts();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/products/index.php';
            require APP . 'view/_templates/null_footer.php';
        }
        
        function searchProduct()
        {
            Auth::handleLogin();
            $search = $_POST["search"];
            $products = $this->product_model->searchProducts($search);
            if (isset($_POST["search_products"])) {
                //$amount_of_products = $this->product_model->getAmountOfProductResults();
                    require APP . 'view/admin/header.php';
                    require APP . 'view/admin/products/search.php';
                    require APP . 'view/_templates/null_footer.php';
            }
            else {
                //fall back
                header('location: ' . URL . 'admin/products');
            }
        }

        function editProduct($product_id)
        {
            Auth::handleLogin();
            $categories = $this->product_model->getCategories();
            if (isset($product_id)) {
                $products = $this->product_model->getProduct($product_id);
                require APP . 'view/admin/products/edit.php';
                require APP . 'view/_templates/null_footer.php';
            } else {
                header('location: ' . URL . 'admin/products');
            }
        }

        function productDetails($product_id)
        {
            Auth::handleLogin();
            $categories = $this->product_model->getCategories();
            if (isset($product_id)) {
                $products = $this->product_model->getProduct($product_id);
                require APP . 'view/admin/products/details.php';
                require APP . 'view/_templates/null_footer.php';
            } else {
                header('location: ' . URL . 'admin/products');
            }
        }

        /** CRUD ACTIONS **/

        function addProduct()
        {
            Auth::handleLogin();
            $products = $this->product_model->getAllProducts();
            // if we have POST data to create a new song entry
            if (isset($_POST["submit_add_product"])) {
                if (isset($_POST["category"]) === $products->category) {
                    header('location: ' . URL . 'admin/products');
                } else if (isset($_POST["SKU"]) === $products->SKU) {
                    header('location: ' . URL . 'admin/products');
                } else if (isset($_POST["manufacturer_name"]) === $products->manufacturer_name) {
                    header('location: ' . URL . 'admin/products');
                } else if (isset($_POST["product_name"]) === $products->product_name) {
                    header('location: ' . URL . 'admin/products');
                } else if (isset($_POST["product_model"]) === $products->product_model) {
                    header('location: ' . URL . 'admin/products');
                } else if (isset($_POST["price"]) === $products->price) {
                    header('location: ' . URL . 'admin/products');
                } else if (isset($_POST["link"]) === $products->link) {
                    header('location: ' . URL . 'admin/products');
                } else {
                    // ADD THIS in product_model/product_model.php
                    $this->product_model->addProduct(
                            $_POST["category"],
                            $_POST["SKU"],
                            $_POST["manufacturer_name"],
                            $_POST["product_name"],
                            $_POST["product_model"],
                            $_POST["price"],
                            $_POST["link"]);
                }
            //$message = CRUD_ADDED;
            // where to go after song has been added
            header('location: ' . URL . 'admin/products');
            }
        }

        function updateProduct()
        {
            Auth::handleLogin();
            // if we have POST data to create a new song entry
            if (isset($_POST["update_product"])) {
                $this->product_model->updateProduct($_POST["category"], $_POST["SKU"], $_POST["manufacturer_name"], $_POST["product_name"], $_POST["product_model"], $_POST["price"], $_POST["link"], $_POST["product_id"]);
            }

            // where to go after song has been added
            header('location: ' . URL . 'admin/products');
        }

        function deleteProduct($product_id)
        {
            Auth::handleLogin();
            $amount_of_products = $this->product_model->getAmountOfProducts();
            if ($_POST[$product_id] <= $amount_of_products) {
                if (isset($product_id)) {
                    $this->product_model->deleteProduct($product_id);
                    header('location: ' . URL . 'admin/products');
                }
            }
            else {
                $this->$error = CRUD_UNABLE_TO_DELETE;
                header('location: ' . URL . 'admin/products');
            }

        }
        
        function generateProductReports()
        {
            Auth::handleLogin();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/notavailable.php';
            require APP . 'view/_templates/null_footer.php';
        }
        
    function orderAction($order_id)
    {
        Auth::handleLogin();
        if (isset($_POST['accept_request'])) {
            $action_successful = $this->order_model->acceptOrder($_POST['order_id']);
            if ($action_successful == true) {
                header('location: ' . URL . 'som/orders?page=1');
            } else {
                header('location: ' . URL . 'som/orders?page=1');
            }
        } else if (isset($_POST['reject_request'])) {
            $action_successful = $this->order_model->rejectOrder($_POST['order_id']);
            if ($action_successful == true) {
                header('location: ' . URL . 'som/orders?page=1');
            } else {
                header('location: ' . URL . 'som/orders?page=1');
            }
        }
    }
}
