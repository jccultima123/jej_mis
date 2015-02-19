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
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/---/index
     */
    public function index()
    {
        // getting all songs and amount of songs
        $products = $this->model->getAllProducts();
        $amount_of_products = $this->model->getAmountOfProducts();

       // load views. within the views we can echo out $songs and $amount_of_songs easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/products/index.php';
        require APP . 'view/_templates/footer.php';
    }
    
    public function deleteProduct($product_id)
    {
        // if we have an id of a song that should be deleted
        if (isset($product_id)) {
            // do deleteSong() in model/model.php
            $this->model->deleteSong($product_id);
        }

        // where to go after song has been deleted
        header('location: ' . URL . 'songs/index');
    }

    public function editProduct($product_id)
    {
        // if we have an id of a song that should be edited
        if (isset($product_id)) {
            // do getProduct() in model/model.php
            $tb_product = $this->model->getProduct($product_id);

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
