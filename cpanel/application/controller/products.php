<?php

class Products extends Controller
{
    function __construct()
    {
        parent::__construct();

        // this controller should only be visible/usable by logged in users, so we put login-check here
        Auth::handleLogin();
        $this->product_model = $this->loadModel('Product');
    }
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/---/index
     */
    public function index()
    {
        //load controllers and models
        $products = $this->product_model->getAllProducts();
        $manufacturers = $this->product_model->getAllManufacturers();
        $categories = $this->product_model->getCategories();
        $product_by_category = $this->product_model->getProductbyCategory();
        $amount_of_products = $this->product_model->getAmountOfProducts();
        
        //load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/products/index.php';
        require APP . 'view/_templates/footer.php';
    }
    
    public function search()
    {
        $search = $_POST["search_products"];
        $products = $this->product_model->searchProducts($search);
        if (isset($_POST["search_products"])) {
            //$amount_of_products = $this->product_model->getAmountOfProductResults();
                require APP . 'view/_templates/header.php';
                require APP . 'view/products/index.php';
                require APP . 'view/_templates/footer.php';
        }
        else {
            //fall back
            header('location: ' . URL . 'products');
        }
    }

    public function edit($product_id)
    {
        $categories = $this->product_model->getCategories();
        if (isset($product_id)) {
            $products = $this->product_model->getProduct($product_id);
            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar
            require APP . 'view/products/edit.php';
        } else {
            $this->$error = CRUD_UNABLE_TO_EDIT;
            header('location: ' . URL . 'products');
        }
    }
    
    public function details($product_id)
    {
        $categories = $this->product_model->getCategories();
        if (isset($product_id)) {
            $products = $this->product_model->getProduct($product_id);
            require APP . 'view/products/details.php';
        } else {
            $this->$error = CRUD_UNABLE_TO_EDIT;
            header('location: ' . URL . 'products');
        }
    }
    
    /** CRUD ACTIONS **/
    
    public function add()
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
    
    public function update()
    {
        // if we have POST data to create a new song entry
        if (isset($_POST["update_product"])) {
            $this->product_model->updateProduct($_POST["category"], $_POST["SKU"], $_POST["manufacturer_name"], $_POST["product_name"], $_POST["product_model"], $_POST["price"], $_POST["link"], $_POST["product_id"]);
        }

        // where to go after song has been added
        header('location: ' . URL . 'products');
    }
    
    public function delete($product_id)
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

}
