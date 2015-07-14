<?php

/*
 * Catalogue Controller for public site
 */

class Catalogue extends PublicController {
    
    /**
     * Construct this object by extending the basic Controller class
     */
    function __construct()
    {
        parent::__construct();
        $this->branch_model = $this->loadModel('Branch');
        $this->misc_model = $this->loadModel('Misc');
        $this->catalogue_model = $this->loadModel('Catalogue');
        $this->product_model = $this->loadModel('Product');
        $this->category_model = $this->loadModel('Category');
    }
    
    function index()
    {
        $latest_prod_time = $this->product_model->getLatestTime();
        $product_count = $this->product_model->countProducts();
        $products = $this->product_model->getAllProducts();
        $manufacturers = $this->product_model->getAllManufacturers();
        require VIEWS_PATH . 'CRM/public/header.php';
        require VIEWS_PATH . 'CRM/public/index.php';
        require VIEWS_PATH . 'CRM/public/footer.php';
    }
    
    function fetch($p)
    {
        if (isset($p)) {
            switch ($p) {
                case 'products':
                    $this->product_model->getAllProducts();
                    require VIEWS_PATH . 'CRM/public/products.php';
                    break;
                default :
                    echo 'Not Yet Available.';
            }
        }
    }
    
    function action()
    {
        if (isset($_POST['set_feedback'])) {
            $a = $this->catalogue_model->setFeedback(
                    RANDOM_NUMBER, // -- > for Feedback No.
                    $_POST['first_name'],
                    $_POST['last_name'],
                    $_POST['middle_name'],
                    $_POST['email'],
                    $_POST['feedback_content']
                    );
            if ($a) {
                header('location: ' . URL);
            } else {
                header('location: ' . URL);
            }
        }
    }
    
}
