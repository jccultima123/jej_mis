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
        // MIS COMPONENTS
        $this->sales_model = $this->loadModel('Sales');
        $this->order_model = $this->loadModel('Order');
        $this->ams_model = $this->loadModel('Ams');
        $this->crm_model = $this->loadModel('Crm');
    }
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/'index' (which is the default page btw)
     */
    function index()
    {
        if (isset($_SESSION['user_logged_in'])) {
            // loading some models
            $amount_of_customers = $this->crm_model->getAmountOfCustomers();
            // load views
            $_SESSION["feedback_positive"][] = FEEDBACK_UNDER_DEVELOPMENT;
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/home/index.php';
            require APP . 'view/_templates/null_footer.php';
            exit;
        }
        else {
            // Destroying Session
            Session::destroy();
            // load views
            require APP . 'view/admin/login/header.php';
            require APP . 'view/admin/login/index.php';
            require APP . 'view/_templates/null_footer.php';
            exit();
        }
    }
    
    function about()
    {
        Auth::handleLogin();
        require APP . 'view/admin/header.php';
        require APP . 'view/about/index.php';
        require APP . 'view/_templates/null_footer.php';
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
        $this->admin_model->logout();
        // redirect user to base URL
        header('location: ' . URL . 'admin');
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
            $amount_of_products = $this->product_model->getAmountOfProducts();
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
        
    function usersDashboard()
    {
        Auth::handleLogin();
        $users = $this->user_model->getAllUsers();
        $branches = $this->branch_model->getBranches();
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/user/index.php';
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
                require APP . 'view/_templates/notavailable.php';
            } else {
                require APP . 'view/admin/user/details.php';
            }
            require APP . 'view/admin/footer.php';
        } else {
            header('location: ' . URL . 'admin/usersdashboard');
        }
    }
    
    function editUser($user_id)
    {
        Auth::handleLogin();
        if (isset($user_id)) {
            $user = $this->user_model->getUser($user_id);
            $branches = $this->branch_model->getBranches();
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/user/edit.php';
            require APP . 'view/admin/footer.php';
        } else {
            header('location: ' . URL . 'admin/usersdashboard');
        }
    }
    
    function deactivateUser($user_id)
    {
        Auth::handleLogin();
        $user_count = $this->user_model->countUsers();
        if ($_POST[$user_id] <= $user_count) {
            if (isset($user_id)) {
                $this->user_model->deactivateUser($user_id);
                header('location: ' . URL . 'admin/usersdashboard');
            }
        } else {
            header('location: ' . URL . 'admin/usersdashboard');
        }
    }
    
    function deleteUser($user_id)
    {
        Auth::handleLogin();
        $user_count = $this->user_model->countUsers();
        if ($_POST[$user_id] <= $user_count) {
            if (isset($user_id)) {
                $this->user_model->deleteUser($user_id);
                header('location: ' . URL . 'admin/usersdashboard');
            }
        } else {
            header('location: ' . URL . 'admin/usersdashboard');
        }
    }
    
    function userAction()
    {
        Auth::handleLogin();
        if (isset($_POST['create_user'])) {
            $action_successful = $this->user_model->registerNewUser();
            if ($action_successful == true) {
                header('location: ' . URL . 'admin/usersdashboard');
            } else {
                header('location: ' . URL . 'admin/userRegister');
            }
        } else if (isset($_POST['accept_request'])) {
            $action_successful = $this->user_model->acceptNewUser();
            if ($action_successful == true) {
                header('location: ' . URL . 'admin/usersdashboard');
            } else {
                header('location: ' . URL . 'admin/usersdashboard');
            }
        } else if (isset($_POST['reject_request'])) {
            $action_successful = $this->user_model->rejectNewUser();
            if ($action_successful == true) {
                header('location: ' . URL . 'admin/usersdashboard');
            } else {
                header('location: ' . URL . 'admin/usersdashboard');
            }
        } else if (isset($_POST['update_user'])) {
            $action_successful = $this->user_model->updateUser();
            if ($action_successful == true) {
                header('location: ' . URL . 'admin/usersdashboard');
            } else {
                header('location: ' . URL . 'admin/editUser/' . $_POST['user_id']);
            }
        } else {
            header('location: ' . URL . 'admin/usersdashboard');
        }
    }

    function userRegister()
    {
        Auth::handleLogin();
        $branches = $this->branch_model->getBranches();
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/user/register.php';
        require APP . 'view/admin/footer.php';
    }
}
