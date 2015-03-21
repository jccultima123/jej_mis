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
    }
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/---/index
     */
    public function index()
    {
        if (isset($_SESSION['logged_in'])) {
            $products = $this->products->getAllProducts();
            $amount_of_products = $this->products->getAmountOfProducts();
            require APP . 'view/_templates/header.php';
            require APP . 'view/products/index.php';
        } else {
            // the user is not logged in. you can do whatever you want here.
            // for demonstration purposes, we simply show the "you are not logged in" view.
            require APP . 'view/_templates/login_header.php';
            require APP . 'view/_templates/login.php';
        }
        require APP . 'view/_templates/footer.php';
    }
    
    public function addProduct()
    {
        // if we have POST data to create a new song entry
        if (isset($_POST["submit_add_product"])) {
            // ADD THIS in model/model.php
            $this->products->addProduct($_POST["category"], $_POST["SKU"], $_POST["product_name"], $_POST["product_model"], $_POST["manufacturer_name"], $_POST["price"], $_POST["link"]);
        }

        // where to go after song has been added
        header('location: ' . URL . 'products/index');
    }
    
    public function deleteProduct($product_id)
    {
        // if we have an id of a song that should be deleted
        if (isset($product_id)) {
            // do deleteSong() in model/model.php
            $this->products->deleteSong($product_id);
        }

        // where to go after song has been deleted
        header('location: ' . URL . 'songs/index');
    }

    public function editProduct($product_id)
    {
        // if we have an id of a song that should be edited
        if (isset($product_id)) {
            // do getProduct() in model/model.php
            $tb_product = $this->products->getProduct($product_id);

            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $song easily
            require APP . 'view/_templates/header.php';
            require APP . 'view/products/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to songs index page (as we don't have a song_id)
            header('location: ' . URL . 'products/index');
            $error = '<h4>Unable to edit.</h4>';
        }
    }

}
