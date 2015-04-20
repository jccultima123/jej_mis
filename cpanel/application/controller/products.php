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
        $products = $this->model->getAllProducts();
        $amount_of_products = $this->model->getAmountOfProducts();
        require APP . 'view/_templates/header.php';
        require APP . 'view/products/index.php';
        require APP . 'view/_templates/footer.php';
    }
    
    public function add()
    {
        $products = $this->model->getAllProducts();
        // if we have POST data to create a new song entry
        if (isset($_POST["submit_add_product"])) {
            if (isset($_POST["category"]) === $products->category) {
                $error = CRUD_UNABLE_TO_ADD;
                header('location: ' . URL . 'products');
            } else if (isset($_POST["SKU"]) === $products->SKU) {
                $error = CRUD_UNABLE_TO_ADD;
                header('location: ' . URL . 'products');
            } else if (isset($_POST["product_name"]) === $products->product_name) {
                $error = CRUD_UNABLE_TO_ADD;
                header('location: ' . URL . 'products');
            } else if (isset($_POST["product_model"]) === $products->product_model) {
                $error = CRUD_UNABLE_TO_ADD;
                header('location: ' . URL . 'products');
            } else if (isset($_POST["manufacturer_name"]) === $products->manufacturer_name) {
                $error = CRUD_UNABLE_TO_ADD;
                header('location: ' . URL . 'products');
            } else if (isset($_POST["price"]) === $products->price) {
                $error = CRUD_UNABLE_TO_ADD;
                header('location: ' . URL . 'products');
            } else if (isset($_POST["link"]) === $products->link) {
                $error = CRUD_UNABLE_TO_ADD;
                header('location: ' . URL . 'products');
            } else {
                // ADD THIS in model/model.php
                $this->model->addProduct(
                        $_POST["category"],
                        $_POST["SKU"],
                        $_POST["product_name"],
                        $_POST["product_model"],
                        $_POST["manufacturer_name"],
                        $_POST["price"],
                        $_POST["link"]);
            }
        //$message = CRUD_ADDED;
        // where to go after song has been added
        header('location: ' . URL . 'products');
        }
    }
    
    public function delete($product_id)
    {
        // if we have an id of a song that should be deleted
        if (isset($product_id)) {
            // do deleteSong() in model/model.php
            $this->model->deleteSong($product_id);
            header('location: ' . URL . 'products');
        }
        else {
            $error = CRUD_UNABLE_TO_DELETE;
            header('location: ' . URL . 'products');
        }

    }

    public function edit($product_id)
    {
        $amount_of_products = $this->model->getAmountOfProducts();
        // if we have an id of a song that should be edited
        if (isset($product_id) <= $amount_of_products ) {
            // do getProduct() in model/model.php
            $products = $this->model->getProduct($product_id);

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $song easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/products/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to songs index page (as we don't have a song_id)
            $error = CRUD_UNABLE_TO_EDIT;
            header('location: ' . URL . 'products');
        }
    }

}
