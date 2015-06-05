<?php

class Admin extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        Session::init();
        // CORE
        $this->admin_model = $this->loadModel('Admin');
        $this->product_model = $this->loadModel('Branch');
        $this->product_model = $this->loadModel('Product');
        // MIS COMPONENTS
        $this->aom_model = $this->loadModel('Som');
        $this->ams_model = $this->loadModel('Ams');
        $this->crm_model = $this->loadModel('Crm');
    }
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/'index' (which is the default page btw)
     */
    public function index()
    {
        if (isset($_SESSION['user_logged_in'])) {
            // loading some models
            $amount_of_customers = $this->crm_model->getAmountOfCustomers();
            // load views
            $_SESSION["feedback_positive"][] = FEEDBACK_UNDER_DEVELOPMENT;
            require APP . 'view/admin/header.php';
            require APP . 'view/admin/home/index.php';
            require APP . 'view/admin/footer.php';
            exit;
        }
        else {
            // Destroying Session
            Session::destroy();
            // load views
            require APP . 'view/admin/login/header.php';
            require APP . 'view/admin/login/index.php';
            require APP . 'view/admin/login/footer.php';
            exit();
        }
    }
    
    public function about()
    {
        // load views
        require APP . 'view/admin/header.php';
        require APP . 'view/admin/about/index.php';
        require APP . 'view/admin/footer.php';
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
            header('location: ' . URL);
        } else {
            // delete the invalid cookie to prevent infinite login loops
            $admin_model->deleteCookie();
            // if NO, then move user to login/index (login form) (this is a browser-redirection, not a rendered view)
            header('location: ' . URL . 'login');
        }
    }
    
        // PRODUCTS
        public function products()
        {
            Auth::handleLogin();
        }
        
        public function searchProduct()
        {
            $search = $_POST["search"];
            $products = $this->product_model->searchProducts($search);
            if (isset($_POST["search_products"])) {
                //$amount_of_products = $this->product_model->getAmountOfProductResults();
                    require APP . 'view/_templates/header.php';
                    require APP . 'view/products/search.php';
                    require APP . 'view/_templates/footer.php';
            }
            else {
                //fall back
                header('location: ' . URL . 'products');
            }
        }

        public function editProduct($product_id)
        {
            $categories = $this->product_model->getCategories();
            if (isset($product_id)) {
                $products = $this->product_model->getProduct($product_id);
                require APP . 'view/products/edit.php';
                require APP . 'view/_templates/footer.php';
            } else {
                header('location: ' . URL . 'products');
            }
        }

        public function productDetails($product_id)
        {
            $categories = $this->product_model->getCategories();
            if (isset($product_id)) {
                $products = $this->product_model->getProduct($product_id);
                require APP . 'view/products/details.php';
                require APP . 'view/_templates/footer.php';
            } else {
                header('location: ' . URL . 'products');
            }
        }

        /** CRUD ACTIONS **/

        public function addProduct()
        {
            $products = $this->product_model->getAllProducts();
            // if we have POST data to create a new song entry
            if (isset($_POST["submit_add_product"])) {
                if (isset($_POST["category"]) === $products->category) {
                    $this->$error = CRUD_UNABLE_TO_ADD;
                    header('location: ' . URL . 'products');
                } else if (isset($_POST["SKU"]) === $products->SKU) {
                    $this->$error = CRUD_UNABLE_TO_ADD;
                    header('location: ' . URL . 'products');
                } else if (isset($_POST["manufacturer_name"]) === $products->manufacturer_name) {
                    $this->$error = CRUD_UNABLE_TO_ADD;
                    header('location: ' . URL . 'products');
                } else if (isset($_POST["product_name"]) === $products->product_name) {
                    $this->$error = CRUD_UNABLE_TO_ADD;
                    header('location: ' . URL . 'products');
                } else if (isset($_POST["product_model"]) === $products->product_model) {
                    $this->$error = CRUD_UNABLE_TO_ADD;
                    header('location: ' . URL . 'products');
                } else if (isset($_POST["price"]) === $products->price) {
                    $this->$error = CRUD_UNABLE_TO_ADD;
                    header('location: ' . URL . 'products');
                } else if (isset($_POST["link"]) === $products->link) {
                    $this->$error = CRUD_UNABLE_TO_ADD;
                    header('location: ' . URL . 'products');
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
            header('location: ' . URL . 'products');
            }
        }

        public function updateProduct()
        {
            // if we have POST data to create a new song entry
            if (isset($_POST["update_product"])) {
                $this->product_model->updateProduct($_POST["category"], $_POST["SKU"], $_POST["manufacturer_name"], $_POST["product_name"], $_POST["product_model"], $_POST["price"], $_POST["link"], $_POST["product_id"]);
            }

            // where to go after song has been added
            header('location: ' . URL . 'products');
        }

        public function deleteProduct($product_id)
        {
            $amount_of_products = $this->product_model->getAmountOfProducts();
            if ($_POST[$product_id] <= $amount_of_products) {
                if (isset($product_id)) {
                    $this->product_model->deleteProduct($product_id);
                    header('location: ' . URL . 'products');
                }
            }
            else {
                $this->$error = CRUD_UNABLE_TO_DELETE;
                header('location: ' . URL . 'products');
            }

        }
        
        function reports()
        {
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/notavailable.php';
            require APP . 'view/_templates/footer.php';
        }
}
