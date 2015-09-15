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
    
    function support()
    {
        $sys = $this->config->loadSysConfig();
        $sys_contact = $this->config->loadSysConfig('contacts');
        if (isset($_POST['set_feedback'])) {
            $a = $this->catalogue_model->setFeedback(
                    RANDOM_NUMBER, // -- > for Feedback No.
                    $_POST['type'],
                    $_POST['priority'],
                    $_POST['name'],
                    $_POST['email'],
                    $_POST['feedback_content']
                    );
            if ($a == true) {
                header('location: ' . URL);
            } else {
                require VIEWS_PATH . 'CRM/public/feedback_form.php';
            }
        } else {
            require VIEWS_PATH . 'CRM/public/feedback_form.php';
            exit;
        }
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
                    return 'Not Yet Available.';
            }
        }
    }
    
}
