<?php

/**
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Products extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();

        // this controller should only be visible/usable by logged in users, so we put login-check here
        Auth::handleLogin();
        
        Session::init();
        
    }
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/---/index
     */
    public function index()
    {
        $products = $this->product_model->getAllProducts();
        $amount_of_products = $this->product_model->getAmountOfProducts();
        require APP . 'view/_templates/header.php';
        require APP . 'view/products/index.php';
        require APP . 'view/_templates/footer.php';
    }
    
    public function search()
    {
        if (isset($_POST["search_products"])) {
            $products = $this->product_model->searchProducts($_POST["search_products"]);
            $amount_of_products = $this->product_model->getAmountOfProductResults();
                require APP . 'view/_templates/header.php';
                require APP . 'view/products/search.php';
                require APP . 'view/_templates/footer.php';
        }
        else {
            //fall back
            header('location: ' . URL . 'products');
        }
    }

    public function edit($product_id)
    {
        // $amount_of_products = $this->product_model->getAmountOfProducts();
        // if we have an id of a song that should be edited
        if (isset($product_id)) {
            // do getProduct() in product_model/product_model.php
            $products = $this->product_model->getProduct($product_id);

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $song easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/products/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to songs index page (as we don't have a song_id)
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
